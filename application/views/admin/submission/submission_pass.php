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
                            <th>Start_Date</th>
                            <th>End_Date</th>
                            <th>Complete Form</th>
                            <th>Wallet Balance	</th>
                            <th>status	</th>
                          
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
                            <td><?php echo  date('Y-m-d',strtotime($r->create_at));?></td>
                            <td><?php echo date('Y-m-d',strtotime($r->activate_date));?></td>
                            <td><?php echo date('Y-m-d',strtotime($r->end_date));?></td>
                            <td>not submited</td>
                           
                        
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