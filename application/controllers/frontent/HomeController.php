<?php

defined('BASEPATH') or exit('No direct script access allowed');



class HomeController extends CI_Controller

{



	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.php/welcome

	 *	- or -

	 * 		http://example.com/index.php/welcome/index

	 *	- or -

	 * Since this controller is set as the default controller in

	 * config/routes.php, it's displayed at http://example.com/

	 *

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.php/welcome/<method_name>

	 * @see https://codeigniter.com/user_guide/general/urls.html

	 */







	public function session_check()

	{



		$sess = $this->session->userdata('customer_sess');



		if (empty($sess)) {

			redirect(base_url('customer-login'));

		} else {

		}

	}





	public function customerlogin()

	{

		$this->load->view('frontent/login');

	}

	function customer_auth()

	{



		$customerid = $this->input->post('customerid');

		$password = $this->input->post('password');

		$login_data = $this->model->hdm_get_where('tbl_register', array('customer_id' => $customerid));

		//print_r($login_data);

		if (!empty($login_data)) {

			$pass = $this->encryption->decrypt($login_data[0]->password);

			if ($password == $pass) {

				// check user is activate 



				if ($login_data[0]->is_active == '0') {

					$this->session->set_flashdata('success', 'Your Account is deactivate please contact to admin');

					return 	redirect(base_url('customer-login'));

				}

				$sess = array(

					'name' => $login_data[0]->name,

					'email' => $login_data[0]->email,

					'mobile' => $login_data[0]->mobile,

					'customer_id' => $login_data[0]->customer_id,

					'is_agreement' => $login_data[0]->is_agreement,

					'is_login' => TRUE



				);

				$this->customer_log('login');

				$this->session->set_userdata('customer_sess', $sess);

				redirect(base_url('home'));

			} else {

				$this->session->set_flashdata('success', 'Please check your ID & Password');

				return 	redirect(base_url('customer-login'));

			}

		} else {

			$this->session->set_flashdata('success', 'Please check your ID & Password');

			return 	redirect(base_url('customer-login'));

		}

	}

	public function home()

	{



		$this->session_check();

		$this->is_agreementdone();
		$this->checkistaskchecked();
		






		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$customerdata = $this->model->hdm_get_where('tbl_register', array('customer_id' => $customer_id));

		$planId = $customerdata[0]->plan_id;

		$total_customer_form =  $this->model->hdm_get_where_count('tbl_form', array('customer_id' => $customer_id, 'submit_at!=' => ''));

		$plan_data = $this->model->hdm_get_where('tbl_plan', array('id' => $planId));

		$perform =  $this->model->get_planform_price($planId);

		//$wallet = $customerdata[0]->wallet;

		$wallet = $perform;

		$set2['wallet'] = ($total_customer_form* $wallet);



		$customer_data1 = $this->model->hdm_update_where('tbl_register', $set2, array('customer_id' => $customer_id));





		$data['total_form'] = $plan_data[0]->forms;

		$data['customer_form'] = $total_customer_form;

		$data['left_form'] = $plan_data[0]->forms - $total_customer_form;







		$this->db->select('*');

		$this->db->where('customer_id', $customer_id);

		$data['record'] = $this->db->get_where('tbl_register')->result();



		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$customerdata = $this->model->hdm_get_where('tbl_register', array('customer_id' => $customer_id));

		$planId = $customerdata[0]->plan_id;

		$total_customer_form =  $this->model->hdm_get_where_count('tbl_form', array('customer_id' => $customer_id, 'submit_at!=' => ''));

		$plan_data = $this->model->hdm_get_where('tbl_plan', array('id' => $planId));

		$forms = $plan_data[0]->forms;



		if ($forms == $total_customer_form && $customerdata[0]->submission_status == '0' ) {

			$this->session->set_flashdata('success', 'You have complete the forms please Submit Your task and wait for admin response');

			// return  redirect('home');

		} 



		if($customerdata[0]->submission_status =='4'){

			$this->session->set_flashdata('success', 'You have Submited Your task please wait for admin response');

			

		}
		
       /* if($customerdata[0]->submission_status =='1'){

			$this->session->set_flashdata('success', 'Hello,We are regretting to inform you that, the accuracy of your submitted work is not up to mark. kindly login with your login credentials and check your quality report of the error we received while processing your submission. We cannot provide you with a grade or feedback on the assignment at this time because you didn't achieve the required accuracy to avail the payment.Please submit accurate information in the next project & earn your income of 40 Rs. per accurate form however you will get this project submission amount 5000 Rs. showing as your wallet Portal in the next  project the only condition is you have to submit the project within a give time frame work with required accuracy 90% means 450 out of 500 must be accurate without any single mistake and we will be more than happy to review your proposal and provide feedback. As per the contract that you have signed you need to pay portal maintenance utility charges incase accuracy fails.We apologize for any inconvenience this may have caused you, and thank you for your understanding. Best regards, Epic Data Centre Projection');

			

		}*/



		$data['middle_content'] = 'frontent/dashboard/dashboard';

		$this->load->view('frontent/index', $data);

	}



