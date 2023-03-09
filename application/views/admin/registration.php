
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?=$title;?> | TechnoBrigade</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/app.min.css">
  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/bundles/jquery-selectric/selectric.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/style.css">
  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?=base_url('admin_assets');?>/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='<?=base_url('admin_assets');?>/img/favicon.ico' />
</head>
<style>.error{color:red}</style>
<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Student Register</h4>
              </div>
              <div class="card-body">
			  <div class="error"><?=validation_errors();?></div>
                <?=form_open_multipart($action);?>
                  <div class="row">
                    <div class="form-group col-4">
                      <label for="frist_name">Roll No</label>
                      <input id="rollno" type="text" class="form-control" name="rollno" autofocus value="<?=$roll_no;?>" readonly>
                    </div>
                    <div class="form-group col-8">
                      <label for="last_name">Name</label>
                      <input id="name" type="text" class="form-control" name="name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email">
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"name="password">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="passwordconf">
                    </div>
                  </div>
				  <div class="row">
                    <div class="form-group col-4">
                      <label for="frist_name">Standard</label>
                      <input id="standard" type="text" class="form-control" name="standard" autofocus>
                    </div>
                    <div class="form-group col-4">
                      <label for="last_name">Mobile No</label>
                      <input id="mobile" type="text" class="form-control" name="mobile" pattern="[6-9]{1}[0-9]{9}" title="Please Enter Valid Format Mobile Number" required>
                    </div>
					<div class="form-group col-4">
                      <label for="last_name">Photo</label>
                      <input id="pic" type="file" class="form-control" name="pic" accept="image/*">
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                <?=form_close();?>
              </div>
              <div class="mb-4 text-muted text-center">
                Already Registered? <a href="<?=base_url('secure-login');?>">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="<?=base_url('admin_assets');?>/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?=base_url('admin_assets');?>/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?=base_url('admin_assets');?>/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?=base_url('admin_assets');?>/js/page/auth-register.js"></script>
  <!-- Template JS File -->
  <script src="<?=base_url('admin_assets');?>/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="<?=base_url('admin_assets');?>/js/custom.js"></script>
</body>

</html>