<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check extends BD_Controller 
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
         $user_id= $this->post('user_id');
         $is_played= $this->post('is_played');
         
         
         $count = $this->db->get_where('user',['ID'=>$user_id])->row('count');
        $is_used = $this->db->get_where('user',['ID'=>$user_id])->row('is_used');
     if($user_id!='' && $is_played!='')
     {
        if($count!=0 && $is_played!=0)
        {
            $count=$count-1;
            
            $update = [
                                'count' =>$count,
                              
                              ];
                            $this->db->where('ID',$user_id)->update('user',$update);
          // $this->model->hdm_update_where('user',['count'=>$count],['ID'=>$user_id]);
            $this->set_response($count, REST_Controller::HTTP_OK);
        }
        else
        {
             $this->set_response(intval($count), REST_Controller::HTTP_OK);
        }
        
     }
     else
    {
        $this->response(['msg'=>'Something went wrong'],422);
    }
        
  }
}
?>