<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_detail extends BD_Controller 
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
        $seller_stock_id = $this->input->post('seller_stock_id');

        $seller_stock = $this->model->hdm_get_where('seller_stock',['category_id'=>$category_id,'ID'=>$seller_stock_id]);
        
        if(!empty($seller_stock))
        {
            $response = [];
            foreach($seller_stock as $row)
            {
                $stock = $this->db->get_where('stock',['category_id'=>$category_id,'ID'=>$row->stock_id]);
                
                $response = [
                                //'seller_stock_id'      => intval($row->ID),
                                'stock_name'    => $stock->row('name'),
                                'part_code'     => $row->part_code,
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
?>