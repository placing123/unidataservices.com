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
        $stock_id = $this->input->post('stock_id');
        
        $seller_stock = $this->model->hdm_get_where_order_gorup('part_code',['category_id'=>$category_id,'status'=>'1','stock_id'=>$stock_id,'seller_id'=>$seller_id,'part_code!='=>''],'ID','DESC','part_code');
        
        if(!empty($seller_stock))
        {
            $response = [];
            foreach($seller_stock as $row)
            {
                
                $multipal_part_code = $this->db->query("SELECT pc.ID,b.name as b_name,t.name as t_name,fd.model_no,pc.part_code,pc.created_date FROM full_details fd LEFT JOIN type t ON t.ID = fd.type_id LEFT JOIN brand b ON b.ID = fd.brand_id RIGHT JOIN part_code pc on FIND_IN_SET(pc.ID, fd.part_code_ids) WHERE pc.part_code = '$row->part_code' AND pc.seller_id = $seller_id AND pc.category_id = $category_id AND pc.stock_id = $row->stock_id AND pc.status = 1")->result();
                
                
                $multipalpartcode = [];
                $singlepartcode = [];
                
                if(!empty($multipal_part_code) && count($multipal_part_code) > 1)
                {
                    foreach($multipal_part_code as $multipal_part_code_row)
                    {
                        if($multipal_part_code_row->b_name != '' AND $multipal_part_code_row->t_name != '' AND $multipal_part_code_row->model_no != '')
                        {
                            $multipalpartcode[] = [
                                                        'seller_stock_id'      => intval($multipal_part_code_row->ID),
                                                        'brand_name'           => strval($multipal_part_code_row->b_name),
                                                        'type_name'            => strval($multipal_part_code_row->t_name),
                                                        'model_no'             => strval($multipal_part_code_row->model_no),
                                                        'part_code'            => $multipal_part_code_row->part_code,
                                                        'date'                 => date_format(date_create($multipal_part_code_row->created_date),'d-m-Y'),
                                                    ];
                        }
                        else
                        {
                            $singlepartcode[] = [
                                                        'seller_stock_id'      => intval($multipal_part_code_row->ID),
                                                        'part_code'            => $multipal_part_code_row->part_code,
                                                        'date'                 => date_format(date_create($multipal_part_code_row->created_date),'d-m-Y'),
                                                    ];
                        }
                    }
                }
                elseif($row->type == 0)
                {
                    $multipal_part_code = $this->db->query("SELECT * FROM `full_details` WHERE FIND_IN_SET($row->ID,part_code_ids)")->result();
                    
                    foreach($multipal_part_code as $multipal_part_code_row)
                    {
                        $brand_name = $this->db->where(['ID'=>$multipal_part_code_row->brand_id])->get('brand')->row('name');
                        $type_name = $this->db->where(['ID'=>$multipal_part_code_row->type_id])->get('type')->row('name');
                        
                        $multipalpartcode[] = [
                                                'seller_stock_id'      => intval($row->ID),
                                                'brand_name'           => strval($brand_name),
                                                'type_name'            => strval($type_name),
                                                'model_no'             => strval($multipal_part_code_row->model_no),
                                                'part_code'            => $row->part_code,
                                                'date'                 => date_format(date_create($row->created_date),'d-m-Y'),
                                              ];
                    }
                }
                
                
                $response[] = [
                                'seller_stock_id'      => intval($row->ID),
                                'stock_id'              => intval($row->stock_id),
                                'part_code'            => $row->part_code,
                                'date'                => date_format(date_create($row->created_date),'d-m-Y'),
                                'multipal_part_code' => $multipalpartcode,
                                'single_part_code' => $singlepartcode,
                              ];
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