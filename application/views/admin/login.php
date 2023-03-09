<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

  <title>Admin Login </title>

  <!-- General CSS Files -->

  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/app.min.css">

  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/bundles/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->

  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/style.css">

  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/components.css">

  <!-- Custom style CSS -->

  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/custom.css">

  <link rel='shortcut icon' type='image/x-icon' href='<?=base_url('admin_assets');?>/img/favicon.ico' />

</head>



<body>

  <div class="loader"></div>

  <div id="app">

    <section class="section">

      <div class="container mt-5">

        <div class="row">

		  <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

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

            <div class="card card-primary">

              <div class="card-header">

                <h4>Admin Login</h4>

              </div>

              <div class="card-body">

                <form method="POST" action="<?=$action;?>" class="needs-validation" novalidate="">

                  <div class="form-group">

                    <label for="email">Email</label>

                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>

                    <div class="invalid-feedback">

                      Please fill in your email

                    </div>

                  </div>

                  <div class="form-group">

                    <div class="d-block">

                      <label for="password" class="control-label">Password</label>

                    </div>

                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>

                    <div class="invalid-feedback">

                      please fill in your password

                    </div>

                  </div>

                  <div class="form-group">

                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">

                      Login

                    </button>

                  </div>

                </form>

              </div>

            </div>

			<div class="mt-5 text-muted text-center">

              Don't have an account? <a href="<?=base_url('student-register');?>">Create One</a>

            </div>

          </div>

        </div>

      </div>

    </section>

  </div>

  <!-- General JS Scripts -->

  <script src="<?=base_url('admin_assets');?>/js/app.min.js"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->

  <script src="<?=base_url('admin_assets');?>/js/scripts.js"></script>

  <!-- Custom JS File -->

  <script src="<?=base_url('admin_assets');?>/js/custom.js"></script>

</body>

</html>