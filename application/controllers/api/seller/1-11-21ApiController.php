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
      //  $this->auth();
        $this->load->Model('Common');
    }
    function  id_without_profile_get(){

        $wherearr =array('is_profile_created'=>'0');
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

        $seller_with_fulldtls_spare =0;
        $seller_with_partcode_spare =0;
        $total_seller =0;
        foreach($states as $st){

             $this->db->where('state_id',$st['ID']);
              //$this->db->where("seller.ID IN(select seller_id from full_details where state_id='$st[ID]')");
             $this->db->where('login_status','0');
             $this->db->where('is_profile_created','1');
             $records =  $this->db->get('seller')->result_array();
            if(sizeof($records) > 0){

                foreach($records as $r){
                    $this->db->where('seller_id',$r['ID']);
                    $records2 = $this->db->get('full_details')->result_array();
                   
                    if(sizeof($records2) > 0){
                         $seller_with_fulldtls_spare = $seller_with_fulldtls_spare + 1;
                    }
    
                    $this->db->where('seller_id',$r['ID']);
                    $records3 = $this->db->get('part_code')->result_array();
             
                    if(sizeof($records3) > 0  && sizeof($records2) < 0 ){
                        $seller_with_partcode_spare = $seller_with_partcode_spare + 1;
                    }
                 }
                
                 $total_seller = $seller_with_fulldtls_spare + $seller_with_partcode_spare;
                 if($total_seller > 0){
                    $data[] =array('state_id'=>$st['ID'],'state_name'=>$st['state_name'],'total_seller'=>$total_seller);
                 }

            $seller_with_fulldtls_spare =0;
            $seller_with_partcode_spare =0;
            $total_seller =0;
           }
            
           
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
             $this->db->where('is_profile_created','1');
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
            $this->db->where('is_profile_created','1');
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

             $this->db->where('state_id',$st['ID']);
             $this->db->where('login_status','0');
             $records =  $this->db->get('seller')->result_array();
           if(sizeof($records) > 0){
                foreach($records as $r){
                    $this->db->where('seller_id',$r['ID']);
                    $records2 = $this->db->get('full_details')->result_array();
                    $this->db->where('seller_id',$r['ID']);
                    $records3 = $this->db->get('part_code')->result_array();
                    if(sizeof($records2) <= 0  && sizeof($records3) <= 0 ){
                        $seller_without_spare = $seller_without_spare + 1;
                    }
                 }
                    if($seller_without_spare > 0){
                        $data[] =array('state_id'=>$st['ID'],'state_name'=>$st['state_name'],'total_seller'=>$seller_without_spare);
                    }
                    $seller_without_spare =0; 
           }      
              
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

            $seller_with_fulldtls_spare =0;
            $seller_with_partcode_spare =0;
            $total_seller =0;

         foreach($dist_record as $st){

            $this->db->where('district_id',$st['ID']);
            $this->db->where('login_status','0');
            $records =  $this->db->get('seller')->result_array();



           if(sizeof($records) > 0){

               foreach($records as $r){
                   $this->db->where('seller_id',$r['ID']);
                   $records2 = $this->db->get('full_details')->result_array();

                   if(sizeof($records2) > 0){
                        $seller_with_fulldtls_spare = $seller_with_fulldtls_spare + 1;
                   }
   
                   $this->db->where('seller_id',$r['ID']);
                   $records3 = $this->db->get('part_code')->result_array();
            
                   if(sizeof($records3) > 0  && sizeof($records2) < 0 ){
                       $seller_with_partcode_spare = $seller_with_partcode_spare + 1;
                   }
                }
               
                $total_seller = $seller_with_fulldtls_spare + $seller_with_partcode_spare;
                if($total_seller > 0){
                   $data[] =array('district_id'=>$st['ID'],'district_name'=>$st['district_name'],'total_seller'=>$total_seller);
                }

            }
           $seller_with_fulldtls_spare =0;
           $seller_with_partcode_spare =0;
           $total_seller =0;
          
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

             $this->db->where('district_id',$st['ID']);
             $this->db->where('login_status','0');
             $records =  $this->db->get('seller')->result_array();
           if(sizeof($records) > 0){
                foreach($records as $r){
                    $this->db->where('seller_id',$r['ID']);
                    $records2 = $this->db->get('full_details')->result_array();
                    $this->db->where('seller_id',$r['ID']);
                    $records3 = $this->db->get('part_code')->result_array();

                   
                    if(sizeof($records2) <= 0  && sizeof($records3) <= 0 ){
                      
                        $seller_without_spare = $seller_without_spare + 1;
                    }
                 }
                    if($seller_without_spare > 0){
                        $data[] =array('district_id'=>$st['ID'],'district_name'=>$st['district_name'],'total_seller'=>$seller_without_spare);
                    }
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
                   
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
        $this->db->where($where); 
        $this->db->where('login_status','0'); 
        $this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records = $query->result_array(); 

        $this->db->where("seller.ID NOT IN(select seller_id from part_code where district_id='$disrict_id')");
        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,company_name');
        $this->db->where($where); 
        $this->db->where('login_status','0'); 
        $this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records1 = $query->result_array(); 
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
        $this->db->where('is_profile_created','1');
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
        $this->db->where('is_profile_created','1');
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        $records1 = $query->result_array(); 
        $records4=[];
                 
                 if($records !=''  || $records1 !=''){
                    $records4= array_unique(array_merge($records,$records1), SORT_REGULAR);
                    $this->response($records4,200);
                 
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
         $this->db->where('is_profile_created','1');
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
       
        $this->db->where('stock_id',$stock_id);
        $this->db->where('part_code',$part_code);
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
        $this->db->join('district', 'district.ID = part_code.district_id','Inner');
       
        $this->db->where('part_code.state_id',$state_id);
        $this->db->where('stock_id',$stock_id);
        $this->db->where('part_code',$part_code);
        $this->db->group_by('district_id');

        $query = $this->db->get('part_code');
        $records = $query->result_array(); // as array

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
            $this->db->set('report_type','1');
			$this->db->where('ID',$seller_id);
			$this->db->update('seller');
		     $is_update =  	$this->db->affected_rows();
			if($is_update ==1){
				$this->response(['msg'=>'Reported successfully'],200);
			} else {
				$this->response(['msg'=>'Something went wrong'],422);
			}

		}

          function report_profile_user_listing_get(){

		        $where =array('report_type'=>!'0');
               
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
	    	
        function search_with_fulldetails_in_post(){


          

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

												   	$this->db->select('part_code_ids');
                $this->db->where($wherearray);
                $this->db->where('state_id',$st['ID']);
                $query = $this->db->get('full_details');
                $records = $query->result(); // as array
													

																//check stock id now 
																if(sizeof($records) > 0){
																			foreach($records as $k){
																					$partcode_ids = explode(",",$k->part_code_ids);
																			}
																		
																			foreach($partcode_ids as $key=>$v){
																			

																						$this->db->where('Id',$v);
																						$this->db->where('state_id',$st['ID']);
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
																			$recordsdata[] = array('totalparts'=>$total_dtls_spare,'state_name'=>$st['state_name'],'state_id'=>$st['ID']);
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
      $api_key = 'AAAAKZLje1I:APbGQDw8FD...TjmtuINVB-g';
                
    $msg = array
    (
    'body' 	=> 'Body  Of Notification',
    'title'	=> 'Title Of Notification',
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
        print_r($result);
        return $result;
 }

 function homepage_get(){
     $query1 =$this->db->query("SELECT * FROM `seller` WHERE `is_profile_created`=0 and login_status=0");
     $id_without_profile = $query1->num_rows();

     $query2 =$this->db->query("SELECT * FROM `seller` WHERE `is_profile_created`=1 and login_status=0");
     $new_profile = $query2->num_rows();

     $query3 =$this->db->query("SELECT * FROM `seller` WHERE `report_type`!=0 and login_status=0");
     $reported_profile = $query3->num_rows();


     $query4 =$this->db->query("SELECT DISTINCT   t2.seller_id as psid,t1.seller_id as fsid FROM full_details t1
     RIGHT JOIN part_code t2 ON t2.seller_id = t1.seller_id WHERE   t1.seller_id IS NULL");
     $partcodeseller = $query4->num_rows();

     $query5 =$this->db->query("SELECT DISTINCT full_details.seller_id FROM `full_details` INNER JOIN seller ON seller.ID= full_details.seller_id WHERE login_status='0'");
     $fulldtlsseller = $query5->num_rows();

     $user_with_spare = $partcodeseller + $fulldtlsseller;
     
     $query5 =$this->db->query("SELECT t2.seller_id as psid,t1.ID as fsid FROM seller t1
     LEFT JOIN part_code t2 ON t2.seller_id = t1.ID 
     LEFT JOIN full_details t3 ON t3.seller_id = t1.ID 
     WHERE login_status=0 AND t2.seller_id IS Null");
     $user_without_spare = $query5->num_rows();

     //$user_without_spare =0;
     $query5 =$this->db->query("SELECT * FROM `seller` WHERE `login_status`=0");
     $india_user = $query5->num_rows();

     $user_with_spare = $india_user - $user_without_spare;

     

    
     //$india_user=0;
     $list = array(
              'id_without_profile'=>$id_without_profile,
              'new_profile'=>$new_profile,
              'reported_profile'=>$reported_profile,
              'user_without_spare'=>$user_without_spare,
              'user_with_spare'=>$user_with_spare,
              'india_user'=>$india_user,
              'my_action'=>0,
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
}