<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete_account extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
    }
	
	public function index_get()
	{
        $seller_id = $this->seller_data->seller_id;

        $seller = $this->model->hdm_update_where('seller',['token'=>'','login_status'=>'1'],['ID'=>$seller_id]);

        if($seller)
        {
            $response = ['msg' => 'Account Delete Successfully'];

            $this->set_response($response, REST_Controller::HTTP_OK);
        }
        else
        {
            $response = ['msg' => 'Something went wrong please try again'];

            $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
        }
        
	}
}