	public function resumetask()

	{



		$this->session_check();

		$this->is_agreementdone();

		 $this->check_total_form();

		$this->check_enddate();



		 $this->check_istask_submited();

		$data['middle_content'] = 'frontent/resume-task';

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$this->db->select('id');

		$this->db->where('customer_id', $customer_id);



		$data['record'] = $this->db->get_where('tbl_form')->result();



	



		$this->db->where('customer_id', $customer_id);

		$this->db->select_max('id');

		$this->db->where('status', '1');

		$this->db->order_by('submit_at', 'DESC');

		$res1 = $this->db->get('tbl_form');



		$result =0;

		if ($res1->num_rows() > 0)

		{

			$res2 = $res1->result_array();

			$result = $res2[0]['id'];

		} else {

			$result = "";

		}



		$data['last_update_record'] =  $result;

		// $data['last_update_record'] = $this->db->get_where('tbl_form')->row();



		

		

		// print_r($data['last_update_record']);

		// die();

		$this->load->view('frontent/index', $data);

	}



	function check_enddate()

	{



		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$enddate = $this->model->get_last_date($customer_id);

		$date_now = date("Y-m-d"); // this format is string comparable

		if ($date_now > $enddate) {



			$this->session->set_flashdata('success', 'You have cross date');

		

			return  redirect('home',$data);

		}  

	}



	public function agreement()

	{

		//$this->session_check();



		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$data['url'] = $this->model->get_agreementurlbycustid($customer_id);

		$data['middle_content'] = 'frontent/agreement';

		$this->load->view('frontent/index', $data);

	}

	public function form_list()

	{

		//$this->session_check();

		$data['middle_content'] = 'frontent/form_list';

		$this->load->view('frontent/index', $data);

	}

	public function instructions()

	{

		$this->session_check();

		$data['middle_content'] = 'frontent/instructions';

		$this->load->view('frontent/index', $data);

	}

	public function profile()

	{

		$this->session_check();

		$data['middle_content'] = 'frontent/profile';





		$this->load->view('frontent/index', $data);

	}

	public function query()

	{

		$this->session_check();

		$data['middle_content'] = 'frontent/query';

		$this->load->view('frontent/index', $data);

	}



	function customer_logout()

	{

	    	$this->customer_log('logout');

		$this->session->sess_destroy('customer_sess');

		$this->session->set_flashdata('success', 'Thank You!, Visit Again');

		redirect(base_url('customer-login'));

	}



	function store_form()

	{

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$where = array('customer_id' => $customer_id, 'id' => $_POST['form_id']);



		$_POST['status'] = '1';



		unset($_POST["form_id"]);



		$set = $_POST;

		$set['submit_at'] = date('Y-m-d h:i:s');

		$update_data = $this->model->hdm_update_where('tbl_form', $set, $where);



		/* update customer wallet

		$customerdata = $this->model->hdm_get_where('tbl_register', array('customer_id' => $customer_id));

		$planId = $customerdata[0]->plan_id;

		$perform =  $this->model->get_planform_price($planId);

		$wallet = $customerdata[0]->wallet;

		$wallet += $perform;

		$set2['wallet'] = $wallet;



		$customer_data = $this->model->hdm_update_where('tbl_register', $set2, array('customer_id' => $customer_id));*/

		$response = array('status' => '1', 'msg' => 'Form has submited successfully');

		echo json_encode($response);

	}





