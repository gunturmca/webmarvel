

			<script type="text/javascript">

					$(document).ready(function() {
						
							 var hgt;
							 var frm;
							 var taskb = document.documentElement.clientHeight;
							 hgt = taskb -174
							 $('#groupinput').height(hgt);
							
							
							  $('#preview').click(function(){
							  
								test1=document.getElementById("table_search").value;
								tglawal=document.getElementById("tglmulai").value;
								tglakhir=document.getElementById("tglakhir").value;
								window.location="<?php echo base_url(); ?>report/cabsen/preview?field=" + test1 + "&tglawal=" + tglawal + "&tglakhir=" + tglakhir;
								
							 });
							
						 });
						  
							 
						  </script>

 <div id="content" class="">
            <!-- content starts -->
     <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url();?>admin">Home</a>
            </li>
            <li>
                <a href="#">Keahdiran</a>
            </li>
        </ul>
    </div>

 	<div class=" row"  style="margin-top:-18px">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Kehadiran</h2>

       
    </div>
    <div class="box-content" id="groupinput">
		

                
                  <div class="box-tools" style="float:right">
                     <form id="form2" name="form2" method="POST" action="<?php echo base_url();?>report/cabsen/tampil"  >
      	
                    <div class="input-group" style="width: 150px; margin-top:0px; padding-right:-10px">
                      <span class="input-group" style="width: 150px; margin-top:0px; padding-right:-10px">
                      <input type="text" name="table_search" id="table_search"  class="form-control input-sm pull-right" placeholder="Search"  />
                      </span>
                      <div class="input-group-btn" >
                       <button id="btnsrch"  class="btn btn-sm btn-default"><i class="fa fa-search"></i> </button>
                      </div>
                      
                    </div>
                    
                  </div>
                  
              
 				<div style="width:100px; margin-top:-20px"  >
                  <h3 >
                  	<a href="#" id="preview" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-edit"></i> Preview</a>
                  </h3>
                 
                   </div><!-- /.box-header -->
                   <div >
              <div style="margin-right:547px; margin-top:-40px ; float:right">
                        <label class="form-control input-sm pull-righ" style="border:white" >Tanggal</label>
              </div>
                
              <div style="margin-right:195px; margin-top:-40px ; float:right">
                 <input type="text"  name ="tglakhir" id="tglakhir" class="form-control input-sm pull-righ"  title="date" placeholder="Tanggal Terakhir"  />
              </div>
              <div style="margin-right:373px; margin-top:-40px ; float:right; width:10px">
                        <label class="form-control input-sm pull-righ" style="border:white" >-</label>
              </div>
              <div style="margin-right:377px; margin-top:-40px ; float:right">
                    <input type="text" name ="tglmulai" id="tglmulai" class="form-control input-sm pull-righ" title="date"  placeholder="Tanggal Mulai"  />
              </div>
              </div>
</form>
            <table  id="mytable" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                      <th rowspan="2"><div align="center">NIK</div></th>
                      <th rowspan="2"><div align="center">Nama</div></th>
                      <th rowspan="2"><div align="center">Departemen</div></th>
                      <th rowspan="2"><div align="center">Divisi</div></th>
                      <th colspan="2"><div align="center">01</div></th>
                      <th colspan="2"><div align="center">02</div></th>
                      <th colspan="2"><div align="center">03</div></th>
                      <th colspan="2"><div align="center">04</div></th>
                      <th colspan="2"><div align="center">05</div></th>
                      <th colspan="2"><div align="center">06</div></th>
                      <th colspan="2"><div align="center">07</div></th>
                      <th colspan="2"><div align="center">08</div></th>
                      <th colspan="2"><div align="center">09</div></th>
                      <th colspan="2"><div align="center">10</div></th>
                      <th colspan="2"><div align="center">11</div></th>
                      <th colspan="2"><div align="center">12</div></th>
                      <th colspan="2"><div align="center">13</div></th>
                      <th colspan="2"><div align="center">14</div></th>
                      <th colspan="2"><div align="center">15</div></th>
                      <th colspan="2"><div align="center">16</div></th>
                      <th colspan="2"><div align="center">17</div></th>
                      <th colspan="2"><div align="center">18</div></th>
                      <th colspan="2"><div align="center">19</div></th>
                      <th colspan="2"><div align="center">20</div></th>
                      <th colspan="2"><div align="center">21</div></th>
                      <th colspan="2"><div align="center">22</div></th>
                      <th colspan="2"><div align="center">23</div></th>
                      <th colspan="2"><div align="center">24</div></th>
                      <th colspan="2"><div align="center">25</div></th>
                      <th colspan="2"><div align="center">26</div></th>
                      <th colspan="2"><div align="center">27</div></th>
                      <th colspan="2"><div align="center">28</div></th>
                      <th colspan="2"><div align="center">29</div></th>
                      <th colspan="2"><div align="center">30</div></th>
                      <th colspan="2"><div align="center">31</div></th>
                    </tr>
                    <tr>
                      
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                        <th> Masuk</th>
                        <th> Pulang</th>
                    </tr>
                </thead>
            </table>
       
 </div>



            </div>
        </div>
    </div>
    </div>



      
      <script type="text/javascript">

			$(document).ready(function() {
			var field1='<?php echo $field=$this->input->post('table_search');?>';
			var tglawal='<?php echo $field=$this->input->post('tglmulai');?>';
			var tglakhir='<?php echo $field=$this->input->post('tglakhir');?>';
				var dataTable =  $('#mytable').DataTable( {
					pageResize: true,  // page resize di aktifkan
					/*processing: true,*/
					serverSide: true,

					ajax: {"url": "<?php echo base_url(); ?>report/cabsen/json", "type": "POST","data":{"field":field1,"tglawal":tglawal,"tglakhir":tglakhir},},
                   
					"bFilter": false,
				"bLengthChange": false,
				
				iDisplayLength: 100,
				scrollX: true,
				scrollCollapse: true,
				scrollY:        '50vh',
				});
						
				
			} );
			
					
			
		</script>