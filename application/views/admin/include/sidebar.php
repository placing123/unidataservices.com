<?php 

$master_data = $this->model->hdm_get('tbl_master');

   $customer_care_no = $master_data[0]->care_no;
   $care_eml = $master_data[0]->care_eml;
   $care_add = $master_data[0]->address;
   $company_name = $master_data[0]->name;


   $logo = base_url().$master_data[0]->logo;
   $seal = base_url().$master_data[0]->seal;


?>

<div class="main-sidebar sidebar-style-2">

 <input type="hidden"  id="base_url"  value="<?php echo base_url();?>">


 
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">

          <img alt="image" src="<?= $logo;?>"    style="width:50px"   class="user-img"> <span class="d-sm-none d-lg-inline-block"></span></a>

  
        </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header"><?php    echo $this->session->userdata('admin_sess')['name'];   ?> </li>
            <li class="dropdown <?=($this->uri->segment(1)=='admin-dashboard')?'active':'';?>">
              <a href="<?=base_url();?>admin-dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
		      	<!-- <li class="dropdown <?=($this->uri->segment(1)=='student-list-show')?'active':'';?>">
              <a href="<?=base_url();?>student-list-show" class="nav-link"><i data-feather="users"></i><span>Student List</span></a>
            </li> -->

            <!-- <li class="dropdown <?=($this->uri->segment(1)=='new-resume')?'active':'';?>">
              <a href="<?=base_url();?>new-resume" class="nav-link"><i data-feather="users"></i><span>New Resume</span></a>
            </li>

             <li class="dropdown <?=($this->uri->segment(1)=='resume_create')?'active':'';?>">
              <a href="<?=base_url();?>resume_create" class="nav-link"><i data-feather="users"></i><span>Resume Create</span></a>
            </li>-->

            
            <li class="dropdown <?=($this->uri->segment(1)=='register-list')?'active':'';?>">
              <a href="<?=base_url();?>register-list" class="nav-link"><i data-feather="users"></i><span>Register</span></a>
            </li>

            <li class="dropdown <?=($this->uri->segment(1)=='franchise-list')?'active':'';?>">
              <a href="<?=base_url();?>franchise-list" class="nav-link"><i data-feather="users"></i><span>Franchise</span></a>
            </li>

            <li class="dropdown <?=($this->uri->segment(1)=='caller_list')?'active':'';?>">
              <a href="<?=base_url();?>caller_list" class="nav-link"><i data-feather="users"></i><span>Caller</span></a>
            </li>


            <li class="dropdown"> 
            <a href="<?=base_url('admin_assets');?>#" data-toggle="dropdown"

              class="nav-link dropdown-toggle nav-link-lg nav-link-user">   <i data-feather="users"></i> 
            <span class="d-sm-none d-lg-inline-block">caller  Report</span>      </a>

            <div class="dropdown-menu dropdown-menu-right ">
              <a href="<?=base_url('caller_report');?>" class="dropdown-item has-icon "> 
              Caller Day Report
              </a>

              <a href="<?=base_url('caller_month_report');?>" class="dropdown-item has-icon"> 
              Caller Month Report
              </a>

            </div>

          </li>

            <li class="dropdown <?=($this->uri->segment(1)=='plan-list')?'active':'';?>">
              <a href="<?=base_url();?>plan-list" class="nav-link"><i data-feather="users"></i><span>Plan</span></a>
            </li>


            <li class="dropdown <?=($this->uri->segment(1)=='activate_listing')?'active':'';?>">
              <a href="<?=base_url();?>activate_listing" class="nav-link"><i data-feather="users"></i><span>Sign Agreement</span></a>
            </li>
            <li class="dropdown <?=($this->uri->segment(1)=='search')?'active':'';?>">
              <a href="<?=base_url();?>search" class="nav-link"><i data-feather="users"></i><span>Activate</span></a>
            </li>

            <li class="dropdown <?=($this->uri->segment(1)=='activate_list')?'active':'';?>">
              <a href="<?=base_url();?>activate_list" class="nav-link"><i data-feather="users"></i><span>Activate list</span></a>
            </li>

            <li class="dropdown <?=($this->uri->segment(1)=='help-request')?'active':'';?>">
              <a href="<?=base_url();?>help-request" class="nav-link"><i data-feather="users"></i><span>Help Reuqest</span></a>
            </li>

            <li class="dropdown <?=($this->uri->segment(1)=='date-extent')?'active':'';?>">
              <a href="<?=base_url();?>date-extent" class="nav-link"><i data-feather="users"></i><span>Date Extend</span></a>
            </li>
            <li class="dropdown <?=($this->uri->segment(1)=='customer_qc')?'active':'';?>">
              <a href="<?=base_url();?>customer_qc" class="nav-link"><i data-feather="users"></i><span>Qc</span></a>
            </li>

      
            <li class="dropdown <?=($this->uri->segment(1)=='reminder_mail')?'active':'';?>">
              <a href="<?=base_url();?>reminder_mail" class="nav-link"><i data-feather="users"></i><span>Reminder mail</span></a>
            </li>

            <!-- <li class="dropdown <?=($this->uri->segment(1)=='resend_mail')?'active':'';?>">
              <a href="<?=base_url();?>resend_mail" class="nav-link"><i data-feather="users"></i><span>Resend mail</span></a>
            </li> -->
            <li class="dropdown <?=($this->uri->segment(1)=='noc_mail')?'active':'';?>">
              <a href="<?=base_url();?>noc_mail" class="nav-link"><i data-feather="users"></i><span>Noc</span></a>
            </li>
            <li class="dropdown <?=($this->uri->segment(1)=='submission_notsubmit')?'active':'';?>">
              <a href="<?=base_url();?>submission_notsubmit" class="nav-link"><i data-feather="users"></i><span>Not submitted list</span></a>
            </li>
            <li class="dropdown <?=($this->uri->segment(1)=='submission_fail')?'active':'';?>">
              <a href="<?=base_url();?>submission_fail" class="nav-link"><i data-feather="users"></i><span>Submission Fail list</span></a>
            </li>
            <li class="dropdown <?=($this->uri->segment(1)=='submission_pass')?'active':'';?>">
              <a href="<?=base_url();?>submission_pass" class="nav-link"><i data-feather="users"></i><span>Submission pass</span></a>
            </li>
          
            <li class="dropdown <?=($this->uri->segment(1)=='customer-action')?'active':'';?>">
              <a href="<?=base_url();?>customer-action" class="nav-link"><i data-feather="users"></i><span> Customer action </span></a>
            </li>

            <li class="dropdown <?=($this->uri->segment(1)=='customer-log')?'active':'';?>">
              <a href="<?=base_url();?>customer-log" class="nav-link"><i data-feather="users"></i><span> Customer Log </span></a>
            </li>

           
           

            <li class="dropdown <?=($this->uri->segment(1)=='work_space')?'active':'';?>">
              <a href="<?=base_url();?>work_space" class="nav-link"><i data-feather="users"></i><span>Work space</span></a>
            </li>

        

          <?php  
                    
                    $rid = $this->session->userdata('admin_sess')['role_id'];
                    $pid = '27';
                    $where = array('role_id'=>$rid,'permission_id'=>$pid,'view_per'=>'1');
                    $check_approve = $this->model->hdm_get_where_count('permission_role',$where);
                    if($check_approve > 0){ ?>

                        <li class="dropdown"> 
                                    <a href="<?=base_url('admin_assets');?>#" data-toggle="dropdown"

                                      class="nav-link dropdown-toggle nav-link-lg nav-link-user">   <i data-feather="users"></i> 
                                    <span class="d-sm-none d-lg-inline-block">Role</span>      </a>

                                    <div class="dropdown-menu dropdown-menu-right ">
                                      <a href="<?=base_url('add-role');?>" class="dropdown-item has-icon "> 
                                    Add Role
                                      </a>
                                      <a href="<?=base_url('role_manage');?>" class="dropdown-item has-icon"> 
                                      Role manage
                                      </a>

                                    </div>

                                  </li>


               <?php } ?>



           


          <?php  
                    
                    $rid = $this->session->userdata('admin_sess')['role_id'];
                    $pid = '24';
                    $where = array('role_id'=>$rid,'permission_id'=>$pid,'view_per'=>'1');
                    $check_approve = $this->model->hdm_get_where_count('permission_role',$where);
                    if($check_approve > 0){ ?>

                    <li class="dropdown <?=($this->uri->segment(1)=='master_setting')?'active':'';?>">
                    <a href="<?=base_url();?>master_setting" class="nav-link"><i data-feather="users"></i><span>Master setting</span></a>
                  </li>


               <?php } ?>
                  


          

            <li class="dropdown <?=($this->uri->segment(1)=='change_password')?'active':'';?>">
              <a href="<?=base_url();?>change_password" class="nav-link"><i data-feather="users"></i><span>Change Password</span></a>
            </li>
          </ul>
        </aside>
      </div>
     