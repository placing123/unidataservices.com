<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
    }
	
	public function index_post()
	{
	    $seller_id = $this->seller_data->seller_id;
        $category_id = $this->input->post('category_id');
        $brand_id = $this->input->post('brand_id');
        $type_id = $this->input->post('type_id');
        $model_no = $this->input->post('model_no');
        
        $search_full_details = $this->model->hdm_get_where('full_details',['category_id'=>$category_id,'brand_id'=>$brand_id,'type_id'=>$type_id,'model_no'=>$model_no]);
        
        if(!empty($search_full_details))
        {
            $response = [];
            foreach($search_full_details as $row)
            {
                $seller_data = $this->model->hdm_get_where_limit('seller',['ID'=>$row->seller_id,'login_status'=>0],1);
                
                if(!empty($seller_data))
                {
                    $stock_name = $this->model->hdm_get_where_limit('stock',['ID'=>$row->stock_id,'category_id'=>$row->category_id],1);
                    $district_name = $this->model->hdm_get_where_limit('district',['ID'=>$seller_data['district_id'],'state_id'=>$seller_data['state_id']],1);
                    
                    $response[] = [
                                    'stock_name' => $stock_name['name'],
                                    'part_code'  => $row->part_code,
                                    'city_name'  => $district_name['district_name'],
                                  ];
                }
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