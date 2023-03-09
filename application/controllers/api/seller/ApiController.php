<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends BD_Controller 
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
    function  id_without_profile_get(){

        $wherearr =array('is_profile_created'=>'0','login_status'=>'0');
        $records = $this->Common->get_details('seller',$wherearr);
        if(sizeof($records) > 0){
            $this->response($records,200);
        }else
        {
            $this->response(['msg'=>'Something went wrong'],422);
        }
    }
        
    function new_seller_profiles_get(){

        $records = $this->Common->new_seller_profiles();
        if(sizeof($records) > 0){
            $this->response($records,200);
        }else
        {
            $this->response(['msg'=>'Something went wrong'],422);
        }
    }
    function profile_details_post(){

        $id = $this->input->post('id');
        $where =array('seller.ID'=>$id);
        $records = $this->Common->get_details_by_id('seller',$where);
        
        if(sizeof($records) > 0){
            $this->response($records,200);
        }else
        {
            $this->response(['msg'=>'Something went wrong'],422);
        }

    }
    function state_userwith_spare_get(){

        $states = $this->Common->get_data('state');
        $data =array();
        $seller_with_spare =0;
        foreach($states as $st){

             
        $records=[];
        $records1=[];
        $this->db->where("seller.ID IN(select seller_id from full_details where full_details.state_id='$st[ID]')");
                   
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
        $this->db->where('seller.state_id',$st['ID']);
        $this->db->where('login_status','0'); 
        $this->db->where('status','1'); 
        $this->db->where('is_role','0'); 
        //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records = $query->result_array(); 

        $this->db->where("seller.ID IN(select seller_id from part_code where part_code.state_id='$st[ID]')");
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
         $this->db->where('seller.state_id',$st['ID']);
        $this->db->where('login_status','0'); 
        $this->db->where('status','1'); 
        //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records1 = $query->result_array(); 
        $records4=[];
                 
        if($records !=''  || $records1 !=''){
            $records4= array_unique(array_merge($records,$records1), SORT_REGULAR);
            $seller_with_spare=sizeof($records4);
            //$this->response($records4,200);
        }
                    if($seller_with_spare > 0){
                        $data[] =array('state_id'=>$st['ID'],'state_name'=>$st['state_name'],'total_seller'=>$seller_with_spare);
                    }
                    $seller_with_spare =0; 
                
              
       } 
        if(sizeof($data) > 0){
            $this->response($data,200);
        }else{
            $this->response(['msg'=>'Something went wrong'],422);
        }

    }

