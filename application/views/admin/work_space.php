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

            <h4>Work space</h4>

        
          </div>

          <style>.error{color:red}</style>

          <?=validation_errors();?>

          <?=form_open_multipart($action);?>

          <div class="card-body">
                <div class="row">
                        <div class="form-group col-3">
                            <label for="last_name">customer ID</label>
                            <input id="customer_id" type="text" class="form-control" name="customer_id" value="">
                        </div>
                        <div class="form-group col-3">
                            <label for="last_name">Name</label>
                            <input id="customer_id" type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group col-3">
                            <label for="last_name">Email</label>
                            <input id="customer_id" type="text" class="form-control" name="email" value="">
                        </div>

                        <div class="form-group col-3">
                            <label for="last_name"></label>
                                <input type="submit" name="btn" class="btn btn-primary" value="Submit" >
                            </div>
                        </div>
                </div>
         </div>

           <?=form_close();?>


      </div>

    </div>


    <div class="card">

<div class="card-header">
  <h4>Work space Details/Report</h4>
</div>
<div class="card-body">
      <div class="row">
      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
            <thead>
                      <tr>
                          <th>Customer ID</th>
                          <th>Name</th>
                          <th>Password</th>
                          <th>Number</th>
                          <th>EmailId</th>
                          <th>create at</th>
                          <th>Status</th>
                      </tr>
            </thead>
                      <tbody>
                          <tr>
                            <?php 

                          
                              if(!empty($rec)){ ?>
                              <td><?php echo $customer_id= $rec[0]->customer_id;  ?></td>
                              <td><?php echo $rec[0]->name;  ?></td>
                              <td><?php echo $rec[0]->decpassword;  ?></td>
                              <td><?php echo $rec[0]->mobile;  ?></td>
                              <td><?php echo $rec[0]->email;  ?></td>
                              <td><?php echo $rec[0]->create_at;  ?></td>
                              <td><?php 
                              
                              if($rec[0]->is_active='1'){
                                echo"Active";
                              } else {
                                echo"De-Active";
                              }
                              ?></td>
                            <?php } ?>
                          </tr>
                       </tbody>
                      </table>
      
      </div>

      <br></br>
<?php
  if(!empty($rec)){ 

  $planId = $rec[0]->plan_id;
  $total_customer_form =  $this->model->hdm_get_where_count('tbl_form', array('customer_id' => $customer_id, 'submit_at!=' => ''));
  $plan_data = $this->model->hdm_get_where('tbl_plan', array('id' => $planId));
  $total_form = $plan_data[0]->forms;
  $customer_form= $total_customer_form;
  $left_form = $plan_data[0]->forms - $total_customer_form;

  $this->db->from('tbl_form');
  $this->db->order_by("id", "asc");
  $this->db->where('customer_id',$customer_id);
  $query = $this->db->get(); 
  $last_records =  $query->row();

   $lastid1 = $last_records->id;
   $lastid2 = $last_records->id;
  
  
  ?>

  <div class="row">


<span>complete form  </span>


<?php  

          for ($i=1; $i <= $total_form; $i++) {


         
                $where = array('submit_at!=' => '','id'=>$lastid1);
                  $is_submit = $this->model->hdm_get_where_count('tbl_form',$where);
          
                
                
                if($is_submit == '1'){
                  // echo '<span>'.$i.',</span>';
                  // echo "complete".$lastid1;
                  // echo '<span   class="trrr"   >'.$is_submit.',</span>';
                  echo '<span   class="trrr"   >'.$i.',</span>';
                
                 
               } 

            

               $lastid1++;

               }  

            
               ?>


</div>

<div class="row">
  <!-- <table class="table table-striped table-hover" id="tableExport" style="width:100%;"  >
  <tbody>

  <tr    class="trrr"  style="display: flexbox;"   > -->

<span>Empty form :  </span>

<!-- <td> -->
<?php  
          for ($i=1; $i <= $total_form; $i++) {
                $where = array('submit_at!=' => '','id'=>$lastid2);
                  $is_submit = $this->model->hdm_get_where_count('tbl_form',$where);
                
                 if($is_submit =='0'){
                  // echo '<span   class="trrr"   >'.$is_submit.',</span>';
                  echo '<span   class="trrr"   >'.$i.',</span>';
                 }  else {
                // echo "not".$lastid2;
              

               }
          
               $lastid2++;

               }  

            
               ?>

<!-- </td>
  </tr>
       
   </tbody>
  </table> -->

</div>



  <?php 

} else{
 
}
     
	

?>




    
</div>

</div>

</div>


  </div>

</section>



</div>

