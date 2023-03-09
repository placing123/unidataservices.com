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
                    <h4>Customer Query Details</h4>

                   <pre>  <?php  // print_r($rec);  ?>  </pre>

                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                            <th>sr.no</th>
                            <th> CustomerId</th>
                            <th> FormID</th>
                            <th>Field Name</th>
                            <th>Req.Date</th>
                            <th>Action</th>
                         
                          </tr>
                        </thead>
                        <tbody>
                        <?php  $i=0; foreach($rec as $r)  :  $i++ ;?>
                          <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $r->customer_id;?></td>
                          <td><?php echo $r->form_id;?></td>
                          <td>    <?php echo $this->model->get_fieldname($r->qry_field);   ?></td>
                          <td><?php echo $r->create_at;?></td>                                        
                          <td> 
                          <a href="<?=base_url('open-customer-request').'/'.$r->qryfldid;?>" class="btn btn-warning" >Open</a>
                            

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
      