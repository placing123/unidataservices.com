  <!-- [ breadcrumb ] start -->
  <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="feather icon-home bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Profile</h5>
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
                                            <li class="breadcrumb-item"><a href="#!">Profile</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->

                        <form  method="post"  id="edit_form"  action="<?php echo base_url().'update_customerdata'?>" >
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <!-- [ page content ] start -->
                                       
                                        <div class="row"   id="resume_section" >
                                           
                                           <div class="col-lg-12 col-xl-6">
                                                <div class="card">
                                                 
                                                  <div class="card-block">
                                                    <div class="card-header">
                                                     <h4>Personal Details</h5>
                                                   
                                                  </div>

                                                  <div class="row form-group">
                                                        <div class="col-sm-3">
                                                          <label class="col-form-label">ID</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <input  required     readonly  type="text" class="form-control" name="customer_id"  id="customer_id"    value="<?php echo $record[0]->customer_id;?>"   >
                                                        </div>
                                                      </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-3">
                                                          <label class="col-form-label">First Name</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <input   required  readonly type="text" class="form-control" name="name"  id="name"    value="<?php echo $record[0]->name;?>"   >
                                                        </div>
                                                      </div>

                                                      <div class="row form-group">
                                                        <div class="col-sm-3">
                                                          <label class="col-form-label">Mobile</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <input   required readonly type="text" class="form-control" name="mobile"  id="mobile"   value="<?php echo $record[0]->mobile;?>">
                                                        </div>
                                                      </div>

                                                      <div class="row form-group">
                                                        <div class="col-sm-3">
                                                          <label class="col-form-label"> Email</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <input  required readonly  type="text" class="form-control" name="email"  id="email"   value="<?php echo $record[0]->email;?>">
                                                        </div>
                                                      </div>
                                                      <div class="row form-group">
                                                        <div class="col-sm-3">
                                                          <label class="col-form-label">Address</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <input   required readonly type="text" class="form-control" name="address"  id="address"   value="<?php echo $record[0]->address;?>">
                                                        </div>
                                                      </div>
                                                   
                                                    <!--  <div class="row form-group">
                                                        <div class="col-sm-3">
                                                          <label class="col-form-label"> New Password</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <input  required   type="password" class="form-control" name="password" id="decpassword" placeholder="new password"  value="<?php echo $record[0]->decpassword;?>">
                                                        </div>
                                                      </div> -->
                                   

                                                  <div class="row form-group">
                                                        <div class="col-sm-3">
                                                          <label class="col-form-label">Account Holder Name</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <input type="text" class="form-control" name="holder_name"  id="holder_name"    value="<?php echo $record[0]->holder_name;?>"   >
                                                        </div>
                                                      </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-3">
                                                          <label class="col-form-label">Account Number</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <input     type="text" class="form-control" name="ac_no"  id="ac_no"    value="<?php echo $record[0]->ac_no;?>"   >
                                                        </div>
                                                      </div>

                                                      <div class="row form-group">
                                                        <div class="col-sm-3">
                                                          <label class="col-form-label">IFSC Code</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                          <input    type="text" class="form-control" name="ifsc_code"  id="ifsc_code"   value="<?php echo $record[0]->ifsc_code;?>">
                                                        </div>
                                                      </div>
                                                      <!-- end  -->

                                                      <div class="row form-group">
                                                       
                                                       <div class="col-sm-12">
                                                       <button type="submit"  class="btn btn-primary">Update</button>
                                                    
                                                       </div> 
                                                     </div>  

                                                      <!-- end  -->
                                                  </div>
                                                </div>  
                                           </div>

                                           <div class="col-lg-12 col-xl-6">

                                           <div class="card">
                                                 
                                                 <div class="card-block">
                                                    <div class="card-header">
                                                      <h4>Company Details</h5>
                                                    </div>

                                                  
                                                    <table>
                                                      <tbody>  
                                                        <tr>
                                                          <td>  company care No  : </td>
                                                          <td> <?php echo $master_data[0]->care_no;?> </td>
                                                        </tr>
                                                        <tr>
                                                          <td>  company Email</td>
                                                          <td> <?php echo $master_data[0]->care_eml;?> </td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </div>


                                           </div>


                                        </div>
                                        <!-- [ page content ] end -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
     