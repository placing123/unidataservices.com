<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                  <?php if($this->session->flashdata('success')) { ?>
        			<div class="alert alert-success alert-dismissible fade show" role="alert">
        			  <strong>Success!</strong> <?=$this->session->flashdata('success');?>.
        			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        				<span aria-hidden="true">&times;</span>
        			  </button>
        			</div>
        		  <?php } ?>
        		  <?php if($this->session->flashdata('error')) { ?>
        			<div class="alert alert-danger alert-dismissible fade show" role="alert">
        			  <strong>Error!</strong> <?=$this->session->flashdata('error');?>.
        			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        				<span aria-hidden="true">&times;</span>
        			  </button>
        			</div>
        		  <?php } ?>
                <div class="card">
                  <div class="card-header">
                    <h4>Plan</h4>

                    <?php  
                    
                    $rid = $this->session->userdata('admin_sess')['role_id'];
                    $pid = '6';
                    $where = array('role_id'=>$rid,'permission_id'=>$pid,'add_per'=>'1');
                    $check_approve = $this->model->hdm_get_where_count('permission_role',$where);
                    if($check_approve > 0){ ?>
                     <a href="<?=base_url('plan-add');?>" class="btn btn-warning" style="position:absolute;right:10px">Add</a>

                    <?php } ?>
                  


                  

                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                            <th>Plan No</th>
                            <th> Plan</th>
                            <th>Days</th>
                            <th>Forms</th>
                            <th>per Forms</th>
                            <th>Qc-CutOff</th>
                            <th>Fees</th>
                            <th>cancel charge</th>
                            <th>cancel charge1</th>
                            <th>First part</th>
                            <th>multiple login penalty</th>
                            <th>Not submit charge</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($rec as $r) : ?>
                          <tr>
                          <td><?php echo  $r->plan_no;?></td>
                          <td><?php echo $r->plan_name;?></td>
                          <td><?php echo $r->days;?></td>
                          <td><?php echo $r->forms;?></td>
                          <td><?php echo $r->per_form;?></td>
                          <td><?php echo $r->cutoff;?></td>
                          <td><?php echo $r->fees;?></td>
                          <td><?php echo $r->cancel_charge;?></td>
                          <td><?php echo $r->cancel_charge1;?></td>
                          <td><?php echo $r->first_part;?></td>
                          <td><?php echo $r->mul_login_chrg;?></td>
                          <td><?php echo $r->not_submit_chrg;?></td>
                          <td> 
                          <a href="<?=base_url('edit_plan').'/'.$r->id; ?>" class="btn btn-warning" >Edit</a>
	                         <a href="javascript:void(0)"   onclick="delete_records('tbl_plan',<?php echo $r->id; ?>,'6');" class="btn btn-danger" >Delete</a>

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
      