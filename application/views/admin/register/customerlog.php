<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> <?= $this->session->flashdata('success'); ?>.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php } ?>
          <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> <?= $this->session->flashdata('error'); ?>.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php } ?>

          <div class="card">
            <div class="card-header">
              <h4> <?php echo $title; ?> </h4>
            </div>

            <style>
                            .error {
                                color: red
                            }
                        </style>

                        <?= validation_errors(); ?>

                        <?= form_open_multipart($action); ?>

                        <div class="card-body">
                            <div class="row">
                            
                                <div class="form-group col-5">
                                <label for="plan_no">customerID </label>
                                    <input required id="customerId" type="number" class="form-control" name="customerId" value="">
                                </div>
                                <div class="form-group col-5">  
                                <label for="plan_no"> </label>
                                    <input type="submit" name="btn" class="btn btn-primary" value="search" >

                                </div>
                              
                            </div>

                        </div>
                        <?= form_close(); ?>



          </div>






          <div class="card">
            <div class="card-header">
              <h4> <?php echo $title; ?> </h4>
            </div>

            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                  <thead>
                    <tr>
                  
                      <th>Date</th>
                      <th> Module</th>
                      <th> Time</th>
                      <th> IP</th>
                      <th>Country Name</th>
                      <th> State Name</th>
                      <th>City</th>
                      <th> Pincode</th>
                      <th> Latitude</th>
                      <th> Longitude</th>
                     
                      
                  
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sr = 0;
                    foreach ($rec as $r) : $sr++; 

                  
                    ?>
                      <tr>
                     
                        <td><?php echo $r->customer_id; ?></td>
                        <td><?php echo $r->module_type; ?></td>
                        <td><?php echo $r->activity_time; ?></td>
                        <td><?php echo $r->ip; ?></td>
                       
                 <?php   
 
        // IP address 
        //$userIP = '162.222.198.75'; 
         
        // API end URL 
        $r->apiURL = 'https://freegeoip.app/json/'.$r->ip; 
         
        // Create a new cURL resource with URL 
       $r->ch = curl_init($r->apiURL); 
         
        // Return response instead of outputting 
        curl_setopt($r->ch, CURLOPT_RETURNTRANSFER, true); 
         
        // Execute API request 
        $r->apiResponse = curl_exec($r->ch); 
         
        // Close cURL resource 
        curl_close($r->ch); 
         
        // Retrieve IP data from API response 
       $r->ipData = json_decode($r->apiResponse, true); 
         
        if(!empty($r->ipData)){ 
          //  $r->country_code = $r->ipData['country_code']; 
            $r->country_name = $r->ipData['country_name']; 
            //$r->region_code = $r->ipData['region_code']; 
            $r->region_name = $r->ipData['region_name']; 
            $r->city = $r->ipData['city']; 
            $r->zip_code = $r->ipData['zip_code']; 
            $r->latitude = $r->ipData['latitude']; 
            $r->longitude = $r->ipData['longitude']; 
           // $r->time_zone = $r->ipData['time_zone'];
        }else{ 
    echo 'IP data is not found!'; 
} 
                    ?>
                    
                        <td><?php echo  $r->country_name; ?></td>
                        
                        <td><?php echo $r->region_name; ?></td>
                        <td><?php echo  $r->city; ?></td>
                        <td><?php echo $r->zip_code; ?></td>
                        <td><?php echo $r->latitude; ?></td>
                        <td><?php echo $r->longitude; ?></td>
                        
                      </tr>
                      
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

