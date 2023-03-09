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
              <h4>Activate</h4>
              <!-- <a href="<?= base_url('register-add'); ?>" class="btn btn-warning" style="position:absolute;right:10px">Add</a> -->
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>customerID</th>
                      <th>customerID</th>
                      <th> name</th>
                      <th>Register date</th>
                      <th>Signature</th>
                      <th>Agreement</th>
                      <th>mobile </th>
                      <th>email </th>
                      <th>address</th>
                      <th>Plan</th>
                      <th>franchise</th>
                      <th>Caller</th>
                      <th>Activate Date</th>
                      <th>End date</th>
                      <th>Action</th>
                      <th>Resign</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sr = 0;
                    foreach ($rec as $r) : $sr++; 

                         
                    $planId = $r->plan_id;   
                    $total_customer_form =  $this->model->hdm_get_where_count('tbl_form', array('customer_id' => $r->customer_id, 'submit_at!=' => ''));
                    $plan_data = $this->model->hdm_get_where('tbl_plan', array('id' => $planId));
                
                    $left_form = $plan_data[0]->forms - $total_customer_form; 
                    
           
                    
                    
                    
                    
                    
                    
                    ?>
                      <tr>
                        <td><?php echo  $sr; ?></td>
                        <td><?php echo $r->customer_id; ?></td>
                        <td><?php echo $r->customer_id; ?></td>
                        <td><?php echo $r->name; ?></td>
                        <td><?php echo $r->create_at; ?></td>
                        <td>
                          <a href="<?php echo base_url() .'uploads/signature/'.$r->signature; ?>" download="<?php echo $r->customer_id; ?>">
                            <img style="width:150px;height:100px;"  src="<?php echo base_url() .'uploads/signature/'.$r->signature; ?>" alt="<?php echo $r->customer_id; ?>">
                          </a>
                        </td>
                        <td>
                          <?php if ($r->sign_agreement == '0') { ?>
                            <span>  Not sign yet </span>

                          <?php   } else { ?>
                            <a href="<?php echo base_url().'/admin_assets/signpdf/'.$r->sign_agreement; ?>" target="_blank"> Download </a>
                        <?php } ?>
                        </td>
                        <td><?php echo $r->mobile; ?></td>
                        <td><?php echo $r->email; ?></td>
                        <td><?php echo $r->address; ?></td>
                        <td><?php echo $r->plan_name; ?></td>
                        <td><?php echo $r->franchise_name; ?></td>
                        <td><?php echo $r->caller_name; ?></td>
                        <td><?php echo $r->activate_date; ?></td>
                        <td><?php echo $r->end_date;?></td>
                        <td>
                          <a href="javascript:void(0)" onclick="activate_agreement(<?php echo $r->customer_id; ?>);" class="btn btn-warning">Activate</a>
                        </td>
                        <td>
                          <a href="javascript:void(0)" onclick="resend_sign(<?php echo $r->customer_id; ?>);" class="btn btn-warning">Resend sign</a>
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


<script>
  function activate_agreement(id) {

    var base_url = $("#base_url").val();
    swal({
        title: "Are you sure?",
        text: "You want to activate user account!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: base_url + '/activate_agreement',
            method: 'post',
            data: {
              id: id
            },
            dataType: 'json',
            success: function(response) {
              if (response.status = '1') {
                swal("User Activate Successfully", {
                  icon: "success",
                });
              }
              location.reload();
            }
          });
        } else {
          swal("Your have cancel process");
        }
      });
  }






  function resend_sign(id) {

var base_url = $("#base_url").val();
swal({
    title: "Are you sure?",
    text: "You want to resign user account!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: base_url + '/resend_sign',
        method: 'post',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          if (response.status = '1') {
                swal("User resign successfully", {
                  icon: "success",
                });
              }
              location.reload();
        }
      });
    } else {
      swal("Your have cancel process");
    }
  });
}




















</script>