function state_all_india_user_get(){

        $states = $this->Common->get_data('state');

        $data =array();

       
        $total_seller =0;
        foreach($states as $st){

             $this->db->where('state_id',$st['ID']);
             $this->db->where('login_status','0');
             $this->db->where('status','1'); 
             $this->db->where('is_role','0');
             $records =  $this->db->get('seller')->result_array();
            if(sizeof($records) > 0){

                
                 $total_seller =sizeof($records) ;
                 if($total_seller > 0){
                    $data[] =array('state_id'=>$st['ID'],'state_name'=>$st['state_name'],'total_seller'=>$total_seller);
                 }

           
            $total_seller =0;
           }
            
           
         }

        if(sizeof($data) > 0){
            $this->response($data,200);
        }else{
            $this->response(['msg'=>'Something went wrong'],422);
        }
         
    }
    function district_all_india_user_post(){

        $state_id = $this->input->post('state_id');
         $dist_record = $this->Common->citywise_district($state_id);
         $data =array();

           
            $total_seller =0;

         foreach($dist_record as $st){

            $this->db->where('district_id',$st['ID']);
            $this->db->where('login_status','0');
            $this->db->where('status','1'); 
            $this->db->where('is_role','0');
            //$this->db->where('is_profile_created','1');
            $records =  $this->db->get('seller')->result_array();



           if(sizeof($records) > 0){

             
                $total_seller =sizeof($records) ;
                if($total_seller > 0){
                   $data[] =array('district_id'=>$st['ID'],'district_name'=>$st['district_name'],'total_seller'=>$total_seller);
                }

            }
          
           $total_seller =0;
          
        }

       if(sizeof($data) > 0){
           $this->response($data,200);
       }else{
           $this->response(['msg'=>'Something went wrong'],422);
       }
        


    }
    function  users_without_spares_get(){

        $states = $this->Common->get_data('state');
        $data =array();
        $seller_without_spare =0;
        foreach($states as $st){

             
              $records=[];
        $records1=[];
        $this->db->where("seller.ID NOT IN(select seller_id from full_details where full_details.state_id='$st[ID]')");
        $this->db->where("seller.ID NOT IN(select seller_id from part_code where part_code.state_id='$st[ID]')");
                 
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
        $this->db->where('seller.state_id',$st['ID']);
        $this->db->where('login_status','0'); 
        $this->db->where('status','1'); 
        $this->db->where('is_role','0'); 
        //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records = $query->result_array(); 

      //  print_r($records);

        $this->db->where("seller.ID NOT IN(select seller_id from part_code where part_code.state_id='$st[ID]')");
        $this->db->where("seller.ID NOT IN(select seller_id from full_details where full_details.state_id='$st[ID]')");
      
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
         $this->db->where('seller.state_id',$st['ID']);
        $this->db->where('login_status','0'); 
        $this->db->where('status','1'); 
        $this->db->where('is_role','0'); 
        //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records1 = $query->result_array(); 
        $records4=[];

       // print_r($records1);
                 
        if($records !=''  || $records1 !=''){
            $records4= array_unique(array_merge($records,$records1), SORT_REGULAR);
            $seller_without_spare=sizeof($records4);
            //$this->response($records4,200);
        }
                    if($seller_without_spare > 0){
                        $data[] =array('state_id'=>$st['ID'],'state_name'=>$st['state_name'],'total_seller'=>$seller_without_spare);
                    }
                    $seller_without_spare =0; 
                
              
       } 
        if(sizeof($data) > 0){
            $this->response($data,200);
        }else{
            $this->response(['msg'=>'Something went wrong'],422);
        }

    }



    function  userwidspare_district_post(){

         $state_id = $this->input->post('state_id');
         $dist_record = $this->Common->citywise_district($state_id);
         $data =array();

            $seller_without_spare=0;

         foreach($dist_record as $st){

             $records=[];
        $records1=[];
        $this->db->where("seller.ID IN(select seller_id from full_details where district_id='$st[ID]')");
                   
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
        $this->db->where('district_id',$st['ID']);
        $this->db->where('login_status','0'); 
        $this->db->where('is_role','0'); 
        $this->db->where('status','1'); 
        //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records = $query->result_array(); 

        $this->db->where("seller.ID IN(select seller_id from part_code where district_id='$st[ID]')");
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
         $this->db->where('district_id',$st['ID']); 
        $this->db->where('login_status','0'); 
        $this->db->where('status','1'); 
        $this->db->where('is_role','0'); 
        //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records1 = $query->result_array(); 
        $records4=[];
                 
        if($records !=''  || $records1 !=''){
            $records4= array_unique(array_merge($records,$records1), SORT_REGULAR);
            $seller_without_spare=sizeof($records4);
            //$this->response($records4,200);
        }     
               
                if($seller_without_spare > 0){
                   $data[] =array('district_id'=>$st['ID'],'district_name'=>$st['district_name'],'total_seller'=>$seller_without_spare);
                }

            
           $seller_without_spare=0;
          
        }

       if(sizeof($data) > 0){
           $this->response($data,200);
       }else{
           $this->response(['msg'=>'Something went wrong'],422);
       }
        


    }

    function userwithoutspare_district_post(){
        $state_id = $this->input->post('state_id');
         $dist_record = $this->Common->citywise_district($state_id);
         $data =array();

        $seller_without_spare =0;
        foreach($dist_record as $st){

          
        $records=[];
        $records1=[];
        $this->db->where("seller.ID NOT IN(select seller_id from full_details where district_id='$st[ID]')");
        $this->db->where("seller.ID NOT IN(select seller_id from part_code where district_id='$st[ID]')");           
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
        $this->db->where('district_id',$st['ID']);
        $this->db->where('login_status','0'); 
        $this->db->where('status','1'); 
        $this->db->where('is_role','0'); 
        //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records = $query->result_array(); 

     
        $this->db->where("seller.ID NOT IN(select seller_id from full_details where district_id='$st[ID]')");
        $this->db->where("seller.ID NOT IN(select seller_id from part_code where district_id='$st[ID]')");
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
         $this->db->where('district_id',$st['ID']); 
        $this->db->where('login_status','0'); 
        $this->db->where('status','1'); 
        $this->db->where('is_role','0'); 
        //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records1 = $query->result_array(); 

        //print_r($records);
        //print_r($records1);

     

        $records4=[];
                 
        if($records !=''  || $records1 !=''){
            $records4= array_unique(array_merge($records,$records1), SORT_REGULAR);
            $seller_without_spare=sizeof($records4);
           
        }

       //    print_r($records1);

        
                    if($seller_without_spare > 0){
                        $data[] =array('district_id'=>$st['ID'],'district_name'=>$st['district_name'],'total_seller'=>$seller_without_spare);
                    }
           
            $seller_without_spare =0;
       }
        if(sizeof($data) > 0){
            $this->response($data,200);
        }else{
            $this->response(['msg'=>'Something went wrong'],422);
        }
    }



    function district_seller_without_spare_post(){

       $disrict_id = $this->input->post('disrict_id');
        
       $where =array('district_id'=>$disrict_id);
        //$this->db->where($where); 
        $records=[];
        $records1=[];
        $this->db->where("seller.ID NOT IN(select seller_id from full_details where district_id='$disrict_id')");
        $this->db->where("seller.ID NOT IN(select seller_id from part_code where district_id='$disrict_id')");   //ebtry in partcode but not in full so it wil consider partcode data that's why put this con 
                
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
        $this->db->where($where); 
        $this->db->where('login_status','0'); 
        $this->db->where('status','1'); 
        $this->db->where('is_role','0'); 
        //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records = $query->result_array(); 

        $this->db->where("seller.ID NOT IN(select seller_id from part_code where district_id='$disrict_id')");
        
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
        $this->db->where($where); 
        $this->db->where('login_status','0');
        $this->db->where('status','1'); 
        $this->db->where('is_role','0'); 

        //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records1 = $query->result_array(); 

      //  print_r($records1);
        $records4=[];
                 
        if($records !=''  || $records1 !=''){
            $records4= array_unique(array_merge($records,$records1), SORT_REGULAR);
            $this->response($records4,200);
        }
        else {
             $this->response(['msg'=>'Something went wrong'],422);
        }
    }
    
        
