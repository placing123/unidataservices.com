<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Matches extends BD_Controller 
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
       // $this->auth();
    }
    
 public function matches_data_post(){

$curl = curl_init();
$PROJ_KEY = 'RS_P_1420374614458110037';
$API_TOKEN = 'v5sRS_P_1420374614458110037s1439808829649982832';

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.sports.roanuz.com/v5/cricket/${PROJ_KEY}/featured-matches/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "rs-token: ${API_TOKEN}"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

    }
}
?>