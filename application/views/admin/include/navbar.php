<?php 

$master_data = $this->model->hdm_get('tbl_master');

   $customer_care_no = $master_data[0]->care_no;
   $care_eml = $master_data[0]->care_eml;
   $care_add = $master_data[0]->address;
   $company_name = $master_data[0]->name;


   $logo = base_url().$master_data[0]->logo;
   $seal = base_url().$master_data[0]->seal;


?>


<nav class="navbar navbar-expand-lg main-navbar sticky">

        <div class="form-inline mr-auto">

          <ul class="navbar-nav mr-3">

            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg

									collapse-btn"> <i data-feather="align-justify"></i></a></li>

                 <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">

                <i data-feather="maximize"></i>

              </a></li>

            <li>

              <form class="form-inline mr-auto">

                <div class="search-element">

                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">

                  <button class="btn" type="submit">

                    <i class="fas fa-search"></i>

                  </button>

                </div>

              </form>

            </li>

          </ul>

        </div>

        <ul class="navbar-nav navbar-right">

          <li class="dropdown">
            <a href="<?=base_url('admin_assets');?>#" data-toggle="dropdown"

              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> 
              <img alt="image" src="<?= $logo;?>"  class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>

            <div class="dropdown-menu dropdown-menu-right pullDown">

              <div class="dropdown-title">Hello <?=$this->session->userdata('admin_sess')['name'];?></div>

              <div class="dropdown-divider"></div>

              <a href="<?=base_url('secure-logout');?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>

                Logout

              </a>

            </div>

          </li>

        </ul>

      </nav>