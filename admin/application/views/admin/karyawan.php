



 <div id="content" class="">
            <!-- content starts -->
     <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url();?>admin">Home</a>
            </li>
            <li>
                <a href="#">Karyawan</a>
            </li>
        </ul>
    </div>

 	<div class=" row"  style="margin-top:-18px">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Karyawan</h2>

       
    </div>
    <div class="box-content">
		

                
                  <div class="box-tools" style="float:right">
                     <form id="form2" name="form2" method="POST" action="<?php echo base_url(); ?>ckaryawan/tampil"  >
      
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
                  	<a href="<?php echo base_url(); ?>ckaryawan/tambah_karyawan" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-edit"></i> Tambah</a>
                  </h3>
                   </div><!-- /.box-header -->
</form>
            <table  id="mytable" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        
                        <th width="68">Action</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>JK</th>
                        
                        <th>Jabatan</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Pendidikan</th>
                        <th>Jurusan</th>
                        <th>Lulusan</th>
                        <th>Email</th>
 						<th >Resign</th>
                        
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

					ajax: {"url": "<?php echo base_url(); ?>ckaryawan/json", "type": "POST","data":{"field":field1},},
                   
					"bFilter": false,
				"bLengthChange": false,
				
				iDisplayLength: 100,
				scrollX: true,
				scrollCollapse: true,
				scrollY:        '50vh',
				});
						
				
			} );
			
					
			
		</script>
			
