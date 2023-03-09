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

            <h4> Not Submitted QC Submission</h4>

            <!-- <a href="<?=base_url('student-list-show');?>" class="btn btn-warning" style="position:absolute;right:10px">List</a> -->

          </div>

          <style>.error{color:red}</style>

          <?=validation_errors();?>

          <?=form_open_multipart($action);?>

          <div class="card-body">

            <div class="row">

             <?php  
             
             
             $customer_id = $this->uri->segment(2);
             
             $wherecust1 = array('customer_id'=>$customer_id);
		        $register_data =  $this->model->hdm_get_where('tbl_register',$wherecust1);
        $plan_id     =  $register_data[0]->plan_id;
       
		$plan_data =  $this->model->hdm_get_where('tbl_plan',array('id'=>$plan_id));
		$total_form = $plan_data[0]->forms;

		$where = array('customer_id'=>$customer_id);
		$total_pass = $this->model->hdm_get_where_count('tbl_approve_result',$where);
		$where = array('customer_id'=>$customer_id,'fid_status'=>'0');
		$total_fail = $this->model->hdm_get_where_count('tbl_approve',$where);
             
     ?>




                <div class="form-group col-5">

                <?php 

                      if($total_pass == $total_form){ ?> 
                        <h1> Customer ID :  <?php echo $this->uri->segment(2); ?> Success  </h1>

                        <input type="hidden"  value="3"   name="status">
                      <?php }   else { ?>
                        <h1> Customer ID :  <?php echo $this->uri->segment(2); ?>   </h1>
                        <input type="hidden"  value="1"   name="status"   >

                     <?php  }
             ?>

               
               <input type="hidden"  value="<?php echo $this->uri->segment(2); ?>"   name="customer_id">
    
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