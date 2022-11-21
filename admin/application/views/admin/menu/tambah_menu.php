<!-- Content Wrapper. Contains page content -->

<script type="text/javascript">
					$(document).ready(function() {
						 var hgt;
						 var frm;
						 var taskb = document.documentElement.clientHeight;
						 hgt = taskb -174;
						 showfield();
						   $('#groupinput').height(hgt-115);
						   $('#simpan').on('click', function(){
								save();
							});
							$('#add').on('click', function(){
								window.location = '<?php echo base_url(); ?>cmenu/tambah_menu';
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
                <a href="#">Menu Utama</a>
            </li>
            <li>
                <a href="#">Tambah</a>
            </li>
        </ul>
    </div>

<div class=" row"  style="margin-top:-18px">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Menu Utama</h2>

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
     
                         <input type="hidden" name="idmenu" value="">
                         
                        
                           <label for="exampleInputEmail1">Kode</label>
                         <input type="text" class="form-control" name="code"  id="code" placeholder="Kode Menu"/>
    
                        <label for="exampleInputEmail1">Menu</label>
                          <input type="text" class="form-control" name="nameof" id="nameof"   placeholder="Menu"/>
                          
                         <label for="exampleInputEmail1">Page</label>
                           <input type="text" class="form-control" name="page" id="page"  placeholder="Page"/>
                           <label for="exampleInputEmail1">Icon</label>
                          <input type="text" class="form-control" name="icon" id="icon"   placeholder="Icon"/>

                          <label for="exampleInputEmail1">Sub Menu</label>
                          <select name="submenu" id="submenu" class="form-control">
                          	  <option value="">Select Item</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                             
                          </select> 
                         
                         
     
                        </div>
                 
                  
                  <input type="hidden" name="id" >
                  <a href="<?php echo base_url(); ?>cmenu/tampil" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Batal</a>
                  <button type="button" name="simpan" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                  <button type="button" name="add" id="add" class="btn btn-danger"><i class="fa fa-retweet"></i> Add</button>

                </form>
        </div>

            </div>
        </div>
    </div>
    </div>