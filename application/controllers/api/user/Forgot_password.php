<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Forgot_password extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        //$this->auth();
    }
	
	public function index_post()
	{
        $email = $this->post('email');

        $this->form_validation->set_rules('email','Email','trim|required|valid_email',
                                        array('required'=>'Please Fill Email Field'));
                                        
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
        
            $email = $this->db->or_where(['email'=>$email])->get('user');
            $email_val = $email->row();
    
            if(!empty($email_val))
            {
                $otp = $this->SMSApi_get('Forgot Password',$email_val->email);
    
                $token['user_id'] = $email_val->ID;
                $token['otp'] = $otp;
                $token['type'] = 'user_otp';
                $date = new DateTime();
                $token['iat'] = $date->getTimestamp();
                $token['exp'] = $date->getTimestamp() + 600; //10 min
    
    
                $kunci = $this->config->item('thekey');
    
                $otp_token = JWT::encode($token,$kunci );
    
                $new_upd = $this->db->where('ID',$email_val->ID)->update('user',['otp'=>$otp]);
    
                $response =   array(
                                        'otp' => $otp,
                                        'otp_token' => $otp_token,
                                   );
    
                $this->set_response($response, REST_Controller::HTTP_OK);
            }
            else
            {
            	$invalidemail = ['msg' => 'Please Enter Register Email'];
            	
                $this->response($invalidemail, 422);
            }  
        }
	}

    public function new_password_post()
    {
        $this->auth();

        $password = $this->input->post('password');
        $otp = $this->input->post('otp');
        $user_id = $this->user_otp->user_id;
        //$otp = $this->user_data->otp;
        
        $this->form_validation->set_rules('otp','OTP','required|numeric|exact_length[4]',
                                        array('required'=>'Please Fill OTP Field','exact_length'=>'Please Enter Valid OTP'));
                                        
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
        	$check_otp = $this->db->where(['ID'=>$user_id,'otp'=>$otp])->get('user')->row();

	        if(!empty($check_otp))
	        {
	            $new_upd = $this->db->where(['ID'=>$user_id,'otp'=>$otp])->update('user',['password'=>$this->encryption->encrypt($password)]);

	            if($new_upd)
	            {
	                $this->db->where('ID',$user_id)->update('user',['otp'=>'']);

	                $this->response(['msg'=>'Your Password has been changed successfully'],200);
	            }
	            else
	            {
	                $this->response(['msg'=>'Something went wrong'],422);
	            }
	        }
	        else
	        {
	        	$invalidemail = ['msg' => 'Please Enter Valid OTP'];
            	$this->response($invalidemail, 422);
	        }
        }
    }

    public function send_mail_post() 
    { 
        $from_email = "nishantsavani11@gmail.com"; 
        $to_email = "nishantsavani11@gmail.com"; 
   
        //Load email library 
        $this->load->library('email'); 
   
        $this->email->from($from_email, 'Your Name'); 
        $this->email->to($to_email);
        $this->email->subject('Email Test'); 
        $this->email->message('Testing the email class.'); 
   
        echo $this->email->send();
    } 
      
    public function SMSApi_get($subject,$email)
    {
        $otp        = rand(1000,9999);
        // $api_key    = '35FFD75FDA98CC';     //Your sms api key
        // $from       = 'OWSMPY';         //It may be your userid or your mobile number
        // $sms_text   = urlencode("Your JATS request for OTP. YOUR ONE TIME PASSWORD IS ".$otp);
        
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, "http://msg.ampala.in/app/smsapi/index.php?key=".$api_key."&campaign=10442&routeid=10&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_HEADER, 0);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_URL, "http://msg.ampala.in/app/smsapi/index.php");
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=10442&routeid=10&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
        // $response = curl_exec($ch);
    //  echo "JSON OTP Response : ".json_decode($response);
        // curl_close($ch);
        
        // Mail Otp
        $this->load->library('email');

        $config['protocol']  = 'smtp';
        $config['smtp_host'] = 'mail.sparesengineer.com';
        $config['smtp_port'] = '587';
        $config['smtp_user'] = 'shooter@sparesengineer.com';
        $config['smtp_from_name'] = 'Shooter Game';
        $config['smtp_pass'] = '2yJzXA^@8mbj';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';                         

        $this->email->initialize($config);
        
        $this->email->set_newline("\r\n");
        
        $this->email->from($config['smtp_user'], $config['smtp_from_name']);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message("<p>Hello Sir/Mam,<br>Your Shooter game request for OTP. YOUR ONE TIME PASSWORD IS <br><h2>".$otp."</h2>.<br><br> ThankYou<br>Shooter game</p>");

        $this->email->send();
        //echo $this->email->debugger();
        //die;
        return $otp;
    }
}