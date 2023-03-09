<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Already_exists extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        date_default_timezone_set('Asia/Kolkata');
    }
	
	public function index_post()
	{
	    $seller_id = $this->seller_data->seller_id;
	    
        $category_id = $this->input->post('category_id');
        $brand_id = $this->input->post('brand_id');
        $type_id = $this->input->post('type_id');
        $model_no = $this->input->post('model_no');
        
             $this->db->select('*');
            $this->db->where('seller_id',$seller_id);
            $this->db->where('status','1');
            $records =  $this->db->get('full_details')->result();

        
        $seller_stock = $this->model->hdm_get_where_order('full_details',['category_id'=>$category_id,'brand_id'=>$brand_id,'type_id'=>$type_id,'model_no'=>$model_no,'status'=>'1','seller_id'=>$seller_id],'ID','DESC');
        
        if(!empty($seller_stock))
        {
            $brand = $this->db->limit(1,0)->get_where('brand',['category_id'=>$category_id,'status'=>'0','ID'=>$seller_stock[0]->brand_id])->row();
            $type = $this->db->limit(1,0)->get_where('type',['category_id'=>$category_id,'status'=>'0','ID'=>$seller_stock[0]->type_id])->row();
           
            /*and part_code !=''*/
            $part_code_list = $this->db->query("select * from part_code where ID in (".$seller_stock[0]->part_code_ids.") ")->result_array(); 
            $part_code_data = [];
            foreach($part_code_list as $pcl)
            {
                $stock = $this->db->limit(1,0)->get_where('stock',['ID'=>$pcl['stock_id']])->row();
                $part_code_data[] = ['part_id'=>intval($pcl['ID']),'part_code'=>$pcl['part_code'],'stock_id'=>intval($pcl['stock_id']),'stock_name'=>$stock->name]; 
            }
            
            if(!empty($part_code_data))
            {
                $response =   [
                                'seller_stock_id'       => intval($seller_stock[0]->ID),
                                'brand_id'              => intval($seller_stock[0]->brand_id),
                                'brand_name'            => $brand->name,
                                'type_id'               => intval($seller_stock[0]->type_id),
                                'type_name'             => $type->name,
                                'model_no'              => $seller_stock[0]->model_no,
                                'is_already_exist'      => $records[0]->is_already_exist,
                                'part_code'             => $part_code_data,
                                'added_on'              => date_format(date_create($seller_stock[0]->created_at),'d-m-Y'),
                                'updated_no'            => date_format(date_create($seller_stock[0]->updated_at),'d-m-Y'),
                              ];
            }
            else
            {
                $response = [];

                //$this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
            }
            
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
        else
        {
            $response = [];

            $this->set_response($response, REST_Controller::HTTP_OK);
        }
	}
}