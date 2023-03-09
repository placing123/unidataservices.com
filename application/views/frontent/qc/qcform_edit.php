  <!-- [ breadcrumb ] start -->
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="feather icon-home bg-c-blue"></i>
          <div class="d-inline">
            <h5>QC </h5>
            <!-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> -->
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- [ breadcrumb ] end -->


  <pre>   <?php

          $form_id = $formrecords[0]->id;
          $fid_status = 'fid_status';
          $customer_id = $this->session->userdata('customer_sess')['customer_id'];
          ?>

</pre>
  <form method="post" action="<?php echo base_url() . 'update_form' ?>">
  <input type="hidden" value="<?php echo  $formrecords[0]->id; ?>" name="form_id">
    <div class="pcoded-inner-content">
      <div class="main-body">
        <div class="page-wrapper">
          <div class="page-body">
            <!-- [ page content ] start -->


            <div class="row" id="resume_section">
              <div class="col-lg-12 col-xl-6">
                <div class="card">
                  <div class="card-header">
                    <h5>Image</h5>
                  </div>
                  <div class="card-block">
                    <div class="embed-responsive embed-responsive-1by1">
                      <iframe id="resumepdf" class="embed-responsive-item" src="<?php echo base_url() . 'uploads/resumes/' . $formrecords[0]->resume_id . '.pdf'; ?>"></iframe>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-xl-6">
                <div class="card">
                  <div class="card-header">
                    <h5>Resume Data</h5>

                  </div>
                  <div class="card-block">
                    <div class="card-header">
                      <h4>PersonalDetails</h5>

                    </div>
                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '1');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>


                      <div class="col-sm-3">
                        <label class="col-form-label">Mis/Miss/Mrs</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="mis" id="mis" value="<?php echo $formrecords[0]->mis; ?>">
                      </div>
                    </div>

                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '2');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>

                      <div class="col-sm-3">
                        <label class="col-form-label">First Name</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="first_name" id="first_name" value="<?php echo $formrecords[0]->first_name; ?>">
                      </div>
                    </div>


                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '3');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Last Name</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="last_name" id="last_name" value="<?php echo $formrecords[0]->last_name; ?>">
                      </div>
                    </div>
                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '4');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Contact No</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" class="form-control <?php echo $status; ?> " name="contact_no" id="contact_no" value="<?php echo $formrecords[0]->contact_no; ?>">
                      </div>
                    </div>

                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '5');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Alternate No</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?>  " name="alternate_no" id="alternate_no" value="<?php echo $formrecords[0]->alternate_no; ?>">
                      </div>
                    </div>

                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '6');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label"> Email</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?>  " name="Email" id="Email" value="<?php echo $formrecords[0]->email; ?>">
                      </div>
                    </div>

                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '7');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Company Name</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="company_name" id="company_name" value="<?php echo $formrecords[0]->company_name; ?>">
                      </div>
                    </div>
                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '8');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Website url</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="website_url" id="website_url" value="<?php echo $formrecords[0]->website_url; ?>">
                      </div>
                    </div>
                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '9');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Address</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="address" id="address" value="<?php echo $formrecords[0]->address; ?>">
                      </div>
                    </div>

                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '10');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">City</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="city" id="city" value="<?php echo $formrecords[0]->city; ?>">
                      </div>
                    </div>


                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '11');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">State</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="state" id="state" value="<?php echo $formrecords[0]->state; ?>">
                      </div>
                    </div>

                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '12');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Zip</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="zip" id="zip" value="<?php echo $formrecords[0]->zip; ?>">
                      </div>
                    </div>


                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '13');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Sic Desc</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="sic_desc" id="sic_desc" value="<?php echo $formrecords[0]->sic_desc; ?>">
                      </div>
                    </div>
                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '14');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Sic code</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="sic_code" id="sic_code" value="<?php echo $formrecords[0]->sic_code; ?>">
                      </div>
                    </div>
                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '15');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Entity Type</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="entity_type" id="entity_type" value="<?php echo $formrecords[0]->entity_type; ?>">

                      </div>
                    </div>

                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '16');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">company sale</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="company_sale" id="company_sale" value="<?php echo $formrecords[0]->company_sale; ?>">

                      </div>
                    </div>

                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '17');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Revenue</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="revenue" id="revenue" value="<?php echo $formrecords[0]->revenue; ?>">

                      </div>
                    </div>

               


                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '18');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Country</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="country" id="country" value="<?php echo $formrecords[0]->country; ?>">
                      </div>
                    </div>
                    <!-- end  -->
                    <div class="row form-group">

                      <?php
                      $where = array('customer_id' => $customer_id, 'form_id' => $form_id, 'fid' => '19');
                      $st = $this->model->hdm_get_where_row('tbl_approve', $where, $fid_status);
                      if ($st != '0') {
                        $status = 'approve_c';
                      } else {
                        $status = 'disapprove_c';
                      }

                      ?>
                      <div class="col-sm-3">
                        <label class="col-form-label">Medical ins</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control <?php echo $status; ?> " name="medical_ins" id="medical_ins" value="<?php echo $formrecords[0]->medical_ins; ?>">
                      </div>
                    </div>
                    <!-- end  -->
                   

                    <!-- end  -->


                  </div>
                </div>
              </div>
              <!-- Project statustic end -->

            </div>
            <!-- [ page content ] end -->
          </div>
        </div>
      </div>
    </div>

  </form>