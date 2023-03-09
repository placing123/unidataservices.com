<div class="main-content">

<section class="section">

  <div class="section-body">

    <div class="row">

      <div class="col-12 col-md-12 col-lg-12">

           <?php if($this->session->flashdata('success')) { ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">

              <strong>Success!</strong> <?=$this->session->flashdata('success');?>

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

            <h4>User Registration</h4>

            <a href="<?=base_url('register-list');?>" class="btn btn-warning" style="position:absolute;right:10px">List</a>

          </div>

          <style>.error{color:red}</style>

          <?=validation_errors();?>

          <?=form_open_multipart($action);?>

          <div class="card-body">

            <div class="row">

             
              

                <div class="form-group col-5">
                 <label for="name"> Name:</label>
                 <input id="name" type="text" class="form-control" name="name" value=""   required   >
                </div>

                  <div class="form-group col-5">

                  <label for="mobile ">Mobile </label>

                  <input id="mobile" type="text" class="form-control" name="mobile" value=""   onkeyup="check_mobile()"    required >

                  </div>
                  <div class="form-group col-5">
                    <label for="email">Email </label>
                    <input id="email" type="text" class="form-control" name="email" value=""   onkeyup="check_email()"    required >

                    </div>
                    <div class="form-group col-5">
                    <label for="address">Address</label>
                    <input id="address" type="text" class="form-control" name="address" value="" required >
                    </div>

                    <div class="form-group col-5">
                    <label for="last_name">Plan</label>
                            <select name="plan_id" id="plan_id"  class="form-control"  required  >
                                <option value="" >Select</option>
                                <?php foreach($plan_rec as $r) : ?>
                                <option value="<?php echo  $r->id;?>" ><?php echo  $r->plan_name;?></option>
                                <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group col-5">
                    <label for="last_name">Agreement</label> 
                            <select name="agreement_id" id="agreement_id"  class="form-control"  required >
                                <option value="" >Select</option>
                                <?php foreach($agreement_rec as $r) : ?>
                                <option value="<?php echo  $r->id;?>" ><?php echo  $r->agreement;?></option>
                                <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group col-5">
                    <label for="last_name">Franchise</label>
                            <select name="franchise_id" id="franchise_id"  class="form-control" required  onchange="get_callers(this.value)"  >
                                <option value="" >Select</option>
                                <?php foreach($franchise_rec as $r) : ?>
                                <option value="<?php echo  $r->id;?>" ><?php echo  $r->franchise_name;?></option>
                                <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group col-5">
                    <label for="last_name">Caller</label>
                            <select name="caller_id" id="caller_id"  class="form-control"  required  >
                            </select>
                    </div>

                    <div class="form-group col-5">
                                    <label for="days">Aadhar Card </label>
                                    <input type="file" class="form-control" name="aadharcard"  required >
                                  
                      </div>
                      <div class="form-group col-5">
                                    <label for="days">Pan Card </label>
                                    <input type="file" class="form-control" name="pancard" required >
                                  
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

<script>

function get_callers(franchise_id){
 

var base_url = $("#base_url").val();

  $.ajax({
     url:base_url+'/get_callers',
     method: 'post',
     data: {franchise_id:franchise_id},
     dataType: 'json',
     success: function(response){
       //console.log(response.data);
       $("#caller_id").empty();
       $("#caller_id").append(response.data);
     }
  });


}



function check_mobile(){

  var checktype =1;
  var base_url = $("#base_url").val();
  var value = $("#mobile").val();

  $.ajax({
     url:base_url+'/check_dataexit',
     method: 'post',
     data: {checktype:checktype,value:value},
     dataType: 'json',
     success: function(response){
       
       if(response.status =='1'){
          alert('already exit');
          $(':input[type="submit"]').prop('disabled', true);
       } else {
        $(':input[type="submit"]').prop('disabled', false);
       }
      
     }
  });
}



function check_email(){

var checktype =2;
var base_url = $("#base_url").val();
var value = $("#email").val();

$.ajax({
   url:base_url+'/check_dataexit',
   method: 'post',
   data: {checktype:checktype,value:value},
   dataType: 'json',
   success: function(response){
     
     if(response.status =='1'){
        alert('already exit');
        $(':input[type="submit"]').prop('disabled', true);
     } else {
      $(':input[type="submit"]').prop('disabled', false);
     }
    
   }
});
}



</script>