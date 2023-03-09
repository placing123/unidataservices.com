<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends BD_Controller 
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");
        $this->auth();
    }
    
    public function index_post()
    {
        /** $user_id = $this->user_data->user_id;
        
        $payment_history = $this->db->order_by('ID','DESC')->where('user_id',$user_id)->get('user_account')->result();
        
        if(!empty($payment_history))
        {
            $data = [];
            foreach($payment_history as $payment_history_row)
            {
                $data[] = [
                            'order_id' => $payment_history_row->order_id,
                            'transaction_id' => $payment_history_row->transaction_id,
                            'transaction_amount' => intval($payment_history_row->transaction_amount),
                            'coin' => intval($payment_history_row->amount),
                            'status' => $payment_history_row->status,
                            'date_time' => date_format(date_create($payment_history_row->date_time),'d-m-Y H:i:s'),
                          ];
            }
            
            $this->set_response($data, REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response(['msg'=>'Data not found'],422);
        }
   **/
   
   $user_id= $this->post('user_id');
   $payment_history = $this->db->order_by('ID','DESC')->where('user_id',$user_id)->get('user_account')->result();
        
        if(!empty($payment_history))
        {
           $total_amount = $this->db->query("SELECT SUM(amount) AS amount FROM user_account WHERE user_id = $user_id")->row('amount');
            
            $this->set_response($total_amount, REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response(['msg'=>'Data not found'],422);
        }
    }
   
}
?>