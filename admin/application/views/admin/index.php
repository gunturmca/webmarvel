
<!DOCTYPE html>
<html>
<head>
<style>

/*.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}

.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 10%;
    margin-top: -15%;
	width:200px
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}*/
</style>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MARVEL</title>
  <link rel="icon" href="<?php echo base_url(); ?>img/ic_launcher.png" type="image/icon type">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css">
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
<?php /*?>  <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css"><?php */?>
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  
   
   	<link href="<?php echo base_url(); ?>css/charisma-app.css" rel="stylesheet">
	<link href='<?php echo base_url(); ?>css/animate.min.css' rel='stylesheet'>
   <?php /*?> <link href='/<?php echo base_url(); ?>css/scroll.css' rel='stylesheet'><?php */?>
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.dataTables.min.css">

  	
    <link href='<?php echo base_url(); ?>bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href="<?php echo base_url(); ?>css/charisma-app.css" rel="stylesheet">

	<script src="<?php echo base_url(); ?>jquery/jquery.min.js"></script>
     <script src="<?php echo base_url(); ?>js/aes.js"></script>
<script src="http://www.myersdaily.org/joseph/javascript/md5.js"></script>
     <script src="<?php echo base_url(); ?>js/jquery.redirect.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src='<?php echo base_url(); ?>js/jquery.dataTables.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/timepicker.css">

<script src='<?php echo base_url(); ?>bower_components/moment/min/moment.min.js'></script>
    <script src="<?php echo base_url(); ?>assets/timepicker.js"></script>
    <script src="<?php echo base_url(); ?>include/cekfield.js"></script>

<?php /*?><script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script><?php */?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>Styles/kendo.common.min.css">
	<link href="<?php echo base_url(); ?>Styles/kendo.default.min.css" rel="stylesheet">



	<script src="<?php echo base_url(); ?>jskendo/kendo.all.min.js"></script>


  <!-- Google Font -->

<script type="text/javascript">

					$(document).ready(function() {
					
            $('#simpan').on('click', function(){
   
              var baru = $("#passbaru").val(); 
               var lama = $("#passlama").val(); 
               var passbaru=md5(baru);
               var passlama=md5(lama);
               //var passbaru=baru;
               //var passlama=lama;
               var user='<?php  echo $this->session->userdata('userid'); ?>';
              

              
              
               $.ajax({
                 url : "./cadduser/updatepassword",
                 type: "get",
                  data:{passbaru:passbaru,user:user,passlama:passlama},
                 async: true,
                 dataType: "json",
                 success: function(data)
                   {
                     if (data==1)
                      {
                        alert('Update Password Success');
                        window.location = '<?php echo base_url(); ?>login/logout';
                        }
                    else
                    {
                      alert('Update Password Failed');
                    }
                      
                     
                     
                   }
                 });
             });
						
  });
  </script>

</head>
<body class="hold-transition skin-red sidebar-collapse ">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>UN</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>MARVEL</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu" >
        <ul class="nav navbar-nav" >
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu" style="display:none" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>            </a>
            <ul class="dropdown-menu" >
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url(); ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url(); ?>dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url(); ?>dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url(); ?>dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url(); ?>dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- Tasks: style can be found in dropdown.less -->
          <li >
            <a href="" lass="btn btn-default btn-flat" data-toggle="modal" data-target="#mylogin">
              <i class="fa fa-lock" style="font-size:18px;color:white"></i>
              <span class="label label-danger"></span>           </a>
            
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('username');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('username');?>
                  <small>Bergabung Sejak <?php echo $this->session->userdata('masuk');?></small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#contact-modal">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>login/logout" class="btn btn-default btn-flat"  >Sign out</a>
                  
                         
                  
                  
                  
                  
                  
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('admin_nama');?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
          </span>
        </div>
        
        
