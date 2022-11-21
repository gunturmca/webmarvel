<!-- Content Wrapper. Contains page content -->
 <script src="<?php echo base_url(); ?>js/aes.js"></script>
 <script src=".././popup/pelanggaran/karyawan.js"></script>
<script type="text/javascript">

					$(document).ready(function() {
						
							 var hgt;
							 var frm;
							 var taskb = document.documentElement.clientHeight;
							 hgt = taskb -174
							 $('#groupinput').height(hgt-76);
							 
							 $('#simpan').on('click', function(){
							 	    
									save();
							  });
							 $('#add').on('click', function(){
									tambah();
								});
								
							 $("#username").click(function(){
								
								frmsearh_penduduk();
								 var window = $('#window').data('kendoWindow');
  									window.title("Karyawan");
								});	
							
							$("#table_search1").keypress(function(){

									 	{keypress(); }
									
								});
								
								
								
								
						 });
						  
						  function keypress()
						  {
						  	var keyPressed = event.keyCode || event.which;
							if (keyPressed==13)
								{
									event.preventDefault();
									tampil();
								}
						  }
						  

							
							function checkbox() {
						  // Get the checkbox
						  var checkBox = document.getElementById("aktif");
						  if (checkBox.checked == true){
							checkBox.value = "1";
							
						  } else {
							checkBox.value = "0";
						  }
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
                <a href="#">user</a>
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
        <h2><i class="glyphicon glyphicon-user"></i> Tambah User</h2>

        <div class="box-icon">
            
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
     <div id="window" style="margin:1px;padding:1px;display: none" >
                           <div class="input-group" style="width: 100%; margin-top:0px; padding-right:-10px">
                              <span class="input-group" style="width: 100%; margin-top:0px; padding-right:-10px">
                              
                                            <input type="text" name="table_search1" onKeyPress="" id="table_search1"  
                                                class="form-control input-sm pull-right" placeholder="Search" style="width:100%;"/>
                              </span>
                              <div class="input-group-btn" >
                                   <button id="btnsrch" type="button" onClick="tampil()"  class="btn btn-sm btn-default" 
                                        style=" margin-left:2px"><i class="fa fa-search" ></i> </button>
                              </div>
                          </div>
                            <div id="grid1" style="margin-top:2px;" ></div>
                            

   						 </div>
                <!-- form start -->
 <div id="groupinput" class="form-group" style="overflow:auto; margin:0 0 10px 0;"> 
                <!-- form start -->
                 
                 <form id="form2" name="form2" method="" action=""  >
               
 
                           <label for="exampleInputEmail1">NIK </label>
                         <input type="text" class="form-control" name="nik"  disabled id="nik" placeholder="NIK"/>
    					
                        
                           <div style="margin-top:24px;  float:right; margin-right:3px">
                    	
                               <button id="username" type="button"   class="btn btn-sm btn-default" style=" 
                           		margin-left:2px; height:35px"><i class="fa fa-search" ></i> </button>
                            </div>
                          <div style=" margin-right:43px">
                              <label for="exampleInputEmail1">Karyawan</label>
                              <input type="text" class="form-control" name="nama" id="nama"   placeholder="Karyawan" />
                    		</div>
                            
                        <label for="exampleInputEmail1">User Name</label>
                          <input type="text" class="form-control" name="username" id="username"   placeholder="User Name"/>
                        <label for="exampleInputEmail1">Passowrd</label>
                          <input type="text" class="form-control" name="password" id="password"   placeholder="Password"/>
                        

                          
     
                        </div>
                         <input type="text" class="form-control" name="idkaryawan" id="idkaryawan"   placeholder="" style="display:none"/>
                      <a href="<?php echo base_url(); ?>cuser/tampil" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
                      <button type="button" name="simpan" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                      <button type="button" name="add" id="add" class="btn btn-danger"><i class="fa fa-retweet"></i> Add</button>
                      
              
              </form>
               
        </div>

            </div>
        </div>
    </div>
    </div>
        
         