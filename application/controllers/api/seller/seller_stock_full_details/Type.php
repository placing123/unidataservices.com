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
	    $category_id = $this->input->post('category_id');
	    
        $type = $this->model->hdm_get_where('type',['status'=>'0','category_id'=>$category_id]);

        if(!empty($type))
        {
            $response = [];
            foreach($type as $row)
            {
                $response[] = [
                                'type_id'      => intval($row->ID),
                                'type_name'    => $row->name,
                              ];
            }

            $this->set_response($response, REST_Controller::HTTP_OK);
        }
        else
        {
            $response = ['msg' => 'Data Not Found'];

            $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
        }
        
	}
}