	function update_form()

	{  //form action



		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$where = array('customer_id' => $customer_id, 'id' => $_POST['form_id']);

		$_POST['status'] = '1';

		unset($_POST["form_id"]);



		$set = $_POST;

		$set['update_at'] = date('Y-m-d h:i:s');

		$update_data = $this->model->hdm_update_where('tbl_form', $set, $where);

		return redirect('query-list');

	}

	function save_for_query()

	{



		$form_id= $_POST['form_id'];

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$where = array('customer_id' => $customer_id, 'id' =>$form_id );

		$_POST['status'] = '2';



		unset($_POST["form_id"]);

		$set = $_POST;

		//	$set['update_at'] = date('Y-m-d h:i:s');

		$update_data = $this->model->hdm_update_where('tbl_form', $set, $where);





	//	$form_id = $_POST['form_id'];

		$login_data = $this->model->hdm_get_where('tbl_query', array('customer_id' => $customer_id, 'form_id' => $form_id));

		//print_r($login_data);

		if (!empty($login_data)) {

			$response = array('status' => '1', 'msg' => 'Form is already in query');

		} else {



			$where = array('id' => $form_id);

			$set['is_qry'] = '1';

			$update_data = $this->model->hdm_update_where('tbl_form', $set, $where);

			$insert['customer_id'] = $customer_id;

			$insert['form_id'] = $form_id;

			$res = $this->model->hdm_insert('tbl_query', $insert);

			$response = array('status' => '1', 'msg' => 'Form save for query successfully');

		}

		echo json_encode($response);

	}



	function update_resume()

	{  //ajax 

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$where = array('customer_id' => $customer_id, 'id' => $_POST['form_id']);

		$_POST['status'] = '1';



		unset($_POST["form_id"]);



		$set = $_POST;

		$set['update_at'] = date('Y-m-d h:i:s');

		$update_data = $this->model->hdm_update_where('tbl_form', $set, $where);



		$response = array('status' => '1', 'msg' => 'Form has Update  successfully');

		echo json_encode($response);

	}



	function check_agreement()

	{





		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$is_agreement = $this->session->userdata('customer_sess')['is_agreement'];

		if ($is_agreement == 0) {

			//return redirect('dashboard');

			$response = array('status' => '0', 'msg' => 'please complete the agreement first');

		} elseif ($is_agreement == 1) {

			//	return redirect('resumetask');

			$response = array('status' => '1', 'msg' => 'Wait for admin approval');

		} else {

			//return redirect('dashboard');

			$response = array('status' => '2', 'msg' => 'processing now');

		}



		//print_r($response);

		return $response;

	}





	function agreement_view()

	{



		$this->session_check();

		$this->customer_log('agreement-view');

		$is_agreement = $this->session->userdata('customer_sess')['is_agreement'];

		if ($is_agreement == '1') {

			//$this->session->set_flashdata('success',$msg);

			redirect(base_url('home'));

		}

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$data['url'] = $this->model->get_agreementurlbycustid($customer_id);

		$data['middle_content'] = 'frontent/agreement/agreement';

		$this->load->view('frontent/index', $data);

	}



	function approval_waiting_page()

	{



		$this->session_check();

		$data['middle_content'] = 'frontent/approval_waiting_page';

		$this->load->view('frontent/index', $data);

	}



	function is_agreementdone()

	{

		$is_agreement = $this->session->userdata('customer_sess')['is_agreement'];

        $msg ="welcome";
		if ($is_agreement == '0') {

			$this->session->set_flashdata('success', $msg);

			redirect(base_url('agreement'));

		} else if ($is_agreement == '1') {

			$this->session->set_flashdata('success', $msg);

			redirect(base_url('approval_waiting'));

		} else {

			return true;

		}

	}



	function get_forms()

	{

		$form_id = $this->input->post('form_id');

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$this->db->select('*');

		$this->db->where('customer_id', $customer_id);

		$this->db->where('id', $form_id);

		$data = $this->db->get_where('tbl_form')->result_array();

		//print_r($data);



		$response = array('status' => '1', 'data' => $data[0]);

		echo  json_encode($response);

	}

