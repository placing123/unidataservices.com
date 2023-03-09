<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller

{

	public function index()

	{
	    
	  

		$this->session_check();

		$data['title'] = 'Student-Login';

		$data['action'] = 'admin-authenticate';

		$this->load->view('admin/login',$data);

	}

	

	public function student_register()

	{

		$this->session_check();

		$data['title'] = 'Student Register';

		$data['action'] = 'Registration';

		$r=$this->db->get("student");

		$m=$r->num_rows();

		if($m==0)

		{

		    $seq = 1;

            $a = sprintf("%d", $seq);

            $roll_no = $a;

		}

		else

		{

		    $query2 = $this->db->query("SELECT * FROM student ORDER BY stud_roll_no DESC LIMIT 1")->result();

		    $last_id = $query2[0]->stud_roll_no;

	        $inc_no = "$last_id" + 1;

	        $ars = sprintf("%d", $inc_no);

	        $roll_no = $ars;

		}

		$data['roll_no'] = $roll_no;

		$this->load->view('admin/registration',$data);

	}

	function alpha_dash_space($str)

	{

		return ( ! preg_match("/^([A-Z-a-z_ ])+$/i", $str)) ? FALSE : TRUE;

	} 

	public function add_student()

	{

		$this->form_validation->set_rules('name','Name','trim|required|callback_alpha_dash_space|min_length[5]',array('required'=>'<div class="error">Please Fill %s field</div>'));

		$this->form_validation->set_rules('email','Email','trim|required|is_unique[student.stud_email]|valid_email',array('required'=>'<div class="error">Please Fill %s field','is_unique'=>'<div class="error">This %s Already exists</div>'));

		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[8]',array('required'=>'<div class="error">Please Fill %s field</div>'));

		$this->form_validation->set_rules('passwordconf','Password Confirmation','trim|required|matches[password]',array('required'=>'<div class="error">Please Fill %s field</div>','matches'=>'<div class="error">Password and Confirm Password must be same</div>'));

		$this->form_validation->set_rules('standard','Standard','trim|required',array('required'=>'<div class="error">Please Fill %s field</div>'));

		if($this->form_validation->run() == FALSE)

		{

			$data['title'] = 'Student Register';

			$data['action'] = 'Registration';

			$r=$this->db->get("student");

			$m=$r->num_rows();

			if($m==0)

			{

				$seq = 1;

				$a = sprintf("%d", $seq);

				$roll_no = $a;

			}

			else

			{

				$query2 = $this->db->query("SELECT * FROM student ORDER BY stud_roll_no DESC LIMIT 1")->result();

				$last_id = $query2[0]->stud_roll_no;

				$inc_no = "$last_id" + 1;

				$ars = sprintf("%d", $inc_no);

				$roll_no = $ars;

			}

			$data['roll_no'] = $roll_no;

			$this->load->view('admin/registration',$data);

			}

		else

		{

			if(isset($_FILES['pic']['name']) && $_FILES['pic']['name']!=''  ) {$pic = $this->lib->pic_upload('pic');} else {$pic="";} 

			$insert = array(

				'stud_roll_no'		=> $this->input->post('rollno'),

				'stud_name'			=> $this->input->post('name'),

				'stud_email'		=> $this->input->post('email'),

				'stud_password'		=> $this->encryption->encrypt($this->input->post('password')),

				'stud_mobile'		=> $this->input->post('mobile'),

				'stud_std'			=> $this->input->post('standard'),

				'stud_pic'			=> '<img src="'.base_url($pic).'" width="100px" height="100px">',

				'stud_pic_path'		=>	$pic,

			);

			$res = $this->model->hdm_insert('student',$insert);

			if($res)

			{

				$this->session->set_flashdata('success','Student Registered Successfully');

				redirect('secure-login');

			}

			else

			{

				$this->session->set_flashdata('error','Something wrong');

				redirect('student-register');

			}

		}

	}

	

	public function authenticate()

	{

		$username = $this->input->post('email');

		$password = $this->input->post('password');

		

			$login_data = $this->model->hdm_get_where('Admin',array('email'=>$username));

			// print_r($login_data);

			if(!empty($login_data))

			{

				
				$newpassword = $this->input->post('password');

				

				$pass = $this->encryption->decrypt($login_data[0]->password);

				  
			  

			  if($newpassword == $pass)

			  {

						$sess = array(

							'role_id' => $login_data[0]->id,
							'name' => $login_data[0]->email,

							'email' => $login_data[0]->username,                                                  

							'mobile' => '9033505470',                                                  

							'std' => '1',//$login_data[0]->stud_std,                                                  

							'pic' => '',                                                  

							'is_login' => TRUE

						);

						$this->session->set_userdata('admin_sess',$sess);

						redirect(base_url('admin-dashboard'));

					}

					else

					{

						$this->session->set_flashdata('error','Invalid Password');

						redirect(base_url('secure-login'));

					}

			

		    }

		    else

		    {

		        $this->session->set_flashdata('error','Invalid Student');

					redirect(base_url('secure-login'));

		    }

	}

	

	public function logout()

	{

			$this->session->sess_destroy('admin_sess');

			$this->session->set_flashdata('success','Thank You!, Visit Again');

			redirect(base_url('onlineplacment-adminLogin'));

	}

	

	public function session_check()

	{

		$sess = $this->session->userdata('admin_sess');
		if(!empty($sess))
		{
			redirect(base_url('admin-dashboard'));
		}

		else

		{

			

		}

	}

}

?>