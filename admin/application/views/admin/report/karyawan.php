<script type="text/javascript">
$(document).ready(function(){
    $('#preview').click(function(){
       
	test1=document.getElementById("table_search").value;

	window.location="<?php echo base_url(); ?>report/ckaryawan/preview?field="+test1;
	
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
                <a href="#">Report Karyawan</a>
            </li>
        </ul>
    </div>

 	<div class=" row"  style="margin-top:-18px">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Report Karyawan</h2>

       
    </div>
    <div class="box-content">
		

                
                  <div class="box-tools" style="float:right">
                     <form id="form2" name="form2" method="POST" action="<?php echo base_url(); ?>report/ckaryawan/tampil"  >
      
                    <div class="input-group" style="width: 150px; margin-top:0px; padding-right:-10px">
                      <span class="input-group" style="width: 150px; margin-top:0px; padding-right:-10px">
                      <input type="text" name="table_search" id="table_search" class="form-control input-sm pull-right" placeholder="Search"  />
                      </span>
                      <div class="input-group-btn" >
                       <button id="btnsrch"  class="btn btn-sm btn-default"><i class="fa fa-search"></i> </button>
                      </div>
                      
                    </div>
                    
                  </div>
                  
              
 				<div style="width:100px; margin-top:-20px" >
                  <h3 >
                  	<a href="#" id="preview" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-edit"></i> Preview</a>
                  </h3>
                   </div><!-- /.box-header -->
</form>
            <table  id="mytable" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        
                        <th>NIK</th>
                        <th>No. KTP</th>
                        <th>No. KPJ</th>
                        <th>No. BPJS TK</th>
                        <th>Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>JK</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Divisi</th>
                        <th>HP</th>
                        <th>Pendidikan</th>
                        <th>Jabatan</th>
                        
                        <th>Departemen</th>
                        <th>Job Desk</th>
                        <th>Group</th>
                        <th>Tanggal Masuk</th>
                        
                        
                        <th>Tanggal Diangkat</th>
                        <th>Tanggal Keluar</th>
                       
                         
                  
                        
                        
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
			
				var dataTable =  $('#mytable').DataTable( {
					pageResize: true,  // page resize di aktifkan
					/*processing: true,*/

					serverSide: true,

					ajax: {"url": "<?php echo base_url(); ?>report/ckaryawan/json", "type": "POST","data":{"field":field1},},
                   
					"bFilter": false,
					"bLengthChange": false,
					iDisplayLength: 100,
					scrollY:        '50vh',
				
				});
						
				
			} );

					 
						 
			
		</script>
			
