<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends BD_Controller 
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
	    if($category!='')
	    {
	        $brand = $this->db->get_where('brand',['category_id'=>$category])->result();

            if(!empty($brand))
            {
                $response = [];
                foreach($brand as $row)
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
	        $this->set_response(['msg'=>'Choose Category First'], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	    }
        
	}
	public function add_post()
	{
	    $category_id = $this->input->post('category_id');
	     $brand = $this->input->post('brand');
	    
	    if($category_id && $brand !='')
	    {
	         $data = array(  
	              'category_id'     =>  $category_id,
	               'name'     =>  $brand,  
	              
	             
	                 );  
        //insert data into database table.  
       

            if(!empty($data))
            {
                 $this->db->insert('brand',$data);  
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
	    $brand_id = $this->input->post('id');
	    $brand = $this->input->post('brand');
	    if($category && $brand && $brand_id !='')
	    {
	         $data = array(  
	              'category_id'     =>  $category,
	               'name'     =>  $brand,  
	              
	             
	                 );  
        //insert data into database table.  
       

            if(!empty($data))
            {
                $this->db->where('id', $brand_id);
                
                 $this->db->update('brand',$data);  
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
	    $brand_id = $this->input->post('id');
	    //$brand = $this->input->post('brand');
	    if($category_id && $brand_id !='')
	    {
	           
            $data = $this->model->hdm_delete('brand',['ID'=>$brand_id]);
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