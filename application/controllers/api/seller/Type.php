<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
    }
	
	public function index_post()
	{
	    $category = $this->input->post('category_id');
	    $brand = $this->input->post('brand_id');
	    if($category!='' && $brand!='')
	    {
	        $type = $this->db->get_where('type',['category_id'=>$category,'brand_id'=>$brand])->result();

            if(!empty($type))
            {
                $response = [];
                foreach($type as $row)
                {
                    $response[] = [
                                    'id'      => intval($row->ID),
                                    'name'    => $row->name,
                                  ];
                }
    
                $this->set_response($response, REST_Controller::HTTP_OK);
            }
            else
            {
                $response = ['msg' => 'Data Not Found'];
    
                $this->set_response($response, REST_Controller::HTTP_OK);
            }    
	    }
	    else
	    {
	        $this->set_response(['msg'=>'Choose Category and Brand First'], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	    }
        
	}
	
		public function add_post()
	{
	    $category_id = $this->input->post('category_id');
	     $type = $this->input->post('type_name');
	    
	    if($category_id && $type !='')
	    {
	         $data = array(  
	              'category_id'     =>  $category_id,
	               'name'     =>  $type,  
	              
	             
	                 );  
        //insert data into database table.  
       

            if(!empty($data))
            {
                 $this->db->insert('type',$data);  
                 $response = ['msg' => 'Data Added Succesfully'];
    
                $this->set_response($response, REST_Controller::HTTP_OK);
            }
            else
            {
                $response = ['msg' => 'Data Not Found'];
    
                $this->set_response($response, REST_Controller::HTTP_OK);
            }    
	    }
	    else
	    {
	        $this->set_response(['msg'=>'Choose Category First'], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	    }
        
	}
	
		public function edit_post()
	{
	    $category = $this->input->post('category_id');
	    $type_id = $this->input->post('type_id');
	    $type = $this->input->post('type_name');
	    if($category && $type && $type_id !='')
	    {
	         $data = array(  
	              'category_id'     =>  $category,
	               'name'     =>  $type,  
	              
	             
	                 );  
        //insert data into database table.  
       

            if(!empty($data))
            {
                $this->db->where('id', $type_id);
                
                 $this->db->update('type',$data);  
                 $response = ['msg' => 'Data Updated Succesfully'];
    
                $this->set_response($response, REST_Controller::HTTP_OK);
            }
            else
            {
                $response = ['msg' => 'Data Not Found'];
    
                $this->set_response($response, REST_Controller::HTTP_OK);
            }    
	    }
	    else
	    {
	        $this->set_response(['msg'=>'Choose Category First'], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	    }
        
	}
	
		public function delete_post()
	{
	    $category_id = $this->input->post('category_id');
	    $type_id = $this->input->post('type_id');
	    //$brand = $this->input->post('brand');
	    if($category_id && $type_id !='')
	    {
	           
            $data = $this->model->hdm_delete('type',['ID'=>$type_id]);
            if($data)
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
        else
	    {
	        $this->set_response(['msg'=>'Choose Category First'], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	    }
	}
	
	
}