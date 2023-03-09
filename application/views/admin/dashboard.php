
<?php 

$master_data = $this->model->hdm_get('tbl_master');

   $customer_care_no = $master_data[0]->care_no;
   $care_eml = $master_data[0]->care_eml;
   $care_add = $master_data[0]->address;
   $company_name = $master_data[0]->name;


   $logo = base_url().$master_data[0]->logo;
   $seal = base_url().$master_data[0]->seal;


?>


<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

  <title><?=$title;?></title>

  <!-- General CSS Files -->

  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/app.min.css">

  <!-- Template CSS -->

  <?=$css;?>

  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/style.css">

  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/components.css">

  <!-- Custom style CSS -->

  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/custom.css">

  <link rel='shortcut icon' type='image/x-icon' href='<?=base_url('admin_assets');?>/img/favicon.ico' />

</head>


<body>

  <div class="loader"></div>

  <div id="app">

    <div class="main-wrapper main-wrapper-1">

      <div class="navbar-bg"></div>

    	<?php $this->load->view('admin/include/navbar');?>

    	<?php $this->load->view('admin/include/sidebar');?>

	 <!-- Main Content -->

		<?php $this->load->view($page);?>

		<?php $this->load->view('admin/include/footer');?>

	</div>

  </div>

  <!-- General JS Scripts -->

  <script src="<?=base_url('admin_assets');?>/js/app.min.js"></script>

  <?php if($this->uri->segment('1')=='admin-dashboard') { ?>

  <!-- JS Libraies -->

  <script src="<?=base_url('admin_assets');?>/bundles/apexcharts/apexcharts.min.js"></script>

  <!-- Page Specific JS File -->

  <script src="<?=base_url('admin_assets');?>/js/page/index.js"></script>

  <?php } ?>

  <!-- Template JS File -->

  <script src="<?=base_url('admin_assets');?>/js/scripts.js"></script>

  <!-- Custom JS File -->

  <?=$script;?>

  <script src="<?=base_url('admin_assets');?>/js/custom.js"></script>

</body>



</html>