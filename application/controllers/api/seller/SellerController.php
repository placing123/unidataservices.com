<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class sellerController extends BD_Controller 
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
    function search_withparcode_post(){  //district wise partcode   //data except seller id  with same seller state  BUT DIFF DISRICT
        $seller_id = $this->input->post('seller_id');
        $stock_id = $this->input->post('stock_id');
        $part_code = $this->input->post('part_code');
        $category_id = $this->input->post('category_id');
        $state_id = $this->input->post('state_id'); //for other state

             $this->db->select('*');
             $whrarr = array('seller.ID'=>$seller_id,'login_status'=>'0');
             $this->db->where($whrarr);
              //$this->db->where('status','1');
              //$this->db->where('hide_search','0');
             $seller_records =  $this->db->get('seller')->result();
             
             if( $seller_records)
            { 
             $district_id    =  $seller_records[0]->district_id;
              //$state_id    =  $seller_records[0]->state_id;

            $this->db->select('part_code.ID,seller_id,part_code,district_name,state_name,district.ID as district_id,state.ID as state_id');
            $this->db->join('district', 'district.ID = part_code.district_id','LEFT');
            $this->db->join('state', 'state.ID = part_code.state_id','LEFT');
            $this->db->join('seller', 'seller.ID = part_code.seller_id','LEFT');
            $wherearr2 = array('seller_id!='=>$seller_id,'stock_id'=>$stock_id,'part_code'=>$part_code,'category_id'=>$category_id,'part_code.district_id!='=>$district_id,'part_code.state_id'=>$state_id);
            $this->db->where($wherearr2);
												$this->db->where('seller.status',1);
												$this->db->where('seller.hide_search',0);

            $this->db->group_by('district_id');
            $query = $this->db->order_by('order_date','DESC')->get('part_code');
            $records = $query->result_array(); // as array

												$total_records = $this->db->count_all_results();

					//							print_r($this->db->last_query());
            // if(sizeof($records) > 0){
            //     $this->response($records,200);
            // }else {
            //     $this->response(['msg'=>'Data not Found'],403);
            // }

												if(sizeof($records) > 0){
													$this->response(['data'=>$records,'total_records'=>$total_records],200);
											}else {
															$this->response(['msg'=>'Data not Found'],403);
											}
							
        }
        else
        {
             $this->response(['msg'=>'Something went wrong'],422);
        }
    }
    function sr_partcode_post(){
        $seller_id    = $this->input->post('seller_id');
        $stock_id     = $this->input->post('stock_id');
        $part_code    = $this->input->post('part_code');
        $category_id  = $this->input->post('category_id'); 
        $this->db->select('*');
        $this->db->where('ID',$seller_id);
        $this->db->where('login_status','0');
        //$this->db->where('status','1');
         //$this->db->where('hide_search','0');
        $seller_records =  $this->db->get('seller')->result();
        if( $seller_records)
        { 
            $district_id    =  $seller_records[0]->district_id;
            $state_id      =  $seller_records[0]->state_id;

            $wherearr1 = array('seller_id'=>$seller_id,'stock_id'=>$stock_id,'part_code'=>$part_code,'category_id'=>$category_id);
            $wherearr2 = array('seller_id!='=>$seller_id,'stock_id'=>$stock_id,'part_code'=>$part_code,'category_id'=>$category_id,'part_code.district_id'=>$district_id);
  
            $this->db->select('part_code.ID,seller_id,part_code,district_name,DATE_FORMAT(part_code.created_date, "%d-%m-%y") as created_date');
            $this->db->join('district', 'district.ID = part_code.district_id','LEFT');
			$this->db->join('seller', 'seller.ID = part_code.seller_id','LEFT');
			$this->db->where('seller.status',1);
            $this->db->where('seller.hide_search',0);
           // $this->db->limit(1); 
            $records1 = $this->db->order_by('order_date','DESC')->get_where('part_code',$wherearr1)->result();
           
           $this->db->select('part_code.ID,seller_id,part_code,district_name,DATE_FORMAT(part_code.created_date, "%d-%m-%y") as created_date');
           $this->db->join('district', 'district.ID = part_code.district_id','LEFT');
											$this->db->join('seller', 'seller.ID = part_code.seller_id','LEFT');
											$this->db->where('seller.status',1);
            $this->db->where('seller.hide_search',0);
          // $this->db->limit(1); 
           $records2 = $this->db->order_by('order_date','DESC')->get_where('part_code',$wherearr2)->result();
           if(sizeof($records1)> 0){
			       $total_records = sizeof($records1);
			  
               $response = array('data'=>$records1[0], 'total_records'=>$total_records, 'found'=>1,'msg'=>'data found successfully');
           }else if(sizeof($records2)> 0){
		            	$total_records = sizeof($records2);
               $response =  array('data'=>$records2[0],'total_records'=>$total_records,'found'=>0,'msg'=>'data found successfully');
           }else{
               $response =  array('response'=>['state_id'=>$state_id],'found'=>2,'msg'=>'data not found');
           }

           $this->response($response,200);
      
						}
						else
						{
										$this->response(['msg'=>'Something went wrong '],422);
						}
       // print_r($this->db->last_query());
     
    }

    function search_selle_fulldtls_post(){  //self stock

        $seller_id = $this->input->post('seller_id');
        $category_id = $this->input->post('category_id'); 
								$brand_id = $this->input->post('brand_id'); 
								$type_id = $this->input->post('type_id'); 
        $model_no = $this->input->post('model_no'); 
        $stock_id = $this->input->post('stock_id');
        $part_code = $this->input->post('part_code');
  //      $state_id = $this->input->post('state_id');  

        $whereharr =array('ID'=>$seller_id); 
        $this->db->select('*');
        $this->db->where($whereharr);
        $seller_records =  $this->db->get('seller')->result();
  						$district_id    =  $seller_records[0]->district_id;
  						$state_id    =  $seller_records[0]->state_id;
					       
     
        $wherearr1 = array('seller_id'=>$seller_id,'category_id'=>$category_id,'model_no'=>$model_no,'brand_id'=>$brand_id,'type_id'=>$type_id);    
        $this->db->select('full_details.seller_id,full_details.ID as table_id,full_details.district_id,full_details.state_id,part_code_ids,district_name,DATE_FORMAT(created_at, "%d-%m-%y") as created_at');
        $this->db->join('district', 'district.ID = full_details.district_id','LEFT');
        $records1 = $this->db->order_by('order_date','DESC')->get_where('full_details',$wherearr1)->result();

								$total_records = $this->db->count_all_results();

						//	print_r($this->db->last_query());    

        // $records2 = $this->db->order_by('created_at','DESC')->get_where('full_details',$wherearr2)->result();
										if(sizeof($records1) > 0){  //check fulldetails  partcode ids has same partcode of user inputed  after matching 4 params 
														foreach($records1 as $row){
																		$partcode_arr = explode(",",$row->part_code_ids);
																								if($part_code !=""){
																												foreach($partcode_arr as $id){
																																		$parcode_exit = $this->db->get_where('part_code',array('ID'=>$id,'part_code'=>$part_code,'stock_id'=>$stock_id ))->result();
																																		if(sizeof($parcode_exit) > 0){
																																						$records1 = array('seller_id'=>$row->seller_id,'id'=>$row->table_id,'part_code'=>$part_code,'district_name'=>$row->district_name,'district_id'=>$row->district_id,'state_id'=>$row->state_id,'created_date'=>$row->created_at);
																																						$response = array('response'=>$records1,'total_records'=>$total_records,'found'=>0,'from'=>'fulldetails','info'=>'match partcode_ids','msg'=>'data found successfully');
																																						$this->response($response,200);
																																		}
																																		else {
																																			$this->db->join('seller', 'seller.ID = part_code.seller_id','LEFT');
																																			$this->db->where('seller.status','1');  //approve
																																			$this->db->where('stock_id',$stock_id);
																																			$query2 = $this->db->get('part_code');
																																			$records2 = $query2->result_array(); // as array
																																			if(sizeof($records2) > 0){
																																				$records1 = array('seller_id'=>$row->seller_id,'id'=>$row->table_id,'part_code'=>$part_code,'district_name'=>$row->district_name,'district_id'=>$row->district_id,'state_id'=>$row->state_id,'created_date'=>$row->created_at);
																																				$response = array('response'=>$records1,'total_records'=>$total_records,'found'=>0,'from'=>'fulldetails','info'=>'pcode not match but other condition match','msg'=>'data found successfully');
																																							$this->response($response,200);
											
																																			}			
																																						
																																		}
																														}
																							} else{
																					
																								$this->db->join('seller', 'seller.ID = part_code.seller_id','LEFT');
																								$this->db->where('seller.status','1');  //approve
																								$this->db->where('stock_id',$stock_id);
																								$query2 = $this->db->get('part_code');

																								$records2 = $query2->result_array(); // as array

																								$total_records = $this->db->count_all_results();

																								if(sizeof($records2) > 0){
																									$records1 = array('seller_id'=>$row->seller_id,'id'=>$row->table_id,'part_code'=>$part_code,'district_name'=>$row->district_name,'district_id'=>$row->district_id,'state_id'=>$row->state_id,'created_date'=>$row->created_at);
																									$response = array('response'=>$records1,'total_records'=>$total_records,'found'=>0,'from'=>'fulldetails','info'=>'pcode not match but other condition match1','msg'=>'data found successfully');
																												$this->response($response,200);

																								}					
																								
																							

																							}
																		}
												}
												else {  //check into partcode 
													$wherearr1 = array('seller_id'=>$seller_id,'category_id'=>$category_id,'stock_id'=>$stock_id,'part_code'=>$part_code);    
													$this->db->select('part_code.seller_id,part_code.state_id,part_code.district_id,part_code.ID as table_id,part_code,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date');
													$this->db->join('district', 'district.ID = part_code.district_id','LEFT');
													$records1 = $this->db->order_by('order_date','DESC')->get_where('part_code',$wherearr1)->row();


													$wherearr3 = array('seller_id'=>$seller_id,'category_id'=>$category_id,'stock_id'=>$stock_id,'part_code'=>$part_code);    
													$this->db->select('part_code.seller_id,part_code.state_id,part_code.district_id,part_code.ID as table_id,part_code,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date');
													$this->db->join('district', 'district.ID = part_code.district_id','LEFT');
													$recordsp3 = $this->db->order_by('order_date','DESC')->get_where('part_code',$wherearr3)->result();
													$total_records = $this->db->count_all_results();


													if(!empty($records1)> 0){ //selft stock match partocode
								
											
														$records1 = array('seller_id'=>$records1->seller_id,'id'=>$records1->table_id,'part_code'=>$records1->part_code,'district_name'=>$records1->district_name,'district_id'=>$records1->district_id,'state_id'=>$records1->state_id,'created_date'=>$records1->created_date);
														$response = array('response'=>$records1,'total_records'=>$total_records,'found'=>0,'from'=>'partcode','info'=>'frompartcode','msg'=>'data found successfully');
												  	$this->response($response,200);
												}

														$response =  array('data1'=>['state_id'=>$state_id],'found'=>2,'msg'=>'data not found');
		     		}
									$response =  array('data1'=>['state_id'=>$state_id],'found'=>2,'msg'=>'data not found');
       	$this->response($response,200);
					}

    function feedbacklisting_post(){

		$feedback_type = $this->input->post('feedback_type');


		$this->db->where('type',$feedback_type);
        $query = $this->db->get('feedback');
        $records = $query->result_array(); // as array
        if(sizeof($records) > 0){
            $this->response($records,200);
        }else {
            $this->response(['msg'=>'Something went wrong'],422);
        }
    }


				function search_selle_other_fulldtls_post(){  //self stock

					$seller_id = $this->input->post('seller_id');
					$category_id = $this->input->post('category_id'); 
					$model_no = $this->input->post('model_no'); 
					$brand_id = $this->input->post('brand_id'); 
					$type_id = $this->input->post('type_id'); 
					$stock_id = $this->input->post('stock_id');
					$part_code = $this->input->post('part_code');
					$state_id = $this->input->post('state_id');

					$whereharr =array('ID'=>$seller_id); 
					$this->db->select('*');
					$this->db->where($whereharr);
					$seller_records =  $this->db->get('seller')->result();
					$district_id    =  $seller_records[0]->district_id;  //
									
		
					$wherearr1 = array('seller_id!='=>$seller_id,'category_id'=>$category_id,'model_no'=>$model_no,'brand_id'=>$brand_id,'type_id'=>$type_id,'full_details.state_id'=>$state_id,'district_id'=>$district_id);      //same disrict but other seller
				$this->db->select('full_details.seller_id,full_details.ID,full_details.district_id,full_details.state_id,part_code_ids,district_name,DATE_FORMAT(created_at, "%d-%m-%y") as created_at');
					$this->db->join('district', 'district.ID = full_details.district_id','LEFT');
					$records1 = $this->db->order_by('order_date','DESC')->get_where('full_details',$wherearr1)->result();

					$total_records = $this->db->count_all_results();

						if(sizeof($records1) > 0){  //check fulldetails  partcode ids has same partcode of user inputed not after matching 4 params 
											foreach($records1 as $row){
															$partcode_arr = explode(",",$row->part_code_ids);
																					if($part_code !=""){
																									foreach($partcode_arr as $id){
																															$parcode_exit = $this->db->get_where('part_code',array('ID'=>$id,'part_code'=>$part_code,'stock_id'=>$stock_id ))->result();
																															if(sizeof($parcode_exit) > 0){
																																			$records1 = array('seller_id'=>$row->seller_id,'id'=>$row->ID,'part_code'=>$part_code,'district_name'=>$row->district_name,'district_id'=>$row->district_id,'state_id'=>$row->state_id,'created_date'=>$row->created_at);
																																			$response = array('data2'=>$records1,'total_records'=>$total_records,'found'=>1,'from'=>'fulldetails','info'=>'match partcode_ids','msg'=>'data found successfully');
																																			$this->response($response,200);
																															}
																															else{
																																$records1 = array('seller_id'=>$row->seller_id,'id'=>$row->ID,'part_code'=>$part_code,'district_name'=>$row->district_name,'district_id'=>$row->district_id,'state_id'=>$row->state_id,'created_date'=>$row->created_at);
																																$response = array('data2'=>$records1,'total_records'=>$total_records,'found'=>1,'from'=>'fulldetails','info'=>'pcode not match but other condition match','msg'=>'data found successfully');
																																		$this->response($response,200);
																																			
																															}
																											}
																				} else{
																					$records1 = array('seller_id'=>$row->seller_id,'id'=>$row->ID,'part_code'=>$part_code,'district_name'=>$row->district_name,'district_id'=>$row->district_id,'state_id'=>$row->state_id,'created_date'=>$row->created_at);
																					$response = array('data2'=>$records1,'total_records'=>$total_records,'found'=>1,'from'=>'fulldetails','info'=>'pcode not match but other condition match','msg'=>'data found successfully');
																								$this->response($response,200);

																				}
															}	
									}
									else {  //check into partcode 
										$wherearr1 = array('seller_id!='=>$seller_id,'category_id'=>$category_id,'district_id'=>$district_id,'stock_id'=>$stock_id,'part_code'=>$part_code);    
													$this->db->select('part_code.seller_id,part_code.state_id,part_code.district_id,part_code.ID,part_code,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date');
													$this->db->join('district', 'district.ID = part_code.district_id','LEFT');
													$records1 = $this->db->order_by('order_date','DESC')->get_where('part_code',$wherearr1)->row();


													$wherearr3 = array('seller_id!='=>$seller_id,'category_id'=>$category_id,'district_id'=>$district_id,'stock_id'=>$stock_id,'part_code'=>$part_code);    
													$this->db->select('part_code.seller_id,part_code.state_id,part_code.district_id,part_code.ID,part_code,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date');
													$this->db->join('district', 'district.ID = part_code.district_id','LEFT');
													$this->db->order_by('order_date','DESC')->get_where('part_code',$wherearr3)->result();

													$total_records = $this->db->count_all_results();

									


													if(!empty($records1)> 0){ //selft stock match partocode
								
														$records2 = array('seller_id'=>$records1->seller_id,'id'=>$records1->ID,'part_code'=>$records1->part_code,'district_name'=>$records1->district_name,'district_id'=>$records1->district_id,'state_id'=>$records1->state_id,'created_date'=>$records1->created_date);
														$response = array('data2'=>$records2,'total_records'=>$total_records,'found'=>1,'from'=>'partcode','info'=>'frompartcode','msg'=>'data found successfully');
																	$this->response($response,200);
																}
											$response =  array('data2'=>['state_id'=>$state_id],'found'=>2,'msg'=>'data not found');
						}
					$this->response($response,200);
		}


		function send_inquery_post(){

		$query="SELECT MIN(order_date) as mindate FROM part_code LIMIT1";
		$records = $this->db->query($query)->row();
		if(!empty($records)> 0){
			  $mindate = $records->mindate;
			  $mindate = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($mindate)));
		}

			$sender_seller = $this->input->post('sender_seller');
			$receiver_seller = $this->input->post('receiver_seller');
			$type = $this->input->post('from');
			$table_id = $this->input->post('table_id');


	

				if($type =='fulldetails'){
					$type="0";
			 	$this->db->set('order_date',$mindate);
					$this->db->where('id',$table_id);
					$this->db->update('full_details');
				}else{
					$type="1";

					$this->db->set('order_date',$mindate);
					$this->db->where('id',$table_id);
					$this->db->update('part_code');
				//	print_r(	$this->db->last_query());

				}

				$wherearr = array('sender_seller'=>$sender_seller,'receiver_seller'=>$receiver_seller,'type'=>$type,'table_id'=>$table_id);
				$records1 = $this->db->get_where('inquiry',$wherearr)->row();
				if(!empty($records1)> 0){
					$response =  array('status'=>2,'msg'=>'inquery already sent');
					return $this->response($response,200);
				}

			$data = array('sender_seller'=>$sender_seller,'receiver_seller'=>$receiver_seller,'type'=>$type,'table_id'=>$table_id);

			$this->db->insert('inquiry',$data);

			$insert_id = $this->db->insert_id();

			$response =  array('status'=>1,'msg'=>'Will contact to you soon','id'=>$insert_id);
			$this->response($response,200);
		}

		function sent_inquery_list_post(){

			$seller_id = $this->input->post('seller_id');
			$category_id = $this->input->post('category_id');

			$this->db->order_by("create_at", "desc");
			$indata = $this->db->get_where('inquiry',array('sender_seller'=>$seller_id,'is_sender_del'=>'0'))->result();
		
			$records_arr =[];
			if(sizeof($indata) > 0){
							foreach($indata as $i){

							
								if($i->type =='0'){
													$table_name = 'full_details';
													$id=$i->table_id;
													$records = $this->Common->sent_inquery_fulldetls($id,$category_id);	

										//			print_r($records);
													if(sizeof($records) > 0){
																								foreach($records as $row){
																									$rec = $this->db->get_where('stock',array('ID'=>$row['stid']))->row();
																						//			print_r($rec);
																									$stock_name =  $rec->name;
																									$records_arr[] = array('mark_as_read'=>$i->is_sender_read,'dealer_id'=>$i->receiver_seller,'deal_id'=>$i->id,'type'=>$i->type,'stock_name'=>$stock_name,'part_code'=>'','receiver_name'=>$row['owner_name'],'district_name'=>$row['district_name'],'state_name'=>$row['state_name'],'created_date'=>$row['created_date'],'brand_name'=>$row['brand_name'],'category_name'=>$row['category_name'],'type_name'=>$row['type_name'],'model_no'=>$row['model_no']);
																			  			}

												   	}
				    		}
									else	{
											$table_name = 'part_code';
											$id=$i->table_id;
											$records1 = $this->Common->sent_inquery_partcode($id,$category_id);	
												if(sizeof($records1) > 0){
																foreach($records1 as $row){
																	$records_arr[] = array('mark_as_read'=>$i->is_sender_read,'dealer_id'=>$i->receiver_seller,'deal_id'=>$i->id,'type'=>$i->type,'stock_name'=>$row['stock_name'],'part_code'=>$row['part_code'],'receiver_name'=>$row['owner_name'],'district_name'=>$row['district_name'],'state_name'=>$row['state_name'],'created_date'=>$row['created_date'],'brand_name'=>"",'category_name'=>"",'type_name'=>"",'model_no'=>"");
																}
												 	}
				     	}
					}
			}
   if(sizeof($records_arr) > 0){
							$this->response($records_arr,200);
					}else {
									$this->response(['msg'=>'No Data Found'],422);
					}

				
			}

			function receive_seller_inquery_post(){

				$seller_id = $this->input->post('seller_id');
		 	$category_id = $this->input->post('category_id');

				$this->db->order_by("create_at", "desc");
			 $indata = $this->db->get_where('inquiry',array('receiver_seller'=>$seller_id,'is_receiver_del'=>'0'))->result();
		
					$records_arr =[];
					if(sizeof($indata) > 0){
									foreach($indata as $i){
														$sender_seller_id = $i->sender_seller;
														$records1 = $this->db->get_where('seller',array('ID'=>$sender_seller_id))->row();
																	if(!empty($records1)> 0){ 
																	    	$sender_name = $records1->owner_name;

																										if($i->type =='0'){
																											$table_name = 'full_details';
																											$id=$i->table_id;
																											$records = $this->Common->sent_inquery_fulldetls($id,$category_id);	
																														if(sizeof($records) > 0){
																																			foreach($records as $row){
																																				$rec = $this->db->get_where('stock',array('ID'=>$row['stid']))->row();
																																				//			print_r($rec);
																																							$stock_name =  $rec->name;
																																				$records_arr[] = array('mark_as_read'=>$i->is_receiver_read,'dealer_id'=>$i->sender_seller,'deal_id'=>$i->id,'type'=>$i->type,'stock_name'=>$stock_name,'part_code'=>'','sender_name'=>$sender_name,'district_name'=>$row['district_name'],'state_name'=>$row['state_name'],'created_date'=>$row['created_date'],'brand_name'=>$row['brand_name'],'category_name'=>$row['category_name'],'type_name'=>$row['type_name'],'model_no'=>$row['model_no']);
																																	}
																	
																														}
																											}
																											else	{
																													$table_name = 'part_code';
																													$id=$i->table_id;
																													$records1 = $this->Common->sent_inquery_partcode($id,$category_id);	
																		
																															if(sizeof($records1) > 0){
																																		foreach($records1 as $row){
																																		$records_arr[] = array('mark_as_read'=>$i->is_receiver_read,'dealer_id'=>$i->sender_seller,'deal_id'=>$i->id,'type'=>$i->type,'stock_name'=>$row['stock_name'],'part_code'=>$row['part_code'],'sender_name'=>$sender_name,'district_name'=>$row['district_name'],'state_name'=>$row['state_name'],'created_date'=>$row['created_date'],'brand_name'=>"",'category_name'=>"",'type_name'=>"",'model_no'=>"");
																																		}
																																}
																												}
                 		}
									}
									

					 	}
							if(sizeof($records_arr) > 0){
								$this->response($records_arr,200);
							}else {
											$this->response(['msg'=>'No Data Found'],422);
							}

			}

			function seller_fav_post(){
	
				$deal_id = $this->input->post('deal_id'); 
				$type = $this->input->post('type');   //receiver list =1 sentlist=>2
				if($type == '1'){

					$is_receiver_fav='1';
					$this->db->set('is_receiver_fav',$is_receiver_fav);
					$this->db->where('id',$deal_id);
					$this->db->update('inquiry');
								
					//			print_r($this->db->last_query());
				}else{
					$is_sender_fav ='1';
 				$this->db->set('is_sender_fav',$is_sender_fav);
					$this->db->where('id',$deal_id);
					$this->db->update('inquiry');
					//			print_r($this->db->last_query());

				}
			
				$this->response(['msg'=>'add to favourite successfully'],200);
	}

	function mark_as_read_post(){

		$deal_id = $this->input->post('deal_id'); 
		$type = $this->input->post('type');   //receiver list =1 sentlist=>2
//is_read =0  1=read
		
$is_read =  $this->input->post('is_read'); 

$msg ="Mark as read successfully";

		if($type == '1'){

			if($is_read =='0'){
				$is_receiver_read='0';
				$msg ="Mark unread successfully";
			} else {
				$is_receiver_read='1';


			}
	
			$this->db->set('is_receiver_read',$is_receiver_read);
			$this->db->where('id',$deal_id);
			$this->db->update('inquiry');
						
			//			print_r($this->db->last_query());
		}else{

			if($is_read =='0'){
				$is_sender_read='0';

				$msg ="Mark unread successfully";
				
			} else {
				$is_sender_read='1';
			}


			$this->db->set('is_sender_read',$is_sender_read);
			$this->db->where('id',$deal_id);
			$this->db->update('inquiry');
			//			print_r($this->db->last_query());

		}

		$this->response(['msg'=>$msg],200);


	}
	
 function others_buyfeedback_post(){

		$seller_id = $this->input->post('seller_id'); 
	
		$query="SELECT feed,feedback_id,COUNT(seller_id) as ttlfeedback FROM seller_feedback LEFT JOIN feedback on feedback.id = seller_feedback.feedback_id 
		WHERE seller_id='".$seller_id."' GROUP BY feedback_id";

		$records = $this->db->query($query)->result();

		if(sizeof($records) > 0){
				$this->response($records,200);
		}else {
				$this->response(['msg'=>'Data not Found'],403);
		}


	}

	function delete_deals_post(){

		$deal_id = $this->input->post('deal_id'); 
		$type = $this->input->post('type');   //receiver list =1 sentlist=>2
		if($type == '1'){
		   	$is_receiver_del='1';
						$this->db->set('is_receiver_del',$is_receiver_del);
						$this->db->where('id',$deal_id);
						$this->db->update('inquiry');
			//			print_r($this->db->last_query());
		}else{
						
						$is_sender_del ='1';
						$this->db->set('is_sender_del',$is_sender_del);
						$this->db->where('id',$deal_id);
						$this->db->update('inquiry');
			//			print_r($this->db->last_query());

		}
	
		$this->response(['msg'=>'Delete successfully'],200);

	}


