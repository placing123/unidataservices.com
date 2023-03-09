<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        date_default_timezone_set("Asia/Kolkata");
        parent::__construct();
        $this->auth();
    }
    
    public function index_post()
    {
        $user_id = $this->user_data->user_id;

        $user_rec = $this->db->limit(1,0)->get_where('user',['ID'=>$user_id])->row();

        $company_name = $this->post('company_name');
        $owner_name = $this->post('owner_name');
        $mobile_1 = $this->post('mobile_1');
        $mobile_whatsapp_1 = $this->post('mobile_whatsapp_1');
        $mobile_call_1 = $this->post('mobile_call_1');
        $mobile_2 = $this->post('mobile_2');
        $mobile_whatsapp_2 = $this->post('mobile_whatsapp_2');
        $mobile_call_2 = $this->post('mobile_call_2');
        $state_id = $this->post('state_id');
        $district_id = $this->post('district_id');
        $area = $this->post('area');
        $address = $this->post('address');
        $pincode = $this->post('pincode');

        $this->form_validation->set_rules('company_name','Company Name','trim|required',array('required'=>'Please Fill Company Name Field'));
        $this->form_validation->set_rules('state_id','State','trim|required',array('required'=>'Please Select Your State'));
        $this->form_validation->set_rules('district_id','District','trim|required',array('required'=>'Please Select Your District'));
        $this->form_validation->set_rules('address','Address','trim|required',array('required'=>'Please Fill Address Field'));

        if($mobile_1 != '')
        {
            $this->form_validation->set_rules('mobile_1','Mobile No','trim|required|regex_match[/^[6-9]{1}[0-9]{9}+$/]',array('required'=>'Please Fill Primary Mobile No Field','regex_match'=>'Please Enter Valid Primary Mobile No.'));
        }

        if($mobile_2 != '')
        {
            $this->form_validation->set_rules('mobile_2','Mobile No','trim|required|regex_match[/^[6-9]{1}[0-9]{9}+$/]',array('required'=>'Please Fill Other Mobile No Field','regex_match'=>'Please Enter Valid Other Mobile No.'));
        }

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
            if(isset($_FILES['profile_image']) && $_FILES['profile_image']['size']>0)
            {
                $config['upload_path']          = './admin_assets/img/user_profile/';
                $config['allowed_types']        = 'jpeg|jpg|png|JPEG|JPG|PNG';
                $config['encrypt_name']         = true;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('profile_image'))
                {
                    $error = $this->upload->display_errors();
                    $this->response($error,422);    
                }
                else
                {
                    if(!empty($user_rec->profile_image) && $user_rec->profile_image!='user_thumbnail.png')
                    {
                        unlink('admin_assets/img/user_profile/'.$user_rec->profile_image);
                    }
                    $data = $this->upload->data();
                    $ins = [
                                'profile_image'     => $data['file_name'],
                           ];
                    $up_res = $this->db->where('ID',$user_id)->update('user',$ins);
                }
            }

            $ins =  [
                        'company_name' => $company_name,   
                        'owner_name' => $owner_name,   
                        'mobile_1' => $mobile_1,   
                        'mobile_whatsapp_1' => $mobile_whatsapp_1,   
                        'mobile_call_1' => $mobile_call_1,   
                        'mobile_2' => $mobile_2,   
                        'mobile_whatsapp_2' => $mobile_whatsapp_2,   
                        'mobile_call_2' => $mobile_call_2,   
                        'state_id' => $state_id,   
                        'district_id' => $district_id,   
                        'area' => $area,   
                        'address' => $address,   
                        'pincode' => $pincode,
                    ];

            $up_res = $this->db->where(['ID'=>$user_id,'login_status'=>'0'])->update('user',$ins);

            if($up_res)
            {
                $user_data = $this->model->hdm_get_where_limit('user',array('ID'=>$user_id),1);
                $state_data = $this->model->hdm_get_where_limit('state',array('ID'=>$user_data['state_id']),1);
                $district_data = $this->model->hdm_get_where_limit('district',array('ID'=>$user_data['district_id']),1);

                if($user_data['profile_image'] != '')
                {
                    $profile_image = $user_data['profile_image'];
                }
                else
                {
                    $profile_image = '';
                }

                $response = [
                                'mobile_no' => $user_data['mobile_no'],
                                'profile_image' => $profile_image,
                                'company_name' => $user_data['company_name'],
                                'owner_name' => $user_data['owner_name'],
                                'mobile_1' => $user_data['mobile_1'],
                                'mobile_whatsapp_1' => intval($user_data['mobile_whatsapp_1']),
                                'mobile_call_1' => intval($user_data['mobile_call_1']),
                                'mobile_2' => $user_data['mobile_2'],
                                'mobile_whatsapp_2' => intval($user_data['mobile_whatsapp_2']),
                                'mobile_call_2' => intval($user_data['mobile_call_2']),
                                'state_id' => intval($user_data['state_id']),
                                'state_name' => strval($state_data['state_name']),
                                'district_id' => intval($user_data['district_id']),
                                'district_name' => strval($district_data['district_name']),
                                'area' => $user_data['area'],
                                'address' => $user_data['address'],
                                'pincode' => $user_data['pincode'],
                                'status' => intval($user_data['status']),
                                'created_on' => date_format(date_create($user_data['created_date']),'d-m-Y'),
                                'updated_on' => date_format(date_create($user_data['updated_date']),'d-m-Y'),
                            ];

                $this->response($response,200);
            }
            else
            {
                $this->response(['msg'=>'Something went wrong'],422);
            }
        }
    }
}
?>