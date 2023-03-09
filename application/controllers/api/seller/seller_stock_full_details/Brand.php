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
	    $seller_id = $this->seller_data->seller_id;
	    $category_id = $this->input->post('category_id');
	    
        $brand = $this->model->hdm_get_where('brand',['status'=>'0','category_id'=>$category_id]);
        
        $total_count = $this->db->get_where('full_details',['seller_id'=>$seller_id,'category_id'=>$category_id,'status'=>'1'])->num_rows();

        if(!empty($brand))
        {
            $response = [];
            foreach($brand as $row)
            {
                $response[] = [
                                'brand_id'      => intval($row->ID),
                                'brand_name'    => $row->name,
                              ];
            }
            
            $data = [
                        'total_stock' => intval($total_count),
                        'brand' => $response,
                    ];

            $this->set_response($data, REST_Controller::HTTP_OK);
        }
        else
        {
            $response = ['msg' => 'Data Not Found'];

            $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
        }
        
	}
}