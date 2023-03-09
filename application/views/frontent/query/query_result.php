 <!-- [ breadcrumb ] start -->
 <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="feather icon-inbox bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Query Result</h5>
                                         
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="../index.html"><i class="feather icon-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Bootstrap Table</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="#!">Basic Initialization</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">

                                    <!-- start acc -->

                                    <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Pending Request 
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
      <div class="dt-responsive table-responsive">
                                                            <table id="simpletable" class="table table-striped table-bordered ">
                                                                <thead>
                                                                    <tr>
                                                                        <th>SR.no</th>
                                                                        <th>Reg ID</th>
                                                                        <th>Field name </th>
                                                                      
                                                                      
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php  $i=0;
                                                                    foreach($pending_records as $r){ $i++; ?>
                                                                      <tr>
                                                                      <td><?php echo $i?></td>
                                                                      <td><?php echo $r->customer_id; ?></td>
                                                                      <td>    <?php echo $this->model->get_fieldname($r->qry_field);   ?></td>
                                                                        
                                                                    </tr>

                                                                   <?php  } ?>
                                                                  
                                                                   
                                                                  
                                                                </tbody>
                                                              
                                                            </table>
                                                        </div></div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         Approve Request 
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
      <div class="dt-responsive table-responsive">
                                                            <table id="simpletable2" class="table table-striped table-bordered ">
                                                                <thead>
                                                                    <tr>
                                                                    <th>SR.no</th>
                                                                        <th>Reg ID</th>
                                                                        <th>Field name </th>
                                                                        <th>Field Value </th>
                                                                      
                                                                      
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php  $i=0;
                                                                    foreach($approve_records as $r){ $i++; ?>
                                                                    <tr>
                                                                        <td><?php echo $i?></td>
                                                                        <td><?php echo $r->customer_id; ?></td>
                                                                        <td>    <?php echo $this->model->get_fieldname($r->qry_field);   ?></td>
                                                                        <td><?php echo $r->value; ?></td>
                                                                    </tr>

                                                                   <?php  } ?>
                                                                     
                                                                </tbody>
                                                               
                                                            </table>
                                                        </div> </div>
    </div>
  </div>

</div>
                                    <!-- end  -->
                                    
                                      
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                            <div id="styleSelector">

                            </div>
                        </div>



  