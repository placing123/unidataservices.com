<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends BD_Controller 
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
	    $data = json_decode(file_get_contents("php://input"), true);
	    
	    $seller_id = $this->seller_data->seller_id;
	    $seller_stock_id = $data['seller_stock_id'];
	    
        $category_id = $data['category_id'];
        $brand_id = $data['brand_id'];
        $type_id = $data['type_id'];
        $model_no = $data['model_no'];
        
             $this->db->select('*');
             $this->db->where('seller.ID',$seller_id);
             $this->db->where('login_status','0');
             $seller_records =  $this->db->get('seller')->result();
        
        $full_details = $this->db->limit(1,0)->get_where('full_details',['ID'=>$seller_stock_id])->row();    
        $part_code = $this->db->query("Delete from part_code where ID in (".$full_details->part_code_ids.")");
        if(!empty($data))
        {
            
            $part_code_ids = [];
            for($i = 0; $i < count($data['data']); $i++)
            {
                // if($data['data'][$i]['part_code']!='')
                // {
                   $insert_part_code = ['seller_id' => $seller_id,
                        'stock_id' => $data['data'][$i]['stock_id'],
                        'category_id' => $category_id,
                        'state_id'=>$seller_records[0]->state_id,
                        'district_id'=>$seller_records[0]->district_id,
                        'part_code' => $data['data'][$i]['part_code']];   
                    $this->db->insert('part_code',$insert_part_code);
                    $part_code_ids[] = $this->db->insert_id(); 
                // }
            }
             $insert = [
                            'seller_id' => $seller_id,
                            'category_id' => $category_id,
                            'brand_id' => $brand_id,
                            'type_id' => $type_id,
                            'model_no' => $model_no,
                            'part_code_ids' => implode(",",$part_code_ids),
                            'status' => '1',
                            'created_at' => $full_details->created_at,
                            'updated_at' => date('Y-m-d H:i:s'),
                          ];
                      
                $this->db->where('ID',$seller_stock_id)->update('full_details',$insert); 
            $response = ['msg' => 'The item details are updated Successfully to your stock list'];

            $this->set_response($response, 200);
        
        }
        else
        {
            $response = ['msg' => 'Something went wrong please try again'];

            $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
        }
	}
}