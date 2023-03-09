<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        date_default_timezone_set('Asia/Kolkata');
    }
	
	public function index_post()
	{
	    $seller_id = $this->seller_data->seller_id;
        $seller_stock_id = $this->input->post('seller_stock_id');
        $part_code = $this->input->post('part_code');
        
        $this->form_validation->set_rules('seller_stock_id','seller_stock_id','trim|required',array('required'=>'Please Fill Seller Stock Id Field'));
        $this->form_validation->set_rules('part_code','part_code','trim|required',array('required'=>'Please Fill Part Code Field'));
        
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
            $part_code_date = $this->db->limit(1,0)->get_where('part_code',['ID'=>$seller_stock_id])->row();
            $update = [
                        'part_code' => $part_code,
                        'created_date' => $part_code_date->created_date,
                      ];
            
            $this->model->hdm_update_where('part_code',$update,['ID'=>$seller_stock_id]);
            
            if($seller_id)
            {
                $response = ['msg' => 'Updated Successfully'];

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