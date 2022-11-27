
   <script type="text/javascript">
					
		$(document).ready(function(){ 
			
				var row = 0;
		     $( window ).on( "load", function() {
				$.ajax({
					 url : "./admin/hideshowdashboard",
					 type: "get",
					 data:{},
					 async: true,
					 dataType: "json",
					 success: function(data)
						 {
							
						  var i;
						  
							for (i = 0; i < data.length; i++)
								{
									
									$("#"+data[i].filename).show();
								}
						 }
					 });

			});
			
		});
</script>
<style type="text/css">


table {
    border-collapse: separate;
    border-spacing: 0 5px;
}

thead th {
    background-color: #006DCC;
    color: white;
}

tbody td {
    background-color: #EEEEEE;
}

tr td:first-child,
tr th:first-child {
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
}

tr td:last-child,
tr th:last-child {
    border-top-right-radius: 6px;
    border-bottom-right-radius: 6px;
}
</style>
    <!-- topbar starts -->
 <div id="content" class="">
            <!-- content starts -->
     <div>
        <ul class="breadcrumb" >
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Dashboard</a>
            </li>
        </ul>
    </div>
<div class=" row"  style="margin-top:-18px">
<div class="box col-md-12"  >
        <div class="box-inner" >
            <div class="box-header well" data-original-title="" >
                <h2><i class="glyphicon glyphicon-edit"></i> DASHBOARD</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
               <div class="row">
    <div class="box col-md-4" id="absen" style="display:none">
    
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>Jadwal</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content buttons">
						<div id="wrapper">
                            <div >
                                <div class="row">
                                
                                  <div class="col-sm-0" style="margin-left:15px;margin-right:15px" >
                                                        <div class="box-inner" style=" width:100%">
                                                            <div style="height:275px; margin-right:5px; margin-left:5px">
                                                     <table  cclass="table"  cellspacing="0" width="100%" >
                                                     <thead
                                                       <tr style="font-weight:bold">
                                                       <td bgcolor="#CCCCCC" width="50px"><div align="center">No</div></td>
                                                       <td bgcolor="#CCCCCC" width="100px"><div align="center">Tgl</div></td>
                                                       <td bgcolor="#CCCCCC" width="100px"><div align="center">NIK</div></td>
                                                       <td bgcolor="#CCCCCC" width="100px"><div align="center">Nama</div></td>
                                                       <td bgcolor="#CCCCCC"><div align="center">Departemen</div></td>
													 </thead>
                                                            
                                                      <tbody>
															<?php /*?><?php  
                                                               $no = 1;
                                                                foreach ($mangkir as $lihat):
                                                             ?>
                                                              <tr>
                                                                  <td><?php echo $no++ ?></td>
                                                                  <td><?php echo $lihat->tgl ?></td>
                                                                  <td><?php echo $lihat->nik ?></td>
                                                                  <td><?php echo $lihat->nama ?></td>
                                                                  <td><?php echo $lihat->departemen?></td>


                                                              </tr>
                                                               <?php endforeach ?><?php */?>
                                                       </tbody>
                                                 </table>
                                                        		</div>
                                                         </div>
                                                </div>
                    
        						</div>
                            
                           
                            
                         </div>
                          
                    </div>
                </div>

               
            </div>
        </div>
       <!--/span-->
        
        <div class="box-content">
               <div class="row" style="margin-left:-10px;margin-right:-10px">
    <div class="box col-md-4" id="jadwal" style="display:none">
    
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>Absensi</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content buttons">
						<div id="wrapper">
                            <div >
                                <div class="row">
                                
                                  <div class="col-sm-0" style="margin-left:15px;margin-right:15px" >
                                                        <div class="box-inner" style=" width:100%">
                                                            <div style="height:275px; margin-right:5px; margin-left:5px">
                                                     <table  cclass="table"  cellspacing="0" width="100%" >
                                                     <thead
                                                       <tr style="font-weight:bold">
                                                       <td bgcolor="#CCCCCC" width="50px"><div align="center">No</div></td>
                                                       <td bgcolor="#CCCCCC" width="100px"><div align="center">Tgl</div></td>
                                                       <td bgcolor="#CCCCCC" width="100px"><div align="center">NIK</div></td>
                                                       <td bgcolor="#CCCCCC" width="100px"><div align="center">Nama</div></td>
                                                       <td bgcolor="#CCCCCC"><div align="center">Departemen</div></td>
													 </thead>
                                                            
                                                      <tbody>
															<?php /*?><?php  
                                                               $no = 1;
                                                                foreach ($mangkir as $lihat):
                                                             ?>
                                                              <tr>
                                                                  <td><?php echo $no++ ?></td>
                                                                  <td><?php echo $lihat->tgl ?></td>
                                                                  <td><?php echo $lihat->nik ?></td>
                                                                  <td><?php echo $lihat->nama ?></td>
                                                                  <td><?php echo $lihat->departemen?></td>


                                                              </tr>
                                                               <?php endforeach ?><?php */?>
                                                       </tbody>
                                                 </table>
                                                        		</div>
                                                         </div>
                                                </div>
                    
        						</div>
                            
                           
                            
                         </div>
                          
                    </div>
                </div>

               
            </div>
        </div>
    </div>
    <!--/span-->

    </div>
    <!--/span-->
    
    <div class="box-content">
               <div class="row" style="margin-left:-10px;margin-right:-10px">
    <div class="box col-md-4" id="absen" style="display:none">
    
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>Absensi</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content buttons">
						<div id="wrapper">
                            <div >
                                <div class="row">
                                
                                  <div class="col-sm-0" style="margin-left:15px;margin-right:15px" >
                                                        <div class="box-inner" style=" width:100%">
                                                            <div style="height:275px; margin-right:5px; margin-left:5px">
                                                     <table  cclass="table"  cellspacing="0" width="100%" >
                                                     <thead
                                                       <tr style="font-weight:bold">
                                                       <td bgcolor="#CCCCCC" width="50px"><div align="center">No</div></td>
                                                       <td bgcolor="#CCCCCC" width="100px"><div align="center">Tgl</div></td>
                                                       <td bgcolor="#CCCCCC" width="100px"><div align="center">NIK</div></td>
                                                       <td bgcolor="#CCCCCC" width="100px"><div align="center">Nama</div></td>
                                                       <td bgcolor="#CCCCCC"><div align="center">Departemen</div></td>
													 </thead>
                                                            
                                                      <tbody>
															<?php /*?><?php  
                                                               $no = 1;
                                                                foreach ($mangkir as $lihat):
                                                             ?>
                                                              <tr>
                                                                  <td><?php echo $no++ ?></td>
                                                                  <td><?php echo $lihat->tgl ?></td>
                                                                  <td><?php echo $lihat->nik ?></td>
                                                                  <td><?php echo $lihat->nama ?></td>
                                                                  <td><?php echo $lihat->departemen?></td>


                                                              </tr>
                                                               <?php endforeach ?><?php */?>
                                                       </tbody>
                                                 </table>
                                                        		</div>
                                                         </div>
                                                </div>
                    
        						</div>
                            
                           
                            
                         </div>
                          
                    </div>
                </div>

               
            </div>
        </div>
    </div>
    <!--/span-->

    </div>
    <!--/span-->
    

    
</div><!--/row-->
     
                   
</div>

<!--/row-->
<!--/row-->
<!-- content ends -->
        </div>



            </div>
        </div>
    </div>
