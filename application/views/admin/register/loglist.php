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
              <h4>Log</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                  <thead>
                    <tr>
                  
                      <th>customerID</th>
                    
                      <th> name</th>
                   
                      <th>mobile </th>
                      <th>email </th>
                   
                      <th>Plan</th>
                      <th>franchise</th>
                      <th>Caller</th>
                      <th>Activate Date</th>
                      <th>End date</th>
                      <th>Action</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sr = 0;
                    foreach ($rec as $r) : $sr++; 

                  
                    ?>
                      <tr>
                     
                        <td><?php echo $r->customer_id; ?></td>
                        <td><?php echo $r->name; ?></td>
                        <td><?php echo $r->mobile; ?></td>
                        <td><?php echo $r->email; ?></td>
                        <td><?php echo $r->plan_name; ?></td>
                        <td><?php echo $r->franchise_name; ?></td>
                        <td><?php echo $r->caller_name; ?></td>
                        <td><?php echo $r->activate_date; ?></td>
                        <td><?php echo $r->end_date;?></td>
                        <td>
                          <a href="<?php echo base_url().'customer-log/'.$r->customer_id;?>"  class="btn btn-warning">View log</a>
                        </td>
                       
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

