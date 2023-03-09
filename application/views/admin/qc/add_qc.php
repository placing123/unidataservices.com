<div class="main-content">

	<section class="section">

		<div class="section-body">

			<div class="row">
			<div class="col-12">
          <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> <?= $this->session->flashdata('success'); ?>.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php } ?>
          <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> <?= $this->session->flashdata('error'); ?>.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php } ?>

				<div class="col-12 col-md-12 col-lg-12">
					<div class="card">

						<div class="card-header">
							<h4><?php echo $title; ?></h4>
						</div>

						<style>
							.error {
								color: red;
							}
						</style>

						<?= validation_errors(); ?>

						
						
						<form  class="email" id="form_approveid" method="post" >

						<div class="card-body">

							<div class="row">
								<div class="form-group col-5">
									<label for="last_name">Customer</label>
									<select name="customer_id" id="customer_id" class="form-control" onclick="get_users_form()">
										<option value="">Select</option>
										<?php foreach($cust_rec as $r) :   ?>
											<option value="<?php echo  $r->customer_id; ?>"><?php echo  $r->customer_id; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group col-5">
									<label for="last_name">form</label>
									<select name="customer_form" id="customer_form" class="form-control" onchange="get_customer_formdata()">
										<option value="">Select</option>
									</select>
								</div>

							</div>

							<div class="row">
								<div class="form-group col-5">
									<label for="pass">pass:</label><label for="pass"  id="pass_res"  ></label>
									<label for="fail">Fail:</label><label for="fail"   id="fail_res" ></label>
								</div>
							</div>


							<div class="row" id="resume_section"    style="display:none;"   >


								<div class="form-group col-6">
									<label for="plan_no">Resume Preview</label>



									<div class="embed-responsive embed-responsive-1by1">
										<iframe id="resumepdf" class="embed-responsive-item" src="<?php echo base_url() . 'uploads/resumes/1.pdf'; ?>"></iframe>
									</div>

								</div>



								<div class="form-group col-6">
									<div class="row">
										<h3>Personal Details</h3>
										<div class="form-group col-12">
											<label for="fname">Name</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id1"         required    />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id1"   required />
												Disapprove
											</label>

											<input readonly id="fname" type="text" class="form-control" name="fname">

										</div>
										<div class="form-group col-12">
											<label for="plan_name"> Middle Name</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id2"     />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id2" />
												Disapprove
											</label>

											<input readonly id="mname" type="text" class="form-control" name="mname" value="">

										</div>
										<div class="form-group col-12">
											<label for="plan_name"> Last Name</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id3" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id3" />
												Disapprove
											</label>
											<input readonly id="lname" type="text" class="form-control" name="lname" value="">

										</div>
										<div class="form-group col-12">
											<label for="plan_name">DOB</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id4" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id4" />
												Disapprove
											</label>

											<input readonly id="dob" type="date" class="form-control" name="dob" value="">

										</div>
										<div class="form-group col-12">
											<label for="plan_name">Gender</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id5" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id5" />
												Disapprove
											</label>

											<input readonly id="gender" type="text" class="form-control" name="gender" value="">

										</div>
										<div class="form-group col-12">
											<label for="plan_name">Nationality</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id6" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id6" />
												Disapprove
											</label>
											<input readonly id="Nationality" type="text" class="form-control" name="Nationality" value="">

										</div>
										<div class="form-group col-12">
											<label for="plan_name">Marital status</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id7" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id7" />
												Disapprove
											</label>

											<input readonly id="mari_status" type="text" class="form-control" name="mari_status" value="">

										</div>
										<div class="form-group col-12">
											<label for="plan_name">passport</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id8" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id8" />
												Disapprove
											</label>

											<input readonly id="passport" type="text" class="form-control" name="passport" value="">

										</div>
										<div class="form-group col-12">
											<label for="plan_name">hobbies</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id9" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id9" />
												Disapprove
											</label>

											<input readonly id="hobbies" type="text" class="form-control" name="hobbies" value="">

										</div>
										<div class="form-group col-12">
											<label for="plan_name">Language known</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id10" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id10" />
												Disapprove
											</label>

											<input readonly id="lang_known" type="text" class="form-control" name="lang_known" value="">

										</div>
										<div class="form-group col-12">
										<h3>Communication Details</h3>
											<label for="plan_name">address</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id11" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id11" />
												Disapprove
											</label>

											<input readonly id="address" type="text" class="form-control" name="address" value="">

										</div>
										<div class="form-group col-12">
											<label for="plan_name">Land Mark</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id12" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id12" />
												Disapprove
											</label>

											<input readonly id="land_mark" type="text" class="form-control" name="land_mark" value="">

										</div>

										<div class="form-group col-12">
											<label for="plan_name">State</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id13" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id13" />
												Disapprove
											</label>

											<input readonly id="State" type="text" class="form-control" name="State" value="">

										</div>

										<div class="form-group col-12">
											<label for="plan_name">City</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id14" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id14" />
												Disapprove
											</label>

											<input readonly id="City" type="text" class="form-control" name="City" value="">

										</div>

										<div class="form-group col-12">
											<label for="plan_name">pincode</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id15" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id15" />
												Disapprove
											</label>

											<input readonly id="pincode" type="text" class="form-control" name="pincode" value="">

										</div>

										<div class="form-group col-12">
											<label for="plan_name">Mobile</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id16" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id16" />
												Disapprove
											</label>

											<input readonly id="Mobile" type="text" class="form-control" name="Mobile" value="">

										</div>

										<div class="form-group col-12">
											<label for="email">Email</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id17" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id17" />
												Disapprove
											</label>
											<input readonly id="email" type="text" class="form-control" name="email" value="">

										</div>

										<h4>QUALIFICATION DETAILS</h4>
										<div class="form-group col-12">
											<label for="plan_name">SSC Result</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id18" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id18" />
												Disapprove
											</label>

											<input readonly id="ssc_result" type="text" class="form-control" name="ssc_result" value="">

										</div>

										<div class="form-group col-12">
											<label for="plan_name">SSC Passing year</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id19" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id19" />
												Disapprove
											</label>

											<input readonly id="ssc_board_uni" type="text" class="form-control" name="ssc_board_uni" value="">

										</div>

										<div class="form-group col-12">
											<label for="plan_name">SSC Board/University</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id20" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id20" />
												Disapprove
											</label>
											<input readonly id="ssc_pass_year" type="text" class="form-control" name="ssc_pass_year" value="">
										</div>

										<div class="form-group col-12">
											<label for="plan_name">HSC Result</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id21" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id21" />
												Disapprove
											</label>
											<input readonly id="hsc_result" type="text" class="form-control" name="ssc_pass_year" value="">
										</div>




										<div class="form-group col-12">
											<label for="plan_name">HSC Passing Year</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id22" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id22" />
												Disapprove
											</label>
											<input readonly id="hsc_pass_year" type="text" class="form-control" name="hsc_pass_year" value="">
										</div>





										<div class="form-group col-12">
											<label for="plan_name">HSC Board/University</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id23" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id23" />
												Disapprove
											</label>
											<input readonly id="hsc_uni" type="text" class="form-control" name="hsc_uni" value="">
										</div>

										<div class="form-group col-12">
											<label for="plan_name">Diploma Degree</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id24" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id24" />
												Disapprove
											</label>
											<input readonly id="dip_deg" type="text" class="form-control" name="dip_deg" value="">
										</div>

										<div class="form-group col-12">
											<label for="plan_name">Diploma Result</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id25" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id25" />
												Disapprove
											</label>
											<input readonly id="dip_res" type="text" class="form-control" name="dip_res" value="">
										</div>


										<div class="form-group col-12">
											<label for="plan_name">Diploma University</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id26" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id26" />
												Disapprove
											</label>
											<input readonly id="dip_uni" type="text" class="form-control" name="dip_uni" value="">
										</div>
										<!-- end  -->

										<div class="form-group col-12">
											<label for="plan_name">Diploma Year</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id27" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id27" />
												Disapprove
											</label>
											<input readonly id="dip_year" type="text" class="form-control" name="dip_year" value="">
										</div>
										<!-- end  -->
										<div class="form-group col-12">
											<label for="plan_name">Graduation Degree</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id28" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id28" />
												Disapprove
											</label>
											<input readonly id="gradu_deg" type="text" class="form-control" name="gradu_deg" value="">
										</div>
										<!-- end  -->
										<div class="form-group col-12">
											<label for="plan_name">Graduation Result</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id29" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id29" />
												Disapprove
											</label>
											<input readonly id="gradu_res" type="text" class="form-control" name="gradu_res" value="">
										</div>
										<!-- end  -->
										<div class="form-group col-12">
											<label for="plan_name">Graduation University</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id30" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id30" />
												Disapprove
											</label>
											<input readonly id="gradu_uni" type="text" class="form-control" name="gradu_uni" value="">
										</div>
										<!-- end  -->
										<div class="form-group col-12">
											<label for="plan_name">Graduation Year</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id31" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id31" />
												Disapprove
											</label>
											<input readonly id="gradu_year" type="text" class="form-control" name="gradu_year" value="">
										</div>
										<!-- end  -->

										<div class="form-group col-12">
											<label for="plan_name">Post Graduation Degree</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id32" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id32" />
												Disapprove
											</label>
											<input readonly id="post_grad_deg" type="text" class="form-control" name="post_grad_deg" value="">
										</div>
										<!-- end  -->

										<div class="form-group col-12">
											<label for="plan_name">Post Graduation Result</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id33" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id33" />
												Disapprove
											</label>
											<input readonly id="post_grad_res" type="text" class="form-control" name="post_grad_res" value="">
										</div>
										<!-- end  -->

										<div class="form-group col-12">
											<label for="plan_name">Post Graduation University</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id34" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id34" />
												Disapprove
											</label>
											<input readonly id="post_grad_uni" type="text" class="form-control" name="post_grad_uni" value="">
										</div>
										<!-- end  -->
										<div class="form-group col-12">
											<label for="plan_name">Post Graduation Year</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id35" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id35" />
												Disapprove
											</label>
											<input readonly id="post_grad_year" type="text" class="form-control" name="post_grad_year" value="">
										</div>
										<!-- end  -->


										<div class="form-group col-12">
											<label for="plan_name">Highest Level Education</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id36" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id36" />
												Disapprove
											</label>
											<input readonly id="high_lev_edu" type="text" class="form-control" name="high_lev_edu" value="">
										</div>
										<!-- end  -->

										<div class="form-group col-12">
							<h3>			EMPLOYMENT DETAILS  </h3>
											<label for="plan_name">Total Work Experience/Year</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id37" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id37" />
												Disapprove
											</label>
											<input readonly id="ttl_exp_year" type="text" class="form-control" name="ttl_exp_year" value="">
										</div>
										<!-- end  -->

										<div class="form-group col-12">
											<label for="plan_name">Month</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id38" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id38" />
												Disapprove
											</label>
											<input readonly id="ttl_exp_mon" type="text" class="form-control" name="ttl_exp_mon" value="">
										</div>
										<!-- end  -->

										<div class="form-group col-12">
											<label for="plan_name">Total Companies Worked For</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id39" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id39" />
												Disapprove
											</label>
											<input readonly id="company_work_for" type="text" class="form-control" name="company_work_for" value="">
										</div>
										<!-- end  -->



										<div class="form-group col-12">
											<label for="plan_name"> Last/Current Employer</label>
											<label class="radio">
												<input type="radio" required value="1" class="app" name="field_id40" />
												Approve
											</label>
											<label class="radio">
												<input type="radio" required value="0" class="disapp" name="field_id40" />
												Disapprove
											</label>
											<input readonly id="last_curr_emp" type="text" class="form-control" name="last_curr_emp" value="">
										</div>
										<!-- end  -->
										<div class="form-group col-5">
										<!-- <input type="btn" name="btn" class="btn btn-primary" value="Submit"   onclick="form_approve()"  > -->
											<!-- <input type="submit" name="btn" class="btn btn-primary" value="Submit"   onclick="approve_form()"       > -->
									
											<button class="btn btn-primary"  >submit</button>
									
										</div>


									</div>


								</div>

							</div>


						</div>

						<?= form_close(); ?>



					</div>

				</div>

			</div>

		</div>

	</section>
