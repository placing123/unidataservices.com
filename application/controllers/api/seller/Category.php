<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
    }
	
	public function index_get()
	{
        $state = $this->model->hdm_get_where('category',['status'=>'0']);

        if(!empty($state))
        {
            $response = [];
            foreach($state as $row)
            {
                $response[] = [
                                'category_id'      => intval($row->ID),
                                'category_name'    => $row->name,
                              ];
            }
            
            $slider = [
                        [
                            'image' => base_url('admin_assets/img/slider/silder-1.png'),
                            'url' => 'https://www.google.com/',
                        ],
                        [
                            'image' => base_url('admin_assets/img/slider/silder-2.png'),
                            'url' => 'https://www.google.com/',
                        ],
                        [
                            'image' => base_url('admin_assets/img/slider/silder-3.png'),
                            'url' => 'https://www.google.com/',
                        ],
                        [
                            'image' => base_url('admin_assets/img/slider/silder-4.jpg'),
                            'url' => 'https://www.google.com/',
                        ]
                     ];
            
            $data = [
                        'slider' => $slider,
                        'category' => $response,
                    ];

            $this->set_response($data, REST_Controller::HTTP_OK);
        }
        else
        {
            $response = ['msg' => 'Data Not Found'];

            $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
        }
        
	}
	
		public function add_post()
	{
	   
	     $category = $this->input->post('category');
	    
	    if($category !='')
	    {
	         $data = array(  
	              
	               'name'     =>  $category,  
	              
	             
	                 );  
        //insert data into database table.  
       

            if(!empty($data))
            {
                 $this->db->insert('category',$data);  
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
	        $this->set_response(['msg'=>'Enter Category Name First'], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	    }
        
	}
		public function edit_post()
	{
	    $category = $this->input->post('category');
	    $category_id = $this->input->post('id');
	    
	    if($category && $category_id !='')
	    {
	         $data = array(  
	             
	               'name'     =>  $category,  
	              
	             
	                 );  
        //insert data into database table.  
       

            if(!empty($data))
            {
                $this->db->where('id', $category_id);
                
                 $this->db->update('category',$data);  
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
	        $this->set_response(['msg'=>'Enter Category Name First'], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	    }
        
	}
	public function delete_post()
	{
	    $category_id = $this->input->post('category_id');
	   
	    if($category_id !='')
	    {
	           
            $data = $this->model->hdm_delete('category',['ID'=>$category_id]);
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