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

            <h4>Date Extend</h4>

        
          </div>

          <style>.error{color:red}</style>

          <?=validation_errors();?>

          <?=form_open_multipart($action);?>

          <div class="card-body">

            <div class="row">

             
                <div class="form-group col-5">

                  <label for="last_name">CustomerID</label>

                  <input id="customerID" type="text" class="form-control"  onkeyup="get_last_date()" name="customerID"  >

                </div>

                <div class="form-group col-5">

                    <label for="last_name">Current End Date</label>

                    <input id="lastdate"  readonly  type="text" class="form-control"   placeholder="Current End Date" value="">

                </div>
                <div class="form-group col-5">

                <label for="last_name">New End  Date</label>

                <input id="end_date"  type="date" class="form-control"   name="end_date"  placeholder=""  >
                     <input id="time"  type="time" class="form-control"   name="time"  placeholder=""  >

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

function get_last_date(){
   
    var base_url = $("#base_url").val();
    var customerID = $("#customerID").val();

  $.ajax({
     url:base_url+'/get_last_date',
     method: 'post',
     data: {customerID:customerID},
     dataType: 'json',
     success: function(response){
        
        $("#lastdate").val(response.expdate);
      
     }
  });

}


</script>