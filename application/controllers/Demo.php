<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Demo extends CI_Controller
{
	public function index()
	{
		$user_id = '1';
		$data['user_data'] = $this->model->hdm_get_where_limit('user',array('ID'=>$user_id,'login_status'=>'0'),1);
		$data['state_data'] = $this->model->hdm_get_where_limit('state',array('ID'=>$data['user_data']['state_id']),1);
		$data['district_data'] = $this->model->hdm_get_where_limit('district',array('ID'=>$data['user_data']['district_id']),1);
		
		$this->load->library('pdf');

        $html_content = $this->load->view('download_profile', $data);
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        $this->pdf->stream("".$user_id.".pdf", array("Attachment"=>0));

		//$this->load->view('download_profile',$data);
	}
}
?>