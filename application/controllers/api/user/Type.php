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
}