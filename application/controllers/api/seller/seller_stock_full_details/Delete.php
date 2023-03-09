<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends BD_Controller 
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
         $seller_stock_id = $this->input->post('seller_stock_id');
        
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
            $full_details = $this->db->limit(1,0)->get_where('full_details',['ID'=>$seller_stock_id])->row();    
            $part_code = $this->db->query("Delete from part_code where ID in (".$full_details->part_code_ids.")");
            $seller_stock_delete = $this->model->hdm_delete('full_details',['ID'=>$seller_stock_id]);
            
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