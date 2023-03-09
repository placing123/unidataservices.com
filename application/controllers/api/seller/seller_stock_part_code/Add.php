<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

       // $this->load->Model('Common');
        $this->auth();
        date_default_timezone_set('Asia/Kolkata');
    }
	
	public function index_post()
	{
	    
	    $seller_id = $this->seller_data->seller_id;
        $category_id = $this->input->post('category_id');
        $stock_id = $this->input->post('stock_id');
        $part_code = $this->input->post('part_code');
        
           
              $this->db->select('*');
             $this->db->where('seller.ID',$seller_id);
             $this->db->where('login_status','0');
             $seller_records =  $this->db->get('seller')->result();
          
        $this->form_validation->set_rules('category_id','category_id','trim|required',array('required'=>'Please Fill Category Id Field'));
        $this->form_validation->set_rules('stock_id','stock_id','trim|required',array('required'=>'Please Fill Stock Id Field'));
        $this->form_validation->set_rules('part_code','part_code','trim|required|callback_part_code_match',array('required'=>'Please Fill Part Code Field'));
        
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
                        'seller_id' => $seller_id,
                        'stock_id' => $stock_id,
                        'category_id' => $category_id,
                        'part_code' => $part_code,
                        'type' => '1',
                        'state_id'=>$seller_records[0]->state_id,
                        'district_id'=>$seller_records[0]->district_id,
                       
                      ];
            $seller_id = $this->model->hdm_live_id('part_code',$insert);
            
            if($seller_id)
            {
                $response = ['msg' => 'Added Successfully'];

                $this->set_response($response, 200);
            }
            else
            {
                $response = ['msg' => 'Something went wrong please try again'];

                $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
	}
	
	public function part_code_match()
	{
	    $part_code = $this->input->post('part_code');
	    $seller_id = $this->seller_data->seller_id;
	    $category_id = $this->input->post('category_id');
	    $stock_id = $this->input->post('stock_id');
	     
	    $seller_stock = $this->model->hdm_get_where('part_code',['category_id'=>$category_id,'status'=>'1','stock_id'=>$stock_id,'seller_id'=>$seller_id,'part_code'=>$part_code,'type'=>'1']);
	    
	    if(count($seller_stock) < 1)
	    {
	        return true;
	    }
	    else
	    {
	        $this->form_validation->set_message('part_code_match', 'Already exists part code');
	        return false;
	    }
	}
}