	function save_signature()

	{

		$this->customer_log('customer-sign');

		define('UPLOAD_DIR', './uploads/signature/');

		$img = $_POST['img_data'];

		$img = str_replace('data:image/png;base64,', '', $img);

		$img = str_replace(' ', '+', $img);

		$data = base64_decode($img);

		$file = UPLOAD_DIR . uniqid() . '.png';



		preg_match("/[^\/]+$/", $file, $matches);

		$imgdbanme = $matches[0]; // test

		$success = file_put_contents($file, $data);



		// $img_fullurl = base_url().'/uploads/signature'.$imgdbanme;



	

		chmod($_SERVER['DOCUMENT_ROOT'] .'/uploads/signature/'.$imgdbanme,0666);



		//  chmod("http://onlineplacement.in/admin_assets/signpdf/20220226092046.pdf", 664);

	

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$where = array('customer_id' => $customer_id);

		$set['signature'] = $imgdbanme;

		$set['is_agreement'] = '1';

		$set['sign_date'] = date('Y-m-d');	

		$update_data = $this->model->hdm_update_where('tbl_register', $set, $where);

		$set['sign_agreement'] = $this->create_sign_pdf();

		$set['sign_ip'] = $_SERVER['REMOTE_ADDR'];  

		$update_data = $this->model->hdm_update_where('tbl_register', $set, $where);

		$response = array('status' => '1', 'msg' => 'we will contact you soon');

		echo json_encode($response);

	}



	

	function create_sign_pdf()

	{



		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$customerdata = $this->model->hdm_get_where('tbl_register', array('customer_id' => $customer_id));

		$pdfdata['create_at'] = date('y-m-d', strtotime($customerdata[0]->create_at));

		$pdfdata['customer_id'] = $customer_id;

		$pdfdata['name'] = $customerdata[0]->name;

		$pdfdata['address'] = $customerdata[0]->address;

		$pdfdata['signature'] = $customerdata[0]->signature;

		$pdfdata['reg_date'] =  $customerdata[0]->reg_date;

		$pdfdata['plan_id'] =  $customerdata[0]->plan_id;

		$pdfdata['aadharcard'] =  $customerdata[0]->aadharcard;

		$pdfdata['pancard'] =  $customerdata[0]->pancard;



		$this->load->library('pdf');

		$html_content = $this->load->view('pdf/aftersignpdf', $pdfdata, true);

		$this->pdf->loadHtml($html_content);

		$this->pdf->render();

		$output = $this->pdf->output();

		$date = date('Ymdhis');

		file_put_contents('admin_assets/signpdf/' . $date . '.pdf', $output);

	 	 $response = $date . '.pdf';

		return  $response;

	}



	function logoutusers()

	{

		$this->session->sess_destroy('customer_sess');

		$response = array('status' => '1', 'msg' => 'we will contact you soon');

		echo json_encode($response);

	}



	function saveforquery()

	{



$this->customer_log('save for query');

		$form_id = $this->input->post('form_id');

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$where = array('id' => $form_id);

		$set['is_qry'] = '1';

		$update_data = $this->model->hdm_update_where('tbl_form', $set, $where);

		$response = array('status' => '1', 'msg' => 'your form save as query task');

		$insert['customer_id'] = $customer_id;

		$insert['form_id'] = $form_id;

		$res = $this->model->hdm_insert('tbl_query', $insert);

		echo json_encode($response);

	}

	function query_listing()

	{



		$this->session_check();

		$this->is_agreementdone();

		// $this->check_total_form();

		$this->check_enddate();

		$this->check_istask_submited();



		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$data['middle_content'] = 'frontent/query/query_list';

		$data['records']  = $this->model->hdm_get_where('tbl_query', array('customer_id' => $customer_id));

		$this->load->view('frontent/index', $data);

	}



	function new_query($id)

	{



		$this->session_check();

		$data['middle_content'] = 'frontent/query/add_query';

		$data['record'] = $this->db->get_where('tbl_field')->result();

		$this->load->view('frontent/index', $data);

	}

