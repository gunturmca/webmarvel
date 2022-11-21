
<link rel="stylesheet" href="../css/style.min.css" />
<script src="../js/jstree.min.js"></script>
	<script type="text/javascript">
 var idjabatan;
  var nik;
					$(document).ready(function() {
						
							 var hgt;
							 var frm;
							
							
							 var taskb = document.documentElement.clientHeight;
							 hgt = taskb -174
							 $('#groupinput').height(hgt-86);

								 showcombo('./urlcmb?link=<?php echo encrypt_url("SELECT idjabatan as id, jabatan as nama FROM tjabatan") ;?>','iduser');							 
							/* $('#simpan').on('click', function(){
									save();
							  });*/
							 $('#add').on('click', function(){
									tambah();
								});
								
								
							
								
								
								
								$("#iduser").change(function(){
										idjabatan=$(this).val();
						
					
											
												$("#tree-container").jstree().deselect_all(true);
											
												$.ajax({
													  url : "./tandaibox",
													  type: "get",
													  data:{id:idjabatan},
													  async: true,
													  dataType: "json",
													  success: function(data)
														  {
															var i;
															for(i=0; i<data.length; i++){
																	
																$("#tree-container").jstree("check_node",data[i].fcode);
															}
																	
															
														  }
												  
												
												
												
											  
										  });
								});
								
								<!--delete hak akses-->
									$('#ok').click(function(){
									hapus();
									
									setTimeout(simpan, 500)
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
						  

							
									function hapus()
										{
											$.ajax({
											  url : "./hapushakakses",
											  type: "post",
											  data:{id:idjabatan},
											  async: true,
											  dataType: "json",
											  success: function(data)
												  {
													
													
												  }
										  });
										}
									function simpan()
									
									{
										var arr = [];
										var checked_ids = []; 
												var selectedNodes = $('#tree-container').jstree("get_selected", true);
												var userid = '<?php echo $this->session->userdata('idkaryawan');?>';
												
												$.each(selectedNodes, function() {
													checked_ids.push(this.id);
														<!--tambah hak akses-->
														if (this.id != ''  && idjabatan != '')
														  {
																  arr.push({
																		idjabatan:idjabatan,
																		fcode:this.id,
																		
																		
																	  });	  
															}
													
												});
												var arr= JSON.stringify(arr);	
												$.ajax({
														url : '<?php echo base_url(); ?>chakakses/simpandtl',
														type: "get",
														data:{arr:arr},
														dataType: "json",
														success: function(data)
															{
																	alert("Data Tersimpan");
																	
															}
														});
														
										
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
                <a href="#" >Hak Akses</a>
            </li>
          
        </ul>
    </div>

    <div class=" row"  style="margin-top:-18px">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Hak Akses</h2>

        <div class="box-icon">
            
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    <div style=" margin-left:80px">
    <select name="iduser" id="iduser" class="form-control" ></select>
    </div>
     <div style="width:100px; margin-top:-54px; margin-bottom:0px" >
                  <h3 id="ok"  >
                  	<a href="#" class="btn btn-sm btn-primary btn-flat" ><i class="fa fa-edit" style="height:18px; margin-top:4px"  ></i> Simpan</a>
                    
                  </h3>
                  
                   </div><!-- /.box-he
                <!-- form start -->
                
 <div id="groupinput" class="form-group" style="overflow:auto; margin:0 0 10px 0;"> 
                <!-- form start -->
                 
                 <div id="tree-container"></div>
                        

                          
     
                        </div>
                     
               
        </div>

            </div>
        </div>
    </div>
    </div>
        
        
    <script type="text/javascript">
$(document).ready(function(){ 
    //fill data to tree  with AJAX call
    $('#tree-container').jstree({
	'plugins': ["wholerow", "checkbox"],
        'core' : {
            'data' : {
                "url" : "../js/response.php",
                "dataType" : "json" // needed only if you do not supply JSON headers
            }
        }
    }) 
	
	
	/*var ajaxResponse = '';
    $.ajax({
    	url 	: 'response.php',
    	async  : false,
    	success : function(response)
    	{
    		ajaxResponse = response;
    	}
    });
    var tree = $("#container");
    tree.html(ajaxResponse);
    tree.jstree({
        plugins: ["checkbox" ], //["wholerow", "checkbox", "json_data", "ui", "themes"]
        'checkbox': {
            three_state: false,
            cascade: 'up'
        }
    });
    tree.jstree(true).open_all();
    $('li[data-checkstate="checked"]').each(function() {
        tree.jstree('check_node', $(this));
    });
    tree.jstree(true).close_all();*/
	
});
</script>