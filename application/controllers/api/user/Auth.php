<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Auth extends BD_Controller {

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");
    }

    public function login_post()
    {
        $user_name = $this->post('user_name');
        $password = $this->post('password');
        
		$this->form_validation->set_rules('user_name','User Name','trim|required',array('required'=>'Please Fill User Name Field'));
		$this->form_validation->set_rules('password','Password','required|min_length[6]',
                                        array('required'=>'Please Fill Password Field','min_length'=>'Password Minimum 6 character'));

        if($this->form_validation->run()==false)
        {
            $errs = $this->form_validation->error_array();
            $errors = [];
            foreach($errs as $err){$errors [] = $err;}
            $invalidCredentials = ['msg'=>implode(',',$errors)];
            $this->set_response($invalidCredentials,422);
        }
        else
        {
            $ck_user_name = $this->model->hdm_get_where_limit('user',array('user_name'=>$user_name),1);

            if(!empty($ck_user_name))
            {
                if($password == $this->encryption->decrypt($ck_user_name['password']))
                {
                    $kunci = $this->config->item('thekey');
                    $token['user_id'] = $ck_user_name['ID'];
                    $token['user_name'] = $ck_user_name['user_name'];
                    $token['email'] = $ck_user_name['email'];
                    $token['type'] = 'user';
                    $date = new DateTime();
                    $token['iat'] = $date->getTimestamp();
                    $token['exp'] = $date->getTimestamp() + 3600*24*1825; //5 year
    
                    $token = JWT::encode($token,$kunci);
                    
                    $this->model->hdm_update_where('user',['token'=>$token],['ID'=>$ck_user_name['ID']]);
                    
                    $user_id = $ck_user_name['ID'];
                    
                    $total_amount = $this->db->select('SUM(amount) AS amount')
                                             ->where('user_id',$user_id)
                                             ->get('user_account')
                                             ->row('amount');
                    
                    $user_login =   [
                                        'name' => $ck_user_name['name'],
                                        'age' => intval($ck_user_name['age']),
                                        'country' => $ck_user_name['country'],
                                        'user_name' => $user_name,
                                        'user_id' => $ck_user_name['ID'],
                                        'email' => $ck_user_name['email'],
                                        'referral_id' => $ck_user_name['referral_id'],
                                        'total_amount' => intval($total_amount),
                                        'token' => $token,
                                    ];
    
                    $this->set_response($user_login, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response(['msg'=>'Please Enter Valid Password.'],422);
                }
            }
            else
            {
                $this->response(['msg'=>'Please Enter Valid User Name.'],422);
            }
        }
    }
    
    public function register_post()
    {
        $email = $this->post('email');
        $user_name = $this->post('user_name');
        $password = $this->post('password');
        $referral_code = $this->post('referral_code');
        
		$this->form_validation->set_rules('email','Email','trim|required|valid_emails|is_unique[user.email]',array('required'=>'Please Fill Email Field','is_unique'=>'This %s already exists.'));
		$this->form_validation->set_rules('user_name','User Name','trim|required|is_unique[user.user_name]',array('required'=>'Please Fill User Name Field','is_unique'=>'This %s already exists.'));
		$this->form_validation->set_rules('password','Password','required|min_length[6]',
                                        array('required'=>'Please Fill Password Field','min_length'=>'Password Minimum 6 character'));
                                        
        if($referral_code != '')
        {
            $this->form_validation->set_rules('referral_code','Referral Code','callback_referral_code_match');
        }
        else
        {
            $referral_code = '';
        }
                                        
        if($this->form_validation->run()==false)
        {
            $errs = $this->form_validation->error_array();
            $errors = [];
            foreach($errs as $err){$errors [] = $err;}
            $invalidCredentials = ['msg'=>implode(',',$errors)];
            $this->set_response($invalidCredentials,422);
        }
        else
        {
            $insert = [
                        'email' => $email,
                        'user_name' => $user_name,
                        'password' => $this->encryption->encrypt($password),
                        'referral_code' => $referral_code,
                      ];
                      
            $user_id = $this->model->hdm_live_id('user',$insert);
            
           /* if($referral_code != '')
            {
                $user_account = [
                                    'user_id' => $user_id,
                                    'amount' => '20',
                                    'status' => 'Reference',
                                    'date_time' => date('Y-m-d H:i:s'),
                                ];
                                
                $this->model->hdm_live_id('user_account',$user_account);
                
                $use_referral_code_data = $this->db->get_where('user',['referral_id'=>$referral_code])->row('ID');
                
                $use_reference_code = [
                                        'user_id' => $use_referral_code_data,
                                        'amount' => '20',
                                        'status' => 'Reference',
                                        'date_time' => date('Y-m-d H:i:s'),
                                      ];
                                
                $this->model->hdm_live_id('user_account',$use_reference_code);
            }*/
            
            $kunci = $this->config->item('thekey');
            $token['user_id'] = $user_id;
            $token['user_name'] = $user_name;
            $token['email'] = $email;
            $token['type'] = 'user';
            $date = new DateTime();
            $token['iat'] = $date->getTimestamp();
            $token['exp'] = $date->getTimestamp() + 3600*24*1825; //5 year

            $token = JWT::encode($token,$kunci);
            
            $referral_id = strtoupper(substr($user_name, 0, 3)).$user_id.rand(9999,99999);
            
            $this->model->hdm_update_where('user',['referral_id'=>$referral_id,'token'=>$token],['ID'=>$user_id]);
            
            $total_amount = $this->db->query("SELECT SUM(amount) AS amount FROM user_account WHERE user_id = $user_id")->row('amount');
            
            $user_login =   [
                                'name' => "",
                                'age' => intval(0),
                                'country' => "",
                                'user_id' => $user_id,
                                'user_name' => $user_name,
                                'email' => $email,
                                'referral_id' => $referral_id,
                                'total_amount' => intval($total_amount),
                                'token' => $token,
                            ];

            $this->set_response($user_login, REST_Controller::HTTP_OK);
        }
    }
    
    public function referral_code_match($referral_code)
    {
        $ck_user_name = $this->model->hdm_get_where_limit('user',array('referral_id'=>$referral_code),1);
        
        if(!empty($ck_user_name))
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('referral_code_match', 'Invalid Referral Code');
            return false;
        }
    }
}