<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_profile extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
    }
	
	public function index_get()
	{
        $user_id = $this->user_data->user_id;

        $user_data = $this->model->hdm_get_where_limit('user',array('ID'=>$user_id,'login_status'=>'0'),1);

        if($user_data)
        {
            $this->load->library('pdf');

            $html_content = $this->load->view('download_profile', $user_data);
            $this->pdf->loadHtml($html_content);
            $this->pdf->render();
            $this->pdf->stream("".$user_id.".pdf", array("Attachment"=>0));

            $response = ['msg' => 'Profile Download Successfully'];

            $this->set_response($response, REST_Controller::HTTP_OK);
        }
        else
        {
            $response = ['msg' => 'Something went wrong please try again'];

            $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
        }
        
	}
}