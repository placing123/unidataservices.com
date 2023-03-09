<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $title;?></h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>customerID</th>
                            <th>Password</th>
                            <th> name</th>
                            <th>mobile </th>
                            <th>email </th>
                            <th>address</th>
                            <th>Plan</th>
                            <th>franchise</th>
                            <th>Caller</th>
                            <th>Register Date </th>
                            <th>Activate</th>
                            <th>End_Date</th>
                         
                            <th>Total Form	</th> 
                           <th>Complete Form</th>
                           <th>Empty Form	</th> 
                            <th>Wallet Balance	</th> 
                            
                          
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                    //print_r($rec);
                        
                        $sr=0; foreach($rec as $r) : $sr++;?>
                          <tr>
                            <td><?php echo  $sr;?></td>
                            <td><?php echo $r->customer_id;?></td>
                            <td><?php echo $r->decpassword;?></td>
                            <td><?php echo $r->name;?></td>
                            <td><?php echo $r->mobile;?></td>
                            <td><?php echo $r->email;?></td>
                            <td><?php echo $r->address;?></td>
                            <td><?php echo $r->plan_name;?></td>
                            <td><?php echo $r->franchise_name;?></td>
                            <td><?php echo $r->caller_name;?></td>

                            <td><?php echo  date('Y-m-d',strtotime($r->create_at));?></td>
                                                     <td><?php echo date('Y-m-d',strtotime($r->activate_date));?></td>
                            <td><?php echo date('Y-m-d',strtotime($r->end_date));?></td>
                         
                            <?php 
                              //  $planId = $r->plan_id;
                              //  $total_customer_form =  $this->model->hdm_get_where_count('tbl_form', array('customer_id' => $r->customer_id, 'submit_at!=' => ''));
                              //  $plan_data = $this->model->hdm_get_where('tbl_plan', array('id' => $planId));
     
                              //  if(!empty($plan_data) > 0){
                                  // 
                                  // 
                              //  } else {
                                 $planform="deleted";
                                 $left_form = 'plan Delete'; 
                              //  }
                              

                              $planform=$r->forms;

                              if($r->wallet ==0){
                                $total_customer_form = 0;
                                $left_form = $planform;
                              } else {
                                $total_customer_form = $r->wallet / $r->per_form;
                                $left_form = $planform - $total_customer_form;
                              }
                             
                             


                            ?>
                             <td><?php echo $planform;?></td>
                            <td><?php echo $total_customer_form;?></td>
                            <td><?php echo $left_form;?></td>
                            <td><?php echo $r->wallet;?></td>
                           
                        
                        </tr>
                        <?php endforeach;?>
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
      
    
<script>


</script>