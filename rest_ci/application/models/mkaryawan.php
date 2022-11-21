<?php

class mkaryawan extends CI_Model {

	public function __construct() {
        parent::__construct();
    }
   
				
function json($field) {

$requestData= $_REQUEST;
$columns = array( 	
  0 => 'pin',
  1 => 'nik',
  2 => 'noktp',
  3 => 'nobpjs',
  4 => 'bpjstk',
  5 => 'nama',
  6 => 'tempat_lahir',
  7 => 'tanggal_lahir',
  8 => 'agama',
  9 => 'jk',
  0 => 'alt',
  11 => 'tlp',
  12 => 'divisi',
  13 => 'hp',
  14 => 'pendidikan',
  15 => 'jabatan',
  16 => 'departemen',
  17 => 'jobdesk',
  18 => 'mgroup_kerja',
  19 => 'tanggal_masuk',
  20 => 'tanggal_diangkat',
  21 => 'tanggal_keluar',
 

);
		$sql = " SELECT a.idkaryawan,a.pin,a.nik,a.noktp,a.nobpjs,a.bpjstk,a.nama,a.tempat_lahir,a.tanggal_lahir,a.agama,a.jk,
				CONCAT_WS(' ',a.alamat, e.name ,f.name,g.name ,h.name) as alt,a.tlp,j.divisi,
				a.hp,b.pendidikan,c.jabatan,d.departemen,i.mgroup_kerja ,a.jobdesk,a.tanggal_masuk,a.tanggal_keluar,a.`tanggal_diangkat`
				
				FROM tkaryawan AS a LEFT JOIN tpendidikan AS b ON a.idpendidikan = b.`idpendidikan`
				LEFT JOIN tjabatan AS c ON a.`idjabatan` = c.`idjabatan`
				LEFT JOIN tdepartemen AS d ON a.`iddepartemen` = d.`iddepartemen` left join villages as e ON a.iddesa = e.id
				left join districts as f on a.idkecamatan = f.id
				left join regencies as g on a.idkota = g.id
				left join provinces as h on a.idpropinsi = h.id
				left join tmgroup_kerja as i on a.idgroup = i.idmgroup_kerja
				left join tdivisi as j on a.iddivisi = j.iddivisi
				  where a.nama like '" . $field . "%' or a.nik like '" . $field . "%' or a.jk like '" . $field . "%'  or c.jabatan like '" . $field . "%' or d.departemen like '" . $field . "%'  or i.mgroup_kerja like '" . $field . "%' or a.hp like '" . $field . "%'";
			
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
	
	
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";	
	
$query =   $this->db->query($sql);

	//----------------------------------------------------------------------------------
	
	$data = array();
	 foreach($query->result_object() as $rows )
        {
		$bagong = 10;
	 /*"<div align='right'><a class='btn btn-info' href='cdivisi/editdivisi/' $rows->nik  >
                  <i class='glyphicon glyphicon-edit icon-white'></i>
                  </a>";*/
				  /*"<a href=cjadwalkerja/editjadwalkerja/" .$bagong ." >delete</a>";*/
				  
		$nestedData=array(); 
		$nestedData[] =   "<div align='right'><a class='btn btn-info' href=editkaryawan/". $rows->idkaryawan ."  >
                  <i class='glyphicon glyphicon-edit icon-white'></i>
                  </a>
				  <a class='btn btn-danger' href=# disabled >
                  <i class='glyphicon glyphicon-trash icon-white'></i>
                  </a>
				  </div>";
				  /*<a class='btn btn-danger' href=hapuskaryawan/". $rows->idkaryawan ."  disabled >
                  <i class='glyphicon glyphicon-trash icon-white'></i>
                  </a>*/
              
		$nestedData[] = $rows->pin;
		$nestedData[] = $rows->nik;
		$nestedData[] = $rows->noktp;
		$nestedData[] = $rows->nobpjs;
		$nestedData[] = $rows->bpjstk;
		$nestedData[] = $rows->nama;
		$nestedData[] = $rows->tempat_lahir;
		$nestedData[] = $rows->tanggal_lahir;
		$nestedData[] = $rows->agama;
		$nestedData[] = $rows->jk;
		$nestedData[] = $rows->alt;
		$nestedData[] = $rows->tlp;
		$nestedData[] = $rows->divisi;
		$nestedData[] = $rows->hp;
		$nestedData[] = $rows->pendidikan;
		$nestedData[] = $rows->jabatan;
		$nestedData[] = $rows->departemen;
		$nestedData[] = $rows->jobdesk;
		$nestedData[] = $rows->mgroup_kerja;
		$nestedData[] = $rows->tanggal_masuk;
		
		$nestedData[] = $rows->tanggal_diangkat;
		$nestedData[] = $rows->tanggal_keluar;
		

		
		$data[] = $nestedData;
	}
	//----------------------------------------------------------------------------------
	$json_data = array(
		"draw"            => intval( $requestData['draw'] ),  
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
	
		return $this->db->delete('tkaryawan', array('idkaryawan' => $id));
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