function check_deals_post(){

	$records_arr =[];
	$seller_id = $this->input->post('seller_id'); 
	
	$this->db->select('*');
	$this->db->where('sender_seller',$seller_id);
	$this->db->where('is_sender_del','0');
	$this->db->or_where('receiver_seller',$seller_id);


  
$this->db->order_by("create_at", "desc");
	$query = $this->db->get('inquiry');
 $indata = $query->result_array(); // as array
	$is_feedback=0;

	$receiver_name="";
	if(sizeof($indata) > 0){
		  foreach($indata as $row1){
							   if($row1['sender_seller'] == $seller_id ){
									    $query_type='sent';
						    	} else{
							 		 	$query_type='receive';
				     	}

													$sender_seller_id = $row1['sender_seller'];
													$records1 = $this->db->get_where('seller',array('ID'=>$sender_seller_id))->row();
													if(!empty($records1)> 0){ 
																			$sender_name = $records1->owner_name;
																			$is_feedback=0;
																			$feedback="";
														} 
													$receiver_seller_id = $row1['receiver_seller'];

													$records1 = $this->db->get_where('seller',array('ID'=>$receiver_seller_id))->row();
													if(!empty($records1)> 0){ 
																			$receiver_name = $records1->owner_name;

																			$this->db->join('feedback', 'feedback.ID = seller_feedback.feedback_id','LEFT');
																			$feedback_data = $this->db->get_where('seller_feedback',array('seller_id'=>$receiver_seller_id))->row();
																			if(!empty($feedback_data)> 0){ 
																				$is_feedback=1;
																				$feedback = $feedback_data->feed;
																			}
																			
													} 

										if($row1['type'] =='0'){
											$table_name = 'full_details';
								
											$id=  $row1['table_id'];
											$records2 = $this->Common->sent_inquery_fulldetls1($id);	
														if(sizeof($records2) > 0){
																			foreach($records2 as $row){
																				$rec = $this->db->get_where('stock',array('ID'=>$row['stid']))->row();
																				//			print_r($rec);
																							$stock_name =  $rec->name;
																				$records_arr[] = array('is_feedback'=>$is_feedback,'feedback'=>$feedback,'query_type'=>$query_type,'sender_name'=>$sender_name,'receiver_name'=>$receiver_name,'deal_id'=>$row1['id'],'type'=>$row1['type'],'stock_name'=>$stock_name,'part_code'=>'','district_name'=>$row['district_name'],'state_name'=>$row['state_name'],'created_date'=>$row['created_date'],'brand_name'=>$row['brand_name'],'category_name'=>$row['category_name'],'type_name'=>$row['type_name'],'model_no'=>$row['model_no']);
																	}
	
														}
											}
											else	{	
													$table_name = 'part_code';
													$id=  $row1['table_id'];
													$records1 = $this->Common->sent_inquery_partcode1($id);	
		
															if(sizeof($records1) > 0){
																		foreach($records1 as $row){
																		$records_arr[] = array('is_feedback'=>$is_feedback,'feedback'=>$feedback,'query_type'=>$query_type,'sender_name'=>$sender_name,'receiver_name'=>$receiver_name,'deal_id'=>$row1['id'],'type'=>$row1['type'],'stock_name'=>$row['stock_name'],'part_code'=>$row['part_code'],'sender_name'=>$sender_name,'district_name'=>$row['district_name'],'state_name'=>$row['state_name'],'created_date'=>$row['created_date'],'brand_name'=>"",'category_name'=>"",'type_name'=>"",'model_no'=>"");
																		}
																}
												}



				}
	}

	if(sizeof($records_arr) > 0){
		$this->response($records_arr,200);
	}else {
					$this->response(['msg'=>'No Data Found'],422);
	}

}

