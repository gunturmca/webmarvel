
     <?php  
	 $nmtable =  decrypt_url($this->session->userdata(encrypt_url('idtable')));
	 $arrsql =  decrypt_url($this->session->userdata(encrypt_url('query')));
     $no = 1;
	 $tbody = "";
	 $arr = array();
	 $path =   base_url();

	 echo "<table class='table table-striped table-bordered bootstrap-datatable datatable responsive'>";
	 echo "<thead>" ;
		 echo "<tr>"; 
				 echo "<th>No</th>" ; 
			$arr1  =  explode(",",$arrsql);
		   $arr2=json_decode(json_encode($header),true);
				 for ($y=0;$y<count($arr1);$y++)
					{
						for ($x=0;$x<count($arr2);$x++)
						{
							if ($arr2[$x]['COLUMN_NAME'] ==$arr1[$y] && $arr2[$x]['COLUMN_NAME'] != $nmtable   )
								{
									echo "<th>" . $arr2[$x]['COLUMN_COMMENT'] . "</th>" ; 
									$arr[]=strtolower($arr2[$x]['COLUMN_NAME']);
								}
						}
				}
				echo "<th><div align='center'>Action</div></th>" ; 
		 echo "</tr>"; 
	 echo "</thead>" ; 
	 $no = 1;
	 echo "<tbody>" ; 
	 foreach ($data as $lihat):
		 echo "<tr>"; 
			 echo "<td>".  $no++ ."</td>" ; 
			  foreach ($arr as $value):
					echo "<td>".  $lihat->$value ."</td>"  ;
			  endforeach;
			 $bagong =$lihat->$nmtable;
			  echo "<td class='center'>";
				  echo "<div align='right'>";
						echo "<a class='btn btn-info' style='margin-right:3px' href='http://localhost/bpbd/admin/crespons/editrespons/$bagong'>";
						echo "<i class='glyphicon glyphicon-edit icon-white'></i>";
						echo "</a>";
						echo "<a class='btn btn-danger'  href='http://localhost/bpbd/admin/crespons/hapusrespons/$bagong'>";
						echo "<i class='glyphicon glyphicon-trash icon-white'></i>";
						echo "</a>";
				 echo "</div>";
			  
			  echo "</td>"  ;
		  echo "</tr>"; 
	endforeach;
	echo "</tbody>" ; 
	echo "</table>" ; 
?>
