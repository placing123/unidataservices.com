<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller

{

	public function __construct()

	{

			parent::__construct();
			$this->load->library('pdf');
	
			// $this->lib->session_check();

	}

	

	public function page()

	{


		$data['title'] = 'Dashboard';

		$data['css'] = '';

		$data['script'] = '';

		$data['page'] = 'admin/include/main_content';
		$todaysrecords  = $this->db->get('tbl_register');
		$data['total_records'] = $todaysrecords->num_rows();

		$this->db->where('is_agreement','2');
		$todaysrecords1  = $this->db->get('tbl_register');
		$data['total_activate'] = $todaysrecords1->num_rows();
		$this->load->view('admin/dashboard',$data);

	}


	public function cronjob(){
		$today = date('Y-m-d');

		// $today =  '2022-03-10';
		$where = array('submission_status'=>'0');
		// $this->model->hdm_update_where('tbl_register',$set,$where);
		$this->db->where('end_date<',$today);
		// $this->db->where('end_date<',$today);
		$rec =$this->model->hdm_get_where('tbl_register',$where);

		// print_r($this->db->last_query());

		// print_r($rec);
		foreach($rec as $r){
			// echo $r->id.'<br>';
			// echo $r->end_date.'<br>';
			$set['submission_status']='2';
			$set['cron_at']=date('Y-m-d h:i:s');
			$where = array('id'=>$r->id);
			$this->model->hdm_update_where('tbl_register',$set,$where);
 
		}
	 
	}

	public function exceltopdfdemo()
	{
			$data = array();
			$html_content = $this->load->view('pdf/docresume', $data, true);
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$output = $this->pdf->output();
			$date = date('Ymdhis');
			file_put_contents('admin_assets/pdf/' . $date . '.pdf', $output);
			echo  $response = $date . '.pdf';

			$this->db->select_max('id');
			$res1 = $this->db->get('tbl_resumes');
			if($res1->num_rows() > 0) {
				$res2 = $res1->result_array();
				$resume_id = $res2[0]['id'];
			}

		// testing 
	//	include 'Classes/PHPExcel/IOFactory.php';
		require_once APPPATH . "/third_party/PHPExcel.php";
		$path = 'uploads/pictures/';
		$import_xls_file = 'demo11.xlsx';
		$inputFileName = $path . $import_xls_file;
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		//print_r($allDataInSheet);
		foreach ($allDataInSheet as $value) {
			$resume_id++;
			$inserdata =array();
			// $inserdata['first_name'] = $value['B'];
			// $inserdata['last_name'] = $value['C'];
			// $inserdata['contact_no'] = $value['D'];
			// $inserdata['alternate_no'] = $value['E'];
			// $inserdata['email'] = $value['F'];
			// $inserdata['company_name'] = $value['G'];
			// $inserdata['website_url'] = $value['H'];
			// $inserdata['address'] = $value['I'];
			// $inserdata['city'] = $value['J'];
			// $inserdata['state'] = $value['K'];
			// $inserdata['zip'] = $value['L'];
			// $inserdata['sic_desc'] = $value['M'];
			// $inserdata['sic_code'] = $value['N'];
			// $inserdata['entity_type'] = $value['O'];
			// $inserdata['company_sale'] = $value['P'];
			// $inserdata['revenue'] = $value['Q'];
			// $inserdata['country'] = $value['R'];
			// $inserdata['medical_ins'] = $value['S'];
			$inserdata['mis'] = 'demo111';
			$inserdata['first_name'] = 'demoom';
			$inserdata['last_name'] = 'demosdsd232';
			$inserdata['contact_no'] ='demosdsd232';
			$inserdata['alternate_no'] = 'demosdsd232';
			$inserdata['email'] = 'demosdsd232';
			$inserdata['company_name'] = 'demosdsd232';
			$inserdata['website_url'] = 'demosdsd232';
			$inserdata['address'] ='demosdsd232';
			$inserdata['city'] = 'demosdsd232';
			$inserdata['state'] = 'demosdsd232';
			$inserdata['zip'] = 'demosdsd232';
			$inserdata['sic_desc'] ='demosdsd232';
			$inserdata['sic_code'] = 'demosdsd232';
			$inserdata['entity_type'] = 'demosdsd232';
			$inserdata['company_sale'] = 'demosdsd232';
			$inserdata['revenue'] ='demosdsd232';
			$inserdata['country'] = 'demosdsd232';
			$inserdata['medical_ins'] = 'demosdsd232';

			$this->session->set_userdata($inserdata);

			echo $html_content = $this->load->view('pdf/docresume', $inserdata, true);
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$output = $this->pdf->output();
			file_put_contents('admin_assets/pdf/' . $resume_id . '.pdf', $output);

			$this->session->unset_userdata($inserdata);
			$response = $resume_id . '.pdf';
			//new pdf name last resume of resume pdfs 
			
		}



	
			
	}
}

?>