</form>
<!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>


				<li class="treeview">
                                              <a href="#">
                                                <i class="fa fa-files-o"></i>
                                                <span>Master</span>
                                                <span class="pull-right-container"></span>
                                                
                                              <ul class="treeview-menu">  
                                              <li>
                                                      <a href="<?php echo base_url(); ?>cstandardgramasi/tampil">
                                                      <i class="fa fa-files-o"></i>
                                                      <span>Standard Gramasi</span>
                                                    
                                                      </a>
                                                   </li>

                                                   
                                                   
                                        
                                            </ul>
                                        </li>  


        		 <li class="treeview">
                                               <a href="#">
                                                <i class="fa fa-files-o"></i>
                                                <span>Receiving</span>
                                                <span class="pull-right-container"></span>
                                                
                                              <ul class="treeview-menu">  
                                                    <li>
                                                      <a href="<?php echo base_url(); ?>cmovement/tampil">
                                                      <i class="fa fa-files-o"></i>
                                                      <span>Movement Fab</span>
                                                    
                                                      </a>
                                                      <a href="<?php echo base_url(); ?>cmovementAcc/tampil">
                                                      <i class="fa fa-files-o"></i>
                                                      <span>Movement Acc</span>
                                                      </a>
                                                   </li>  
                                        
                                            </ul>
                                        </li>    
			 <li class="treeview">
                                              <a href="#">
                                                <i class="fa fa-files-o"></i>
                                                <span>Fixed Asset</span>
                                                <span class="pull-right-container"></span>
                                                
                                              <ul class="treeview-menu">  
                                              <li>
                                                       <a href="<?php echo base_url(); ?>cregistrasiasset/tampil">
                                                      <i class="fa fa-files-o"></i>
                                                     <span>Low Value Asset</span>
                                                    
                                                      </a>
                                                   </li>
                                                   <li>
                                                      <a href="<?php echo base_url(); ?>cfixedassets/tampil">
                                                      <i class="fa fa-files-o"></i>
                                                      
							<span>Transaction Asset</span>
                                                    
                                                      </a>
                                                   </li>

                                                   
                                                   
                                        
                                            </ul>
                                        </li> 

                                        <li class="treeview">
                                              <a href="#">
                                                <i class="fa fa-files-o"></i>
                                                <span>Cutting Report</span>
                                                <span class="pull-right-container"></span>
                                                
                                              <ul class="treeview-menu">  
                                              <li>
                                                       <a href="<?php echo base_url(); ?>ccalculationplan/tampil">
                                                      <i class="fa fa-files-o"></i>
                                                     <span>Calculation Plan</span>
                                                    
                                                      </a>
                                                   </li>
                                            </ul>
                                        </li> 
			     
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  
      <div class="content-wrapper">
           <div id ="right" style="display:none" >
                <?php $this->load->view('admin/external');  ?>
            </div>
     
      <?php
	   $this->load->view('admin/'.$page); ?>
    
  </div>
 <script>$('#form2').prepend(right);</script>

  
 
<!-- ./wrapper -->

<!-- jQuery 3 -->


<script src="<?php echo base_url(); ?>bower_components/morris.js/morris.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!--<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>-->
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
	

<!-- Sparkline -->

<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->






<script src="<?php echo base_url(); ?>js/jquery.cookie.js"></script>
<!-- calender plugin -->


<!-- data table plugin -->
<?php /*?><script src='/sunson/admin/js/jquery.dataTables.min.js'></script><?php */?>

<!-- select or dropdown enhancer -->
<script src="<?php echo base_url(); ?>bower_components/chosen/chosen.jquery.min.js"></script>

<script src="<?php echo base_url(); ?>bower_components/colorbox/jquery.colorbox-min.js"></script>


<!-- star-empty rating plugin -->
<script src="<?php echo base_url(); ?>js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?php echo base_url(); ?>js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?php echo base_url(); ?>js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?php echo base_url(); ?>js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?php echo base_url(); ?>js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="<?php echo base_url(); ?>js/charisma.js"></script>
<script>
	userid =  "<?php echo $this->session->userdata('userid'); ?>"
	username = "<?php echo $this->session->userdata('username'); ?>"
		
</script>

            
              
                
               
<div id="mylogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 20px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ganti Password</h4>
      </div>
      <div class="modal-body">
        <form name="form">
    <div class="form-group">
      <label for="exampleInputEmail1">Old Password</label>
      <input type="text" class="form-control" id="passlama" placeholder="Old Password">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">New Password</label>
      <input type="text" class="form-control" id="passbaru" placeholder="New Password">
    </div>
  </form>
      </div>
      <div class="modal-footer">
       <button type="button" id="simpan" class="btn btn-success" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>