function seller_favourite_list_post(){

	$records_arr =[];
	$seller_id = $this->input->post('seller_id'); 
	$this->db->where("(sender_seller='".$seller_id."' OR receiver_seller='".$seller_id."')", NULL, FALSE);
	$this->db->where("(is_sender_fav='1' OR is_receiver_fav='1')", NULL, FALSE);
	$this->db->select('*');
	$query = $this->db->get('inquiry');
    $indata = $query->result_array(); // as array

	if(sizeof($indata) > 0){
					foreach($indata as $row1){
											if($row1['sender_seller'] == $seller_id ){
															$this->db->join('district', 'district.ID = seller.district_id','LEFT');
															$this->db->join('state', 'state.ID = seller.state_id','LEFT');
																$records1 = $this->db->get_where('seller',array('seller.ID'=>$row1['receiver_seller']))->row();
																if(!empty($records1)> 0){ 
																						$name = $records1->owner_name;
																						$state_name = $records1->state_name;
																						$district_name = $records1->district_name;
																						$mobile =$records1->mobile_1;
																						$seller_id = $records1->ID;
																	} 
																$query_type='sent';

																} else{
																$this->db->join('district', 'district.ID = seller.district_id','LEFT');
																$this->db->join('state', 'state.ID = seller.state_id','LEFT');
																	$records1 = $this->db->get_where('seller',array('seller.ID'=>$row1['sender_seller']))->row();
																if(!empty($records1)> 0){ 
																	$name = $records1->owner_name;
																	$state_name = $records1->state_name;
																	$district_name = $records1->district_name;
																	$mobile =$records1->mobile_1;
																	$seller_id = $records1->ID;
																	} 
																	$query_type='receive';
													}
													$records_arr[] = array('seller_id'=>$seller_id,'id'=>$row1['id'],'name'=>$name,'mobile'=>$mobile,'type'=>$row1['type'],'state_name'=>$state_name,'district_name'=>$district_name,'fav_at'=>date('d-m-y',strtotime($row1['fav_at'])));
						}
		}
		if(sizeof($records_arr) > 0){
			$this->response($records_arr,200);
		}else {
			$this->response(['msg'=>'No Data Found'],422);
		}
}




}