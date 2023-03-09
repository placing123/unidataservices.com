  <!-- [ breadcrumb ] start -->
  <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="feather icon-home bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Resume Task</h5>
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
                                            <li class="breadcrumb-item"><a href="#!">resumetask</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->

                        <form  method="post"   action="<?php echo base_url().'store-query'?>" >
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <!-- [ page content ] start -->
                                        <div class="row">
                                        <div class="col-lg-12 col-xl-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                      <h5>Query</h5>
                                                      </div>
                                                        <div class="card-block">

                                                        <div class="row form-group">
                                                                <div class="col-sm-3">
                                                                <label class="col-form-label">Select Field
                                                                <?php 
                                                                // print_r($record);
                                                                
                                                                ?>
                                                                </label>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <select  id="name" name="name" class="form-control"   onchange="check_pendingrequestexit(this.value)"  >
                                                                    <option value=""> select</option>
                                                                <?php 
                                                                    $i=0;
                                                                    foreach($record as $r){ $i++; ?>
                                                                    <option value="<?php echo $r->id;?>"><?php echo $r->name;?> </option>

                                                                    <?php  }  ?>

                                                                    </select>
                                                                    <input type="hidden"  id="query_id" name="query_id" value="<?php echo $this->uri->segment(2);?>">
                                                                </div>
                                                           </div>

                                                           <div class="row form-group">
                                                                <div class="col-sm-3">
                                                                    <label class="col-form-label">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                     <input type="submit"   id="add_query" class="btn btn-primary" value="submit"  >
                                                                </div>
                                                           </div>

                                                        </div>  
                                                    </div>
                                                 </div>  
                                           </div>
                                            </div>
                                       
                                        <!-- [ page content ] end -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>


        