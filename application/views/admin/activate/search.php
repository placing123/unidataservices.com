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
                    <h4><?php echo $title;?></h4>
                    <!-- <a href="<?=base_url('register-add');?>" class="btn btn-warning" style="position:absolute;right:10px">Add</a> -->


                  </div>
                  <div class="card-body">

                  <?=form_open_multipart($action);?>

                        <div class="row">
                              <div class="form-group col-5">
                              <label for="last_name">Name</label>
                              <input id="customer_id" type="text" class="form-control" name="customer_id" value="">
                      </div>
                      <div class="form-group col-5"  style="margin-top: 28px;"    >
                      
                             <input type="submit" name="btn" class="btn btn-primary" value="Search" >
                      </div>
                     <?=form_close();?>
                    <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                        <tr>
                           
                            <th>customerID</th>
                            <th> name</th>
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
                        <?php $sr=0; foreach($rec as $r) : $sr++; ?>
                          <tr>
                        
                          <td><?php echo $r->customer_id; ?></td>
                          <td><?php echo $r->name;?></td>
                          <td>

                          <?php
                          $file =base_url() . 'uploads/signature/' . $r->signature;

                          if(file_exists($file)){ ?>
                           <a href="<?php echo base_url() . 'uploads/signature/' . $r->signature; ?>" download="<?php echo $r->customer_id; ?>">
                            <img width=150px src="<?php echo base_url() . 'uploads/signature/' . $r->signature; ?>" alt="<?php echo $r->customer_id; ?>">
                          </a>

                         <?php  } else{ ?>
                          <span>Not Available</span>

                      <?php    }   ?>
                         
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
      



      <script>

function activate_agreement(id){
  
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
          url:base_url+'/activate_agreement',
          method: 'post',
          data: {id:id},
          dataType: 'json',
          success: function(response){
            if(response.status ='1'){
              swal("User Activate Successfully", {
              icon: "success",
             });
            }
            location.reload();
        }
  });
     } else {
      swal("Your imaginary file is safe!");
    }
  });
}
</script>