<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Marvel </title>
  
  <link rel="icon" href="<?php echo base_url() ?>favicon.ico" type="image/jpg">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->

    <!-- Font Awesome -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ionicons/css/ionicons.min.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE1.min.css">

  <style>
     
      h1 {
        position: absolute;
        top: 35%;
        width: 100%;

        background-color: #666666;
        -webkit-background-clip: text;
        -moz-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: rgba(255,255,255,0.5) 0px 3px 3px;
        margin-top :-20px;
        }
</style>
</head>

</head>
<body  class="hold-transition login-page">

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header">
        <div class="row" style="font-size: x-large;">
            <div class="col-12" style=""><h1>LOGIN MARVEL</h1>
                <a href="login"><img src="" style="width:100%;"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
      <form action="login/do_login" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="User ID" name="userID" id="userID" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="userPassword" name="userPassword" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <div class="custom-control custom-switch">
            <input onclick="myFunction()" type="checkbox" class="custom-control-input" id="passwi">
            <label class="custom-control-label" for="passwi">Show Password</label>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
     
     
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

<!-- /.login-box -->

<!-- jQuery -->

<script>
    function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("passwi");
  // Get the output text
  var pass = document.getElementById("userPassword");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    pass.type = "text";
  } else {
    pass.type = "password";
  }
}
</script>
</body>
</html>
