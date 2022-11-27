<?php

class mkaryawan extends CI_Model {

	public function __construct() {
        parent::__construct();
    }
   
				
function json($field) {

$requestData= $_REQUEST;
$columns = array( 	
  0 => 'nik',
  1 => 'nama',
  2 => 'ktp',
  3 => 'jk',
  4 => 'jabatan',
  5 => 'tlp',
  6 => 'alamat',
  7 => 'pendidikan',
  8 => 'jurusan',
  9 => 'lulusan',
  10 => 'email',
  
  12 => 'status',
  11 => 'idkaryawan',


 

);
		$sql = " SELECT a.idkaryawan,a.nik,a.nmkaryawan as nama,a.jk,a.ktp,c.jabatan,a.tlp,a.jurusan,a.lulusan,a.email,IF (flag=1,'Resign','Aktif') AS status, 
				CONCAT_WS(' ',a.alamat, e.name ,f.name,g.name ,h.name) AS alamat,b.pendidikan,c.jabatan,a.tgl_masuk,a.tgl_keluar
				
				FROM tkaryawan AS a LEFT JOIN tpendidikan AS b ON a.idpendidikan = b.`idpendidikan`
				LEFT JOIN tjabatan AS c ON a.`idjabatan` = c.`idjabatan`
				LEFT JOIN villages AS e ON a.iddesa = e.id
				LEFT JOIN districts AS f ON a.idkecamatan = f.id
				LEFT JOIN regencies AS g ON a.idkota = g.id
				LEFT JOIN provinces AS h ON a.idpropinsi = h.id
				  where a.nmkaryawan like '" . $field . "%' or a.nik like '" . $field . "%' or a.jk like '" . $field . "%'  or c.jabatan like '" . $field . "%'  or a.tlp like '" . $field . "%'";
			
	$query =   $this->db->query($sql);
	$totalData = $query->num_rows();
	$totalFiltered = $totalData;
		
	if( !empty($requestData['search']['value']) ) {
		//----------------------------------------------------------------------------------
		/*$sql.=" AND ( niks LIKE '".$requestData['search']['value']."%' ";    
		$sql.=" OR nama LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR agama LIKE '".$requestData['search']['value']."%' )";*/
	}
	
	
	$query =   $this->db->query($sql);
	$totalFiltered = $query->num_rows($sql);
	
	
/*	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";	
	
$query =   $this->db->query($sql);*/

	//----------------------------------------------------------------------------------
	
	$data = array();
	$x=0;
	 foreach($query->result_object() as $rows )
        {
		$bagong = 10;
	 /*"<div align='right'><a class='btn btn-info' href='cdivisi/editdivisi/' $rows->nik  >
                  <i class='glyphicon glyphicon-edit icon-white'></i>
                  </a>";*/
				  /*"<a href=cjadwalkerja/editjadwalkerja/" .$bagong ." >delete</a>";*/
		$x=$x+1;
		$nestedData=array(); 
		
		$nestedData[] =   "<div align='right'><a class='btn btn-info' href=editkaryawan/". $rows->idkaryawan ."  >
                  <i class='glyphicon glyphicon-edit icon-white'></i>
                  </a>
				  <a class='btn btn-danger' href=hapuskaryawan/". $rows->idkaryawan ." >
                  <i class='glyphicon glyphicon-trash icon-white'></i>
                  </a>
				  </div>";
				  /*<a class='btn btn-danger' href=hapuskaryawan/". $rows->idkaryawan ."  disabled >
                  <i class='glyphicon glyphicon-trash icon-white'></i>
                  </a>*/
				  

             
		$nestedData[] = $rows->nik;
		$nestedData[] = $rows->nama;
		$nestedData[] = $rows->ktp;
		$nestedData[] = $rows->jk;
		$nestedData[] = $rows->jabatan;
		$nestedData[] = $rows->tlp;
		$nestedData[] = $rows->alamat;
		$nestedData[] = $rows->pendidikan;
		$nestedData[] = $rows->jurusan;
		$nestedData[] = $rows->lulusan;
		$nestedData[] = $rows->email;
		$nestedData[] =  $rows->status;
		


		

		
		$data[] = $nestedData;
	}
	//----------------------------------------------------------------------------------
	$json_data = array(
	  
		"recordsTotal"    => intval( $totalData ), 
		"recordsFiltered" => intval( $totalFiltered ), 
		"data"            => $data );
	//----------------------------------------------------------------------------------
	return  json_encode($json_data);
    }
	
	
	
	
	public function tampil1($field)
	 {
	
	
}
//----------------------------------------------------------------------------------

	
	
	
	
	
	function getkota($id){
		$arr = array();
		$query = $this->db->query("SELECT * FROM regencies WHERE province_id='$id' order by name" );
		
        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr); 
    }
	
	function getkecamatan($id){
		$arr = array();
		$query = $this->db->query("SELECT * FROM districts WHERE regency_id='$id' order by name" );
		
        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr); 
    }
	function getdesa($id){
		$arr = array();
		$query = $this->db->query("SELECT * FROM villages WHERE district_id='$id' order by name" );
		
        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr); 
    }
	
	
	
  
    
	public function hapuskaryawan($id)
	{
	
		return $query = $this->db->query("update tkaryawan  set flag = 1  where idkaryawan = $id " );
	}
	
	public function editkaryawan($id)
	{
		return $this->db->get_where('tkaryawan',array('idkaryawan'=>$id));
	}
	
	
	public function get_filterdata($field)
    {
        $arr = array();

		$query = $this->db->query("SELECT * from tkaryawan as b   where b.nama like '" . $field . "%' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
		public function getjson()
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT  column_name, column_type,column_comment FROM database_schema WHERE table_name =  'tkaryawan' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

	
	public function mgetjsonshow($id)
    {
        $arr = array();


		$query = $this->db->query("SELECT * from tkaryawan as a where a.idkaryawan = '$id'");	
        
		foreach($query->result_object() as $rows )
        {
		foreach ($query->list_fields() as $field)
			{
				$arr[$field] =$rows->$field ;
			}	   	
       }

        return  json_encode($arr);

    }
	public function url()
    {
        $arr = array();
		$link=decrypt_url($_GET['link']);
		$query = $this->db->query($link );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  json_encode($arr);
    }
	
}