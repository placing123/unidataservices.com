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

            $this->set_response($response, REST_Controller::HTTP_OK);
        }
        else
        {
            $response = ['msg' => 'Data Not Found'];

            $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
        }
        
	}
}