<!-- Content Wrapper. Contains page content -->

<script type="text/javascript">
					$(document).ready(function() {
						 var hgt;
						 var frm;
						 var taskb = document.documentElement.clientHeight;
						 hgt = taskb -174;
						 showcombo('../urlcmb?link=<?php echo encrypt_url("SELECT code as id, nameof as nama FROM sysappmenu") ;?>','fcode');
						
						 $( window ).on( "load", function() {
								 showfield();

							});
						   $('#groupinput').height(hgt-115);
						   $('#simpan').on('click', function(){
								update();
							});
							$('#add').on('click', function(){
								window.location = '<?php echo base_url(); ?>csubmenu/tambah_submenu';
							});
						  });
						  
						  
						  function checkbox() 
						  {
							  // Get the checkbox
							  var checkBox = document.getElementById("aktif");
							  if (checkBox.checked == true)
								{checkBox.value = "1";} 
							  else 
								{checkBox.value = "0"; }
						  }
						  
						  </script>
 <div id="content" class="">
            <!-- content starts -->
     <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>

            <li>
                <a href="#">Edit Sub Menu</a>
            </li>
        </ul>
    </div>

 <div class=" row"  style="margin-top:-18px">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Edit Sub Menu </h2>

        <div class="box-icon">
            
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
                <!-- form start -->
 <div  id="groupinput" class="form-group" style="overflow:auto; margin:0 0 10px 0;"> 
                <!-- form start -->
               
              <form id="form2" name="form2" method="" action=""  >
                        <input type="hidden" name="idmenuitem" value="">
                         

                           
    
                        <label for="exampleInputEmail1">Menu</label>
                           <select name="focde" id="fcode" class="form-control"></select> 
                         <label for="exampleInputEmail1">Kode Menu Item</label>
                           <input type="text" class="form-control" name="code" id="code"  placeholder="Kode Menu Item"/>
                          <label for="exampleInputEmail1">Menu Item</label>
                           <input type="text" class="form-control" name="nameof" id="nameof"  placeholder="Menu Item"/> 
                          <label for="exampleInputEmail1">File Name</label>
                          <input type="text" class="form-control" name="filename" id="filename"  placeholder="File Name"/> 
 
                          <label for="exampleInputEmail1">Icon</label>
                          <input type="text" class="form-control" name="icon" id="icon"  placeholder="Icon"/>
     
     
                        </div>
                 
                  
                  <input type="hidden" name="id" >
                  <a href="<?php echo base_url(); ?>csubmenu/tampil" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Batal</a>
                  <button type="button" name="simpan" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                  <button type="button" name="add" id="add" class="btn btn-danger"><i class="fa fa-retweet"></i> Add</button>

                </form>
        </div>

            </div>
        </div>
    </div>
    </div>