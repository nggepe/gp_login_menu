
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/awesome/css/all.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/modules/node_modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <img src="<?= base_url() ?>assets/admin/assets/img/stisla-fill.svg" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
            <h4 class="text-dark font-weight-normal">Welcome to <span class="font-weight-bold">Stisla</span></h4>
            <p class="text-muted"><?php echo $this->session->flashdata('flash_msg') ?></p>
            <form method="POST" action="<?= base_url() ?>user_auth/Login/submit" class="needs-validation" novalidate="">
              <div class="form-group">
                <label for="username">username</label>
                <input id="username" type="username" class="form-control" name="username" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                  Please fill in your username
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
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                  <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
              </div>

              <div class="form-group text-right">
                <a href="auth-forgot-password.html" class="float-left mt-3">
                  Forgot Password?
                </a>
                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                  Login
                </button>
              </div>

              <div class="mt-5 text-center">
                Don't have an account? <a href="auth-register.html">Create new one</a>
              </div>
            </form>

            <div class="text-center mt-5 text-small">
              Copyright &copy; Your Company. Made with 💙 by Stisla
              <div class="mt-2">
                <a href="#">Privacy Policy</a>
                <div class="bullet"></div>
                <a href="#">Terms of Service</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="<?= base_url() ?>assets/admin/assets/img/unsplash/login-bg.jpg">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold">Good Mornig</h1>
                <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
              </div>
              Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo base_url(); ?>assets/admin/modules/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/modules/popper.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/modules/tooltip.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/modules/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <script src="<?php echo base_url(); ?>assets/admin/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/modules/jquery-ui/jquery-ui.min.js"></script>
  <!-- Template JS File -->
  <script src="<?= base_url() ?>assets/admin/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>assets/admin/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>
