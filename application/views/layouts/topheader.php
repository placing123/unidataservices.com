<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Meta -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="assets/img/fav.png" />

		<!-- Title -->
		<title>PERFECT JOB CARE</title>

		<!-- *************
			************ Common Css Files *************
			************ -->
		<!-- Bootstrap css -->
		<!-- <link rel="stylesheet" href="http://perfectjobcare.com/customer/assets/css/bootstrap.min.css"> -->

		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" > -->

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css"/>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap-grid.min.css" />
		
		<!-- Icomoon Font Icons css -->
	<!-- //	<link rel="stylesheet" type="http://perfectjobcare.com/customer/assets/text/css" href="assets/fonts/style.css"> -->
		<link rel="stylesheet"  href="http://sparesengineer.com/perfectjob/uploads/assets/css/main.css">

		<!-- Main css -->
	<!-- //	<link rel="stylesheet" href="http://perfectjobcare.com/customer/assets/css/main.css"> -->

		<!-- *************
			************ Vendor Css Files *************
			************ -->
		<!-- Datepickers css -->
		<!-- <link rel="stylesheet" href="http://perfectjobcare.com/customer/assets/vendor/daterange/daterange.css" /> -->

		<!-- FA Icon CDN -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  		
		<!-- jQuery CDN -->
  		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>   

  		<!-- Apex Chart -->
  		<script src="http://perfectjobcare.com/assets/vendor/apex/apexcharts.min.js"></script>

  		<!-- Data Tables -->
			
		<!-- <link rel="stylesheet" href="http://perfectjobcare.com/customer/assets/assets/vendor/datatables/dataTables.bs4.css" /> -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css"  />
		<link rel="stylesheet" href="http://perfectjobcare.com/customer/assets/vendor/datatables/dataTables.bs4-custom.css" />

		<!-- Toastr CDN -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		  <script>
		    function toastConfig(){
		    toastr.options = {
		      "closeButton": true,
		      "debug": false,
		      "newestOnTop": false,
		      "progressBar": false,
		      "positionClass": "toast-top-right",
		      "preventDuplicates": false,
		      "onclick": null,
		      "showDuration": "300",
		      "hideDuration": "1000",
		      "timeOut": "5000",
		      "extendedTimeOut": "1000",
		      "showEasing": "swing",
		      "hideEasing": "linear",
		      "showMethod": "fadeIn",
		      "hideMethod": "fadeOut"
		    }
		  }
		  </script>
		  <!--Disable Form Submit on Pressing Enter Key-->
	<script>
    $(document).on("keypress", 'form', function (e) {
        var code = e.keyCode || e.which;
        console.log(code);
        if (code == 13) {
            console.log('Inside');
            e.preventDefault();
            return false;
        }
    });
    </script>
<!-- Disable back -->
	<script>
	window.location.hash="no-back-button";
	window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
	window.onhashchange=function(){window.location.hash="no-back-button";}
	</script>
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>
<!-- REQUIRED Read Only Fields -->
<script>
    $(".readonly").keydown(function(e){
        e.preventDefault();
    });
</script>
<!-- Disable Right Click / Copy-Paste -->
	</head>