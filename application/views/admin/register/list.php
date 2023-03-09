<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                  <?php if($this->session->flashdata('success')) { ?>
        			<div class="alert alert-success alert-dismissible fade show" role="alert">
        			  <strong>Success!</strong> <?=$this->session->flashdata('success');?>
        			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        				<span aria-hidden="true">&times;</span>
        			  </button>
        			</div>
        		  <?php } ?>
        		  <?php if($this->session->flashdata('error')) { ?>
        			<div class="alert alert-danger alert-dismissible fade show" role="alert">
        			  <strong>Error!</strong> <?=$this->session->flashdata('error');?>
        			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        				<span aria-hidden="true">&times;</span>
        			  </button>
        			</div>
        		  <?php } ?>


      
                <div class="card">
                  <div class="card-header">
                    <h4>User</h4>

                    <?php  
                    
                    $rid = $this->session->userdata('admin_sess')['role_id'];
                    $pid = '3';
                    $where = array('role_id'=>$rid,'permission_id'=>$pid,'add_per'=>'1');
                    $check_approve = $this->model->hdm_get_where_count('permission_role',$where);
                    if($check_approve > 0){ ?>
                      <a href="<?=base_url('register-add');?>" class="btn btn-warning" style="position:absolute;right:10px">Add</a>
                    <?php } ?>
                  

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
                            <th>Activate Date</th>
                            <th>Register date</th>
                            <th>End date</th>
                            <th>Aadhar card</th>
                            <th>Pan card</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                        <?php $sr=0; foreach($rec as $r) : $sr++;?>
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
                            <td><?php echo $r->activate_date;?></td>
                            <td><?php echo $r->create_at;?></td>
                            <td><?php echo $r->end_date;?></td>
                            <td><img src="<?php echo base_url().$r->aadharcard;?>"   style="width:100px; height: 100px;"   ></td>
                            <td><img src="<?php echo base_url().$r->pancard;?>"  style="width:100px; height: 100px;"    ></td>

                        
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

      function activate_agreement(){
      
        $.ajax({
            url:base_url+'/activate_agreement',
            method: 'post',
            data: {id:id},
            dataType: 'json',
            success: function(response){
               alert('activate successfully');
            }
        });
        
      }



      </script>

<script>


</script>