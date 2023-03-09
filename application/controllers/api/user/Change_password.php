<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
    }
	
	public function index_post()
	{
	    $user_id = $this->user_data->user_id;
	    
	    $old_password = $this->post('old_password');
	    $new_password = $this->post('new_password');
	    
	    $this->form_validation->set_rules('old_password','Old Password','required|min_length[6]',
                                        array('required'=>'Please Fill Old Password Field','min_length'=>'Old Password Minimum 6 character'));
	    $this->form_validation->set_rules('new_password','New Password','required|min_length[6]',
                                        array('required'=>'Please Fill New Password Field','min_length'=>'New Password Minimum 6 character'));
	    
        
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
            $ck_password = $this->model->hdm_get_where_limit('user',array('ID'=>$user_id),1);
            
            if($old_password == $this->encryption->decrypt($ck_password['password']))
            {
                $update = [
                            'password' => $this->encryption->encrypt($new_password),
                          ];
                          
                $this->model->hdm_update_where('user',$update,array('ID'=>$user_id));
                
                $this->set_response(['msg'=>'Password Change Successfully.'], REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response(['msg'=>'Please Enter Valid Old Password.'],422);
            }
        }
        
	}
}