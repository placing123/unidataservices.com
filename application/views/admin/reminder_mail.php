<div class="main-content">

  <section class="section">

    <div class="section-body">


      <div class="row">

        <div class="col-12 col-md-12 col-lg-12">

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

              <h4>Reminder Mail</h4>


            </div>

            <style>
              .error {
                color: red
              }
            </style>

            <?= validation_errors(); ?>

            <?= form_open_multipart($action); ?>

            <div class="card-body">
              <div class="row">
                <div class="form-group col-5">
                  <label for="plan_no"></label>
                  <label for="plan_no">customerID </label>
                  <textarea type="text" class="form-control" name="customer_id" id="customer_id" value=""></textarea>
                </div>

                <div class="form-group col-5">
                  <label for="forms">Mobile NO:</label>
                  <input required id="mobile_no" type="number" class="form-control" name="mobile_no" value="">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-3">
                  <a href="javascript:void(0)" onclick="remider_mail_send()" class="btn btn-primary">SEND REMINDER MAIL </a>
                </div>
                <div class="form-group col-3">
                  <a href="javascript:void(0)" onclick="warning_mail_send()" class="btn btn-primary">
                    SEND WARNING MAIL </a>

                </div>

                <div class="form-group col-3">
                  <a href="javascript:void(0)" onclick="resend_mail_send()" class="btn btn-primary">
                    RESEND REGISTER  MAIL </a>

                </div>
              </div>
            </div>
            <?= form_close(); ?>

          </div>

        </div>

      </div>

    </div>

  </section>

</div>