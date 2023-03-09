<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_wise extends BD_Controller {
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->library('pdf');
    }
    
	public function index_post()
	{
	    $seller_id = $this->seller_data->seller_id;
	    $seller_stock_id = $this->input->post('seller_stock_id');
	    $url = $this->input->post('url');
	    
	    $data['seller_data'] = $this->model->hdm_get_where_limit('seller',['ID'=>$seller_id],1);
	    
	    $data['district'] = $this->model->hdm_get_where_limit('district',['ID'=>$data['seller_data']['district_id']],1);
	    $data['state'] = $this->model->hdm_get_where_limit('state',['ID'=>$data['seller_data']['state_id']],1);
	    
	    $data['search_full_details'] = $this->model->hdm_get_where_limit('full_details',['seller_id'=>$seller_id,'ID'=>$seller_stock_id],1);
	    
	   // $data['stock_list'] = $this->model->hdm_get_where('stock',['category_id'=>$data['search_full_details']['category_id']]);
	   
	   $data['stock_list'] = $stock = $this->db->where('status',0)->like('type_id',$data['search_full_details']['type_id'])->get('stock')->result();
	    
	    if(!empty($data['search_full_details']))
	    {
	        $data['url'] = $url;
    	    $data['brand_name'] = $this->model->hdm_get_where_limit('brand',['ID'=>$data['search_full_details']['brand_id']],1);
    	    
    	    $data['type_name'] = $this->model->hdm_get_where_limit('type',['ID'=>$data['search_full_details']['type_id']],1);
    	    
    	    $html_content = $this->load->view('PDF/model_wise', $data, true);
    	    
    		$this->pdf->loadHtml($html_content);
    		$this->pdf->render();
    		//$this->pdf->stream("".date('Ymdhis').".pdf", array("Attachment"=>0));
    		
    		$output = $this->pdf->output();
    		
    		$date = date('Ymdhis');
    		
    		$c_date = date('Ymd');
            if (!is_dir('admin_assets/PDF/'.$c_date)) {
                mkdir('./admin_assets/PDF/' . $c_date, 0777, TRUE);
            
            }
            
            $previous_date = date('Ymd',strtotime("-1 days"));
            
            if (is_dir('admin_assets/PDF/'.$previous_date)) {
                
                $this->remove_dir_get($previous_date);
                  
                // $this->load->helper("file");
                
                // $delete_path = base_url('admin_assets/PDF/'.$previous_date);
                // //$delete_path = $_SERVER['DOCUMENT_ROOT'].'admin_assets/PDF/'.$previous_date.'/';
                
                // rmdir($delete_path);
            }
    		
    		
            file_put_contents('admin_assets/PDF/'.$c_date.'/'.$date.'.pdf', $output);
            
            $response = [
                            'url' => base_url('admin_assets/PDF/'.$c_date.'/'.$date.'.pdf'),
                        ];
                        
            $this->set_response($response, REST_Controller::HTTP_OK);
	    }
	    else
	    {
	        $response = ['msg' => 'Data Not Found'];

            $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	    }
	}
	
	public function remove_dir_get($previous_date)
	{
	    if (is_dir('admin_assets/PDF/'.$previous_date)) 
	    {
    	    if ($dh = opendir('admin_assets/PDF/'.$previous_date.'/'))
            {
                while (($file = readdir($dh)) !== false)
                {
                    //echo "filename:" . $file . "<br>";
                    
                    $delete_path = 'admin_assets/PDF/'.$previous_date.'/'.$file;
                    
                    if($file != '..' && $file != '.')
                    {
                        unlink($delete_path);
                    }
                }
                
                
            }
            
            rmdir('admin_assets/PDF/'.$previous_date);
            
	    }
	}

}

?>