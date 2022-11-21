
   <script type="text/javascript">
 
								 

							
		$(document).ready(function(){ 
		
			var row = 0;
		     $( window ).on( "load", function() {
				
							 idrecord ="<?php echo $this->session->userdata('userid'); ?>";
							 url = "<?php echo base_url(); ?>admin_personal/getjsonshow";
							 
							 
							 setTimeout(function(){
											showfield2(idrecord,url)	
										},500);
				
			});
			$('#simpan').on('click', function(){
							   idrecord ="<?php echo $this->session->userdata('userid'); ?>";
							 	url = "<?php echo base_url(); ?>admin_personal";
								update2(idrecord,url);
							});
			
						showcombo('./admin_personal/urlcmb?link=<?php echo encrypt_url("SELECT idpendidikan as id, pendidikan nama FROM tpendidikan") ;?>','pendidikan_ayah');
						showcombo('./admin_personal/urlcmb?link=<?php echo encrypt_url("SELECT idpendidikan as id, pendidikan nama FROM tpendidikan") ;?>','pendidikan_ibu');
						showcombo('./admin_personal/urlcmb?link=<?php echo encrypt_url("SELECT idpekerjaan as id, pekerjaan nama FROM tpekerjaan") ;?>','pekerjaan_ayah');
						showcombo('./admin_personal/urlcmb?link=<?php echo encrypt_url("SELECT idpekerjaan as id, pekerjaan nama FROM tpekerjaan") ;?>','pekerjaan_ibu');
						showcombo('./admin_personal/urlcmb?link=<?php echo encrypt_url("SELECT  id, name as  nama FROM provinces order by name") ;?>','idpropinsi');
				
				
				
						  
			var dataTable =  $('#mytable').DataTable( {
					pageResize: true,  // page resize di aktifkan
					/*processing: true,*/
					serverSide: true,

					ajax: {"url": "<?php echo base_url(); ?>cpeserta/json", "type": "POST","data":{},},
                   
					"bFilter": false,
				"bLengthChange": false,
				
				iDisplayLength: 100,
				scrollX: true,
				scrollCollapse: true,
				scrollY:        '50vh',
				});
				
				
				$('#angsuran').DataTable( {
			
				scrollY:        '50vh',
				"bFilter": false,
				"bLengthChange": false,
				"aLengthMenu": [
									[25, 50, 100, 200, -1],
									[25, 50, 100, 200, "All"]
								],
				iDisplayLength: -1,
				scrollX: true,
				scrollCollapse: true
			} );
			
			$('#nilaiharian').DataTable( {
			
				scrollY:        '50vh',
				"bFilter": false,
				"bLengthChange": false,
				"aLengthMenu": [
									[25, 50, 100, 200, -1],
									[25, 50, 100, 200, "All"]
								],
				iDisplayLength: -1,
				scrollX: true,
				scrollCollapse: true
			} );
			
			$('#nilaiakhir').DataTable( {
			
				scrollY:        '50vh',
				"bFilter": false,
				"bLengthChange": false,
				"aLengthMenu": [
									[25, 50, 100, 200, -1],
									[25, 50, 100, 200, "All"]
								],
				iDisplayLength: -1,
				scrollX: true,
				scrollCollapse: true
			} );
		
			
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
                <a href="<?php echo base_url(); ?>admin_personal">Dashboard</a>
            </li>
        </ul>
    </div>
<div class=" row"  style="margin-top:-18px">
<div class="box col-md-12"  >
        <div class="box-inner" >
           
      <div class="box-content" style="margin-top:-10px">
               
        
    </div>
        <div class="box-inner" style="margin-left:5px;margin-right:5px">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Data Personal</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content buttons">
						<div id="wrapper">
                            <div >
                                <div class="row">
                                
                                   
                    
        						<div class="col-sm-0" style="margin-bottom:-10px; margin-left:5px; margin-right:5px ; margin-top:-10px">
                                   
                                       <div class="box-content buttons" >
                                                     
                                                     <div class="col-sm-0" >
                                                        <div class="box-inner"  >
                                                            <div style="height:365px; margin-right:5px;margin-left:0px;overflow:auto;">
                                                    			 <form id="form2" name="form2" enctype="multipart/form-data"  method="post" accept-charset="utf-8" action="" >
                    <div class="box-header well" data-original-title="" style="margin-right:4px;">
                        <h2><i class="glyphicon glyphicon-user"></i> Data Pribadi</h2>
                
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
					<div style=" margin-right:135px; margin-top:-5px">
                    	 
                         <label for="exampleInputEmail1">NIP </label>
                         <input type="text" class="form-control" name="nip"  id="nip" placeholder="NIK" alt="NIK"/>
                         
    
                        <label for="exampleInputEmail1">No. KTP</label>
                          <input type="text" class="form-control" name="nik" id="nik"   placeholder="No. KTP"/>
                       
                        <label for="exampleInputEmail1">Peserta</label>
                          <input type="text" class="form-control" name="nama" id="nama"   placeholder="Peserta" alt="Nama"/>
                    
                        <label for="exampleInputEmail1">Tempat Lahir</label>
                          <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir"   placeholder="Tempat Lahir"/>
                    </div>
                        <label for="exampleInputEmail1">Tanggal Lahir</label>
                          <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir"   placeholder="Tanggal Lahir" title="date"/>
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
                          
                  <label for="exampleInputEmail1">Tinggi Badan</label>
                  <input type="text" class="form-control" name="tinggi_badan" id="tinggi_badan"   placeholder="Tinggi Badan "/> 
                  <label for="exampleInputEmail1">Berat Badan</label>
                  <input type="text" class="form-control" name="berat_badan" id="berat_badan"   placeholder="Berat Badan "/>				        		  <label for="exampleInputEmail1">Jarak Dari Rumah</label>
                  <input type="text" class="form-control" name="jarak_dari_rumah" id="jarak_dari_rumah"   placeholder="Jarak Dari Rumah "/>
                  <label for="exampleInputEmail1">Status Tempat Tinggal</label>
                  <input type="text" class="form-control" name="status_tempat_tinggal" id="status_tempat_tinggal"   placeholder="Status Tempat Tinggal "/>
                  <label for="exampleInputEmail1">Status Dalam Keluarga</label>
                  <input type="text" class="form-control" name="status_dalam_keluarga" id="status_dalam_keluarga"   placeholder="Status Dalam Keluarga "/>
                   <label for="exampleInputEmail1">Jumlah Saudara Kandung</label>
                  <input type="text" class="form-control" name="jml_saudara_kandung" id="jml_saudara_kandung"   placeholder="Jumlah Saudara Kandung "/>
                  <label for="exampleInputEmail1">Penyakit Yang Pernah Diderita</label>
                  <input type="text" class="form-control" name="penyakit_pernah_diderita" id="penyakit_pernah_diderita"   placeholder="Penyakit Yang Pernah Diderita "/>
     
                        </div>
                        <!--batas datapeserta-->
                        
                        
                        <div class="box-header well" data-original-title="" style="margin-right:4px">
                        <h2><i class="glyphicon glyphicon-user"></i>  Alamat</h2>
                
                        <div class="box-icon">
                            
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                    class="glyphicon glyphicon-chevron-up"></i></a>
                            <!--<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>-->
                        </div>
                    </div>
                    <div class="box-content" style="margin-right:4px;margin-top:-5px">
 
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
                          <input type="text" class="form-control" name="kode_pos" id="kode_pos"   placeholder="Kode POS"/>
                        <label for="exampleInputEmail1">No. Telp</label>
                          <input type="text" class="form-control" name="tlp" id="tlp"   placeholder="No. Telp"/>
                        
                        
                       
                        
                        </div>
                       
                         <div class="box-header well" data-original-title="" style="margin-right:4px">
                        <h2><i class="glyphicon glyphicon-user"></i> Data Ayah</h2>
                
                        <div class="box-icon">
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        </div>
                    </div>
                  <div class="box-content" style="margin-right:4px;margin-top:-5px">
                        <label for="exampleInputEmail1">Nama </label>
                        <input type="text" class="form-control" name="nmayah"  id="nmayah" placeholder="Nama"/>
                        <label for="exampleInputEmail1">Tanggal Lahir </label>
                        <input type="text" class="form-control" name="tgl_lahir_ayah" id="tgl_lahir_ayah"   placeholder="Tanggal Lahir" title="date"/>
                         <label for="exampleInputEmail1">Pendidikan</label>
                          <select name="pendidikan_ayah" id="pendidikan_ayah" class="form-control" title="Pendidikan"></select>
                         <label for="exampleInputEmail1">Pekerjaan</label>
                         <select name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control" title="Pekerjaan"></select>
                         <label for="exampleInputEmail1">Penghasilan</label>
                         <input type="text" class="form-control" name="penghasilan_ayah"  id="penghasilan_ayah" placeholder="Penghasilan"/>
                         <label for="exampleInputEmail1">No.HP</label>
                         <input type="text" class="form-control" name="hp_ayah"  id="hp_ayah" placeholder="No. HP"/>
                          
                       
                        </div>
                        
                        
                         <div class="box-header well" data-original-title="" style="margin-right:4px">
                        <h2><i class="glyphicon glyphicon-user"></i> Data Ibu</h2>
                
                        <div class="box-icon">
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        </div>
                    </div>
                   <div class="box-content" style="margin-right:4px;margin-top:-5px">
                        <label for="exampleInputEmail1">Nama </label>
                        <input type="text" class="form-control" name="nmayah"  id="nmibu" placeholder="Nama"/>
                        <label for="exampleInputEmail1">Tanggal Lahir </label>
                        <input type="text" class="form-control" name="tgl_lahir_ibu" id="tgl_lahir_ibu"   placeholder="Tanggal Lahir" title="date"/>
                         <label for="exampleInputEmail1">Pendidikan</label>
                          <select name="pendidikan_ibu" id="pendidikan_ibu" class="form-control" title="Pendidikan"></select>
                         <label for="exampleInputEmail1">Pekerjaan</label>
                         <select name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control" title="Pekerjaan"></select>
                         <label for="exampleInputEmail1">Penghasilan</label>
                         <input type="text" class="form-control" name="penghasilan_ibu"  id="penghasilan_ibu" placeholder="Penghasilan"/>
                         <label for="exampleInputEmail1">No.HP</label>
                         <input type="text" class="form-control" name="hp_ibu"  id="hp_ibu" placeholder="No. HP"/>
                          
                       
                        </div>
                        
                        

                       
                 
                    </div>
                    

                    
                     
                       <input type="text" name="password" id="password"  style="display:none" >
                       <div style="margin-left:10px; margin-bottom:10px; margin-top:10px">
                      <button type="button" name="simpan" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Save</button> </div>
                      
                      
              
              </form>
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
        </div>
  

        <!--batas-->
            <div class="box-content" style="margin-left:-10px;margin-right:-10px">
               
        
   
    
    <!--/span-->

    <div class="box col-md-4" id="kehadiran" >
    
        <div class="box-inner" style="margin-bottom:-10px;margin-left:5px;margin-right:5px">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Nilai</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content buttons">
						<div id="wrapper">
                            <div >
                                <div class="row">
                                
                                   
                    
        						<div class="col-sm-6" style="margin-bottom:5px">
                                    <div class="box-inner" >
                                        <div class="box-header well" data-original-title="">
                                            <h2><i class="glyphicon glyphicon-edit"></i>  	Nilai Harian</h2>
                            
                                            <div class="box-icon">
                                                
                                                <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                        class="glyphicon glyphicon-chevron-up"></i></a>
                                               
                                            </div>
                                        </div>
                                       <div class="box-content buttons" >
                                                     
                                                     <div class="col-sm-0" >
                                                        <div class="box-inner"  >
                                                            <div style="height:275px; margin-right:5px;margin-left:5px">
                                                           	  <table id="nilaiharian" width="100%" border="0" height="100%" style="margin-top:5px">
                                                               <thead >
                                                                <tr style="font-weight:bold; color:#000">
                                                                    <th style="background-color:#CCCCCC; color:#000">No</th>
                                                                    <th style="background-color:#CCCCCC; color:#000">Kelas</th>
                                                                    <th style="background-color:#CCCCCC; color:#000">Pelajaran</th>
                                                                    <th style="background-color:#CCCCCC; color:#000"><div align="right">Nilai</div></th>
   
                                                                </tr>
                                                                </thead>
                                                                 <tbody>
																	 <?php  
                                                                       $no = 1;
                                                                        foreach ($datapersonal as $lihat):
                                                                     ?>
                                                                  <tr>
                                                                      <td><?php echo $no++ ?></td>
                                                                      <td><?php echo $lihat->kelas ?></td>
                                                                      <td><?php echo $lihat->nmpelajaran ?></td>
                                                                      <td><div align="right"><?php echo $lihat->nilai?></div></td>
                                                                      
                                                                   </tr>
                                                                  <?php endforeach ?>
                                                                  </tbody>
                                                              </table>

                                                          </div>
                                                        </div>
                                                	</div>
                                                   
                                                     
                                                     
                                                     
                                                     
                                            </div>
                                    </div>
                                    
                          	</div>
                            
                            
                           <div class="col-sm-6" style="margin-bottom:5px">
                                    <div class="box-inner" >
                                        <div class="box-header well" data-original-title="">
                                            <h2><i class="glyphicon glyphicon-edit"></i>  	Nilai Ujian Akhir</h2>
                            
                                            <div class="box-icon">
                                                
                                                <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                        class="glyphicon glyphicon-chevron-up"></i></a>
                                               
                                            </div>
                                        </div>
                                       <div class="box-content buttons" >
                                                     
                                                     <div class="col-sm-0" >
                                                        <div class="box-inner"  >
                                                            <div style="height:275px; margin-right:5px;margin-left:5px;">
                                                           	  <table id="nilaiakhir" width="100%" border="0" height="100%" style="margin-top:5px">
                                                              <thead >
                                                                <tr style="font-weight:bold; color:#000">
                                                                    <th style="background-color:#CCCCCC; color:#000">No</th>
                                                                    <th style="background-color:#CCCCCC; color:#000">Kelas</th>
                                                                    <th style="background-color:#CCCCCC; color:#000">Pelajaran</th>
                                                                    <th style="background-color:#CCCCCC; color:#000">Mendengar</th>
                                                                    <th style="background-color:#CCCCCC; color:#000">Membaca</th>
                                                                    <th style="background-color:#CCCCCC; color:#000">Kosa kata</th>
                                                                    <th style="background-color:#CCCCCC; color:#000">Percakapan</th>
                                                                    
   
                                                                </tr>
                                                                </thead>
                                                                 <tbody>
																	 <?php  
                                                                       $no = 1;
                                                                        foreach ($nilaiakhir as $lihat):
                                                                     ?>
                                                                  <tr>
                                                                      <td><?php echo $no++ ?></td>
                                                                      <td><?php echo $lihat->kelas ?></td>
                                                                      <td><?php echo $lihat->pelajaran ?></td>
                                                                      <td><div align="right"><?php echo $lihat->mendengar?></div></td>
                                                                      <td><div align="right"><?php echo $lihat->membaca?></div></td>
                                                                      <td><div align="right"><?php echo $lihat->kosakata?></div></td>
                                                                      <td><div align="right"><?php echo $lihat->percakapan?></div></td>
                                                                      
                                                                   </tr>
                                                                  <?php endforeach ?>
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
        </div>
        
      <!--  batas yang harus di hapus-->
      
        <div class="box-content" style="margin-top:-5px">
               
        
    </div>
       <div class="box-inner" style="margin-bottom:5px;margin-left:5px;margin-right:5px">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> List Angsuran</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content buttons">
						<div id="wrapper">
                            <div >
                                <div class="row">
                                
                                   
                    
        						<div class="col-sm-0" style="margin-bottom:-10px; margin-left:5px; margin-right:5px ; margin-top:-10px">
                                    
                                        
                                       <div class="box-content buttons" >
                                                     
                                                     <div class="col-sm-0" >
                                                        <div class="box-inner"  >
                                                            <div style="height:355px; margin-right:5px;margin-left:5px">
                                                     <table id="angsuran" width="100%" border="0" height="100%" style="margin-top:5px;">
                                                              <thead >
                                                                <tr style="font-weight:bold; color:#000">
                                                                    <th style="background-color:#CCCCCC; color:#000">No</th>
                                                                    <th style="background-color:#CCCCCC; color:#000">Tanggal</th>
                                                                    <th style="background-color:#CCCCCC; color:#000">Nota</th>
                                                                    <th style="background-color:#CCCCCC; color:#000">Akun</th>
                                                                    <th style="background-color:#CCCCCC; color:#000; text-align:right">Nominal</th>
   
                                                                </tr>
                                                                </thead>
                                                                 <tbody>
																	 <?php  
                                                                       $no = 1;
                                                                        foreach ($angsuran as $lihat):
                                                                     ?>
                                                                  <tr>
                                                                      <td><?php echo $no++ ?></td>
                                                                      <td><?php echo $lihat->tgl ?></td>
                                                                      <td><?php echo $lihat->nota ?></td>
                                                                      <td><?php echo $lihat->akundtl?></td>
                                                                      <td><div align="right"><?php echo $lihat->angsuran?></div></td>
                                                                      
                                                                   </tr>
                                                                  <?php endforeach ?>
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
        
      <!--batas-->
        
        
        
     </div>
     
     
    <!--/span-->

		
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
