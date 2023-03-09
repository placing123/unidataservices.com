<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deleteall extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
    }
	
	public function index_post()
	{
	    $seller_id = $this->seller_data->seller_id;
        $seller_stock_id = explode(",", $this->input->post('seller_stock_id'));
        
        $this->form_validation->set_rules('seller_stock_id','seller_stock_id','trim|required',array('required'=>'Please Fill Seller Stock Id Field'));
        
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
            $seller_stock_delete = '';
            foreach($seller_stock_id as $ssid)
            {
                $seller_stock_delete = $this->model->hdm_delete('part_code',['ID'=>$ssid]);
            }
            
            if($seller_stock_delete)
            {
                $response = ['msg' => 'Delete Successfully'];

                $this->set_response($response, 200);
            }
            else
            {
                $response = ['msg' => 'Something went wrong please try again'];

                $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
	}
}