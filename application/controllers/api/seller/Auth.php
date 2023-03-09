<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;
class Auth extends BD_Controller {



    function __construct()

    {

        parent::__construct();

        date_default_timezone_set("Asia/Kolkata");

    }



    public function login_check_post()

    {

        $mobile_no = $this->post('mobile_no');

        $device_token = $this->post('device_token');

        

		$this->form_validation->set_rules('mobile_no','Mobile No','trim|required|regex_match[/^[6-9]{1}[0-9]{9}+$/]',array('required'=>'Please Fill Mobile No Field','regex_match'=>'Please Enter Valid Mobile No.'));



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

            $ck_mobile_no = $this->model->hdm_get_where_limit('seller',array('mobile_no'=>$mobile_no,'login_status'=>'0'),1);



            if(empty($ck_mobile_no))

            {

                $otp = $this->lib->send_mobile_otp($mobile_no);



                $seller_id = $this->model->hdm_live_id('seller',['mobile_no'=>$mobile_no,'otp'=>$otp,'device_token'=>$device_token]);



               $kunci = $this->config->item('thekey');

                $token['seller_id'] = $seller_id;

                $token['mobile_no'] = $mobile_no;

                $token['password'] = '';

                $token['otp'] = $otp;

                $token['mobile_verify'] = '0';

                $token['login_with_otp'] = '0';

                $token['type'] = 'login_seller';

                $date = new DateTime();

                $token['iat'] = $date->getTimestamp();

                $token['exp'] = $date->getTimestamp() + 600; //10 min


          
                // $token = JWT::encode($token,$kunci);
                $token = JWT::encode($token,$kunci);

                

                $seller_login =   [

                                    'login_with_otp'=> 0,

                                    'otp' => intval($otp),

                                    'token' => $token,

                                ];



                $this->set_response($seller_login, REST_Controller::HTTP_OK);

            }

            else

            {

                if($ck_mobile_no['mobile_verify'] == 0)

                {

                    $otp = $this->lib->send_mobile_otp($mobile_no);



                    $this->model->hdm_update_where('seller',['otp'=>$otp],['mobile_no'=>$mobile_no],['device_token'=>$device_token]);



                    $login_with_otp = 0;

                }

                else

                {

                    $login_with_otp = 1;

                 //  $otp = '0';
                   $otp=rand(1234,9999);

                }



                $kunci = $this->config->item('thekey');

                $token['seller_id'] = $ck_mobile_no['ID'];

                $token['mobile_no'] = $ck_mobile_no['mobile_no'];

                $token['password'] = $ck_mobile_no['password'];

                $token['otp'] = $otp;

                $token['mobile_verify'] = $ck_mobile_no['mobile_verify'];

                $token['login_with_otp'] = $login_with_otp;

                $token['type'] = 'login_seller';

                $date = new DateTime();

                $token['iat'] = $date->getTimestamp();

                $token['exp'] = $date->getTimestamp() + 600; //10 min



                $token = JWT::encode($token,$kunci);



                $seller_login =   [

                                    'login_with_otp'=> $login_with_otp,

                                    'otp' => intval($otp),

                                    'token' => $token,

                                ];



                $this->set_response($seller_login, REST_Controller::HTTP_OK);

            }

        }

    }


   



    public function otp_pass_check_post()

    {

        $this->auth();
        $otp_pass = $this->post('otp_pass');

        $seller_id = $this->seller_data->seller_id;

        $mobile_no = $this->seller_data->mobile_no;

        $password = $this->seller_data->password;

        $otp = $this->seller_data->otp;

        $mobile_verify = $this->seller_data->mobile_verify;

        $login_with_otp = $this->seller_data->login_with_otp;

        $type = $this->seller_data->type;



        if($login_with_otp == 0)

        {

            $this->form_validation->set_rules('otp_pass','OTP','trim|required|regex_match[/^[0-9]{4}+$/]',array('required'=>'Please Fill OTP Field','regex_match'=>'Please Enter Valid OTP.'));

        }

        else

        {

            $this->form_validation->set_rules('otp_pass','Password','trim|required',array('required'=>'Please Fill Password Field'));

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

            if($login_with_otp == 0)

            {

                if($otp_pass == $otp)

                {

                    $this->model->hdm_update_where('seller',['otp'=>''],['mobile_no'=>$mobile_no,'ID'=>$seller_id]);



                    $this->response(['msg'=>'Your OTP has been checked successfully','id'=>$seller_id],200);

                }

                else

                {

                    $this->response(['msg'=>'Please Enter Valid OTP.'],422);

                }

            }

            else

            {

                if($otp_pass == $this->encryption->decrypt($password))

                {

                    $seller_data = $this->model->hdm_get_where_limit('seller',array('ID'=>$seller_id),1);

                    $state_data = $this->model->hdm_get_where_limit('state',array('ID'=>$seller_data['state_id']),1);

                    $district_data = $this->model->hdm_get_where_limit('district',array('ID'=>$seller_data['district_id']),1);



                	$kunci = $this->config->item('thekey');

                    $token['seller_id'] = $seller_data['ID'];

                    $token['mobile_no'] = $seller_data['mobile_no'];

                    $token['type'] = 'seller';

                    $date = new DateTime();

                    $token['iat'] = $date->getTimestamp();

                    $token['exp'] = $date->getTimestamp() + 3600*24*1825; //5 year



                    $token = JWT::encode($token,$kunci);



                    $this->model->hdm_update_where('seller',['token'=>$token,'otp'=>'','mobile_verify'=>'1'],['mobile_no'=>$mobile_no,'ID'=>$seller_id,'login_status'=>'0']);

                    

                    

                    $response = [

                    				'seller_id' => $seller_data['ID'],

                    				'mobile_no' => $seller_data['mobile_no'],

                    				'profile_image' => $seller_data['profile_image'],

                    				'company_name' => $seller_data['company_name'],

                    				'owner_name' => $seller_data['owner_name'],

                    				'mobile_1' => $seller_data['mobile_1'],

                    				'mobile_whatsapp_1' => intval($seller_data['mobile_whatsapp_1']),

                    				'mobile_call_1' => intval($seller_data['mobile_call_1']),

                    				'mobile_2' => $seller_data['mobile_2'],

                    				'mobile_whatsapp_2' => intval($seller_data['mobile_whatsapp_2']),

                    				'mobile_call_2' => intval($seller_data['mobile_call_2']),

                    				'state_id' => intval($seller_data['state_id']),

                    				'state_name' => strval($state_data['state_name']),

                    				'district_id' => intval($seller_data['district_id']),

                    				'district_name' => strval($district_data['district_name']),

                    				'area' => $seller_data['area'],

                    				'address' => $seller_data['address'],

                    				'pincode' => $seller_data['pincode'],

                                    'is_profile_created' => intval($seller_data['is_profile_created']),

                    				'status' => intval($seller_data['status']),

                    				'created_on' => date_format(date_create($seller_data['created_date']),'d-m-Y'),

                                    'updated_on' => date_format(date_create($seller_data['updated_date']),'d-m-Y'),

                    				'token' => $token,

                    				'is_role'=>$seller_data['is_role'],

                                ];



                    $this->response($response,200);

                }

                else

                {

                    $this->response(['msg'=>'Please Enter Valid Password.'],422);

                }

            }

        }

    }



    public function create_password_post()

    {

    	$this->auth();



    	$seller_id = $this->seller_data->seller_id;

    	$password = $this->post('password');



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

        	$seller_data = $this->model->hdm_get_where_limit('seller',array('ID'=>$seller_id),1);

        	$state_data = $this->model->hdm_get_where_limit('state',array('ID'=>$seller_data['state_id']),1);

        	$district_data = $this->model->hdm_get_where_limit('district',array('ID'=>$seller_data['district_id']),1);



            $kunci = $this->config->item('thekey');

            $token['seller_id'] = $seller_data['ID'];

            $token['mobile_no'] = $seller_data['mobile_no'];

            $token['type'] = 'seller';

            $date = new DateTime();

            $token['iat'] = $date->getTimestamp();

            $token['exp'] = $date->getTimestamp() + 3600*24*1825; //5 year



            $token = JWT::encode($token,$kunci);



            $this->model->hdm_update_where('seller',['password'=>$this->encryption->encrypt($password),'token'=>$token,'mobile_verify'=>'1'],['ID'=>$seller_id]);

            

            $response = [
                            'seller_id'=>$seller_id,

            				'mobile_no' => $seller_data['mobile_no'],

            				'profile_image' => $seller_data['profile_image'],

            				'company_name' => $seller_data['company_name'],

            				'owner_name' => $seller_data['owner_name'],

            				'mobile_1' => $seller_data['mobile_1'],

            				'mobile_whatsapp_1' => intval($seller_data['mobile_whatsapp_1']),

            				'mobile_call_1' => intval($seller_data['mobile_call_1']),

            				'mobile_2' => $seller_data['mobile_2'],

            				'mobile_whatsapp_2' => intval($seller_data['mobile_whatsapp_2']),

            				'mobile_call_2' => intval($seller_data['mobile_call_2']),

            				'state_id' => intval($seller_data['state_id']),

            				'state_name' => strval($state_data['state_name']),

            				'district_id' => intval($seller_data['district_id']),

            				'district_name' => strval($district_data['district_name']),

            				'area' => $seller_data['area'],

            				'address' => $seller_data['address'],

            				'pincode' => $seller_data['pincode'],

            				'status' => intval($seller_data['status']),

            				'created_on' => date_format(date_create($seller_data['created_date']),'d-m-Y'),

                            'updated_on' => date_format(date_create($seller_data['updated_date']),'d-m-Y'),

            				'token' => $token,

                        ];



            $this->response($response,200);

        }

    }


    
    function send_password_otp_post(){
        
        $mobile_no = $this->input->post('mobile_no');
        $records = $this->db->get_where('seller',array('mobile_no'=>$mobile_no,'login_status'=>0))->result_array();
          if(sizeof($records) > 0){ 
            $otp = rand(123456,999999);

           $data['otp'] =  $otp;
           $data['id'] =$records[0]['ID'];

           

            $this->db->insert('otp',array('user_id'=> $data['id'],'otp'=>$otp));
            $this->response(['msg'=>'otp send to your mobile number '.$mobile_no,'data'=>$data],200);
        }else {
            $this->response(['msg'=>'Mobile number not exit','status'=>0],200);
        }
    }


    function change_password_post(){

        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');
        $update_data['password'] =  $this->encryption->encrypt($password);
        $this->db->where('ID',$user_id);
        $this->db->update('seller',$update_data);
        $this->response(['msg'=>'Password change successfully','status'=>1],200);

    }


    function verify_otp_post(){

        $user_id = $this->input->post('user_id');
        $otp = $this->input->post('otp');
        $wherearr1 = array('user_id'=>$user_id,'otp'=>$otp);
        $records = $this->db->get_where('otp',$wherearr1)->result_array();
       
            if(sizeof($records) > 0){ 
                $this->db->where('user_id',$user_id);
                $this->db->delete('otp');
                $this->response(['msg'=>'OTP verify successfully','status'=>1],200);
            }else{
                $this->response(['msg'=>'OTP mismatch','status'=>0],401);
            }
        

    }

    function login_otp_verify_post(){

        $this->auth();
        $otp_pass = $this->input->post('otp');
       
        $otp = $this->seller_data->otp;
        if($otp_pass == $otp) {
            $this->response(['msg'=>'OTP verify successfully','status'=>1],200);
        }
        else{
            $this->response(['msg'=>'OTP mismatch','status'=>0],401);
        }
    


    }


}

