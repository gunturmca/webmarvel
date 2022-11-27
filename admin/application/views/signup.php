<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mizuno Semangat Bangsa | Registration Page </title>
  
  <link rel="icon" href="<?=base_url()?>/resources/logo.jpg" type="image/jpg">

  <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ionicons/css/ionicons.min.css">
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/font-awesome/css/font-awesome.min.css">
      <script src="<?php echo base_url(); ?>jquery/jquery.min.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE1.min.css">
     <script src="<?php echo base_url(); ?>js/aes.js"></script>
     <script src="<?php echo base_url(); ?>include/cekfield.js"></script>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header">
        <div class="row" style="font-size: x-large;">
            <div class="col-12" style="">
                <a href="login"><img src="<?php echo base_url() ?>assets/images/logo.png" style="width:100%;"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Pendaftaran Akun Baru</p>

       <form id="form2" name="form2" method="" action=""  >
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" id="nama" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="NIK" name="nik" id="nik" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <div class="custom-control custom-switch">
                      <input onclick="myFunction()" type="checkbox" class="custom-control-input" id="passwi">
                      <label class="custom-control-label" for="passwi">Perlihatkan Password</label>
                    </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="button" name="simpan" id="simpan" class="btn btn-primary btn-block">Register</button>

          </div>
          <!-- /.col -->
        </div>
      </form>


      <a href="login" class="text-center">Sudah punya akun? Login.</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->

<script>
    function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("passwi");
  // Get the output text
  var password = document.getElementById("password");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    password.type = "text";
  } else {
    password.type = "password";
  }
}

$('#simpan').on('click', function(){
								
	saveuser();
	
});
    
</script>
</body>
</html>