function district_seller_with_spare_post() {

        $disrict_id = $this->input->post('disrict_id');
        
       $where =array('district_id'=>$disrict_id);
       //$this->db->where($where); 
       $records=[];
        $records1=[];
        $this->db->where("seller.ID IN(select seller_id from full_details where district_id='$disrict_id')");
                   
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
        $this->db->where($where); 
        $this->db->where('login_status','0');
        $this->db->where('status','1'); 
        $this->db->where('is_role','0'); 
        //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records = $query->result_array(); 
                   // $this->db->where('seller.ID NOT IN',$r['seller_id']);
                   $this->db->where("seller.ID IN(select seller_id from part_code where district_id='$disrict_id')");
                    // $where =array('district_id'=>$disrict_id);
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
        $this->db->where($where); 
        $this->db->where('login_status','0');
        $this->db->where('status','1'); 
        //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records1 = $query->result_array(); 
        $records4=[];
                 
                 if($records !=''  || $records1 !=''){
                    $records4= array_unique(array_merge($records,$records1), SORT_REGULAR);

                   // print_r($records4);
                    foreach($records4 as $row1){
                       

                        $records5[] = array('ID'=>$row1['ID'],'owner_name'=>$row1['owner_name'],'mobile_no'=>$row1['mobile_no'],'state_name'=>$row1['state_name'],'district_name'=>$row1['district_name'],'created_date'=>$row1['created_date'],'company_name'=>$row1['company_name']);
                    }
                    $this->response($records5,200);
                 
                    }
                else {
                    $this->response(['msg'=>'Something went wrong'],422);
                 }
 }
 
 function detail_all_india_seller_district_wise_post() {

        $disrict_id = $this->input->post('disrict_id');
        
       $where =array('district_id'=>$disrict_id);
       //$this->db->where($where); 
       $records=[];
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
        $this->db->where($where); 
        $this->db->where('login_status','0'); 
        $this->db->where('status','1'); 

        $this->db->where('is_role','0'); 
         //$this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records = $query->result_array(); 
                 
                 if($records !=''){
                   
                    $this->response($records,200);
                 
                    }
                else {
                    $this->response(['msg'=>'Something went wrong'],422);
                 }
 }
 function is_part_already_exist_post(){

         $category_id = $this->input->post('category_id');
        $brand_id = $this->input->post('brand_id');
        $type_id = $this->input->post('type_id');
        $model_no = $this->input->post('model_no');
        
             $this->db->select('*');
           // $this->db->where('seller_id',$seller_id);
            $this->db->where('category_id',$category_id);
             $this->db->where('brand_id',$brand_id);
              $this->db->where('type_id',$type_id);
               $this->db->where('model_no',$model_no);
             $this->db->where('status','1');
            $records =  $this->db->get('full_details')->result();
     if(!empty($records))
            {
                $response =   [
                                
                                'is_already_exist'      => $records[0]->is_already_exist,
                                
                              ];
                               $this->set_response($response, REST_Controller::HTTP_OK);
            }
                

                //$this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
            else {
            $this->response(['msg'=>'Something went wrong'],422);
        }


    }
    function search_partcode_post(){

        $stock_id = $this->input->post('stock_id');
        $part_code = $this->input->post('part_code');
        $this->db->select('COUNT(part_code.ID) as totalparts,part_code,state_name,state.ID as state_id');
        $this->db->join('state', 'state.ID = part_code.state_id','Inner');
        $this->db->join('seller', 'seller.ID = part_code.seller_id','LEFT');
        $this->db->where('stock_id',$stock_id);
        $this->db->where('part_code',$part_code);
        $this->db->where('seller.status','1'); 
        $this->db->group_by('state_id');

        $query = $this->db->get('part_code');
        $records = $query->result_array(); // as array

        if(sizeof($records) > 0){
            $this->response($records,200);
        }else {
            $this->response(['msg'=>'Something went wrong'],422);
        }


    }

    function search_partcode2_post(){  //district

        $stock_id = $this->input->post('stock_id');
        $part_code = $this->input->post('part_code');
        $state_id = $this->input->post('state_id');


        $this->db->select('COUNT(part_code.ID) as totalparts,part_code,district_name,district.ID as district_id');
        $this->db->join('district', 'district.ID = part_code.district_id','inner');
        $this->db->join('seller', 'seller.ID = part_code.seller_id','LEFT');
      
        $this->db->where('part_code.state_id',$state_id);
        $this->db->where('stock_id',$stock_id);
        $this->db->where('part_code',$part_code);
        $this->db->where('seller.status','1'); 
        $this->db->group_by('district_id');

        $query = $this->db->get('part_code');
        $records = $query->result_array(); // as array

 //       print_r($this->db->last_query());

        if(sizeof($records) > 0){
            $this->response($records,200);
        }else {
            $this->response(['msg'=>'Something went wrong'],422);
        }


    }
        function district_seller_search_partcode_post() {

        $disrict_id = $this->input->post('disrict_id');
          $stock_id = $this->input->post('stock_id');
        $part_code = $this->input->post('part_code');
        

        
       $where =array('district_id'=>$disrict_id);
       
       $records=[];
        $this->db->where("seller.ID IN(select seller_id from part_code where district_id='$disrict_id' and stock_id='$stock_id'and part_code='$part_code' )");
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
        $this->db->where($where); 
        $this->db->where('login_status','0');
         $this->db->where('status','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records = $query->result_array(); 
       
                 
                 if($records !=''){
                    
                    $this->response($records,200);
                 
                    }
                else {
                    $this->response(['msg'=>'Something went wrong'],422);
                 }
 }
		/*function stock_list_post(){
			$category_id = $this->input->post('category_id');
			$type_id = $this->input->post('type_id');
			$this->db->select('ID,name');
			$this->db->like('type_id', $type_id,'both');
			$this->db->where('category_id',$category_id);
			$query = $this->db->get('stock');
			$records = $query->result_array(); // as array

		//	print_r( $this->db->last_query() );

			if(sizeof($records) > 0){
					$this->response($records,200);
			}else {
					$this->response(['msg'=>'Something went wrong'],422);
			}

		}*/

		

		function report_profile_post(){

			$seller_id = $this->input->post('seller_id'); 

            $report_type = $this->input->post('report_type'); 
            $this->db->set('report_type',$report_type);
			$this->db->where('ID',$seller_id);
			$this->db->update('seller');
			$is_update = $this->db->affected_rows();
			if($is_update ==1){
				$this->response(['msg'=>'Reported successfully'],200);
			} else {
				$this->response(['msg'=>'Something went wrong'],422);
			}

		}

          function report_profile_user_listing_get(){

		    //    $where =array('report_type'=>!'0');
               
                 $records=[];
                
                $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
               
                $this->db->where('login_status','0'); 
                $this->db->where('report_type!=','0'); 
                $this->db->join('state', 'state.ID = seller.state_id','LEFT');
                $this->db->join('district', 'district.ID = seller.district_id','LEFT');
                $query = $this->db->get('seller');
                $records = $query->result_array(); 

                // print_r($this->db->last_query());
                // print_r($records);
               
                         
                         if($records !=''){
                            
                            $this->response($records,200);
                         
                            }
                        else {
                            $this->response(['msg'=>'Something went wrong'],422);
                         }
	    	}
	    	
		function search_with_fulldetails_in_post() {

		
			$category_id = $this->input->post('category_id');
			$type_id     = $this->input->post('type_id');
			$brand_id    = $this->input->post('brand_id');
			$model_no    = $this->input->post('model_no');
		$part_code    = $this->input->post('part_code');
			$stock_id    = $this->input->post('stock_id');


            $total_dtls_spare =0;
            $states = $this->Common->get_data('state');

            $wherearray = array('category_id' => $category_id, 'type_id' => $type_id, 'brand_id' => $brand_id,'model_no'=>$model_no);
           
            $recordsdata =array();
    	       	$total_dtls_spare=0;
            foreach($states as $st){

												    $this->db->join('seller', 'seller.ID = full_details.seller_id','LEFT');
                $this->db->select('part_code_ids');
                $this->db->where($wherearray);
                $this->db->where('full_details.state_id',$st['ID']);
																$this->db->where('seller.status','1'); 
															
                $query = $this->db->get('full_details');
                $records = $query->result(); // as array
                 //check stock id now 
                if(sizeof($records) > 0){
																					 		foreach($records as $k){
																									$partcode_ids = explode(",",$k->part_code_ids);
												        				}
																								foreach($partcode_ids as $key=>$v){
																								$this->db->where('part_code.Id',$v);
                        $this->db->where('part_code.state_id',$st['ID']);
                        $this->db->where('stock_id',$stock_id);
																											if($part_code !=""){
																															$this->db->where('part_code',$part_code);
																											}
																											$this->db->join('seller', 'seller.ID = part_code.seller_id','LEFT');
																											$this->db->where('seller.status','1'); 
                            $query2 = $this->db->get('part_code');
                            $records2 = $query2->result_array(); // as array
																												if(sizeof($records2) > 0){
																												$total_dtls_spare = $total_dtls_spare + 1; 
																												$from='fdtls';
																												}
                    }
                    
																
             		} else {  //check partcode data into partcode table 

																$this->db->where('part_code.state_id',$st['ID']);
																$this->db->where('category_id',$category_id);
																$this->db->where('stock_id',$stock_id);
																$this->db->where('part_code',$part_code);
																$this->db->join('seller', 'seller.ID = part_code.seller_id','LEFT');
																$this->db->where('seller.status','1'); 
																$query2 = $this->db->get('part_code');
																$records2 = $query2->result_array(); // as array
																if(sizeof($records2) > 0){
																	$total_dtls_spare = $total_dtls_spare + 1; 
																	$from='ptcode';
																	}

															
															}
															if($total_dtls_spare >0){
																$qry = $this->db->last_query();
																$recordsdata[] = array(
																																		//'qry'=>$qry,
																																	//	'from'=>$from,
																																		'totalparts'=>$total_dtls_spare,
																																		'state_name'=>$st['state_name'],
																																		'state_id'=>$st['ID']
																																	);
																$total_dtls_spare=0;
												   }
														
             }
            if(sizeof($recordsdata) > 0){
                $this->response($recordsdata,200);
            }else {
                    $this->response(['msg'=>'Something went wrong'],422);
            }
		}

 function disrict_search_fulldtls_post(){

            $category_id  = $this->input->post('category_id');
			$type_id      = $this->input->post('type_id');
			$brand_id     = $this->input->post('brand_id');
			$model_no     = $this->input->post('model_no');
			$part_code    = $this->input->post('part_code');
			$stock_id     = $this->input->post('stock_id');
			$state_id     = $this->input->post('state_id');
			$dist_record  = $this->Common->citywise_district($state_id);
			
                    $recordsdata =array();
					 $total_dtls_spare=0;
			foreach($dist_record as $st){
               
					$wherearray = array('district_id'=>$st['ID'],'category_id' => $category_id, 'type_id' => $type_id, 'brand_id' => $brand_id,'model_no'=>$model_no);
					 
				$this->db->select('part_code_ids');
                $this->db->where($wherearray);
                $this->db->where('district_id',$st['ID']);
                $query = $this->db->get('full_details');
                $records = $query->result(); // as array
								   				//check stock id now 
																if(sizeof($records) > 0){
																			foreach($records as $k){
																					$partcode_ids = explode(",",$k->part_code_ids);
																			}
			              	foreach($partcode_ids as $key=>$v){
																			  	$this->db->where('Id',$v);
																						$this->db->where('district_id',$st['ID']);
																						$this->db->where('stock_id',$stock_id);
																						if($part_code !=""){
																								$this->db->where('part_code',$part_code);
																							}
																							$query2 = $this->db->get('part_code');
																							$records2 = $query2->result_array(); // as array
																						if(sizeof($records2) > 0){
																							$total_dtls_spare = $total_dtls_spare + 1; 
																						}
																			}
																		if($total_dtls_spare >0){
																			$recordsdata[] = array('totalparts'=>$total_dtls_spare,'district_name'=>$st['district_name'],'district_id'=>$st['ID']);
																			$total_dtls_spare=0;
																		}
																
             		}
             }
													if(sizeof($recordsdata) > 0){
														$this->response($recordsdata,200);
												}else {
														$this->response(['msg'=>'Something went wrong'],422);
												}

            
		}
    

        function district_seller_search_fulldetail_post() {

										$disrict_id = $this->input->post('disrict_id');
										$stock_id = $this->input->post('stock_id');
										$part_code = $this->input->post('part_code');
										$category_id  = $this->input->post('category_id');
										$type_id      = $this->input->post('type_id');
										$brand_id     = $this->input->post('brand_id');
										$model_no     = $this->input->post('model_no');
        
       $where =array('district_id'=>$disrict_id,'stock_id'=>$stock_id);
       $where1 =array('district_id'=>$disrict_id);
       
       //$records=[];
        $records1=[];
        $this->db->where("seller_id IN(select seller_id from full_details where district_id='$disrict_id' and category_id='$category_id'and type_id='$type_id'and brand_id='$brand_id'and model_no='$model_no' )");
        
        $this->db->where($where); 
        $this->db->where('type','0'); 
        if($part_code !=""){
								$this->db->where('part_code',$part_code);
								}
        $query = $this->db->get('part_code');
        $records = $query->result(); 
          if($records){
                      $where1 =array('district_id'=>$disrict_id,'seller.ID'=>$records[0]->seller_id);
                      $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
																						$this->db->where($where1); 
																						$this->db->where('login_status','0'); 
																						$this->db->where('status','1'); 
																						$this->db->join('state', 'state.ID = seller.state_id','LEFT');
																						$this->db->join('district', 'district.ID = seller.district_id','LEFT');
																						$query = $this->db->get('seller');
																						$records1 = $query->result_array(); 
																						if($records1 !=''){
																										$this->response($records1,200);
																						}
                     
                    }
                else {
                    $this->response(['msg'=>'Data not found'],422);
                 }
 }
 
			 function myaction_post(){  //action type 	is_fav  =1	stop_search =2		hide_search =3 approved =4
				$type= $this->input->post('action_type');
				$action_value= $this->input->post('action_value'); 
				$seller_id= $this->input->post('seller_id'); 

				if($type=='1'){
					$this->db->set('is_fav',$action_value);
				} elseif($type=='2'){
					$this->db->set('stop_search',$action_value);
				} else if($type=='3'){
					$this->db->set('hide_search',$action_value);
				} else {
					$this->db->set('status',$action_value);
				}

				$this->db->where('ID',$seller_id);
				$this->db->update('seller');
				$is_update =  	$this->db->affected_rows();
				if($is_update ==1){
					$this->response(['msg'=>'Action Update successfully'],200);
				} else {
					$this->response(['msg'=>'Something went wrong'],422);
				}



			 }

    function send_emails_post(){
        $seller_id = $this->input->post('seller_ids');

        $msg =$this->input->post('msg');

       // $email=''
        $seller_arr = explode(',',$seller_id);
        foreach($seller_arr as $sid=>$id){
            $this->db->select('email');
            $records = $this->db->get_where('seller',array('id'=>$id))->result_array();
            if(sizeof($records) > 0){ 
               $email=  $records[0]['email'];
               $this->send_mail($email,$msg);
              
           }
        }
        $this->response(['msg'=>'Email send successfully'],200);
    }

    function send_mail($email,$msg){

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'sparesadmin@spares.sparesengineer.com', // change it to yours
            'smtp_pass' => 'Kicchik]iv.J', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
          );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('sparesadmin@spares.sparesengineer.com'); // change it to yours
        $this->email->to($email);// change it to yours
        $this->email->subject('spares-information');
        $this->email->message($msg);
       // return true;
    //     if($this->email->send())
    //    {
    //     echo 'Email sent.';
    //    }
    //    else
    //   {
    //    show_error($this->email->print_debugger());
    //   }

    }

    function send_notification_post(){
        $seller_id = $this->input->post('seller_ids');
        $msg =$this->input->post('msg');

       // $email=''
        $seller_arr = explode(',',$seller_id);
        foreach($seller_arr as $sid=>$id){
            $this->db->select('token');
            $records = $this->db->get_where('seller',array('id'=>$id))->result_array();
            if(sizeof($records) > 0){ 
               $device_id=  $records[0]['token'];
               $this->send_pushnotification($device_id,$msg);
            }
        }
        $this->response(['msg'=>'Notification send successfully'],200);
    }

    function send_pushnotification($device_id,$msg){
        //API URL of FCM
    $url = 'https://fcm.googleapis.com/fcm/send';

    /*api_key available in:
    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/  
      $api_key = 'AAAALcbOoJo:APA91bG0RM1sETqrraN9W1KXRVfWHzDYhzSGjlNMhe7ZEB-deWLR1d5UpZMLwys5IRukuZVDE3RYiIfQwYwHkf6wRRE2MpakWpF_x8RGH-8d7nAlCsVWNtAGAxyy9ZsbCvCoI5170I9Q';
         
      //$device_id='fpD29PiIRKuiU2mFsz3Fmh:APA91bE3yBUxHxwAR5lCykJOwNRmWtsk9g5gzdPMCg6YDzroFo_6gOjhk-HIbOW8UgDSbJULfajgwsyEatjKm83B9J_E_dzByNFGnuBBKDXZaN3QTm4jrjk-kyIfPEZIqn_2cWgzyuJB';
    $msg = array
    (
    'body' 	=> 'Body  Of Notification',
    'title'	=> 'From Admin',
    'icon'	=> 'Icon',/*Default Icon*/
    'sound' => 'Default'/*Default sound*/
    );

    $fields = array
      (
          'to'		=> $device_id,
          'notification'	=> $msg
      );

        //header includes Content type and api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$api_key
        );
                    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
       // print_r($result);
        return $result;
 }

 function homepage_get(){
     $query1 =$this->db->query("SELECT * FROM `seller` WHERE `is_profile_created`=0 and login_status=0");
     $id_without_profile = $query1->num_rows();

     $query2 =$this->db->query("SELECT * FROM `seller` WHERE `is_profile_created`=1 and `login_status`=0 and `status`=0");
     $new_profile = $query2->num_rows();

     $query3 =$this->db->query("SELECT * FROM `seller` WHERE `report_type`!=0 and login_status=0");
     $reported_profile = $query3->num_rows();


   
     
     $query4 =$this->db->query("SELECT DISTINCT seller_id,state_id from part_code where seller_id IN(select seller.ID from seller where login_status='0' and status='1')")->result_array();
    
    $query5 =$this->db->query("SELECT DISTINCT seller_id,state_id from full_details where seller_id IN(select seller.ID from seller where login_status='0' and status='1')")->result_array();
    
    //$query11 =$this->db->query("SELECT seller.ID,state_id from seller where seller.ID NOT IN(select DISTINCT seller_id from part_code where 1 ) AND login_status='0' and status='1'")->result_array();
    $query11 =$this->db->query("SELECT seller.ID,state_id from seller where seller.ID NOT IN(select DISTINCT seller_id from part_code where 1 ) AND login_status='0'  AND is_role='0' and status='1'  AND seller.ID NOT IN(select DISTINCT seller_id from full_details where 1 )")->result_array();
    

   
    $query12 =$this->db->query("SELECT seller.ID,state_id from seller where seller.ID NOT IN(select DISTINCT seller_id from full_details where 1) AND login_status='0'  AND is_role='0' and status='1'  AND seller.ID NOT IN(select DISTINCT seller_id from part_code  where 1 ) ")->result_array();
     

   // print_r($query12);
     $user_with_spare=sizeof(array_unique(array_merge($query4,$query5), SORT_REGULAR));
     
     $user_without_spare=sizeof(array_unique(array_merge($query11,$query12), SORT_REGULAR));
    
     $query5 =$this->db->query("SELECT * FROM `seller` WHERE `login_status`=0 AND `status`=1 AND `is_role`=0 ");
     $india_user = $query5->num_rows();

     //$user_without_spare = $india_user - $user_with_spare- $id_without_profile;

      $query6 =$this->db->query("SELECT * FROM `seller` WHERE `login_status`=0 and is_fav='1' AND `status`=1 AND `is_role`=0 ");
     $favorite_user = $query6->num_rows();

    $query7 =$this->db->query("SELECT * FROM `category` WHERE `status`=0 ");
     $total_category = $query7->num_rows();
     
      $query8 =$this->db->query("SELECT * FROM `brand` WHERE `status`=0 ");
     $total_brand = $query8->num_rows();
     
     $query9 =$this->db->query("SELECT * FROM `type` WHERE `status`=0 ");
     $total_type = $query9->num_rows();
     
     $query10 =$this->db->query("SELECT * FROM `stock` WHERE `status`=0 ");
     $total_stock = $query10->num_rows();
    

     $query11 =$this->db->query("SELECT * FROM `seller_profile_temp`");
     $update_profile = $query11->num_rows();

     
     $list = array(
            'id_without_profile'=>$id_without_profile,
            'new_profile'=>$new_profile,
            'update_profile'=>$update_profile,

            'reported_profile'=>$reported_profile,
            'user_without_spare'=>$user_without_spare,
            'user_with_spare'=>$user_with_spare,
            'india_user'=>$india_user,
            'my_action'=>0,
            'favorite_user'=>$favorite_user,
            'total_category'=>$total_category,
            'total_brand'=>$total_brand,
            'total_type'=>$total_type,
            'total_stock'=>$total_stock,

     );

     $this->response($list,200);
 }

 function favourite_list_get(){

    $where =array('is_fav'=>'1');
               
    $records=[];
   
   $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
   $this->db->where($where); 
   $this->db->where('login_status','0'); 
   $this->db->join('state', 'state.ID = seller.state_id','LEFT');
   $this->db->join('district', 'district.ID = seller.district_id','LEFT');
   $query = $this->db->get('seller');
   $records = $query->result_array(); 
  
            
            if($records !=''){
               
               $this->response($records,200);
            
               }
           else {
               $this->response(['msg'=>'Something went wrong'],422);
            }
 }

 function state_wise_notification_post(){

    $state_id = $this->input->post('state_id');
    $district_id = $this->input->post('district_id');
    $msg = $this->input->post('msg');

    if($state_id !=""){
        $this->db->where('state_id',$state_id);
    } else{
        $this->db->where('district_id',$district_id); 
    }
   
    $this->db->where('login_status','0');
    $records =  $this->db->get('seller')->result_array();
    if(sizeof($records) > 0){
      foreach($records as $r){
          $device_id = $r['token'];
          $this->send_pushnotification($device_id,$msg);
        }
    }
    $this->response(['msg'=>'Notification send successfully'],200);
 }
 function state_disrict_send_mail_post(){
    $state_id = $this->input->post('state_id');
    $district_id = $this->input->post('district_id');
    $msg = $this->input->post('msg');

    if($state_id !=""){
        $this->db->where('state_id',$state_id);
    } else{
        $this->db->where('district_id',$district_id); 
    }
   
    $this->db->where('login_status','0');
    $records =  $this->db->get('seller')->result_array();
    if(sizeof($records) > 0){
      foreach($records as $r){
          $email = $r['email'];
          $this->send_mail($email,$msg);
            
           }
        }
        $this->response(['msg'=>'Email send successfully'],200);

 }


 function delete_sellers_post(){
   $seller_id = $this->input->post('seller_ids');
    $seller_arr = explode(',',$seller_id);
        foreach($seller_arr as $sid=>$id){
           $this->db->where('id',$id);
           $this->db->delete('seller');
        }
        $this->response(['msg'=>'Delete successfully'],200);
 }

