<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_coin extends BD_Controller 
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");
        //$this->auth();
    }
    
    public function index_post()
    {
        // $user_id = $this->user_data->user_id;
	    $user_id= $this->post('user_id');
	    $order_id = $this->post('order_id');
	    $transaction_id = $this->post('transaction_id');
	    $transaction_amount = $this->post('transaction_amount');
	    $coin = $this->post('coin');
	    $status = $this->post('status');
	    
	    $this->form_validation->set_rules('order_id','Order Id','trim|required',array('required'=>'Please Fill Order Id Field'));
	    $this->form_validation->set_rules('transaction_id','Transaction Id','trim|required',array('required'=>'Please Fill Transaction Id Field'));
	    $this->form_validation->set_rules('transaction_amount','Transaction Amount','trim|required|integer',array('required'=>'Please Fill Transaction Amount Field'));
	    $this->form_validation->set_rules('coin','Coin','trim|required|integer',array('required'=>'Please Fill Coin Field'));
	    
	    if($this->form_validation->run()==false)
        {
            $errs = $this->form_validation->error_array();
            $errors = [];
            foreach($errs as $err){$errors [] = $err;}
            $invalidCredentials = ['msg'=>implode(',',$errors)];
            $this->set_response($invalidCredentials,422);
        }
        else
        {
            $insert = [
                        'user_id' => $user_id,
                        'order_id' => $order_id,
                        'transaction_id' => $transaction_id,
                        'transaction_amount' => $transaction_amount,
                        'amount' => $coin,
                        'status' => $status,
                        'date_time' => date('Y-m-d H:i:s'),
                      ];
                      
            $user_account_id = $this->model->hdm_live_id('user_account',$insert);
            $referral_code = $this->db->get_where('user',['ID'=>$user_id])->row('referral_code');
           
            
            if($user_account_id)
            {
                if($transaction_amount>=5 && $referral_code!='')
                {
                     
                     $refuser_id = $this->db->get_where('user',['referral_id'=>$referral_code])->row('ID');
                      $count = $this->db->get_where('user',['ID'=>$refuser_id])->row('count');
                       $is_used = $this->db->get_where('user_account',['user_id'=>$user_id])->row('is_used');
                       if($is_used!=1 && $count==0)
                       {
                           $count=3;
                           $is_used=1;
                                $update = [
                                        'count' => $count,
                                        
                                        
                                      ];
                                      $update1 = [
                                        
                                        'is_used' =>$is_used,
                                        
                                      ];
                                      $where = [
                                        
                                        'user_id'=>$user_id,
                                        
                                        
                                      ];
                                      
                            $this->db->where('ID',$refuser_id)->update('user',$update);
                             $this->db->where($where)->update('user_account',$update1);
                            
                       }
                       if($is_used!=1 && $count!=0)
                       {
                           $count=$count+3;
                           $is_used=1;
                                $update = [
                                        'count' => $count,
                                        
                                        
                                      ];
                                      $update1 = [
                                        
                                        'is_used' =>$is_used,
                                        
                                      ];
                                      $where = [
                                        
                                        'user_id'=>$user_id,
                                        
                                        
                                      ];
                                      
                            $this->db->where('ID',$refuser_id)->update('user',$update);
                             $this->db->where($where)->update('user_account',$update1);
                            
                       }
                       
                
                }
                
                $total_amount = $this->db->query("SELECT SUM(amount) AS amount FROM user_account WHERE user_id = $user_id")->row('amount');
                
                $total_amount = [
                                    'total_amount' => intval($total_amount),
                                    
                                ];

                $this->set_response($total_amount, REST_Controller::HTTP_OK);
            
                //$this->set_response(['msg'=>'Email Id Change Successfully.'], REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response(['msg'=>'Something went wrong'],422);
            }
            
        }
    }
}
?>