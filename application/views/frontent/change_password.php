<div class="page-header card"     >

<div class="row">
  <div class="col-12">
      <?php if($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong><?=$this->session->flashdata('success');?></strong> .
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php } ?>
    </div>
</div>

        

          <div class="card-body">

            <div class="row">

             
                

                <div class="form-group col-5">

                <label for="last_name">Change Password</label>

                <input id="" type="password" class="form-control" name="password" value=""  placeholder="new password"  >
                <input id="id" type="hidden" class="form-control" name="id" value="<?php echo $rec[0]->id;?>">

                </div>

          </div>
           <input type="submit" class="btn btn-primary" value="Submit" >

         </div>

           <?=form_close();?>

       

        </div>

      

 