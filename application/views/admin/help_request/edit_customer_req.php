<div class="main-content">

<section class="section">

  <div class="section-body">

    <div class="row">

      <div class="col-12 col-md-12 col-lg-12">

         

        <div class="card">

          <div class="card-header">

            <h4><?php echo $title; ?></h4>

           
          </div>

          <style>.error{color:red}</style>

          <?=validation_errors();?>

          <?=form_open_multipart($action);?>

          <div class="card-body">

            <div class="row">

             
                <div class="form-group col-6">

                  <label for="plan_no">Resume Preview</label>

																		<pre> <?php // print_r($rec); 
																		 $form_id = $rec[0]['form_id'];
																	 	$resumeid = $this->model->get_resumeidbyformid($form_id);
																		?>   </pre>

																	<div class="embed-responsive embed-responsive-1by1">
                			<iframe   id="resumepdf"  class="embed-responsive-item" src="<?php echo base_url().'uploads/resumes/'.$resumeid.'.pdf';?>"></iframe>
																</div>

                </div>

														

																			<div class="form-group col-6">
																						<div class="row">
																									<label for="plan_name">Field</label>


																									<input id="qryfldid" type="hidden"  name="qryfldid" value="<?php echo $rec[0]['qryfldid'] ?>">
																									<input id="qry_field" type="text" class="form-control"   name="qry_field" value="">
																					
																					
																			   </div>
																						<div class="row">
																									<label for="plan_name"></label>
																						
																					
																									<input type="submit" name="btn" class="btn btn-primary" value="Submit" >
																			   </div>
																			</div>

            </div>
              

         </div>

           <?=form_close();?>

         

        </div>

      </div>

    </div>

  </div>

</section>



</div>