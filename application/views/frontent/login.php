<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Customer Login</title>
       <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
        <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
        <meta name="author" content="colorlib" />
        <link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">
        <style id="" media="all">
            @font-face {
                font-family: 'Open Sans';
                font-style: normal;
                font-weight: 300;
                font-stretch: normal;
                src: url(/fonts.gstatic.com/s/opensans/v27/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsiH0B4gaVc.ttf) format('truetype');
            }

            @font-face {
                font-family: 'Open Sans';
                font-style: normal;
                font-weight: 400;
                font-stretch: normal;
                src: url(/fonts.gstatic.com/s/opensans/v27/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsjZ0B4gaVc.ttf) format('truetype');
            }

            @font-face {
                font-family: 'Open Sans';
                font-style: normal;
                font-weight: 600;
                font-stretch: normal;
                src: url(/fonts.gstatic.com/s/opensans/v27/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsgH1x4gaVc.ttf) format('truetype');
            }

            @font-face {
                font-family: 'Open Sans';
                font-style: normal;
                font-weight: 700;
                font-stretch: normal;
                src: url(/fonts.gstatic.com/s/opensans/v27/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsg-1x4gaVc.ttf) format('truetype');
            }

            @font-face {
                font-family: 'Open Sans';
                font-style: normal;
                font-weight: 800;
                font-stretch: normal;
                src: url(/fonts.gstatic.com/s/opensans/v27/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgshZ1x4gaVc.ttf) format('truetype');
            }
        </style>
        <style id="" media="all">
            @font-face {
                font-family: 'Quicksand';
                font-style: normal;
                font-weight: 500;
                src: url(/fonts.gstatic.com/s/quicksand/v24/6xK-dSZaM9iE8KbpRA_LJ3z8mH9BOJvgkM0o58a-xw.ttf) format('truetype');
            }

            @font-face {
                font-family: 'Quicksand';
                font-style: normal;
                font-weight: 700;
                src: url(/fonts.gstatic.com/s/quicksand/v24/6xK-dSZaM9iE8KbpRA_LJ3z8mH9BOJvgkBgv58a-xw.ttf) format('truetype');
            }
        </style>
        <link rel="stylesheet" type="text/css" href="<?php  echo base_url().'customer_assets/bower_components/bootstrap/css/bootstrap.min.css' ?>">
        <!-- waves.css -->
        <link rel="stylesheet" href="<?php  echo base_url().'customer_assets/pages/waves/css/waves.min.css'?>" type="text/css" media="all">
        <link rel="stylesheet" type="text/css" href="<?php  echo base_url().'customer_assets/icon/feather/css/feather.css'?>">
    
        <link rel="stylesheet" type="text/css" href="<?php  echo base_url().'customer_assets/icon/themify-icons/themify-icons.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php  echo base_url().'customer_assets/icon/icofont/css/icofont.css'?> ">
        <link rel="stylesheet" type="text/css" href="<?php  echo base_url().'customer_assets/icon/font-awesome/css/font-awesome.min.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php  echo base_url().'customer_assets/css/style.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php  echo base_url().'customer_assets/css/pages.css'?>">
        <meta name="robots" content="noindex, nofollow">
    </head>
    <body themebg-pattern="theme1">
        <div class="theme-loader">
            <div class="loader-track">
                <div class="preloader-wrapper">
                    <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="spinner-layer spinner-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="spinner-layer spinner-yellow">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="spinner-layer spinner-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="login-block">
            <div class="container-fluid">
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

                <div class="row">
                    <div class="col-sm-12">

                    
                        <form class="md-float-material form-material"  method="post" action="<?php echo base_url().'customer-auth'?>"     >
                            <div class="text-center">
                                <img data-cfsrc="../files/assets/images/logo.png" alt="logo.png" style="display:none;visibility:hidden;">
                               
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center txt-primary">Customer Login</h3>
                                        </div>
                                    </div>
                                    <div class="row m-b-20">
                                   
                                    </div>
                                    <p class="text-muted text-center p-b-5">Sign in with your regular account</p>
                                    <div class="form-group form-primary">
                                        <input type="text"   placeholder="ID"  name="customerid" class="form-control" required="">
                                        <!-- <span class="form-bar"></span> -->
                                        <!-- <label class="float-label">ID</label> -->
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="password"  placeholder="Password" name="password" class="form-control" required="">
                                      
                                        <!-- <label class="float-label">Password</label> -->
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                    <span class="text-inverse">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="forgot-phone text-right float-right">
                                                <!-- <a href="auth-reset-password.html" class="text-right f-w-600"> Forgot Password?</a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
          
        </section>
     																						
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/3.6.0/umd/popper.min.js" ></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>   
    
       </body>
</html>