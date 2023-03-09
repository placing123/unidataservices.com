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
                      <h4>Franchise Table</h4>

                      <?php  
                    
                    $rid = $this->session->userdata('admin_sess')['role_id'];
                    $pid = '7';
                    $where = array('role_id'=>$rid,'permission_id'=>$pid,'add_per'=>'1');
                    $check_approve = $this->model->hdm_get_where_count('permission_role',$where);
                    if($check_approve > 0){ ?>
                        <a href="<?=base_url('franchise-add');?>" class="btn btn-warning" style="position:absolute;right:10px">Add</a>
                    <?php } ?>
                  


                   
                  </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th> Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($rec as $r) : ?>
                          <tr>
                          <td><?php echo  $r->id;?></td>
                          <td><?php echo $r->franchise_name;?></td>
                          <td> 

                          <?php  
                    
                    $rid = $this->session->userdata('admin_sess')['role_id'];
                    $pid = '7';
                    $where = array('role_id'=>$rid,'permission_id'=>$pid,'edit_per'=>'1');
                    $check_approve = $this->model->hdm_get_where_count('permission_role',$where);
                    if($check_approve > 0){ ?>
                 <a href="<?=base_url('edit_franchaise').'/'.$r->id; ?>" class="btn btn-warning" >Edit</a>
                            <?php } ?>

                        
                          <a href="javascript:void(0)"   onclick="delete_records('tbl_franchise',<?php echo $r->id; ?>,'7');" class="btn btn-danger" >Delete</a>

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
      