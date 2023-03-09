  <!-- [ breadcrumb ] start -->

  <div class="page-header card">

    <div class="row align-items-end">

      <div class="col-lg-8">

        <div class="page-header-title">

          <i class="feather icon-home bg-c-blue"></i>

          <div class="d-inline">

            <h5>Data Entry</h5>

            <!-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> -->

          </div>

        </div>

      </div>

      <div class="col-lg-4">

        <div class="page-header-breadcrumb">

          <ul class=" breadcrumb breadcrumb-title">

            <li class="breadcrumb-item">

              <a href="index.html"><i class="feather icon-home"></i></a>

            </li>

            <li class="breadcrumb-item"><a href="#!">Data PROJECTION TASK</a> </li>

          </ul>

        </div>

      </div>

    </div>

  </div>

  <!-- [ breadcrumb ] end -->



  <form method="post" id="resume_form">

    <div class="pcoded-inner-content">

      <div class="main-body">

        <div class="page-wrapper">

          <div class="page-body">

            <!-- [ page content ] start -->

            <div class="row">

              <div class="col-lg-12 col-xl-6">

                <div class="card">

                  <div class="card-header">

                    <h5>Form</h5>

                    <?php

                    // print_r($last_update_record);

                    // if (!empty($last_update_record)) {

                    //   $lastid = $last_update_record->id;

                    // } else {

                    //   $lastid = "";

                    // }

                    // $lastid;

                    // //  print_r($last_update_record);

                    // $lastresume = $record[0]->id;



                   // echo $last_update_record;

                    if($last_update_record !=""){

                      $nextselected_id =   $last_update_record + 1;

                    } else {

                     

                      $nextselected_id = $record[0]->id;

                    }



                   

                    ?>



                  </div>

                  <div class="card-block">



                    <div class="row form-group">

                      <div class="col-sm-3">

                        <label class="col-form-label">Select Form

                        </label>

                      </div>

                      <div class="col-sm-9">

                        <select id="resume_id" name="form_id" class="form-control" onchange="get_forms();">

                         

                          <?php

                          $i = 0;

                          foreach ($record as $r) {

                            $i++; ?>

                            <option value="<?php echo $r->id; ?>" <?php if ($nextselected_id  == $r->id) {

                                                                    echo "selected";

                                                               //

                                                                    $lastresume = $r->id;

                                                                  }  ?>><?php echo $i; //$r->id;

                                                                        ?> </option>

                          <?php  }  ?>

                        </select>

                      </div>

                    </div>





                  </div>

                </div>

              </div>

            </div>

          </div>

          <div class="row" id="resume_section">

            <div class="col-lg-12 col-xl-6">

              <div class="card">

                <div class="card-header">

                  <h5>Image</h5>

                </div>

                <div class="card-block">

                  <div class="embed-responsive embed-responsive-1by1">
    
                    <?php
                    
                     $resume_id = $this->model->get_resumeidbyformid($lastresume);
    //die($resume_id);
                    ?>
                  
                  <iframe id="resumepdf" class="embed-responsive-item" width="100%" height="100%"
                    src="<?php echo base_url() . 'uploads/resumes/' . $resume_id . '.pdf'; ?>"
                    frameborder="0" allowfullscreen="" style="position:absolute; top:0; left: 0">
                  </iframe>
                

                   

                  </div>

                </div>

              </div>

            </div>

            <div class="col-lg-12 col-xl-6">

              <div class="card">

                <div class="card-header">

                  <h5>PROJECTION DATA</h5> <br>



                  <h6>Please Note : if you have any query first please submit with field value with NA then update as save for query </h6>



                </div>

                <div class="card-block">

                  <div class="card-header">

                    <h4>PersonalDetails</h5>



                  </div>



                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Mis/Miss/Mrs</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="mis" id="mis">

                    </div>

                  </div>



                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">First Name</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="first_name" id="first_name">

                    </div>

                  </div>



                 



                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Last Name</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="last_name" id="last_name">

                    </div>

                  </div>







                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Contact No</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="contact_no" id="contact_no">

                    </div>

                  </div>



                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Alternate No</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control " name="alternate_no" id="alternate_no">

                    </div>

                  </div>



                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label"> Email</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control " name="email" id="email">

                    </div>

                  </div>



                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Company Name</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="company_name" id="company_name">

                    </div>

                  </div>

                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Website url</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="website_url" id="website_url">

                    </div>

                  </div>

                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Address</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="address" id="address">

                    </div>

                  </div>



                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">City </label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="city" id="city">

                    </div>

                  </div>

               



                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">State</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="state" id="state">

                    </div>

                  </div>



                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Zip</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="zip" id="zip">

                    </div>

                  </div>





                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Sic Desc</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="sic_desc" id="sic_desc">

                    </div>

                  </div>

                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Sic Code</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="sic_code" id="sic_code">

                    </div>

                  </div>

                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Entity Type</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="entity_type" id="entity_type">



                    </div>

                  </div>



                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Company Sale</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="company_sale" id="company_sale">



                    </div>

                  </div>



                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Revenue</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="revenue" id="revenue">



                    </div>

                  </div>



                 





                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Country</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="country" id="country">

                    </div>

                  </div>

                  <!-- end  -->

                  <div class="row form-group">

                    <div class="col-sm-3">

                      <label class="col-form-label">Medical ins</label>

                    </div>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" name="medical_ins" id="medical_ins">

                    </div>

                  </div>

                  <!-- end  -->

                 

                  <!-- end  -->



                  <!-- end  -->

              

                  <!-- end  -->



                  <div class="row form-group">



                    <div class="col-sm-12">



                      <!-- <a    href="javascript:void(0)"    type="submit"  class="btn btn-primary">Submit</a>

                                                        <a href="javascript:void(0)"   type="btn"  onclick="save_for_query(2)" class="btn btn-success"   >Save for query</a>

                                                      -->

                      <input type="hidden" id="type" value="">

                      <button type="submit" id="submitbtn" onclick="save_resume1(1)" class="btn btn-primary">Submit</button>

                      <button type="submit" disabled id="save_for_query" onclick="save_for_query2(2)" class="btn btn-secondary">Save for query</button>

                      <button type="btn" id="editnow" onclick="edit_resumeform()" class="btn btn-success">Edit</button>

                      <button type="btn" id="updateresume" onclick="save_resume3()" class="btn btn-success">Update</button>

                    </div>

                  </div>

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