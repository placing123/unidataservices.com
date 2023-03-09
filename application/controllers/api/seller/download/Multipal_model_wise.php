<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multipal_model_wise extends BD_Controller {
    
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
	    
	    $seller_stock_id = explode(",",$seller_stock_id);
	    
	    if(!empty($seller_stock_id) && $seller_stock_id[0] != '')
	    {
	        $multipal_model_wise = [];
	        for($i = 0; $i < count($seller_stock_id); $i++)
	        {
	            $multipalmodelwise = $this->db->select('FD.model_no,FD.part_code_ids,FD.type_id,C.name AS C_name,C.ID AS C_id,B.name AS B_name,T.name AS T_name,SE.company_name,SE.mobile_no,ST.state_name,D.district_name')
                                              ->from('full_details FD')
                                              ->join('category C','C.ID = FD.category_id')
                                              ->join('brand B','B.ID = FD.brand_id')
                                              ->join('type T','T.ID = FD.type_id')
                                              ->join('seller SE','SE.ID = FD.seller_id')
                                              ->join('state ST','ST.ID = SE.state_id')
                                              ->join('district D','D.ID = SE.district_id')
                                              ->where('FD.ID',$seller_stock_id[$i])
                                              ->where('FD.seller_id',$seller_id)
                                              ->get()
                                              ->result_array();
                                             
                if(!empty($multipalmodelwise))
                {
                    $multipal_model_wise[] = $multipalmodelwise;
                }
	        }
	        
	        if(empty($multipal_model_wise))
	        {
	            $response = ['msg' => 'Data Not Found'];

                $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	        }
	        else
	        { 
    	        $data['url'] = $url;
                $data['multipal_model_wise'] = $multipal_model_wise;
                
                $html_content = $this->load->view('PDF/multipal_model_wise', $data, true);
    	    
        		$this->pdf->loadHtml($html_content);
        		$this->pdf->render();
        		
        		$output = $this->pdf->output();
        		
        		$date = date('Ymdhis');
        		
        		$c_date = date('Ymd');
                if (!is_dir('admin_assets/PDF/'.$c_date)) {
                    mkdir('./admin_assets/PDF/' . $c_date, 0777, TRUE);
                }
                
                $previous_date = date('Ymd',strtotime("-1 days"));
                
                if (is_dir('admin_assets/PDF/'.$previous_date)) {
                    
                    $this->remove_dir_get($previous_date);
                }
        		
        		
                file_put_contents('admin_assets/PDF/'.$c_date.'/'.$date.'.pdf', $output);
                
                $response = [
                                'url' => base_url('admin_assets/PDF/'.$c_date.'/'.$date.'.pdf'),
                            ];
                            
                $this->set_response($response, REST_Controller::HTTP_OK);
	        }
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