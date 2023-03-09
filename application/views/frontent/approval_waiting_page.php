<!-- [ breadcrumb ] start -->
<div class="page-header card"     >

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
                                <h5>Please Wait  For Admin Approval  </h5>
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
                                <li class="breadcrumb-item"><a href="#!">Agreement</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="page-body">
                            <!-- [ page content ] start -->
                            <div class="row">

                                <!-- sale revenue card start -->
                            
                                <!-- sale revenue card end -->

                                <!-- Project statustic start -->
                                <div class="col-xl-12">
                                    <div class="card proj-progress-card">
                                        <div class="card-block">
                                            <div class="row">
                                                <h1 id="timer" ></h1>  
                                            </div>
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


         