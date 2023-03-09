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
        $seller_id = $this->seller_data->seller_id;

        $seller_rec = $this->db->limit(1,0)->get_where('seller',['ID'=>$seller_id])->row();

        $email = $this->post('email');
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
       // $this->form_validation->set_rules('email','Email','trim|required',array('required'=>'Please Fill Email Field'));

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
                $config['upload_path']          = './admin_assets/img/seller_profile/';
                $config['allowed_types']        = 'jpeg|jpg|png|JPEG|JPG|PNG';
                $config['encrypt_name']         = true;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('profile_image'))
                {
                    $errs = $this->upload->display_errors();
                    
                    $error = [
                                'msg' => strip_tags($errs),
                             ];
                           
                    $this->response($error,422);   
                }
                else
                {
                    if(!empty($seller_rec->profile_image) && $seller_rec->profile_image!='seller_thumbnail.png')
                    {
                        unlink('admin_assets/img/seller_profile/'.$seller_rec->profile_image);
                    }
                    $data = $this->upload->data();
                    $ins = [
                                'profile_image'     => $data['file_name'],
                           ];
                    $up_res = $this->db->where('ID',$seller_id)->update('seller',$ins);
                }
            }


            $seller_rec3 = $this->db->limit(1,0)->get_where('seller',['ID'=>$seller_id,'is_profile_created'=>'1'])->row();

            if(empty($seller_rec3)){
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
                     'email' => $email,
                     'is_profile_created' => 1,
                 ];

            } else {
                $ins =  [
                   //  'company_name' => $company_name,   
                 //    'owner_name' => $owner_name,   
                     'mobile_1' => $mobile_1,   
                     'mobile_whatsapp_1' => $mobile_whatsapp_1,   
                     'mobile_call_1' => $mobile_call_1,   
                //     'mobile_2' => $mobile_2,   
                     'mobile_whatsapp_2' => $mobile_whatsapp_2,   
                     'mobile_call_2' => $mobile_call_2,   
                     'state_id' => $state_id,   
                     'district_id' => $district_id,   
                 //    'area' => $area,   
                  //   'address' => $address,   
                     'pincode' => $pincode,
                  //   'email' => $email,
                     'is_profile_created' => 1,
                     'in_approve'=>'0',
                 ];


                 $seller_profile_temp['company_name'] = $company_name;
                 $seller_profile_temp['owner_name'] = $owner_name;
                 $seller_profile_temp['mobile_2'] = $mobile_2;
                 $seller_profile_temp['email'] = $email;
                 $seller_profile_temp['area'] = $area;
                 $seller_profile_temp['address'] = $address;
                 $seller_profile_temp['is_approve'] = '0';
                 $seller_profile_temp['seller_id'] = $seller_id;
                 
                 $this->db->insert('seller_profile_temp',$seller_profile_temp);

            }
            $up_res = $this->db->where(['ID'=>$seller_id,'login_status'=>'0'])->update('seller',$ins);
        
            if($up_res)
            {
                $seller_data = $this->model->hdm_get_where_limit('seller',array('ID'=>$seller_id),1);
                $state_data = $this->model->hdm_get_where_limit('state',array('ID'=>$seller_data['state_id']),1);
                $district_data = $this->model->hdm_get_where_limit('district',array('ID'=>$seller_data['district_id']),1);

                if($seller_data['profile_image'] != '')
                {
                    $profile_image = $seller_data['profile_image'];
                }
                else
                {
                    $profile_image = '';
                }

                $response = [
                                'email' => $seller_data['email'],
                                'mobile_no' => $seller_data['mobile_no'],
                                'profile_image' => $profile_image,
                                'company_name' => $seller_data['company_name'],
                                'owner_name' => $seller_data['owner_name'],
                                'mobile_1' => $seller_data['mobile_1'],
                                'mobile_whatsapp_1' => intval($seller_data['mobile_whatsapp_1']),
                                'mobile_call_1' => intval($seller_data['mobile_call_1']),
                                'mobile_2' => $seller_data['mobile_2'],
                                'mobile_whatsapp_2' => intval($seller_data['mobile_whatsapp_2']),
                                'mobile_call_2' => intval($seller_data['mobile_call_2']),
                                'state_id' => intval($seller_data['state_id']),
                                'state_name' => strval($state_data['state_name']),
                                'district_id' => intval($seller_data['district_id']),
                                'district_name' => strval($district_data['district_name']),
                                'area' => $seller_data['area'],
                                'address' => $seller_data['address'],
                                'pincode' => $seller_data['pincode'],
                                'is_profile_created' => intval($seller_data['is_profile_created']),
                                'status' => intval($seller_data['status']),
                                'created_on' => date_format(date_create($seller_data['created_date']),'d-m-Y'),
                                'updated_on' => date_format(date_create($seller_data['updated_date']),'d-m-Y'),
                            ];

                $this->response($response,200);
            }
            else
            {
                $this->response(['msg'=>'Something went wrong'],422);
            }
        }
    }
    
    public function download_post()
    {
        $this->load->library('pdf');
        
        $seller_id = $this->seller_data->seller_id;
        $url = $this->input->post('url');
        
        $profile_data = $this->db->select('S.*,ST.state_name,D.district_name')
                                 ->from('seller S')
                                 ->join('state ST','ST.ID = S.state_id')
                                 ->join('district D','D.ID = S.district_id')
                                 ->where('S.ID',$seller_id)
                                 ->get()
                                 ->row_array();
                                 
        if(!empty($profile_data))
        {
            $data['url'] = $url;
    	    $data['profile_data'] = $profile_data;
    	    
    	    $html_content = $this->load->view('PDF/profile', $data, true);
    	    
    	    $this->pdf->loadHtml($html_content);
    		$this->pdf->render();
    		
    		$output = $this->pdf->output();
    		
    		file_put_contents('admin_assets/PDF/profile/'.$profile_data['company_name'].'.pdf', $output);
            
            $response = [
                            'url' => base_url('admin_assets/PDF/profile/'.$profile_data['company_name'].'.pdf'),
                        ];
                        
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
        else
        {
            $response = ['msg' => 'Data Not Found'];

            $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
?>