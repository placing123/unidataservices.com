<!-- [ breadcrumb ] start -->
<div class="page-header card">

<div class="row">
  <div class="col-12">
      <?php if($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong><?=$this->session->flashdata('success');?></strong> .
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php } ?>
    </div>
</div>


                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <!-- <i class="feather icon-home bg-c-blue"></i> -->
                            <div class="d-inline">
                                <h5>Complete Task </h5>
                           
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
            <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <!-- [ page content ] start -->
                                       
                                        <div class="row"   id="resume_section" >
                                           
                                           <div class="col-lg-12">
                                                <div class="card">
                                                
                                                  <div class="card-block">
                                                        <div class="card-header">
                                                         
                                                        </div>

                                                        <div class="row form-group">
                                                            <div class="col-sm-2">
                                                            <label class="col-form-label">Please note</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <p>
                                                                ONCE YOU SUBMIT TASK YOU WILL NOT ABLE TO EDIT  FORM   </p>
                                                            </div>
                                                            <div class="col-sm-4">
                                                            <?php 
                                                            
                                                            $customer_id = $this->session->userdata('customer_sess')['customer_id'];
                                                            $customerdata = $this->model->hdm_get_where('tbl_register', array('customer_id' => $customer_id));
                                                        
                                                            $submission_status = $customerdata[0]->submission_status;


                                                            if($submission_status ==0 || $submission_status ==2){ ?>
                                                             <a href="javascript:void(0)" class="btn btn-primary" onclick="submit_task()"   > SUBMIT TASK </a>
                                                           <?php   } else if($submission_status == 3) { ?>
                                                            <a href="javascript:void(0)" class="btn btn-primary"  disabled   > SUBMISSION PASSED </a>
                                                            <?php   } 
                                                             else if($submission_status ==4){ ?>
                                                              <a href="javascript:void(0)" class="btn btn-primary"  disabled >  TASK SUBMITED </a>
                                                             <?php } ?>
                                                            
                                                           
                                                               
                                                        </div>
                                                        </div>

                                                        <!--  -->

                                              
                                                  </div>
                                                </div>  
                                           </div>

                                        </div>
                                        <!-- [ page content ] end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>