	function store_query()

	{



		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$insert['customer_id'] = $customer_id;

		$insert['qry_field'] = $this->input->post('name');

		$insert['qry_id'] = $this->input->post('query_id');

		$res = $this->model->hdm_insert('tbl_qry_field', $insert);

		return redirect('query-list');

	}



	function query_result($qry_id)

	{



		$this->session_check();

		$data['middle_content'] = 'frontent/query/query_result';

		$data['pending_records'] = $this->model->hdm_get_where('tbl_qry_field', array('qry_id' => $qry_id, 'status' => '0'));

		$data['approve_records'] = $this->model->hdm_get_where('tbl_qry_field', array('qry_id' => $qry_id, 'status' => '1'));

		$this->load->view('frontent/index', $data);

	}



	function edit_resume($id)

	{





		$this->session_check();

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$this->db->select('id');

		$this->db->where('customer_id', $customer_id);

		$data['record'] = $this->db->get_where('tbl_form')->result();

		$data['middle_content'] = 'frontent/edit_resume';

		$data['formrecords'] = $this->model->hdm_get_where('tbl_form', array('id' => $id));

		$this->load->view('frontent/index', $data);

	}



	function check_pendingrequestexit()

	{



		$response = array('status' => '0', 'msg' => 'New Request');

		$qry_field = $this->input->post('id');

		$query_id = $this->input->post('query_id');

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$data = $this->model->hdm_get_where('tbl_qry_field', array('qry_id' => $query_id, 'qry_field' => $qry_field, 'status' => '0'));



		if (count($data) > '0') {

			$response = array('status' => '1', 'msg' => 'You have already request for this');

		}

		$data2 = $this->model->hdm_get_where('tbl_qry_field', array('qry_id' => $query_id, 'qry_field' => $qry_field, 'status' => '1'));

		if (count($data2) > '0') {

			$response = array('status' => '2', 'msg' => 'Request already approve for this ');

		}

		echo json_encode($response);

	}



	function edit_profile()

	{



		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$data['record'] = $this->model->hdm_get_where('tbl_register', array('customer_id' => $customer_id));

		$data['master_data'] =  $this->model->hdm_get('tbl_master');

		$data['middle_content'] = 'frontent/customer_profile';

		$this->load->view('frontent/index', $data);

	}



	function terms_con()

	{





$this->customer_log('Terms & condition');

		$data['middle_content'] = 'frontent/terms_con';

		$this->load->view('frontent/index', $data);

	}





	function update_customerdata()

	{

		// print_r($_POST);

			$this->customer_log('Update Profile');

		$customer_id = $this->input->post('customer_id');

		$where = array('customer_id' => $customer_id);

		$set = $_POST;

		$update_data = $this->model->hdm_update_where('tbl_register', $set, $where);

		$this->session->set_flashdata('success', 'Data Update Successfully');

		return redirect('edit_profile');

	}





	function expirepage()

	{



		$data['middle_content'] = 'frontent/form_date_expire';

		$this->load->view('frontent/index', $data);

	}



	

	function check_total_form()

	{

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$customerdata = $this->model->hdm_get_where('tbl_register', array('customer_id' => $customer_id));

		$planId = $customerdata[0]->plan_id;

		$total_customer_form =  $this->model->hdm_get_where_count('tbl_form', array('customer_id' => $customer_id, 'submit_at!=' => ''));

		$plan_data = $this->model->hdm_get_where('tbl_plan', array('id' => $planId));

		$forms = $plan_data[0]->forms;



		if ($forms == $total_customer_form && $customerdata[0]->submission_status == 0  ) {

			$this->session->set_flashdata('success', 'You have complete the forms pleaser Submit Your task and wait for  admin response');

			//

			return  redirect('home');

		} 

		if($customerdata[0]->submission_status ==4){

			$this->session->set_flashdata('success', 'You have Submited Your task please  wait for admin response');

			return  redirect('home');

		}

		if($customerdata[0]->submission_status ==1){

					$this->session->set_flashdata('error', 'Your submission has failed!!!');

					return  redirect('home');

		} 

		

		

	}



	public function mail_with_content()

