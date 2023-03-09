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

            <h4><?php echo $title;?></h4>

            <?php  
                    
                    $rid = $this->session->userdata('admin_sess')['role_id'];
                    $pid = '27';
                    $where = array('role_id'=>$rid,'permission_id'=>$pid,'view_per'=>'1');
                    $check_approve = $this->model->hdm_get_where_count('permission_role',$where);
                    if($check_approve > 0){ ?>
                       <a href="<?=base_url('role-list');?>" class="btn btn-warning" style="position:absolute;right:10px">List</a>

                    <?php } ?>

          
          </div>

          <style>.error{color:red}</style>

          <?=validation_errors();?>

          <?=form_open_multipart($action);?>

          <div class="card-body">

            <div class="row">

             
              

                <div class="form-group col-5">
                 <label for="name">Name:</label>
                 <input required  id="name" type="text" class="form-control" name="name" value="">
                </div>

                <div class="form-group col-5">
                 <label for="email">email:</label>
                 <input required  id="email" type="text" class="form-control" name="email" value="">
                </div>

                <div class="form-group col-5">
                 <label for="password">password:</label>
                 <input required  id="password" type="text" class="form-control" name="password" value="">
                </div>

            </div>
                <input type="submit" name="btn" class="btn btn-primary" value="Submit" >

         </div>

           <?=form_close();?>
        </div>

      </div>

    </div>

  </div>

</section>



</div>