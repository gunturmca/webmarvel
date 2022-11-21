<!-- Content Wrapper. Contains page content -->

<script type="text/javascript">
					$(document).ready(function() {
						 var hgt;
						 var frm;

						 var taskb = document.documentElement.clientHeight;
						 hgt = taskb -174;
						 
						showcombo('../urlcmb?link=<?php echo encrypt_url("SELECT idpendidikan as id, pendidikan nama FROM tpendidikan") ;?>','idpendidikan');
						showcombo('../urlcmb?link=<?php echo encrypt_url("SELECT idjabatan as id, jabatan nama FROM tjabatan") ;?>','idjabatan');  
						showcombo('../urlcmb?link=<?php echo encrypt_url("SELECT  id, name as  nama FROM provinces order by name") ;?>','idpropinsi');
					  
						
	
						 $( window ).on( "load", function() {
								 showfield1();

							});
							
							
						   $('#groupinput').height(hgt-76);
						   $('#simpan').on('click', function(){
							   
								update();
							});
							$('#add').on('click', function(){
								window.location = '<?php echo base_url(); ?>ckaryawan/tambah_karyawan';
							});
							
							
							 $('#idpropinsi').change(function(){
						
							var id=$(this).val();
							$.ajax({
							  url : "../getkota",
							  type: "get",
							  data:{id:id},
							  async: true,
							  dataType: "json",
							  success: function(data)
								  {
									 
									  var html='';
									  var i;
									 html += '<option value=' + "0" + '>' + "Select Item" + '</option>';
									  for (i = 0; i < data.length; i++)
									  {
										  html += '<option value='+ data[i].id+ '>' + data[i].name + '</option>';
										  }
										  
									  $('#idkota').html(html);
								  }
							  });
								
						 });
								
					
							
							
							

						$('#form2').submit(function(e){
							e.preventDefault(); 
								 $.ajax({
									 url:'<?php echo base_url(); ?>ckaryawan/upload',
									 type:"post",
									 data:new FormData(this),
									 processData:false,
									 contentType:false,
									 cache:false,
									 async:false,
									  success: function(data){
										  
								   }
								 });
							});  
							
							
							
							
						 <!--batas propinsi-->
						 $('#idkota').change(function(){
						
							var id=$(this).val();
							$.ajax({
							  url : "../getkecamatan",
							  type: "get",
							  data:{id:id},
							  async: true,
							  dataType: "json",
							  success: function(data)
								  {
									 
									  var html='';
									  var i;
									 html += '<option value=' + "0" + '>' + "Select Item" + '</option>';
									  for (i = 0; i < data.length; i++)
									  {
										  html += '<option value='+ data[i].id+ '>' + data[i].name + '</option>';
										  }
										  
									  $('#idkecamatan').html(html);
								  }
							  });
								
						 });
						 <!--batas kota-->
						 $('#idkecamatan').change(function(){
						
							var id=$(this).val();
							$.ajax({
							  url : "../getdesa",
							  type: "get",
							  data:{id:id},
							  async: true,
							  dataType: "json",
							  success: function(data)
								  {
									 
									  var html='';
									  var i;
									 html += '<option value=' + "0" + '>' + "Select Item" + '</option>';
									  for (i = 0; i < data.length; i++)
									  {
										  html += '<option value='+ data[i].id+ '>' + data[i].name + '</option>';
										  }
										  
									  $('#iddesa').html(html);
								  }
							  });
								
						 });
						 <!--batas kecamatan->
							
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
                <a href="<?php echo base_url(); ?>ckaryawan/tampil">Edit Karyawan</a>
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
        <h2><i class="glyphicon glyphicon-user"></i> Edit Karyawan </h2>

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
               
             <form id="form2" name="form2" enctype="multipart/form-data"  method="post" accept-charset="utf-8" action="" >
                    <div class="box-header well" data-original-title="" style="margin-right:4px">
                        <h2><i class="glyphicon glyphicon-user"></i> Data Karyawan</h2>
                
                        <div class="box-icon">
                            
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                    class="glyphicon glyphicon-chevron-up"></i></a>
                            <!--<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>-->
                        </div>
                    </div>
                    <div class="box-content">
 
                        <div style="margin-top:24px;  float:right">
                    	
                    	<img  src="" width="130px" height="173px" class="thumbnail" name="image" id="photo1" >
                        <input type="file" class="form-control input-sm" name="uploadFile" id="uploadFile"  style="width:130px; margin-top:-31px"  />
                         <input type="text" class="form-control" name="img" id="photo"   placeholder="photo" style="display:none" />
                    </div>
					<div style=" margin-right:135px">
                    	 
                           <label for="exampleInputEmail1">NIK </label>
                         <input type="text" class="form-control" name="nik"  id="nik" placeholder="NIK" alt="NIK"/>
                         
    
                        <label for="exampleInputEmail1">No. KTP</label>
                          <input type="text" class="form-control" name="ktp" id="ktp"   placeholder="No. KTP"/>
                       
                        <label for="exampleInputEmail1">Karyawan</label>
                          <input type="text" class="form-control" name="nmkaryawan" id="nmkaryawan"   placeholder="Karyawan" alt="Nama"/>
                    
                        <label for="exampleInputEmail1">Tempat Lahir</label>
                          <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir"   placeholder="Tempat Lahir"/>
                    </div>
                        <label for="exampleInputEmail1">Tanggal Lahir</label>
                          <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir"   placeholder="Tanggal Lahir" title="date"/>
                        <label for="exampleInputEmail1">Agama</label>
                           <select name="agama" id="agama" class="form-control">
                              <option value="">Select Item</option>
                              <option value="Islam">Islam</option>
                              <option value="Kristen">Kristen</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Budha">Budha</option>
                              <option value="Konghucu">Konghucu</option>
                              <option value="Lainnya">Lainnya</option>
                          </select>
                        <label for="exampleInputEmail1">Jenis Kelamin</label>
                          <select name="jk" id="jk" class="form-control">
                          	  <option value="">Select Item</option>
                              <option value="L">Laki-Laki</option>
                              <option value="P">Perempuan</option>
                             
                          </select> 
                          
                          
                          <label for="exampleInputEmail1">Pendidikan </label>
                          <select name="idpendidikan" id="idpendidikan" class="form-control"></select>
						  <label for="exampleInputEmail1">Jurusan</label>
                          <input type="text" class="form-control" name="jurusan" id="jurusan"   placeholder="Jurusan"/>
                          <label for="exampleInputEmail1">Lulusan</label>
                          <input type="text" class="form-control" name="lulusan" id="lulusan"   placeholder="Lulusan"/>
     
                        </div>
                        <!--batas datakaryawan-->
                        
                        
                        <div class="box-header well" data-original-title="" style="margin-right:4px">
                        <h2><i class="glyphicon glyphicon-user"></i>  Alamat</h2>
                
                        <div class="box-icon">
                            
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                    class="glyphicon glyphicon-chevron-up"></i></a>
                            <!--<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>-->
                        </div>
                    </div>
                    <div class="box-content">
 
                           <label for="exampleInputEmail1">Propinsi</label>
                          <select name="idpropinsi" id="idpropinsi" class="form-control"></select>
                            
                        <label for="exampleInputEmail1">Kota</label>
                           <select name="idkota" id="idkota" class="form-control"></select>
                        <label for="exampleInputEmail1">Kecamatan</label>
                           <select name="idkecamatan" id="idkecamatan" class="form-control"></select>
                         <label for="exampleInputEmail1">Desa</label>
                           <select name="iddesa" id="iddesa" class="form-control"></select>
                        
                         <label for="exampleInputEmail1">Alamat </label>
                         <input type="text" class="form-control" name="alamat"  id="alamat" placeholder="Alamat"/>
    
                        <label for="exampleInputEmail1">Kode POS</label>
                          <input type="text" class="form-control" name="kdpos" id="kdpos"   placeholder="Kode POS"/>
                        <label for="exampleInputEmail1">No. Telp</label>
                          <input type="text" class="form-control" name="tlp" id="tlp"   placeholder="No. Telp"/>
                        
                        
                       
                        
                        </div>
                         <!--batas dalamat-->
                         
                         <div class="box-header well" data-original-title="" style="margin-right:4px">
                        <h2><i class="glyphicon glyphicon-user"></i> Perusahaan</h2>
                
                        <div class="box-icon">
                            
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                    class="glyphicon glyphicon-chevron-up"></i></a>
                            <!--<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>-->
                        </div>
                    </div>
                  <div class="box-content">
 
                        
    
                        <label for="exampleInputEmail1">Jabatan</label>
                          <select name="idjabatan" id="idjabatan" class="form-control" title="Jabatan"></select>

                        <label for="exampleInputEmail1">Tanggal Masuk</label>
                         <input type="text" class="form-control" name="tgl_masuk" id="tgl_masuk"   placeholder="Tanggal Masuk" title="date" alt="Tanggal Masuk"/>
                         
                        <label for="exampleInputEmail1">Tanggal Keluar</label>
                          <input type="text" class="form-control" name="tgl_keluar" id="tgl_keluar"   placeholder="Tanggal Keluar" title="date"/>
                        
                        
                        

                       
                        </div>

                      
                    </div>
                    
                      <a href="<?php echo base_url(); ?>ckaryawan/tampil" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
                       <input type="text" name="password" id="password"  style="display:none" >
                      <button type="submit" name="simpan" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                      <button type="button" name="add" id="add" class="btn btn-danger"><i class="fa fa-retweet"></i> Add</button>
                      
              
              </form>
        </div>

            </div>
        </div>
    </div>
    </div>
    
    <script>
    function changeProfile() {
        $('#uploadFile').click();
    }
    $('#uploadFile').change(function () {
        var imgPath = this.value;
        var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
            readURL(this);
			
        else
            alert("Please select image file (jpg, jpeg, png).")
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#photo1').attr('src', e.target.result);
				document.getElementById("photo").value ="/assets/imgkaryawan/" + input.files[0].name	 ;
//              $("#remove").val(0);
            };
        }
    }
    function removeImage() {
        $('#photo').attr('src', 'noimage.jpg');
//      $("#remove").val(1);
    }
</script>