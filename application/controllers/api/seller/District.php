<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
    }
	
	public function index_post()
	{
        $state_id = $this->input->post('state_id');

        $district = $this->model->hdm_get_where('district',['state_id'=>$state_id]);

        if(!empty($district))
        {
            $response = [];
            foreach($district as $row)
            {
                $response[] = [
                                'id'      => intval($row->ID),
                                'name'    => $row->district_name,
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