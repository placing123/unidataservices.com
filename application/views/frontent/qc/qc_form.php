 <!-- [ breadcrumb ] start -->
 <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="feather icon-inbox bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>QC </h5>
                                                   </div>
                                                    <div style="background-color:red;text-align:center;">
                                                        Your QC Fail 80% Not Achieve
                                                    </div>
                                    </div>
                                </div>
                          
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Zero config.table start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <!-- <h5>Zero Configuration</h5> -->
                                                             </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="simpletable" class="table table-striped table-bordered ">
                                                                <thead>
                                                                    <tr>
                                                                        <th>SR.no</th>
                                                                        <th>Form No</th>
                                                                        <th>View Resume </th>
                                                                       
                                                                      
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php  $i=0;
                                                                    foreach($records as $r){ $i++; ?>
                                                                      <tr>
                                                                      <td><?php echo $i?></td>
                                                                      <td><?php
                                                                      
                                                                      echo $resume_id = $this->model->get_resumeidbyformid($r->form_id);
                                                                      ?></td>
                                                                      <td><a href="<?php echo base_url().'edit-qc-resume/'.$r->form_id;?>"> View</a></td>
                                                              
                                                                    </tr>

                                                                   <?php  } ?>
                                                                  
                                                                   
                                                                  
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>SR.no</th>
                                                                        <th>Form ID</th>
                                                                        <th>Edit Task </th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Zero config.table end -->
                                                <!-- Default ordering table start -->
                                                   
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                            <div id="styleSelector">

                            </div>
                        </div>