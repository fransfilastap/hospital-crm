<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8" />
  <title>Login | CRM RS</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="<?php echo base_url("assets/back/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet" />
  <link href="<?php echo base_url("assets/back/css/metro.css")?>" rel="stylesheet" />
  <link href="<?php echo base_url("assets/back/font-awesome/css/font-awesome.css")?>" rel="stylesheet" />
  <link href="<?php echo base_url("assets/back/css/style.css") ?>" rel="stylesheet" />
  <link href="<?php echo base_url("assets/back/css/style_responsive.css") ?>" rel="stylesheet" />
  <link href="<?php echo base_url("assets/back/css/style_default.css")?>" rel="stylesheet" id="style_color" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/back/uniform/css/uniform.default.css")?>" />
  <link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
  <!-- BEGIN LOGO -->
  <div class="logo">
    <img src="<?php echo base_url("assets/back/img/logo-big.png")?>" alt="" /> 
  </div>
  <!-- END LOGO -->
  <!-- BEGIN LOGIN -->
  <div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="form-vertical login-form" action="<?php echo base_url("admin/login/do_login") ?>" method="post" />
      <h3 class="form-title">Login to your account</h3>
      <?php echo $status; ?>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" type="text" placeholder="Email atau ID anda" name="username" />
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-lock"></i>
            <input class="m-wrap" type="password" style="" placeholder="Password" name="password" />
          </div>
        </div>
      </div>

     <!-- <div class="control-group">
        <div class="controls">
          <div class="left">
            <?php //echo $captcha; ?>
          </div>
        </div>
      </div>
    -->
    <!--
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <input class="m-wrap" type="text" style="" placeholder="Masukan kode Konfirmasi di atas" name="captcha" />
          </div>
        </div>
      </div>
      -->
      <div class="form-actions">
        <label class="checkbox">
        <input type="checkbox" /> Repasien me
        </label>
        <button type="submit" id="login-btn" class="btn green pull-right">
        Login <i class="m-icon-swapright m-icon-white"></i>
        </button>            
      </div>
    </form>
    <!-- END LOGIN FORM -->        
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="form-vertical forget-form" action="index.html" />
      <h3 class="">Forget Password ?</h3>
      <p>Enter your e-mail address below to reset your password.</p>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-envelope"></i>
            <input class="m-wrap" type="text" placeholder="Email" />
          </div>
        </div>
      </div>
      <div class="form-actions">
        <a href="javascript:;" id="back-btn" class="btn">
        <i class="m-icon-swapleft"></i>  Back
        </a>
        <a href="javascript:;" id="forget-btn" class="btn green pull-right">
        Submit <i class="m-icon-swapright m-icon-white"></i>
        </a>            
      </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
  </div>
  <!-- END LOGIN -->
  <!-- BEGIN COPYRIGHT -->
  <div class="copyright">
    2013 &copy; CRM RS.
  </div>
  <!-- END COPYRIGHT -->
  <!-- BEGIN JAVASCRIPTS -->
  <script src="<?php echo base_url("assets/back/js/jquery-1.8.3.min.js")?>"></script>
  <script src="<?php echo base_url("assets/back/bootstrap/js/bootstrap.min.js")?>"></script>  
  <script src="<?php echo base_url("assets/back/uniform/jquery.uniform.min.js")?>"></script> 
  <script src="<?php echo base_url("assets/back/js/jquery.blockui.js")?>"></script>
  <script src="<?php echo base_url("assets/back/js/app.js")?>"></script>
  <script>
    jQuery(document).ready(function() {     
      App.initLogin();
    });
  </script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>