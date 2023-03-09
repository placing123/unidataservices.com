<div class="main-content">
        <section class="section">
          <div class="section-body">

       
            <div class="row">
              <div class="col-12">
                  
                <div class="card">
                 
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                        <tr>
                           
                            <th>customerID</th>
                            <th>Fill form</th>
                            <th>left form</th>
                            <th> name</th>
                            <th> Password</th>
                            <th> sign</th>
                            <th> Agreement</th> 
                            <th>mobile </th>
                            <th>email </th>
                            <th>address</th>
                            <th>Plan</th>
                            <th>franchise</th>
                            <th>Caller</th>
                            <th>Activate Date</th>
                            <th>Register date</th>
                            <th>End date</th>
                            
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $sr=0; foreach($rec as $r) : $sr++;


                          $planId = $r->plan_id;
                          $total_customer_form =  $this->model->hdm_get_where_count('tbl_form', array('customer_id' => $r->customer_id, 'submit_at!=' => ''));
                          $plan_data = $this->model->hdm_get_where('tbl_plan', array('id' => $planId));
                          $left_form = $plan_data[0]->forms - $total_customer_form; 
           
                        
                        ?>
                          <tr>
                        
                          <td><?php echo $r->customer_id; ?></td>
                          <td><?php echo $total_customer_form; ?></td>
                          <td><?php echo $left_form; ?></td>
                          <td><?php echo $r->name;?></td>
                          <td><?php echo $r->decpassword;?></td>
                          <td>

                          <?php
                          $file =base_url() . 'uploads/signature/' . $r->signature;

                          if(file_exists($file)){ ?>
                           <a href="<?php echo base_url() . 'uploads/signature/' . $r->signature; ?>" download="<?php echo $r->customer_id; ?>">
                            <img width=150px src="<?php echo base_url() . 'uploads/signature/' . $r->signature; ?>" alt="<?php echo $r->customer_id; ?>">
                          </a>

                         <?php  } else{ ?>
                          <span>Not Available</span>

                      <?php    }    ?>
                         
                        </td>
                          <td>

                          <?php if ($r->sign_agreement == '0') { ?>
                            <a href="<?php echo base_url() . '/admin_assets/pdf/' . $r->agreement_url; ?>" target="_blank"> Download </a>


                          <?php   } else { ?>
                            <a href="<?php echo base_url() . '/admin_assets/signpdf/' . $r->sign_agreement; ?>" target="_blank"> Download </a>


                          <?php } ?>
                      </td>
                          <td><?php echo $r->mobile;?></td>
                          <td><?php echo $r->email;?></td>
                          <td><?php echo $r->address;?></td>
                          <td><?php echo $r->plan_name;?></td>
                          <td><?php echo $r->franchise_name;?></td>
                          <td><?php echo $r->caller_name;?></td>
                         <td><?php echo $r->activate_date;?></td>
                         <td><?php echo $r->create_at;?></td>
                         <td><?php echo $r->end_date;?></td>
                          <td> 

                        <?php if($r->is_agreement =='1'){ ?>
                               <a href="javascript:void(0)"  onclick="activate_agreement( <?php echo $r->customer_id; ?>);" class="btn btn-warning" >Activate</a>
                         <?php } 
                         else if($r->is_agreement =='0') { ?>
                            <a href="javascript:void(0)"   class="btn btn-primary" disabled >Not Sign </a>
                            <a href="javascript:void(0)"  onclick="activate_agreement( <?php echo $r->customer_id; ?>);" class="btn btn-warning" >Activate</a>
                        
                          <?php }  else if($r->is_agreement =='2') { ?>
                            <a href="javascript:void(0)"   class="btn btn-danger" disabled >Activated</a>
                         <?php  }  ?>
                           </td>
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
      


