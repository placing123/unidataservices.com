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

            <h4>Role Manage</h4>

      
          </div>

          <style>.error{color:red}</style>

          <?=validation_errors();?>

          <?=form_open_multipart($action);?>

          <div class="card-body">

            <div class="row">

            <div class="form-group col-5">
            <label for="last_name">Role</label>
            <select name="role_id" id="role_id"  class="form-control"   onchange="check_permission()"    >
                <option value="" >Select</option>

                <?php foreach($roles as $r) : ?>
                          <option value="<?php echo  $r->id;?>" ><?php echo  $r->username;?></option>
                 <?php endforeach;?>
            </select>
            </div>




            
            <!--  -->

           
            <?php foreach($permissions as $r) : ?>
                <div class="form-group col-5">
                <label for="last_name"><?php echo  $r->name;?></label>
                        <div class="row">
                            <div class="col">
                         
                                    <label class="checkbox">
                                    <input   id="add"  type="checkbox"   name="add_<?php echo $r->id?>"  value="1"/>
                                    Add
                                    </label>
                                    <label class="checkbox">
                                    <input   id="edit"   type="checkbox" name="edit_<?php echo $r->id?>"   value="1"/>
                                    Edit
                                    </label>
                           
                                    <label class="checkbox">
                                    <input     id="remove"   type="checkbox" name="remove_<?php echo  $r->id?>"   value="1"/>
                                   Remove
                                    </label>
                                    <label class="checkbox">
                                    <input    id="view"   type="checkbox"  name="view_<?php echo $r->id?>"  value="1"/>
                                   View
                                    </label>
                            

                            </div>
                        </div>


                </div>
                 <?php endforeach;?>
           
         

             
              
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