function check_approve_post(){
    $seller_id = $this->input->post('seller_id');
    $records = $this->db->get_where('seller',array('id'=>$seller_id,'status'=>'1'))->result_array();
    
   // print_r($this->db->last_query());
    if(sizeof($records) > 0){ 
        $this->response(['msg'=>'profile is approved','is_approve'=>'true'],200);
   }else
   {
       $this->response(['msg'=>'profile is not approve','is_approve'=>'false'],422);
   }

  
}

function pending_approve_list_get(){

    $records = $this->db->get_where('seller_profile_temp',array('is_approve'=>'0'))->result_array();
    //print_r($records);
    if(sizeof($records) > 0){ 
            $this->response(['msg'=>'data found','data'=>$records],200);
    }else {
        $this->response(['msg'=>'data not found','data'=>[]],422);
    }
  }


		function admin_approve_post(){

	    	$seller_id = $this->input->post('seller_id');
			$records = $this->db->get_where('seller_profile_temp',array('seller_id'=>$seller_id))->result_array();

          
            $update_data['company_name'] = $records[0]['company_name'];
            $update_data['owner_name'] = $records[0]['owner_name'];
            $update_data['email'] = $records[0]['email'];
            $update_data['mobile_2'] = $records[0]['mobile_2'];
            $update_data['area'] = $records[0]['area'];
            $update_data['address'] = $records[0]['address'];
            $update_data['in_approve'] = '1';
            
            $seller_id = $records[0]['seller_id'];
         	 $this->db->where('ID',$seller_id);
             $this->db->update('seller',$update_data);

             $this->db->where('seller_id',$seller_id);
			 $this->db->delete('seller_profile_temp');
			
		 	 $this->response(['msg'=>'approve successfully'],200);
			
	}


    function seller_update_dtls_post(){

       	$seller_id = $this->input->post('seller_id');
		$records = $this->db->get_where('seller_profile_temp',array('seller_id'=>$seller_id))->result_array();
        if(sizeof($records) > 0){ 
            $this->response(['msg'=>'data found','data'=>$records],200);
        }else {
            $this->response(['msg'=>'data not found','data'=>[]],422);
        }


    }

    // function inquery_count(){

    // }



}