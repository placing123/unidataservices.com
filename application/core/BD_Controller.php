<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/BeforeValidException.php';
require_once APPPATH . '/libraries/ExpiredException.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';
use \Firebase\JWT\JWT;

class BD_Controller extends REST_Controller
{
    private $user_credential;

    public function auth()
    {
        $headers = $this->input->get_request_header('Authorization');
        $kunci = $this->config->item('thekey'); //secret key for encode and decode
        $token= "token";
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers , $matches)) {
                $token = $matches[1];
            }
        }

        try {
           $decoded = JWT::decode($token, $kunci, array('HS256'));
            
            if($decoded->type == "user")
            {
                $this->user_data = $decoded;

                $val = $this->model->hdm_get_where('user',array('ID'=>$decoded->user_id)); 
                // echo $token;

                if($token!=$val[0]->token)
                {
                    $invalid = ['msg' => 'Invalid token']; //Respon if credential invalid
                    $this->response($invalid, 401);//401    
                }
            }
            else if($decoded->type == "user_otp")
            {
                $this->user_otp = $decoded;
            }
            
        } catch (Exception $e) {
            $invalid = ['msg' => $e->getMessage()]; //Respon if credential invalid
            $this->response($invalid, 401);//401
        }
    }
}