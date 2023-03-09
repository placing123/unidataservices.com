 <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                   <?php if($this->session->flashdata('success')) { ?>
        			<div class="alert alert-success alert-dismissible fade show" role="alert">
        			  <strong>Success!</strong> <?=$this->session->flashdata('success');?>.
        			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        				<span aria-hidden="true">&times;</span>
        			  </button>
        			</div>
        		  <?php } ?>
        		  <?php if($this->session->flashdata('error')) { ?>
        			<div class="alert alert-danger alert-dismissible fade show" role="alert">
        			  <strong>Error!</strong> <?=$this->session->flashdata('error');?>.
        			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        				<span aria-hidden="true">&times;</span>
        			  </button>
        			</div>
        		  <?php } ?>
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Students</h4>
                    <a href="<?=base_url('student-list-show');?>" class="btn btn-warning" style="position:absolute;right:10px">Show Student List</a>
                  </div>
				  <style>.error{color:red}</style>
				  <?=validation_errors();?>
                  <?=form_open_multipart($action);?>
                  <div class="card-body">
                    <div class="row">
                    <div class="form-group col-4">
                      <label for="frist_name">Roll No</label>
                      <input id="rollno" type="text" class="form-control" name="rollno" autofocus value="<?=$rec[0]->stud_roll_no;?>" >
                    </div>
                    <div class="form-group col-8">
                      <label for="last_name">Name</label>
                      <input id="name" type="text" class="form-control" name="name" value="<?=$rec[0]->stud_name;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="<?=$rec[0]->stud_email;?>">
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-4">
                      <label for="frist_name">Standard</label>
                      <input id="standard" type="text" class="form-control" name="standard" autofocus value="<?=$rec[0]->stud_std;?>">
                    </div>
                    <div class="form-group col-4">
                      <label for="last_name">Mobile No</label>
                      <input id="mobile" type="text" class="form-control" name="mobile" pattern="[6-9]{1}[0-9]{9}" title="Please Enter Valid Format Mobile Number" required value="<?=$rec[0]->stud_mobile;?>">
                    </div>
					<div class="form-group col-4">
                      <label for="last_name">Photo</label>
                      <input id="pic" type="file" class="form-control mb-2" name="pic" accept="image/*">
					  <?=$rec[0]->stud_pic;?>
                    </div>
                  </div>
                   <input type="submit" name="btn" class="btn btn-primary" value="Update" >
                 </div>
                   <?=form_close();?>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>