<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_list extends BD_Controller 
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
        
        $seller_stock = $this->model->hdm_get_where_order('full_details',['category_id'=>$category_id,'status'=>'1','seller_id'=>$seller_id],'ID','DESC');
        
        $total_count = count($seller_stock);
        
        if(!empty($seller_stock))
        {
            $response = [];
            foreach($seller_stock as $row)
            {
                $brand = $this->db->limit(1,0)->get_where('brand',['category_id'=>$category_id,'status'=>'0','ID'=>$row->brand_id])->row();
                $type = $this->db->limit(1,0)->get_where('type',['category_id'=>$category_id,'status'=>'0','ID'=>$row->type_id])->row();
               
                /*and part_code !=''*/
                $part_code_list = $this->db->query("select * from part_code where ID in (".$row->part_code_ids.") ")->result_array(); 
                $part_code_data = [];
                foreach($part_code_list as $pcl)
                {
                    $stock = $this->db->limit(1,0)->get_where('stock',['ID'=>$pcl['stock_id']])->row();
                    $part_code_data[] = ['part_id'=>intval($pcl['ID']),'part_code'=>$pcl['part_code'],'stock_id'=>intval($pcl['stock_id']),'stock_name'=>$stock->name]; 
                }
                
                if(!empty($part_code_data))
                {
                    $response[] = [
                                    'seller_stock_id'       => intval($row->ID),
                                    'brand_id'              => intval($row->brand_id),
                                    'brand_name'            => $brand->name,
                                    'type_id'               => intval($row->type_id),
                                    'type_name'             => $type->name,
                                    'model_no'              => $row->model_no,
                                    'part_code'             => $part_code_data,
                                    'added_on'              => date_format(date_create($row->created_at),'d-m-Y'),
                                    'updated_no'            => date_format(date_create($row->updated_at),'d-m-Y'),
                                  ];
                }
                else
                {
                    $seller_stock_delete = $this->model->hdm_delete('full_details',['ID'=>$row->ID]);
                }
            }
            
            if(!empty($response))
            {
                $data = [
                            'total_stock' => intval($total_count),
                            'stock_list'  => $response,
                        ];
            }
            else
            {
                $data = [];
            }
            
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
        else
        {
            $response = [];

            $this->set_response($response, REST_Controller::HTTP_OK);
        }
        
	}
}