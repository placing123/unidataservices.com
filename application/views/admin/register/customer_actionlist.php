<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
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
                    <h4>Customer Action</h4>
                    <a href="javascript:void(0)"  onclick="deactivate_customers()"  class="btn btn-warning" style="position:absolute;right:100px">Deactivate</a>

                    <a href="javascript:void(0)"  onclick="delete_customers()"  class="btn btn-warning" style="position:absolute;right:10px">Delete</a>
                

                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                          
                            <th></th>
                            <th>customerID</th>
                            <th>Password</th>
                            <th> name</th>
                            <th>mobile </th>
                            <th>email </th>
                            <th>address</th>
                            <th>Plan</th>
                            <th>franchise</th>
                            <th>Caller</th>
                            <th>Activate Date</th>
                            <th>Register date</th>
                            <th>End date</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $sr=0; foreach($rec as $r) : $sr++;?>
                          <tr>
                         
                            <td>
                                <input type="checkbox" class="form-check-input" id="reg_<?php echo $r->reg_id?>"  value="<?php echo $r->reg_id?>"   name="reg_id[]"  >
                                <label class="form-check-label"  for="reg_<?php echo $r->id?>"></label>
                            </td>
                            <td><?php echo $r->customer_id;?></td>
                            <td><?php echo $r->decpassword;?></td>
                            <td><?php echo $r->name;?></td>
                            <td><?php echo $r->mobile;?></td>
                            <td><?php echo $r->email;?></td>
                            <td><?php echo $r->address;?></td>
                            <td><?php echo $r->plan_name;?></td>
                            <td><?php echo $r->franchise_name;?></td>
                            <td><?php echo $r->caller_name;?></td>
                            <td><?php echo $r->activate_date;?></td>
                            <td><?php echo $r->create_at;?></td>
                            <td><?php echo $r->end_date;?></td>
                        
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      
      </div>
      
 

<script>


function delete_customers(){

  var base_url = $("#base_url").val(); 

  swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
           $("input:checkbox[name='reg_id[]']:checked").each(function () {
              var id = $(this).val();
                    $.ajax({
                          url:base_url+'/delete_customers',
                          method: 'post',
                          data: {id:id},
                          dataType: 'json',
                          success: function(){
                              console.log('delete');
                             
                          }
                      });
              });
              location.reload();

  } else {
    swal("Your imaginary file is safe!");
  }
});
  
}




function deactivate_customers(){

  
  var base_url = $("#base_url").val(); 

  swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
        $("input:checkbox[name='reg_id[]']:checked").each(function () {
              var id = $(this).val();
                    $.ajax({
                          url:base_url+'/deactivate_customers',
                          method: 'post',
                          data: {id:id},
                          dataType: 'json',
                          success: function(){
                            
                          }
                      });
              });

              console.log('delete');
              location.reload();
  } else {
    swal("Your imaginary file is safe!");
  }
});

}

</script>
