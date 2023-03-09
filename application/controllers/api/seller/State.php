<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
    }
	
	public function index_get()
	{
        $state = $this->model->hdm_get('state');

        if(!empty($state))
        {
            $response = [];
            foreach($state as $row)
            {
                $response[] = [
                                'id'      => intval($row->ID),
                                'name'    => $row->state_name,
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