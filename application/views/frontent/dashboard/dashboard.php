  <!-- [ breadcrumb ] start -->
  <div class="page-header card">

            <div class="row">
              <div class="col-12">
                  <?php if($this->session->flashdata('success')) { ?>
        			<div class="alert alert-success alert-dismissible fade show" role="alert">
        			  <strong><?=$this->session->flashdata('success');?></strong> .
        			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        				<span aria-hidden="true">&times;</span>
        			  </button>  
        			</div>
        		  <?php } ?>
                </div>
            </div>

            <?php if($this->session->flashdata('error')) { ?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">

  <strong>Error!</strong> <?=$this->session->flashdata('error');?>.

  <button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

  </button>

</div>

<?php } ?>

        	
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="feather icon-home bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Dashboard</h5>
                                            <!-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"><i class="feather icon-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Dashboard</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <!-- [ page content ] start -->
                                        <div class="row">

                                      
                                            <!-- Project statustic start -->
                                            <div class="col-xl-6">
                                                <div class="card proj-progress-card">
                                                    <div class="card-block">
                                                        <div class="row">
                                                                 <div class="col-md-6">
                                                                       <h6>Activation  Date</h6>
                                                                       <h5 class="m-b-30 f-w-700">  <?php   echo  $record[0]->activate_date;  ?> </h5>
                                                                </div>
                                                                <div class="col-md-6">
                                                                     <h6>End Date</h6>
                                                                     <h5 class="m-b-30 f-w-700">  <?php   echo  $record[0]->end_date;  ?> </h5>
                                                               
                                                                 </div>
                                                        </div>
                                                    </div>
                                                     <!-- card-block -->
                                                    <? $path = 'admin_assets/signpdf/'.$record[0]->sign_agreement;?>
                                                     <div class="card-block">
                                                        <div class="row">
                                                                 <div class="col-md-6">
                                                                    <h6>Agreement</h6>

                                                                    <?php if($record[0]->sign_agreement ==''){ ?>
                                                                      <span> Not upload sign yet   </span>
                                                                  <?php   } else { ?>
                                                                    <a href="<?php echo base_url().$path;?>"  target="_blank" >  Download </a>
                                                         

                                                                  <?php }?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h6>Wallet</h6>
                                                                    <h5 class="m-b-30 f-w-700">  <?php   echo  $record[0]->wallet;  ?> </h5>
                                                                </div>
                                                               
                                                        </div>
                                                    </div>
                                                     <!-- card-block -->
                                                <b>Note:</b> <h3> YOU CAN WITHDRAW THE WALLET BALANCE IN YOUR ACCOUNT AFTER SUBMISSION OF ALL THE FORMS HOWEVER 80% ACCURACY IS REQUIRED PAYOUT FOR EXAMPLE 400 OUT OF 500 MUST HAVE TO TYPED ACCURATELY (WITHOUT ANY MISTAKE) IN CASE IF YOU WILL NOT COMPLETE THE WORK WITHIN GIVEN TIME FRAME, THEN YOU HAVE TO PAY THE PORTAL MAINTENANCE CHARGES.</h3>
                                                </div>
                                            </div>
                                         
                                            <!-- Project statustic end -->

                                              <!-- Project statustic start -->
                                              <div class="col-xl-6">
                                                <div class="card proj-progress-card">
                                                    <div class="card-block">

                                                    <div id="piechart" style="width: 900px; height: 500px;"></div>


                                                    </div>
                                                     <!-- card-block -->
                                                </div>
                                            </div>
                                         
                                            <!-- Project statustic end -->

                                        </div>
                                        <!-- [ page content ] end -->
                                    </div>
                                </div>
                            </div>
                        </div>






<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Total', 'count'],
          ['left',     <?php echo $left_form; ?>],
          ['submit',    <?php echo $customer_form; ?>]
        ]);

        var options = {
          title: 'Your Activity'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

   