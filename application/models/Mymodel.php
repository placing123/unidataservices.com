<?php
class Mymodel extends CI_Model
{
	
	public function hdm_insert($tbl,$insert)
	{
		return $this->db->insert($tbl,$insert);
	}
	
	public function hdm_live_id($tbl,$insert)
	{
		$this->db->insert($tbl,$insert);
		return $this->db->insert_id();
	}	
	
	public function hdm_get($tbl)
	{
		return $this->db->get($tbl)->result();
	}
	
	public function hdm_get_where($tbl,$where)
	{
		return $this->db->get_where($tbl,$where)->result();
	}

	public function hdm_get_where_count($tbl,$where)
	{
		return $this->db->get_where($tbl,$where)->num_rows();
	}
	
	public function hdm_get_or_where($tbl,$or_where)
	{
		return $this->db->or_where($or_where)->get($tbl)->result();
	}
	
	public function hdm_update_where($tbl,$set,$where)
	{
		return $this->db->where($where)->update($tbl,$set);
	}
	
	public function hdm_delete($tbl,$where)
	{
		return $this->db->delete($tbl,$where);
	}	
	
	public function hdm_get_where_limit($tbl,$where,$limit)
	{
		return $this->db->limit($limit,0)->get_where($tbl,$where)->row_array();
	}
	public function hdm_get_where_group($tbl,$where,$group_by)
	{
		return $this->db->group_by($group_by)->get_where($tbl,$where)->result();
	}
	public function hdm_get_where_row($tbl,$where,$row)
	{
		return $this->db->get_where($tbl,$where)->row($row);
	}
	public function hdm_get_where_order($tbl,$where,$order_by,$order_type)
	{
		return $this->db->order_by($order_by,$order_type)->get_where($tbl,$where)->result();
	}
	public function hdm_query($query)
	{
		return $this->db->query($query)->result();
	}	
	public function get_fieldname($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('tbl_field');
		$ret = $query->row();
		return $ret->name;

	}

	public function get_resumeidbyformid($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('tbl_form');
		$ret = $query->row();
		return $ret->resume_id;
	

	}

	public function get_qry_details(){
		$this->db->select('*,tbl_qry_field.id as qryfldid');
        $this->db->join('tbl_query', 'tbl_query.id = tbl_qry_field.qry_id','LEFT');
		$this->db->where('tbl_qry_field.status','0');
        $query = $this->db->get('tbl_qry_field');
         $res = $query->result(); // as object
        //$res = $query->result_array(); // as array
        return $res;

	}
	public function get_qry_detailsform($id){
		$this->db->select('*,tbl_qry_field.id as qryfldid');
        $this->db->join('tbl_query', 'tbl_query.id = tbl_qry_field.qry_id','LEFT');
		$this->db->where('tbl_qry_field.id',$id);
		$query = $this->db->get('tbl_qry_field');
        // $res = $query->result(); // as object
        $res = $query->result_array(); // as array
        return $res;

	}

	public function get_agreementurlbycustid($id){
		
		$this->db->where('customer_id',$id);
		$query = $this->db->get('tbl_register');
		$ret = $query->row();
		return $ret->agreement_url;

	}

	public function get_last_date($customerID){
		
		$this->db->where('customer_id',$customerID);
		$query = $this->db->get('tbl_register');
		$ret = $query->row();
		return $ret->end_date;

	}



	public function get_planform_price($planId){
		$this->db->where('id',$planId);
		$query = $this->db->get('tbl_plan');
		$ret = $query->row();
		return $ret->per_form;

	}

	public function get_emailbycustid($id){
		
		$this->db->where('customer_id',$id);
		$query = $this->db->get('tbl_register');
		$ret = $query->row();
		return $ret->email;

	}
	public function get_registerDetails($where)
	{
		$this->db->select('*');
		$this->db->join('tbl_plan', 'tbl_plan.id = tbl_register.plan_id','LEFT');
		$this->db->join('tbl_franchise', 'tbl_franchise.id = tbl_register.franchise_id','LEFT');
		$this->db->join('tbl_caller', 'tbl_caller.id = tbl_register.caller_id','LEFT');
		$this->db->where($where);
		$query = $this->db->get('tbl_register');
		$res = $query->result(); 
		return  $res;
	}