	{

		$this->load->library('email');

		$fromemail = "ad@c.com";

		$toemail = "user@email.id";

		$subject = "Mail Subject is here";

		$data = array();

		$mesg = $this->load->view('email/register_mail', $data, true);

		// or

		// $mesg = $this->load->view('email/register_mail','',true);

		$config = array(

			'charset' => 'utf-8',

			'wordwrap' => TRUE,

			'mailtype' => 'html'

		);

		$this->email->initialize($config);

		$this->email->to($toemail);

		$this->email->from($fromemail, "Title");

		$this->email->subject($subject);

		$this->email->message($mesg);

		$mail = $this->email->send();

	}



	function complete_task()

	{







		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$customerdata = $this->model->hdm_get_where('tbl_register', array('customer_id' => $customer_id));

		$planId = $customerdata[0]->plan_id;

		$plan_data = $this->model->hdm_get_where('tbl_plan', array('id' => $planId));

		$data['forms'] = $plan_data[0]->forms;



		$data['total_submitform'] =   $this->model->hdm_get_where_count('tbl_form', array('customer_id' => $customer_id, 'submit_at!=' => ''));

		$data['middle_content'] = 'frontent/complete_task';

		$this->load->view('frontent/index', $data);

	}



	function submit_task()

	{

	    	$this->customer_log('Submit Task');



		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$where = array('customer_id' => $customer_id);

		$set['submission_status'] = '4';

		$update_data = $this->model->hdm_update_where('tbl_register', $set, $where);

		$response =array('status'=>'1');

		echo json_encode($response);

	}



	function check_istask_submited()

	{

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$customerdata = $this->model->hdm_get_where('tbl_register', array('customer_id' => $customer_id));

		$submission_status = $customerdata[0]->submission_status;



		if ($submission_status == '4') {

			$this->session->set_flashdata('success', 'You have submit the task  please wait for admin response');

			return  redirect('home');

		}

	}

	public function checkistaskchecked()
	{
		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$checkistaskchecked =  $this->model->hdm_get_where_count('tbl_approve', array('customer_id' => $customer_id));
		if ($checkistaskchecked > 0) {
			return  redirect('qc_result');
		}
	}


	public function qc_result()

	{
	$customer_id = $this->session->userdata('customer_sess')['customer_id'];
	$data['middle_content'] = 'frontent/qc/qc_form';

		$data['records'] = $this->model->qc_formlist($customer_id);

		$this->load->view('frontent/index', $data);

	}



	public function edit_qc_result($id)

	{



		$form_id  = $this->uri->segment(2);

		$customer_id = $this->session->userdata('customer_sess')['customer_id'];

		$data['formrecords']  = $this->model->hdm_get_where('tbl_form', array('id' => $form_id, 'customer_id' => $customer_id));

		// print_r($data['formrecords']);

		$data['middle_content'] = 'frontent/qc/qcform_edit';

		$this->load->view('frontent/index', $data);

	}

	

		public function customer_log($module_type)

	{

		$customer_id = isset($this->session->userdata('customer_sess')['customer_id']);

		$insertcust['customer_id'] = $customer_id;

		$insertcust['module_type'] = $module_type;

		$insertcust['activity_time'] =date('d-m-y h:i:s');

		$insertcust['ip'] =$_SERVER['REMOTE_ADDR'];  

		$this->model->hdm_insert('tbl_customer_log',$insertcust);

	}

/*function change_password()

	{



	$customer_id = $this->session->userdata('customer_sess')['customer_id'];;






		$data['title'] = 'change password';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'frontend/change_password';

		$data['rec'] = $this->model->hdm_get_where('tbl_register', array('id' => '1'));

		$data['action'] = 'update_change_password1';

		$this->load->view('frontent/index', $data);

	}



	function update_change_password()

	{



		$where = array('id' => $_POST['id']);

		$set['customer_id'] = $this->input->post('customer_id');

		if ($this->input->post('password') != "") {

			$set['password'] = $this->encryption->encrypt($this->input->post('password'));

		}

		$this->model->hdm_update_where('tbl_register', $set, $where);

		$this->session->set_flashdata('success', 'Data Update successfully');

		return redirect('change_password1');

	}*/






	



}

