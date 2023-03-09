<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part_code_wise extends BD_Controller {
    
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
	    
	    $part_code_id = explode(",",$seller_stock_id);
	    
	    if(!empty($part_code_id) && $part_code_id[0] != '')
	    {
	        $part_code_data = [];
	        for($i = 0; $i < count($part_code_id); $i++)
	        {
	            $partcodedata = $this->db->select('PC.part_code,C.name AS C_name,S.name AS S_name,SE.company_name,SE.mobile_no,ST.state_name,D.district_name')
                                         ->from('part_code PC')
                                         ->join('category C','C.ID = PC.category_id')
                                         ->join('stock S','S.ID = PC.stock_id')
                                         ->join('seller SE','SE.ID = PC.seller_id')
                                         ->join('state ST','ST.ID = SE.state_id')
                                         ->join('district D','D.ID = SE.district_id')
                                         ->where('PC.ID',$part_code_id[$i])
                                         ->where('PC.seller_id',$seller_id)
                                         ->get()
                                         ->row_array();
                                         
                if(!empty($partcodedata))
                {
                    $part_code_data[] = $partcodedata;
                }
	        }
	       
	        if(empty($part_code_data))
	        {
	            $response = ['msg' => 'Data Not Found'];

                $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	        }
	        else
	        {
	            $data['url'] = $url;
	            $data['part_code_data'] = $part_code_data;
	            
	            $html_content = $this->load->view('PDF/part_code_wise', $data, true);
	            
	            $this->pdf->loadHtml($html_content);
    		    $this->pdf->render();
    		    
    		    $output = $this->pdf->output();
    		
        		$date = date('Ymdhis');
        		
        		$c_date = date('Ymd');
                if (!is_dir('admin_assets/PDF/Part_code_wise/'.$c_date)) {
                    mkdir('./admin_assets/PDF/Part_code_wise/' . $c_date, 0777, TRUE);
                
                }
                
                $previous_date = date('Ymd',strtotime("-1 days"));
                
                if (is_dir('admin_assets/PDF/Part_code_wise/'.$previous_date)) {
                    
                    $this->remove_dir_get($previous_date);
                }
        		
        		
                file_put_contents('admin_assets/PDF/Part_code_wise/'.$c_date.'/'.$date.'.pdf', $output);
                
                $response = [
                                'url' => base_url('admin_assets/PDF/Part_code_wise/'.$c_date.'/'.$date.'.pdf'),
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
	    if (is_dir('admin_assets/PDF/Part_code_wise/'.$previous_date)) 
	    {
    	    if ($dh = opendir('admin_assets/PDF/Part_code_wise/'.$previous_date.'/'))
            {
                while (($file = readdir($dh)) !== false)
                {
                    //echo "filename:" . $file . "<br>";
                    
                    $delete_path = 'admin_assets/PDF/Part_code_wise/'.$previous_date.'/'.$file;
                    
                    if($file != '..' && $file != '.')
                    {
                        unlink($delete_path);
                    }
                }
                
                
            }
            
            rmdir('admin_assets/PDF/Part_code_wise/'.$previous_date);
            
	    }
	}

}

?>