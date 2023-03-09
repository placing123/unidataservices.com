<div class="main-content">

<section class="section">

  <div class="section-body">

    <div class="row">

      <div class="col-12 col-md-12 col-lg-12">

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

            <h4>Caller</h4>

      
          </div>

          <style>.error{color:red}</style>

          <?=validation_errors();?>

          <?=form_open_multipart($action);?>

          <div class="card-body">

            <div class="row">

            <div class="form-group col-5">
            <label for="last_name">Customer</label>
            <select name="customer_id" id=""  class="form-control" >
                <option value="" >Select</option>

                <?php foreach($cust_rec as $r) :   ?>
											<option value="<?php echo  $r->customer_id; ?>"><?php echo  $r->customer_id; ?></option>
										<?php endforeach; ?>
            </select>
            </div>

          </div>
           <input type="submit" name="btn" class="btn btn-primary" value="Submit" >

         </div>

           <?=form_close();?>


        </div>

      </div>

    </div>

  </div>

</section>



</div>