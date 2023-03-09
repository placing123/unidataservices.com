<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multipal_part_code_wise extends BD_Controller {
    
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
	    $stock_id = $this->input->post('stock_id');
	    $url = $this->input->post('url');
	    
	    $stock_id = explode(",",$stock_id);
	    
	    if(!empty($stock_id) && $stock_id[0] != '')
	    {
	        $multipal_part_code = [];
	        for($i = 0; $i < count($stock_id); $i++)
	        {
    	        $multipalpartcode = $this->db->select('PC.part_code,C.name AS C_name,S.name AS S_name,SE.company_name,SE.mobile_no,ST.state_name,D.district_name')
                                             ->from('part_code PC')
                                             ->join('category C','C.ID = PC.category_id')
                                             ->join('stock S','S.ID = PC.stock_id')
                                             ->join('seller SE','SE.ID = PC.seller_id')
                                             ->join('state ST','ST.ID = SE.state_id')
                                             ->join('district D','D.ID = SE.district_id')
                                             ->where('PC.stock_id',$stock_id[$i])
                                             ->where('PC.seller_id',$seller_id)
                                             ->get()
                                             ->result_array();
                                               
                
                if(!empty($multipalpartcode))
                {
                    $multipal_part_code[] = $multipalpartcode;
                }
                
	        }
	        
	        if(empty($multipal_part_code))
	        {
	            $response = ['msg' => 'Data Not Found'];

                $this->set_response($response, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
	        }
	        else
	        { 
    	        $data['url'] = $url;
                $data['multipal_part_code'] = $multipal_part_code;
                
                $html_content = $this->load->view('PDF/multipal_part_code_wise', $data, true);
                
                $this->pdf->loadHtml($html_content);
                
                $this->pdf->setPaper('A4','portrait');
                
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