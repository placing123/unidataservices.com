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
       $type_id = $this->input->post('type_id');
        
        if($category_id == 0)
        {
            $stock = $this->model->hdm_get('stock',['status'=>0]);
        }
        
        //else 
       // {
           // $stock = $this->db->get_where('stock',['category_id'=>$category_id,'type_id'=>$type_id])->result();
        //}
        
        else
        {
            $stock = $this->db->where('category_id', $category_id)->like('type_id',$type_id)->get('stock')->result();
        }
        // echo $this->db->last_query();
        // die;
        
        $total_count = $this->db->group_by('stock_id')->get_where('part_code',['category_id'=>$category_id,'seller_id'=>$seller_id,'part_code!='=>''])->num_rows();

        if(!empty($stock))
        {
            $response = [];
            foreach($stock as $row)
            {
                
                $count = $this->db->group_by('part_code')->get_where('part_code',['seller_id'=>$seller_id,'stock_id'=>$row->ID,'part_code!='=>''])->num_rows();
                
                $response[] = [
                                'stock_id'      => intval($row->ID),
                                'stock_name'    => $row->name,
                                'count'         => intval($count),
                              ];
            }
            
            // $sort_count = array_column($response, 'count');

            // array_multisort($sort_count, SORT_DESC, $response);
            
            $data = [
                        'total_category' => intval($total_count),
                        'data' => $response,
                    ];

            $this->set_response($data, REST_Controller::HTTP_OK);
        }
        else
        {
            $response = ['msg' => 'Data Not Found'];

            $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
        }
        
	}
	
	public function add_post()
	{
	    $category_id = $this->input->post('category_id');
	     $type_id = $this->input->post('type_id');
	    $stock_name = $this->input->post('stock_name');
	    if($category_id && $type_id && $stock_name!='')
	    {
	         $data = array(  
	              'category_id'     =>  $category_id,
	               'name'     =>  $stock_name,  
	                'type_id'     =>  $type_id,  
	               
	                 );  
        //insert data into database table.  
       

            if(!empty($data))
            {
                 $this->db->insert('stock',$data);  
                 $response = ['msg' => 'Data Added Succesfully'];
    
                $this->set_response($response, REST_Controller::HTTP_OK);
            }
            else
            {
                $response = ['msg' => 'Data Not Found'];
    
                $this->set_response($response, REST_Controller::HTTP_OK);
            }    
	    }
	    else
	    {
	        $this->set_response(['msg'=>'Choose Category First'], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	    }
        
	}
	
		public function edit_post()
	{
	    $category = $this->input->post('category_id');
	    $type_id = $this->input->post('type_id');
	     $stock_id = $this->input->post('stock_id');
	   $stock_name = $this->input->post('stock_name');
	    if($category && $stock_name && $stock_id && $type_id !='')
	    {
	         $data = array(  
	              'category_id'     =>  $category,
	               'name'     =>  $stock_name,  
	               'type_id'     =>  $type_id,  
	              
	             
	                 );  
        //insert data into database table.  
       

            if(!empty($data))
            {
                $this->db->where('id', $stock_id);
                
                 $this->db->update('stock',$data);  
                 $response = ['msg' => 'Data Updated Succesfully'];
    
                $this->set_response($response, REST_Controller::HTTP_OK);
            }
            else
            {
                $response = ['msg' => 'Data Not Found'];
    
                $this->set_response($response, REST_Controller::HTTP_OK);
            }    
	    }
	    else
	    {
	        $this->set_response(['msg'=>'Choose Category First'], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	    }
        
	}
	
		public function delete_post()
	{
	    $category_id = $this->input->post('category_id');
	    //$type_id = $this->input->post('type_id');
	    $stock_id = $this->input->post('stock_id');
	    //$brand = $this->input->post('brand');
	    if($category_id && $stock_id !='')
	    {
	           
            $data = $this->model->hdm_delete('stock',['ID'=>$stock_id]);
            if($data)
             {
        
                 $response = ['msg' => 'Account Delete Successfully'];

                $this->set_response($response, REST_Controller::HTTP_OK);
             }
            else
            {
                $response = ['msg' => 'Something went wrong please try again'];

                $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
            }
	    }
        else
	    {
	        $this->set_response(['msg'=>'Choose Category First'], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	    }
	}
	
}