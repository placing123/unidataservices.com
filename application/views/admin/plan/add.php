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

            <h4><?php echo $title;?></h4>

            <a href="<?=base_url('plan-list');?>" class="btn btn-warning" style="position:absolute;right:10px">List</a>

          </div>

          <style>.error{color:red}</style>

          <?=validation_errors();?>

          <?=form_open_multipart($action);?>

          <div class="card-body">

            <div class="row">

             
                <div class="form-group col-5">

                  <label for="plan_no">Plan No:</label>

                  <input   required  readonly id="plan_no" type="number" class="form-control" name="plan_no" value="<?php echo rand(1234,9999);?>">

                </div>

                <div class="form-group col-5">
                 <label for="plan_name">Plan Name:</label>
                 <input required  id="plan_name" type="text" class="form-control" name="plan_name" value="">
                </div>

                  <div class="form-group col-5">

                  <label for="days">Days</label>

                  <input required id="days	" type="number" class="form-control" name="days" value="">

                  </div>
                  <!-- <div class="form-group col-5">
                    <label for="forms">Forms</label>
                    <input required id="forms" type="number" class="form-control" name="forms" value="">
                  </div> -->

                  <div class="form-group col-5">
                    <label for="forms">Per Forms Price</label>
                    <input required id="per_form" type="number" class="form-control" name="per_form" value="">
                  </div>

                    <div class="form-group col-5">
                    <label for="forms">Total Forms</label>
                    <input required id="forms" type="number" class="form-control" name="forms" value="">

                    </div>

                    <div class="form-group col-5">
                    <label for="cutoff">Qc-CutOff(IN PERCENTAGE):</label>
                    <input required id="cutoff" type="number" class="form-control" name="cutoff" value=""  placeholder="90%" >
                    </div>
                    <div class="form-group col-5">
                    <label for="fees">Total Fees:	</label>
                    <input required  id="fees" type="number" class="form-control" name="fees" value="">
                    </div>

                    <div class="form-group col-5">
                    <label for="cancel_charge">cancel charge:	</label>
                    <input required  id="cancel_charge" type="number" class="form-control" name="cancel_charge" value="">
                    </div>
                     <div class="form-group col-5">
                    <label for="cancel_charge1">cancel charge1:	</label>
                    <input required  id="cancel_charge1" type="number" class="form-control" name="cancel_charge1" value="">
                    </div>

                    <div class="form-group col-5">
                    <label for="first_part">Extension charge:	</label>
                    <input required  id="first_part" type="number" class="form-control" name="first_part" value="">
                    </div>

                    <div class="form-group col-5">
                    <label for="mul_login_chrg">multiple login  penalty:	</label>
                    <input required  id="mul_login_chrg" type="number" class="form-control" name="mul_login_chrg" value="">
                    </div>

                    <div class="form-group col-5">
                    <label for="not_submit_chrg">Not submited charge/submission faild:	</label>
                    <input required  id="not_submit_chrg" type="number" class="form-control" name="not_submit_chrg" value="">
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