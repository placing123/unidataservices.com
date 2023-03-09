<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Custom

{

	public function __construct()

	{

			$this->CI = &get_instance();

	}

	

	public function session_check()

	{

		$sess = $this->CI->session->userdata('admin_sess');

		if(!empty($sess))

		{

			// redirect(base_url('dashboard'));

		}

		else

		{

			redirect(base_url('secure-login'));

		}

	}

	

	public function pic_upload($img)

	{

		$config['upload_path']          = './uploads/pictures/';

		$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG';

		$config['max_size']             = 307200; //3MB

		$config['encrypt_name']			= TRUE;



                $this->CI->load->library('upload', $config);



                if ( ! $this->CI->upload->do_upload($img))

                {

                        $error = $this->CI->upload->display_errors();

						print_r($error); die;

                }

                else

                {

                        $data = $this->CI->upload->data();

						return "uploads/pictures/".$data['file_name'];

                }

	}



    public function agreement_upload($img)

	{

		$config['upload_path']          = './admin_assets/signpdf/';

		$config['allowed_types']        = 'pdf';

		$config['max_size']             = 307200; //3MB

		$config['encrypt_name']			= TRUE;



                $this->CI->load->library('upload', $config);



                if ( ! $this->CI->upload->do_upload($img))

                {

                        $error = $this->CI->upload->display_errors();

						print_r($error); die;

                }

                else

                {

                        $data = $this->CI->upload->data();

						return "uploads/pictures/".$data['file_name'];

                }

	}




	public function send_mobile_otp($mobile)

    {

        $otp = rand(1000,9999);

        $username = "Owsompay3210";

        $smstype = "TRANS";

        //Your authentication key

        $apikey = "e599ee04-e770-4d14-8d43-23698da4de4f";

        //Multiple mobiles numbers separated by comma

        $mobileNumber = $mobile;

        //Sender ID,While using route4 sender id should be 6 characters long.

        $senderId = "OWSMPY";

        //Your message to send, Add URL encoding here.

        $message = "Your Spares Engineer request for OTP. YOUR ONE TIME PASSWORD IS ".$otp;

        //Define route 

       

        

        //Prepare you post parameters

        $postData = array(

            'apikey' => $apikey,

            'numbers' => $mobileNumber,

            'message' => $message,

            'sendername' => $senderId,

            'smstype' => $smstype,

            'username' => $username

        );

        //API URL

        $url = "http://sms.cubetechsolutions.in/sendSMS";

        // init the resource

        $ch = curl_init();

        curl_setopt_array($ch, array(

            CURLOPT_URL => $url,

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_POST => true,

            CURLOPT_POSTFIELDS => $postData

            //,CURLOPT_FOLLOWLOCATION => true

        ));

        //Ignore SSL certificate verification

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //get response

        $output = curl_exec($ch);

        //Print error if any

        if (curl_errno($ch)) {

            echo 'error:' . curl_error($ch);

        }

        curl_close($ch);

        return $otp;

	}

    
	public function excel_upload($img)

	{

		$config['upload_path']          = './uploads/pictures/';

		$config['allowed_types']        = 'xlsx|csv';

		$config['max_size']             = 307200; //3MB

		$config['encrypt_name']			= TRUE;



                $this->CI->load->library('upload', $config);



                if ( ! $this->CI->upload->do_upload($img))

                {

                        $error = $this->CI->upload->display_errors();

						print_r($error); die;

                }

                else

                {

                        $data = $this->CI->upload->data();

						return $data['file_name'];

                }

	}

}

?>