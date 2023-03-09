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
}