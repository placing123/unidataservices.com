<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Common extends CI_Model{

    function get_details($table,$where){

        $this->db->select('seller.ID as seller_id,mobile_no,DATE_FORMAT(created_date, "%d-%m-%y") as created_date');
        $this->db->where($where);  
        $query = $this->db->get($table);
       // $res = $query->result(); // as object
        $res = $query->result_array(); // as array
        return $res;

    }
    function new_seller_profiles(){

        $this->db->select('seller.ID,owner_name,mobile_no,state_name,district_name,DATE_FORMAT(created_date, "%d-%m-%y") as created_date');
        $this->db->where('is_profile_created','1');  
        $this->db->where('login_status','0'); 
        $this->db->where('status','0'); 
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get('seller');
        // $res = $query->result(); // as object
        $res = $query->result_array(); // as array
        return $res;
    }
    function get_details_by_id($table,$where){
        
        $this->db->select('in_approve,seller.ID,owner_name,mobile_no,state_name,district_name,status,report_type,is_fav,stop_search,hide_search,DATE_FORMAT(created_date, "%d-%m-%y") as created_date,profile_image,company_name,mobile_1,mobile_whatsapp_1,mobile_call_1,mobile_2,mobile_whatsapp_2,mobile_call_2,area,address,pincode,mobile_verify,status,login_status,updated_date');
        $this->db->where($where); 
        $this->db->where('login_status','0'); 
        $this->db->join('state', 'state.ID = seller.state_id','LEFT');
        $this->db->join('district', 'district.ID = seller.district_id','LEFT');
        $query = $this->db->get($table);
        $res = $query->result_array(); // as array
        return $res;

    }

    function get_data($table){
        $this->db->select('*');
        $query = $this->db->get($table);
       // $res = $query->result(); // as object
        $res = $query->result_array(); // as array
        return $res;

    }
    function state_wise_seller($state_id){
     
        $this->db->select('count(full_details.seller_id) as ttlseller,seller_id,state_id');
        $this->db->where('full_details.state_id',$state_id);  
        $this->db->group_by('full_details.seller_id'); 
        $query = $this->db->get('full_details');
        $res = $query->result_array();
           
        return $res;

    }

    function citywise_district($state_id){

        $this->db->select('*');
        $this->db->where('state_id',$state_id);
        $query = $this->db->get('district');
        $res = $query->result_array(); // as array
        return $res;

    }

    function get_seller_details_id($seller_id){

        $this->db->select('*');
        $this->db->where('ID',$seller_id);
        $query = $this->db->get('seller');
        $res = $query->result_array(); // as array
        return $res;

    }
    function sent_inquery_partcode($id,$category_id){

        $this->db->select('stock.name as stock_name,part_code,owner_name,district_name,state_name, DATE_FORMAT(part_code.created_date, "%d-%m-%y") as created_date');
        $this->db->join('state','state.ID = part_code.state_id','LEFT');
        $this->db->join('district','district.ID = part_code.district_id','LEFT');
        $this->db->join('stock','stock.ID = part_code.stock_id','LEFT');
        $this->db->join('seller','seller.ID = part_code.seller_id','LEFT');
        $this->db->where('part_code.ID',$id);
        $this->db->where('part_code.category_id',$category_id);
        $query = $this->db->get('part_code');
        $res = $query->result_array(); // as array

     
        return $res;


    }

    function sent_inquery_partcode1($id){

        $this->db->select('stock.name as stock_name,part_code,owner_name,district_name,state_name, DATE_FORMAT(part_code.created_date, "%d-%m-%y") as created_date');
        $this->db->join('state','state.ID = part_code.state_id','LEFT');
        $this->db->join('district','district.ID = part_code.district_id','LEFT');
        $this->db->join('stock','stock.ID = part_code.stock_id','LEFT');
        $this->db->join('seller','seller.ID = part_code.seller_id','LEFT');
        $this->db->where('part_code.ID',$id);
        // $this->db->where('part_code.category_id',$category_id);
        $query = $this->db->get('part_code');
        $res = $query->result_array(); // as array

     
        return $res;


    }

    function sent_inquery_fulldetls($id,$category_id){

        $this->db->select('full_details.id as full_id,part_code.stock_id as stid,model_no,type.name as type_name,category.name as category_name,brand.name as brand_name,owner_name,district_name,state_name,DATE_FORMAT(full_details.created_at, "%d-%m-%y") as created_date ');
        $this->db->join('state', 'state.ID = full_details.state_id','LEFT');
        $this->db->join('district', 'district.ID = full_details.district_id','LEFT');
        $this->db->join('category', 'category.ID = full_details.category_id ','LEFT');
        $this->db->join('brand', 'brand.ID = full_details.brand_id','LEFT');
        $this->db->join('type', 'type.ID = full_details.type_id ','LEFT');
        $this->db->join('part_code', 'part_code.seller_id = full_details.seller_id ','LEFT');
        $this->db->join('seller', 'seller.ID = full_details.seller_id','LEFT');
        $this->db->where('full_details.ID',$id);
        $this->db->where('full_details.category_id',$category_id);

        $this->db->group_by('full_id');
        $query = $this->db->get('full_details');
        $res = $query->result_array(); // as array
        return $res;


    }

    function sent_inquery_fulldetls1($id){

        $this->db->select('full_details.id as full_id,part_code.stock_id as stid,model_no,type.name as type_name,category.name as category_name,brand.name as brand_name,owner_name,district_name,state_name,DATE_FORMAT(full_details.created_at, "%d-%m-%y") as created_date ');
        $this->db->join('state', 'state.ID = full_details.state_id','LEFT');
        $this->db->join('district', 'district.ID = full_details.district_id','LEFT');
        $this->db->join('category', 'category.ID = full_details.category_id ','LEFT');
        $this->db->join('brand', 'brand.ID = full_details.brand_id','LEFT');
        $this->db->join('type', 'type.ID = full_details.type_id ','LEFT');
        $this->db->join('part_code', 'part_code.seller_id = full_details.seller_id ','LEFT');
        $this->db->join('seller', 'seller.ID = full_details.seller_id','LEFT');
        $this->db->where('full_details.ID',$id);
        //$this->db->where('full_details.category_id',$category_id);

        $this->db->group_by('full_id');
        $query = $this->db->get('full_details');
        $res = $query->result_array(); // as array
        return $res;


    }
	
}