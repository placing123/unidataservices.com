<!DOCTYPE html>
<html>
<head>
	<title>Download Profile</title>
	<!-- <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/app.min.css">
	<link rel="stylesheet" href="<?=base_url('admin_assets');?>/bundles/bootstrap-social/bootstrap-social.css">
	  
	<link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/style.css">
	<link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/components.css">
	  
	<link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/custom.css">
	<link rel='shortcut icon' type='image/x-icon' href='<?=base_url('admin_assets');?>/img/favicon.ico' /> -->
</head>
<body>

	<div id="app">
	    <section class="section">
	        <div class="container mt-5">
	            <div class="row">
	            	<div class="col-12" style="text-align: center;">
						<h4><?= $user_data['company_name'] ?></h4>
					</div>
				</div>
				<br>
				<div class="row">
	            	<div class="col-12" style="text-align: center;">
						<img src="<?= base_url('admin_assets/img/user_profile/'.$user_data['profile_image']) ?>" style="width: 30%; height: auto;">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-12">
						<table class="table" style="background-color: white;">
							<thead>
								<tr>
									<th width="50%" style="text-align: right !important; color: red !important;">Owner / Contact Person Name :</th>
									<th width="50%"><b><?= $user_data['owner_name'] ?><b></th>
								</tr>
								<tr>
									<th width="50%" style="text-align: right !important; color: red !important;">Block no. / Building Name / Street Name / Village Name :</th>
									<th width="50%"><b><?= $user_data['address'] ?><b></th>
								</tr>
								<tr>
									<th width="50%" style="text-align: right !important; color: red !important;">Area / Landmark :</th>
									<th width="50%"><b><?= $user_data['area'] ?><b></th>
								</tr>
								<tr>
									<th width="50%" style="text-align: right !important; color: red !important;">District :</th>
									<th width="50%"><b><?= $district_data['district_name'] ?><b></th>
								</tr>
								<tr>
									<th width="50%" style="text-align: right !important; color: red !important;">Pin code :</th>
									<th width="50%"><b><?= $user_data['pincode'] ?><b></th>
								</tr>
								<tr>
									<th width="50%" style="text-align: right !important; color: red !important;">State :</th>
									<th width="50%"><b><?= $state_data['state_name'] ?><b></th>
								</tr>
								<tr>
									<th width="50%" style="text-align: right !important; color: red !important;">Primary Mobile No :</th>
									<th width="50%">
										<b><?= $user_data['mobile_1'] ?><b>
										&nbsp;&nbsp;&nbsp;
										<?php
										if($user_data['mobile_whatsapp_1'] == 1)
										{
											echo '<img src="'.base_url('admin_assets/img/whatsapp_icon.png').'" style="width: 4%;"/>&nbsp;&nbsp;&nbsp;';
										}
										
										if($user_data['mobile_call_1'] == 1)
										{
											echo '<img src="'.base_url('admin_assets/img/call_icon.jpg').'" style="width: 5%;"/>';
										}
										?>
									</th>
								</tr>
								<tr>
									<th width="50%" style="text-align: right !important; color: red !important;">Othre Mobile No :</th>
									<th width="50%">
										<b><?= $user_data['mobile_2'] ?><b>

										&nbsp;&nbsp;&nbsp;
										<?php
										if($user_data['mobile_whatsapp_2'] == 1)
										{
											echo '<img src="'.base_url('admin_assets/img/whatsapp_icon.png').'" style="width: 4%;"/>&nbsp;&nbsp;&nbsp;';
										}
										
										if($user_data['mobile_call_2'] == 1)
										{
											echo '<img src="'.base_url('admin_assets/img/call_icon.jpg').'" style="width: 5%;"/>';
										}
										?>

									</th>
								</tr>
								
							</thead>
						</table>
					</div>
				</div>
	        </div>
	    </section>
	</div>



	<!-- <script src="<?=base_url('admin_assets');?>/js/app.min.js"></script>
  	<script src="<?=base_url('admin_assets');?>/js/scripts.js"></script>
  	<script src="<?=base_url('admin_assets');?>/js/custom.js"></script> -->

</body>
</html>