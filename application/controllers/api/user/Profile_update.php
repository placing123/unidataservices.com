<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_update extends BD_Controller 
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
	    
	    $name = $this->post('name');
	    $age = $this->post('age');
	    $country = $this->post('country');
	    //$email = $this->post('email');
	    
	   // $this->form_validation->set_rules('email','Email','trim|required|valid_emails|callback_email_unique['.$user_id.']',array('required'=>'Please Fill Email Field'));
	    $this->form_validation->set_rules('name','Name','trim|required',array('required'=>'Please Fill Name Field'));
	    $this->form_validation->set_rules('age','Age','trim|required|integer',array('required'=>'Please Fill Age Field'));
	    $this->form_validation->set_rules('country','Country','trim|required',array('required'=>'Please Fill Country Field'));
        
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
            $update = [
                        'name' => $name,
                        'age' => $age,
                        'country' => $country,
                        
                      ];
                      
            $up_res = $this->db->where('ID',$user_id)->update('user',$update);
            
            if($up_res)
            {
                $user_data = $this->model->hdm_get_where_limit('user',array('ID'=>$user_id),1);
                
                $profile_update =   [
                                        'name' => $user_data['name'],
                                        'age' => intval($user_data['age']),
                                        'country' => $user_data['country'],
                                        'user_name' => $user_data['user_name'],
                                       
                                        'referral_id' => $user_data['referral_id'],
                                    ];

                $this->set_response($profile_update, REST_Controller::HTTP_OK);
            
                //$this->set_response(['msg'=>'Email Id Change Successfully.'], REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response(['msg'=>'Something went wrong'],422);
            }
        }
        
	}
	
	public function email_unique($email,$user_id)
	{
	    $count_email = $this->db->get_where('user',['ID!='=>$user_id,'email'=>$email])->num_rows();
	    
	    if($count_email == 0)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('email_unique','This Email already exists.');
			return FALSE;
		}
	}
}