	public function get_total_franchise_count($franchise_id){
		$today = date('Y-m-d');
		$query = $this->db->query('SELECT * FROM tbl_register where reg_date ="'.$today.'" and franchise_id="'.$franchise_id.'"');
		return $query->num_rows();

	}

	public function get_total_franchise_signcount($franchise_id){
		$today = date('Y-m-d');
		$query = $this->db->query('SELECT * FROM tbl_register where sign_date ="'.$today.'" and franchise_id="'.$franchise_id.'"');
		return $query->num_rows();

	}
	public function get_total_caller_count($caller_id){ //current day 
		$today = date('Y-m-d');
		$query = $this->db->query('SELECT * FROM tbl_register where reg_date ="'.$today.'" AND  caller_id="'.$caller_id.'"');
		return $query->num_rows();

	}

	public function qc_formlist($customer_id)
	{
		$query = $this->db->query('SELECT COUNT(fid_status) as ttl, form_id FROM tbl_approve WHERE customer_id="'.$customer_id.'"  AND fid_status="0"  GROUP BY form_id');
		return $query->result();
	}

	public function franchise_current_month_report($franchise_id)
	{
			// Last date of current month.
			$today = date('Y-m-d');
			$date = strtotime($today);
			$maxvalue = date('Y-m-d',strtotime(date("Y-m-30", $date )));
			$minvalue = date('Y-m-d',strtotime(date("Y-m-01", $date )));
			$this->db->where("reg_date BETWEEN '$minvalue' AND '$maxvalue'");
			$query = $this->db->get('tbl_register');
			$res = $query->result(); 
    		return $query->num_rows();
	}
	public function franchise_current_month_signcount($franchise_id)
	{
		// Last date of current month.
			$today = date('Y-m-d');
			$date = strtotime($today);
			$maxvalue = date('Y-m-d',strtotime(date("Y-m-30", $date )));
			$minvalue = date('Y-m-d',strtotime(date("Y-m-01", $date )));
			$this->db->where("sign_date BETWEEN '$minvalue' AND '$maxvalue'");
			$query = $this->db->get('tbl_register');
			$res = $query->result(); 	
			return $query->num_rows();
		
	}


	public function get_total_caller_franchiswisemonth_count($franchise_id,$caller_id)
	{
			// Last date of current month.
			$today = date('Y-m-d');
			$date = strtotime($today);
			$maxvalue = date('Y-m-d',strtotime(date("Y-m-30", $date )));
			$minvalue = date('Y-m-d',strtotime(date("Y-m-01", $date )));

			$this->db->where('franchise_id',$franchise_id);
			$this->db->where('caller_id',$caller_id);
			$this->db->where("reg_date BETWEEN '$minvalue' AND '$maxvalue'");
			$query = $this->db->get('tbl_register');
			$res = $query->result(); 
    		return $query->num_rows();
	}

	public function get_total_caller_franchiswisemonth_signcount($franchise_id,$caller_id)
	{
			// Last date of current month.
			$today = date('Y-m-d');
			$date = strtotime($today);
			$maxvalue = date('Y-m-d',strtotime(date("Y-m-30", $date )));
			$minvalue = date('Y-m-d',strtotime(date("Y-m-01", $date )));

			$this->db->where('franchise_id',$franchise_id);
			$this->db->where('caller_id',$caller_id);
			$this->db->where("sign_date BETWEEN '$minvalue' AND '$maxvalue'");
			$query = $this->db->get('tbl_register');
			$res = $query->result(); 
    		return $query->num_rows();
	}


	
	public function get_todaystotal_caller_count($caller_id,$franchise_id){ //current day 
		$today = date('Y-m-d');
		$query = $this->db->query('SELECT * FROM tbl_register where reg_date ="'.$today.'" AND  caller_id="'.$caller_id.'" AND franchise_id="'.$franchise_id.'"');
		return $query->num_rows();

	}
	

	public function get_todaystotal_caller_signcount($caller_id,$franchise_id){ //current day 
		$today = date('Y-m-d');
		$query = $this->db->query('SELECT * FROM tbl_register where sign_date ="'.$today.'" AND  caller_id="'.$caller_id.'" AND franchise_id="'.$franchise_id.'"');
		return $query->num_rows();

	}
	

	
}
?>