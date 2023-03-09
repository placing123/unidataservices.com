<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student extends CI_Controller
{
	public function __construct()
	{
			parent::__construct();
			$this->lib->session_check();
	}
	
	public function page()
	{
		$data['title'] = 'Student List';
	    $data['css'] = '  ';
		$data['script'] = '';
		$data['action'] = base_url().'career-insert';
		$data['page'] = 'admin/career/add';
		$this->load->view('admin/dashboard',$data);
	}
	
	public function insert()
	{
	    $insert = array(
	        'cr_title' => $this->input->post('t1'),    
	        'cr_desc' => $this->input->post('t2'),    
	        'cr_req' => $this->input->post('t3'),    
	        'cr_update' => $this->input->post('t4'),    
        );
        $res = $this->model->hdm_insert('career',$insert);
        if($res)
        {
            $this->session->set_flashdata('success','Data inserted successfully');
            redirect(base_url('admin-career'));
        }
        else
        {
            $this->session->set_flashdata('error','Something Wrong');
            redirect(base_url('admin-career'));
        }
	}
	
	public function show()
	{
	    $data['title'] = 'Student Show';
		$data['css'] = '<link rel="stylesheet" href="'.base_url().'admin_assets/bundles/datatables/datatables.min.css">
						<link rel="stylesheet" href="'.base_url().'admin_assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">';
		$data['script'] = '<script src="'.base_url().'admin_assets/bundles/datatables/datatables.min.js"></script>
						   <script src="'.base_url().'admin_assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
						   <script src="'.base_url().'admin_assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
						   <script src="'.base_url().'admin_assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
						   <script src="'.base_url().'admin_assets/bundles/datatables/export-tables/jszip.min.js"></script>
						   <script src="'.base_url().'admin_assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
						   <script src="'.base_url().'admin_assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
						   <script src="'.base_url().'admin_assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
						   <script src="'.base_url().'admin_assets/js/page/datatables.js"></script>';
		$data['page'] = 'admin/student/show';
		$data['rec'] = $this->model->hdm_get_where('Admin',array('id'=>1));
		$this->load->view('admin/dashboard',$data);
	}
	
	public function delete($id)
	{
	    $res = $this->model->hdm_update_where('student',array('stud_delete'=>1),array('stud_id'=>$id));
	    if($res)
	    {
	        $this->session->set_flashdata('success','Record Deleted Successfully');
	        redirect(base_url('student-list-show'));
	    }
	    else
	    {
	        $this->session->set_flashdata('error','Something Wrong');
	        redirect(base_url('student-list-show'));
	    }
	}
	
	public function status($id,$val)
	{
	    if($val==0)
	    {
    	    $res = $this->model->hdm_update_where('student',array('stud_status'=>1),array('stud_id'=>$id));
    	    if($res)
    	    {
    	        $this->session->set_flashdata('success','Record Deactivated Successfully');
    	        redirect(base_url('student-list-show'));
    	    }
    	    else
    	    {
    	        $this->session->set_flashdata('error','Something Wrong');
    	        redirect(base_url('student-list-show'));
    	    }
	    }
	    elseif($val==1)
	    {
    	    $res = $this->model->hdm_update_where('student',array('stud_status'=>0),array('stud_id'=>$id));
    	    if($res)
    	    {
    	        $this->session->set_flashdata('success','Record Activated Successfully');
    	        redirect(base_url('student-list-show'));
    	    }
    	    else
    	    {
    	        $this->session->set_flashdata('error','Something Wrong');
    	        redirect(base_url('student-list-show'));
    	    }
	    }
	}
	
	function alpha_dash_space($str)
	{
		return ( ! preg_match("/^([A-Z-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
	}
	
	public function edit($id)
	{
		$data['title'] = 'Student Edit';
	    $data['css'] = '  ';
		$data['script'] = '';
		$data['action'] = base_url().'student-update/'.$id;
		$data['page'] = 'admin/student/add';
		$data['rec'] = $this->model->hdm_get_where('student',array('stud_id'=>$id));
		$this->load->view('admin/dashboard',$data);
	}
	
	public function update($id)
	{
		$this->form_validation->set_rules('name','Name','trim|required|callback_alpha_dash_space|min_length[5]',array('required'=>'<div class="error">Please Fill %s field</div>'));
		$this->form_validation->set_rules('standard','Standard','trim|required',array('required'=>'<div class="error">Please Fill %s field</div>'));
		if($this->form_validation->run() == FALSE)
		{
			$data['title'] = 'Student Edit';
			$data['css'] = '  ';
			$data['script'] = '';
			$data['action'] = base_url().'student-update/'.$id;
			$data['page'] = 'admin/student/add';
			$data['rec'] = $this->model->hdm_get_where('student',array('stud_id'=>$id));
			$this->load->view('admin/dashboard',$data);
			
		}
		else
		{
			$prev_rec = $this->model->hdm_get_where('student',array('stud_id'=>$id));
			if(isset($_FILES['pic']['name']) && $_FILES['pic']['name']!=''  ) {$pic = $this->lib->pic_upload('pic');} else {$pic=$prev_rec[0]->stud_pic_path;} 
			$insert = array(
				'stud_roll_no'		=> $this->input->post('rollno'),
				'stud_name'			=> $this->input->post('name'),
				'stud_email'		=> $this->input->post('email'),
				'stud_mobile'		=> $this->input->post('mobile'),
				'stud_std'			=> $this->input->post('standard'),
				'stud_pic'			=> '<img src="'.base_url($pic).'" width="100px" height="100px">',
				'stud_pic_path'		=>	$pic,
			);
			if($pic==$prev_rec[0]->stud_pic_path)
			{
				$res = $this->model->hdm_update_where('student',$insert,array('stud_id'=>$id));
			}
			else
			{
				unlink($prev_rec[0]->stud_pic_path);
				$res = $this->model->hdm_update_where('student',$insert,array('stud_id'=>$id));
			}
			if($res)
			{
				$this->session->set_flashdata('success','Record Update Successfully');
				redirect('student-list-show');
			}
			else
			{
				$this->session->set_flashdata('error','Something wrong');
				redirect('student-list-show');
			}
		}
	}
}
?>