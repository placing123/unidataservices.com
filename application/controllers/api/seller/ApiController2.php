<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController2 extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        date_default_timezone_set("Asia/Kolkata");
        parent::__construct();
        $this->load->library('email');
       $this->auth();
        $this->load->Model('Common');
    }

    function search_seller_partcode_other_stateslist_post(){
      $seller_id = $this->input->post('seller_id');
      $stock_id = $this->input->post('stock_id');
      $part_code = $this->input->post('part_code');
      $category_id = $this->input->post('category_id');

      
             $this->db->select('*');
             $whrarr = array('seller.ID'=>$seller_id,'login_status'=>'0');
             $this->db->where($whrarr);
              $this->db->where('status','1');
             $seller_records =  $this->db->get('seller')->result();
             
             
             if( $seller_records)
            { 
              $district_id    =  $seller_records[0]->district_id;
               $state_id    =  $seller_records[0]->state_id;

            $this->db->select('state_name,state.ID as state_id');
            //$this->db->join('district', 'district.ID = part_code.district_id','LEFT');
            $this->db->join('state', 'state.ID = part_code.state_id','LEFT');
            $wherearr2 = array('seller_id!='=>$seller_id,'stock_id'=>$stock_id,'part_code'=>$part_code,'category_id'=>$category_id,'part_code.district_id!='=>$district_id,'part_code.state_id!='=>$state_id);
            $this->db->where($wherearr2);
            $this->db->group_by('state_id');
            $query = $this->db->order_by('created_date','DESC')->get('part_code');
            $records = $query->result_array(); // as array


            $total_records = $this->db->count_all_results();

         //    print_r($records);
        
              if(sizeof($records) > 0){
                $this->response(['data'=>$records,'total_records'=>$total_records],200);
              }else {
                  $this->response(['msg'=>'Data not Found'],403);
              }

            // if(sizeof($records) > 0){
            //     $this->response($records,200);
            // }else {
            //     $this->response(['msg'=>'Data not Found'],403);
            // }
        }
        else
        {
             $this->response(['msg'=>'Something went wrong'],422);
        }
    }

    
    function search_seller_fulldetails_other_stateslist_post(){

      $category_id = $this->input->post('category_id'); 
      $model_no = $this->input->post('model_no'); 
      $brand_id = $this->input->post('brand_id'); 
      $type_id = $this->input->post('type_id'); 
      $stock_id = $this->input->post('stock_id');
      $part_code = $this->input->post('part_code');

      $wherearr1 = array('full_details.category_id'=>$category_id,'model_no'=>$model_no,'brand_id'=>$brand_id,'type_id'=>$type_id);    
      $this->db->select('state.ID,state_name');

      $this->db->join('seller', 'seller.ID = full_details.seller_id','left');
      $this->db->join('part_code', 'part_code.seller_id = full_details.seller_id','left');
      if($part_code!=""){
        $this->db->where('part_code.part_code',$part_code);
     
      }
     
      $this->db->where('seller.status','1');
      $this->db->where('seller.hide_search',0);
      $this->db->where('stock_id',$stock_id);
      $this->db->join('state', 'state.ID = full_details.state_id','Inner');
      $this->db->where($wherearr1);
      $this->db->group_by('state.ID');
      $query = $this->db->get('full_details');
      $records = $query->result(); // as array

      $total_records = $this->db->count_all_results();

    // print_r($records);

      if(sizeof($records) > 0){
        $this->response(['data'=>$records,'total_records'=>$total_records],200);
      }else {
          $this->response(['msg'=>'Data not Found'],403);
      }
   }

   function seller_search_seller_fulldetails_other_districtlist_post(){

    $category_id = $this->input->post('category_id'); 
    $model_no = $this->input->post('model_no'); 
    $brand_id = $this->input->post('brand_id'); 
    $type_id = $this->input->post('type_id'); 
    $stock_id = $this->input->post('stock_id');
    $part_code = $this->input->post('part_code');
    $state_id = $this->input->post('state_id');

    $wherearr1 = array('full_details.category_id'=>$category_id,'model_no'=>$model_no,'brand_id'=>$brand_id,'type_id'=>$type_id);    
    $this->db->select('district.ID,district_name,full_details.seller_id,state_name');

    $this->db->join('seller', 'seller.ID = full_details.seller_id','left');
    $this->db->join('state', 'state.ID = full_details.state_id','left');
    $this->db->join('part_code', 'part_code.seller_id = full_details.seller_id','left');
    if($part_code!=""){
      $this->db->where('part_code.part_code',$part_code);
    }
    $this->db->where('seller.status','1');
    $this->db->where('seller.hide_search',0);
    $this->db->where('stock_id',$stock_id);
    $this->db->join('district', 'district.ID = full_details.district_id','Inner');
    $this->db->where('district.state_id',$state_id);
    $this->db->where($wherearr1);
    $this->db->group_by('district.ID');
    $query = $this->db->get('full_details');
    $records = $query->result_array(); // as array


    $total_records = $this->db->count_all_results();

  // print_r($records);

    if(sizeof($records) > 0){
      $this->response(['data'=>$records,'total_records'=>$total_records],200);
    }else {
        $this->response(['msg'=>'Data not Found'],403);
    }


   }
    function send_feedback_post(){

      $data['seller_id'] = $this->input->post('seller_id'); 
      $data['deal_id'] = $this->input->post('deal_id'); 
      $data['feedback_id'] = $this->input->post('feedback_id'); 
     // $data['feedback_type'] = $this->input->post('feedback_type'); 
      $this->db->insert('seller_feedback',$data);
      $this->response(['msg'=>'Thank you for your feedback'],200);
   }

   function check_feedbackgiven_post(){
    $deal_id = $this->input->post('deal_id'); 
    $seller_id = $this->input->post('seller_id'); 
    $wherearr1 = array('deal_id'=>$deal_id,'seller_id'=>$seller_id);
    $records1 = $this->db->get_where('seller_feedback',$wherearr1)->result();
    if(sizeof($records1) > 0){
      $response = array('is_given'=>'true','msg'=>'Feedback already given');
    }else{
      $response = array('is_given'=>'false','msg'=>'Feedback not given');
    }

    $this->response($response,200);
   }

   function check_marks_as_read_post(){
     
    $deal_id = $this->input->post('deal_id'); 
    $seller_id = $this->input->post('seller_id'); 
    $type = $this->input->post('type'); 

    if($type=='1'){
      $where_arr = array('receiver_seller'=>$seller_id,'is_receiver_read'=>'1');
    } else{
      $where_arr = array('sender_seller'=>$seller_id,'is_sender_read'=>'1');
    }
    $this->db->where($where_arr);
    $records1 = $this->db->get_where('inquiry',$where_arr)->result();
    if(sizeof($records1) > 0){
      $response = array('is_given'=>'true','msg'=>'mark read  already given');
    }else{
      $response = array('is_given'=>'false','msg'=>'mark read left');
    }

    $this->response($response,200);


   }
  
  
  
}