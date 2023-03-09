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
        $part_code = $this->input->post('part_code');
        $stock_id = $this->input->post('stock_id');
        
        $search_part_code = $this->model->hdm_get_where('part_code',['part_code'=>$part_code,'status'=>'1','stock_id'=>$stock_id]);
        
        if(!empty($search_part_code))
        {
            $response = [];
            foreach($search_part_code as $row)
            {
                $seller_data = $this->model->hdm_get_where_limit('seller',['ID'=>$row->seller_id,'login_status'=>0],1);
                
                if(!empty($seller_data))
                {
                    $stock_name = $this->model->hdm_get_where_limit('stock',['ID'=>$row->stock_id,'category_id'=>$row->category_id],1);
                    $district_name = $this->model->hdm_get_where_limit('district',['ID'=>$seller_data['district_id'],'state_id'=>$seller_data['state_id']],1);
                    
                    $response[] = [
                                    'seller_stock_id' => intval($row->ID),
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