<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MailController extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
    }
    
    public function withdraw_data_post(){
        
         //Load email library 
        $this->load->library(  'email'); 
   
      
        $name = $this->post('name');
        $address = $this->post('address');
        $country = $this->post('country');
        $wallet_amount = $this->post('wallet_amount');
        $details      = $this->post('details');
        $paypal_mail      = $this->post('paypal_mail');
        
         $user_id      = $this->post('user_id');
        
        $data = array('name'=>$name,'user_id'=>$user_id,'address'=>$address,'country'=>$country,'wallet_amount'=>$wallet_amount,'details'=>$details,'paypal_mail'=>$paypal_mail);
        $this->db->insert('withdraw_mails',$data);
        
        $from_email = "nishantsavani11@gmail.com "; 
        $to_email = "dom.doss@gmail.com";    
        $message = "
                    <html>
                    <head>
                    <title>Widthdraw Details</title>
                    </head>
                    <body>
                    
                    <h3>Widthdraw Details</h3>
                   
                    <table>
                    <tr>
                    <th>Name</th>
                    <td>$name</td>
                    </tr>
                      <tr>
                    <th>Address</th>
                    <td>$address</td>
                    </tr>
                     <tr>
                    <th>Country</th>
                    <td>$country</td>
                    </tr>
                    
                    <tr>
                    <th>wallet amount</th>
                    <td>$wallet_amount</td>
                    </tr>
                    <tr>
                    <th>Details</th>
                    <td>$details</td>
                    </tr>
                    <tr>
                    <th>paypal mail Adress</th>
                    <td>$paypal_mail</td>
                    </tr>
                    
                    
                    </table>
                    </body>
                    </html>
                    ";
                    
             $config=array(
            'charset'=>'utf-8',
            'wordwrap'=> TRUE,
            'mailtype' => 'html'
            );

        $this->email->initialize($config);
   
       
        $this->email->from($from_email, 'Bang for Bucks'); 
        $this->email->to($to_email);
        $this->email->subject('Withdraw Request Details'); 
        $this->email->message($message); 
   
        $send_mail = $this->email->send();
        $this->set_response(['msg'=>'Email send  Successfully.'], REST_Controller::HTTP_OK);
    }
}    
      