</div>

<script>


	function get_users_form(id) {

		var base_url = $("#base_url").val();

		var id = $("#customer_id").val();

		console.log('okk');

		$.ajax({
			url: base_url + '/customer_form',
			method: 'post',
			data: {
				id: id
			},
			dataType: 'json',
			success: function(response) {
				
				$("#customer_form").empty();
				$("#customer_form").append(response.data);
			}

		});
	}



		function get_customer_formdata() {
			var form_id = $("#customer_form").val();
			var base_url = $("#base_url").val();
			var cust_id = $("#customer_id").val();


		$.ajax({
			url: base_url + '/customer_formdata',
			method: 'post',
			data: {
				form_id: form_id,
				cust_id: cust_id
			},
			dataType: 'json',
			success: function(response) {

				qc_pass_faild();

				$("#resume_section").show();


				var imgurl = base_url+'uploads/resumes/';

				var pdfurl = imgurl+response.data.resume_id+'.pdf';
     			  console.log(pdfurl);
      				 $("#resumepdf").attr("src", pdfurl);

				$("#fname").val(response.data.fname);
				$("#mname").val(response.data.mname);
				$("#lname").val(response.data.lname);
				$("#dob").val(response.data.dob);
				$("#gender").val(response.data.gender);
				$("#Nationality").val(response.data.notionality);
				$("#mari_status").val(response.data.mari_status);
				$("#passport").val(response.data.passport);
				$("#hobbies").val(response.data.hobbies);
				$("#address").val(response.data.address);
				$("#land_mark").val(response.data.land_mark);
				$("#State").val(response.data.state);
				$("#City").val(response.data.city);
				$("#pincode").val(response.data.pincode);
				$("#Mobile").val(response.data.mobile);
				$("#email").val(response.data.email);
				$("#ssc_result").val(response.data.ssc_result);
				$("#ssc_board_uni").val(response.data.ssc_board_uni);
				$("#ssc_pass_year").val(response.data.ssc_pass_year);
				$("#hsc_result").val(response.data.hsc_result);
				$("#hsc_pass_year").val(response.data.hsc_pass_year);
				$("#hsc_uni").val(response.data.hsc_uni);
				$("#dip_deg").val(response.data.dip_deg);
				$("#dip_res").val(response.data.dip_res);
				$("#dip_uni").val(response.data.dip_uni);
				$("#dip_year").val(response.data.dip_year);
				$("#gradu_deg").val(response.data.gradu_deg);
				$("#gradu_res").val(response.data.gradu_res);
				$("#gradu_year").val(response.data.gradu_year);
				$("#gradu_uni").val(response.data.gradu_uni);
				$("#post_grad_deg").val(response.data.post_grad_deg);
				$("#post_grad_res").val(response.data.post_grad_res);
				$("#post_grad_uni").val(response.data.post_grad_uni);
				$("#post_grad_year").val(response.data.post_grad_year);
				$("#high_lev_edu").val(response.data.high_lev_edu);
				$("#ttl_exp_year").val(response.data.ttl_exp_year);
				$("#ttl_exp_mon").val(response.data.ttl_exp_mon);
				$("#company_work_for").val(response.data.company_work_for);
				$("#lang_known").val(response.data.lang_known);
				$("#last_curr_emp").val(response.data.last_curr_emp);

				checked_btn();   

			}
		});
	}

	function form_approve() {

		var formData = $('#form_approveid').serialize();
		var base_url = $("#base_url").val();

		$.ajax({
			url: base_url + '/form_approve',
			method: 'post',
			data: formData,
			dataType: 'json',
			success: function(response) {
				if (response.status == '1') {
					alert(response.msg);
					$('html,body').animate({scrollTop: $(".section").offset().top}, 'fast');
					$('select[name^="customer_form"] option[value="'+response.next_form+'"]').attr("selected","selected");
					get_customer_formdata();
					qc_pass_faild();
					
					$(".disapp").prop('checked', false);
					$(".app").prop('checked', false);
				}
			}
		});

	}

	function qc_pass_faild(){

		var base_url = $("#base_url").val();
		var cust_id = $("#customer_id").val();

		$.ajax({
			url: base_url + '/qc_pass_faild',
			method: 'post',
			data: {
				cust_id: cust_id
			},
			dataType: 'json',
			success: function(response) {
				
				$("#pass_res").text(response.total_pass);
				$("#fail_res").text(response.total_fail);

				if(response.total_fail > 65 ){
					alert('form has more then 10 disapprove submit the qc');
					window.location.replace(base_url+'customer_qcsubmit/'+cust_id);
				}

				if(response.submission_pass == 1 ){
					alert('All form data are correct submmit the QC');
					window.location.replace(base_url+'customer_qcsubmit/'+cust_id);
				}
			}

		});


	}




function checked_btn(){   

	var form_id  = $("#customer_form").val();
	var cust_id  = $("#customer_id").val();
	var base_url = $("#base_url").val();

	$.ajax({
			url: base_url + '/get_approve_data',
			method: 'post',
			data: {
				form_id: form_id,
				cust_id: cust_id
			},
			dataType: 'json',
			success: function(response) {
				
				if(response.status==1){
					$.each(response.data, function(key, value) {
						// $(".app").prop('checked', true);
				    	// $(".disapp").prop('checked', true);
						// console.log( value.id);
						$("input[name=field_id"+value.fid+"][value=" +value.fid_status+ "]").attr('checked', 'checked');
						// if($('input[name="field_id'+value.fid+'"]:checked').length > 0){

						// }
					});

				} else {
			    	$(".app").attr('checked', true);
					$(".disapp").attr('checked', false);
				}
				
			}

		});



	
}








</script>