<nav class="pcoded-navbar">
                        <div class="nav-list">
                            <div class="pcoded-inner-navbar main-menu">
                                <div class="pcoded-navigation-label">Navigation</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="">
                                        <a href="<? echo base_url().'home'; ?>" class="waves-effect waves-dark">
            								<span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                            <span class="pcoded-mtext">Dashboard</span>
                                        </a>
                                    </li>

                                    <li class="">
                                          <a href="<? echo base_url().'resumetask'; ?>" class="waves-effect waves-dark">
          									<span class="pcoded-micon">
          										<i class="feather icon-menu"></i>
          									</span>
                                              <span class="pcoded-mtext">Data Entry</span>
                                          </a>
                                      </li>
                                      <li class="">
                                          <a href="<? echo base_url().'query-list'; ?>" class="waves-effect waves-dark">
          									<span class="pcoded-micon">
          										<i class="feather icon-menu"></i>
          									</span>
                                              <span class="pcoded-mtext">Query Task(HELP LINE) </span>
                                          </a>
                                      </li>
                                      <li class="">
                                          <a href="<? echo base_url().'terms_con'; ?>" class="waves-effect waves-dark">
          									<span class="pcoded-micon">
          										<i class="feather icon-menu"></i>
          									</span>
                                              <span class="pcoded-mtext">Terms and Guidelines</span>
                                          </a>
                                      </li>
                                      <li class="">
                                          <a href="<? echo base_url().'edit_profile'; ?>" class="waves-effect waves-dark">
          									<span class="pcoded-micon">
          										<i class="feather icon-menu"></i>
          									</span>
                                              <span class="pcoded-mtext"> My Profile</span>
                                          </a>
                                      </li>

                                      <?php 

                                        $customer_id = $this->session->userdata('customer_sess')['customer_id'];
                                        $customerdata = $this->model->hdm_get_where('tbl_register', array('customer_id' => $customer_id));
                                        $planId = $customerdata[0]->plan_id;
                                        $total_customer_form =  $this->model->hdm_get_where_count('tbl_form', array('customer_id' => $customer_id, 'submit_at!=' => ''));
                                        $plan_data = $this->model->hdm_get_where('tbl_plan', array('id' => $planId));
                                        $forms = $plan_data[0]->forms;

                                        if ($forms == $total_customer_form && $customerdata[0]->submission_status == '0' ) {
                                           ?>
                                            <li class="">
                                            <a href="<? echo base_url().'complete_task'; ?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon">
                                                    <i class="feather icon-menu"></i>
                                                </span>
                                                <span class="pcoded-mtext"> Complete Task</span>
                                            </a>
                                        </li>
                                        <?php  }   ?>
                                     
                                      <!-- <li class=""  >
                                          <a href="<? echo base_url().'qc_result'; ?>" class="waves-effect waves-dark">
          									<span class="pcoded-micon">
          										<i class="feather icon-menu"></i>
          									</span>
                                              <span class="pcoded-mtext"> QC Result</span>
                                          </a>
                                      </li>-->

                                      <!-- <li class="">
                                          <a href="<? echo base_url().'home'; ?>" class="waves-effect waves-dark">
          									<span class="pcoded-micon">
          										<i class="feather icon-menu"></i>
          									</span>
                                              <span class="pcoded-mtext"> Change Password</span>
                                          </a>
                                      </li> -->
                                     </ul>
                               </div>
                        </div>
                    </nav>