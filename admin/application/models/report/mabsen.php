<?php

class mabsen extends CI_Model {

	public function __construct() {
        parent::__construct();
    }
   
				
function json($field,$tglawal,$tglakhir) {

$requestData= $_REQUEST;
$columns = array( 	

  0 => 'nik',
  1 => 'nama',
  2 => 'departemen',
  3 => 'divisi',
 


);
		
		$cari = "where month(tgl_masuk) = month('" .  date("Y-m-d") . "') and year(tgl_masuk) = year('" .  date("Y-m-d") . "') ";
		if ($field != '' && $tglawal != '' && $tglakhir != '')
		{
			$cari = "where tgl_masuk between  '" . $tglawal . "' and '" . $tglakhir . "'  and (a.nik = '" . $field . "' or b.nama = '" . $field . "' or  c.departemen = '" . $field . "' or d.divisi = '" . $field . "')" ;
		}
		if ($field == '' && $tglawal != '' && $tglakhir != '')
		{
			$cari = "where tgl_masuk between  '" . $tglawal . "' and '" . $tglakhir . "' " ;
		}
		if ($field != '' && ($tglawal == '' || $tglakhir == ''))
		{
			$cari = "where month(tgl_masuk) = month('" .  date("Y-m-d") . "') and year(tgl_masuk) = year('" .  date("Y-m-d") . "') and (a.nik = '" . $field . "' or b.nama = '" . $field . "' or  c.departemen = '" . $field . "' or d.divisi = '" . $field . "')" ;
		}
		
		$sql = " SELECT nik,nama,departemen,divisi,
GROUP_CONCAT(m01) AS M01,GROUP_CONCAT(p01) AS P01,
GROUP_CONCAT(m02) AS M02,GROUP_CONCAT(p02) AS P02 ,
GROUP_CONCAT(m03) AS M03,GROUP_CONCAT(p03) AS P03,
GROUP_CONCAT(m04) AS M04,GROUP_CONCAT(p04) AS P04,
GROUP_CONCAT(m05) AS M05,GROUP_CONCAT(p05) AS P05,
GROUP_CONCAT(m06) AS M06,GROUP_CONCAT(p06) AS P06,
GROUP_CONCAT(m07) AS M07,GROUP_CONCAT(p07) AS P07,
GROUP_CONCAT(m08) AS M08,GROUP_CONCAT(p08) AS P08,
GROUP_CONCAT(m09) AS M09,GROUP_CONCAT(p09) AS P09,
GROUP_CONCAT(m10) AS M10,GROUP_CONCAT(p10) AS P10,
GROUP_CONCAT(m11) AS M11,GROUP_CONCAT(p11) AS P11,
GROUP_CONCAT(m12) AS M12,GROUP_CONCAT(p12) AS P12 ,
GROUP_CONCAT(m13) AS M13,GROUP_CONCAT(p13) AS P13,
GROUP_CONCAT(m14) AS M14,GROUP_CONCAT(p14) AS P14,
GROUP_CONCAT(m15) AS M15,GROUP_CONCAT(p15) AS P15,
GROUP_CONCAT(m16) AS M16,GROUP_CONCAT(p16) AS P16,
GROUP_CONCAT(m17) AS M17,GROUP_CONCAT(p17) AS P17,
GROUP_CONCAT(m18) AS M18,GROUP_CONCAT(p18) AS P18,
GROUP_CONCAT(m19) AS M19,GROUP_CONCAT(p19) AS P19,
GROUP_CONCAT(m20) AS M20,GROUP_CONCAT(p20) AS P20,
GROUP_CONCAT(m21) AS M21,GROUP_CONCAT(p21) AS P21,
GROUP_CONCAT(m22) AS M22,GROUP_CONCAT(p22) AS P22 ,
GROUP_CONCAT(m23) AS M23,GROUP_CONCAT(p23) AS P23,
GROUP_CONCAT(m24) AS M24,GROUP_CONCAT(p24) AS P24,
GROUP_CONCAT(m25) AS M25,GROUP_CONCAT(p25) AS P25,
GROUP_CONCAT(m26) AS M26,GROUP_CONCAT(p26) AS P26,
GROUP_CONCAT(m27) AS M27,GROUP_CONCAT(p27) AS P27,
GROUP_CONCAT(m28) AS M28,GROUP_CONCAT(p28) AS P28,
GROUP_CONCAT(m29) AS M29,GROUP_CONCAT(p29) AS P29,
GROUP_CONCAT(m30) AS M30,GROUP_CONCAT(p30) AS P30,
GROUP_CONCAT(m31) AS M31,GROUP_CONCAT(p31) AS P31

FROM
(SELECT a.nik,b.nama,c.departemen,d.divisi,
					CASE WHEN DAY(tgl_masuk)='1'  THEN jam_masuk END AS 'M01',
					CASE WHEN DAY(tgl_pulang)='1'  THEN jam_pulang END AS 'P01',
					CASE WHEN DAY(tgl_masuk)='2'  THEN jam_masuk END AS 'M02',
					CASE WHEN DAY(tgl_pulang)='2'  THEN jam_pulang END AS 'P02',
					CASE WHEN DAY(tgl_masuk)='3'  THEN jam_masuk END AS 'M03',
					CASE WHEN DAY(tgl_pulang)='3'  THEN jam_pulang END AS 'P03',
					CASE WHEN DAY(tgl_masuk)='4'  THEN jam_masuk END AS 'M04',
					CASE WHEN DAY(tgl_pulang)='4'  THEN jam_pulang END AS 'P04',
					CASE WHEN DAY(tgl_masuk)='5'  THEN jam_masuk END AS 'M05',
					CASE WHEN DAY(tgl_pulang)='5'  THEN jam_pulang END AS 'P05',
					CASE WHEN DAY(tgl_masuk)='6'  THEN jam_masuk END AS 'M06',
					CASE WHEN DAY(tgl_pulang)='6'  THEN jam_pulang END AS 'P06',
					CASE WHEN DAY(tgl_masuk)='7'  THEN jam_masuk END AS 'M07',
					CASE WHEN DAY(tgl_pulang)='7'  THEN jam_pulang END AS 'P07',
					CASE WHEN DAY(tgl_masuk)='8'  THEN jam_masuk END AS 'M08',
					CASE WHEN DAY(tgl_pulang)='8'  THEN jam_pulang END AS 'P08',
					CASE WHEN DAY(tgl_masuk)='9'  THEN jam_masuk END AS 'M09',
					CASE WHEN DAY(tgl_pulang)='9'  THEN jam_pulang END AS 'P09',
					CASE WHEN DAY(tgl_masuk)='10'  THEN jam_masuk END AS 'M10',
					CASE WHEN DAY(tgl_pulang)='10'  THEN jam_pulang END AS 'P10',
					CASE WHEN DAY(tgl_masuk)='11'  THEN jam_masuk END AS 'M11',
					CASE WHEN DAY(tgl_pulang)='11'  THEN jam_pulang END AS 'P11',
					CASE WHEN DAY(tgl_masuk)='12'  THEN jam_masuk END AS 'M12',
					CASE WHEN DAY(tgl_pulang)='12'  THEN jam_pulang END AS 'P12',
					CASE WHEN DAY(tgl_masuk)='13'  THEN jam_masuk END AS 'M13',
					CASE WHEN DAY(tgl_pulang)='13'  THEN jam_pulang END AS 'P13',
					CASE WHEN DAY(tgl_masuk)='14'  THEN jam_masuk END AS 'M14',
					CASE WHEN DAY(tgl_pulang)='14'  THEN jam_pulang END AS 'P14',
					CASE WHEN DAY(tgl_masuk)='15'  THEN jam_masuk END AS 'M15',
					CASE WHEN DAY(tgl_pulang)='15'  THEN jam_pulang END AS 'P15',
					CASE WHEN DAY(tgl_masuk)='16'  THEN jam_masuk END AS 'M16',
					CASE WHEN DAY(tgl_pulang)='16'  THEN jam_pulang END AS 'P16',
					CASE WHEN DAY(tgl_masuk)='17'  THEN jam_masuk END AS 'M17',
					CASE WHEN DAY(tgl_pulang)='17'  THEN jam_pulang END AS 'P17',
					CASE WHEN DAY(tgl_masuk)='18'  THEN jam_masuk END AS 'M18',
					CASE WHEN DAY(tgl_pulang)='18'  THEN jam_pulang END AS 'P18',

					CASE WHEN DAY(tgl_masuk)='19'  THEN jam_masuk END AS 'M19',
					CASE WHEN DAY(tgl_pulang)='19'  THEN jam_pulang END AS 'P19',
					CASE WHEN DAY(tgl_masuk)='20'  THEN jam_masuk END AS 'M20',
					CASE WHEN DAY(tgl_pulang)='20'  THEN jam_pulang END AS 'P20',
					CASE WHEN DAY(tgl_masuk)='21'  THEN jam_masuk END AS 'M21',
					CASE WHEN DAY(tgl_pulang)='21'  THEN jam_pulang END AS 'P21',
					CASE WHEN DAY(tgl_masuk)='22'  THEN jam_masuk END AS 'M22',
					CASE WHEN DAY(tgl_pulang)='22'  THEN jam_pulang END AS 'P22',
					CASE WHEN DAY(tgl_masuk)='23'  THEN jam_masuk END AS 'M23',
					CASE WHEN DAY(tgl_pulang)='23'  THEN jam_pulang END AS 'P23',
					CASE WHEN DAY(tgl_masuk)='24'  THEN jam_masuk END AS 'M24',
					CASE WHEN DAY(tgl_pulang)='24'  THEN jam_pulang END AS 'P24',
					CASE WHEN DAY(tgl_masuk)='25'  THEN jam_masuk END AS 'M25',
					CASE WHEN DAY(tgl_pulang)='25'  THEN jam_pulang END AS 'P25',
					CASE WHEN DAY(tgl_masuk)='26'  THEN jam_masuk END AS 'M26',
					CASE WHEN DAY(tgl_pulang)='26'  THEN jam_pulang END AS 'P26',
					CASE WHEN DAY(tgl_masuk)='27'  THEN jam_masuk END AS 'M27',
					CASE WHEN DAY(tgl_pulang)='27'  THEN jam_pulang END AS 'P27',
					CASE WHEN DAY(tgl_masuk)='28'  THEN jam_masuk END AS 'M28',
					CASE WHEN DAY(tgl_pulang)='28'  THEN jam_pulang END AS 'P28',
					CASE WHEN DAY(tgl_masuk)='29'  THEN jam_masuk END AS 'M29',
					CASE WHEN DAY(tgl_pulang)='29'  THEN jam_pulang END AS 'P29',
					CASE WHEN DAY(tgl_masuk)='30'  THEN jam_masuk END AS 'M30',
					CASE WHEN DAY(tgl_pulang)='30'  THEN jam_pulang END AS 'P30',
					CASE WHEN DAY(tgl_masuk)='31'  THEN jam_masuk END AS 'M31',
					CASE WHEN DAY(tgl_pulang)='31'  THEN jam_pulang END AS 'P31'
					
					FROM tabsen AS a LEFT JOIN tkaryawan AS b ON a.nik = b.nik LEFT JOIN tdepartemen AS c ON b.iddepartemen = c.iddepartemen
					LEFT JOIN tdivisi AS d ON b.iddivisi = d.iddivisi " . $cari . " ) as a group by nik";
			
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
		
              

		$nestedData[] = $rows->nik;
		$nestedData[] = $rows->nama;
		$nestedData[] = $rows->departemen;
		$nestedData[] = $rows->divisi;
	
		
		$nestedData[] = $rows->M01;
		$nestedData[] = $rows->P01;
		$nestedData[] = $rows->M02;
		$nestedData[] = $rows->P02;
		$nestedData[] = $rows->M03;
		$nestedData[] = $rows->P03;
		$nestedData[] = $rows->M04;
		$nestedData[] = $rows->P04;
		$nestedData[] = $rows->M05;
		$nestedData[] = $rows->P05;
		$nestedData[] = $rows->M06;
		$nestedData[] = $rows->P06;
		$nestedData[] = $rows->M07;
		$nestedData[] = $rows->P07;
		$nestedData[] = $rows->M08;
		$nestedData[] = $rows->P08;
		$nestedData[] = $rows->M09;
		$nestedData[] = $rows->P09;
		$nestedData[] = $rows->M10;
		$nestedData[] = $rows->P10;
		$nestedData[] = $rows->M11;
		$nestedData[] = $rows->P11;
		$nestedData[] = $rows->M12;
		$nestedData[] = $rows->P12;
		$nestedData[] = $rows->M13;
		$nestedData[] = $rows->P13;
		$nestedData[] = $rows->M14;
		$nestedData[] = $rows->P14;
		$nestedData[] = $rows->M15;
		$nestedData[] = $rows->P15;
		$nestedData[] = $rows->M16;
		$nestedData[] = $rows->P16;
		$nestedData[] = $rows->M17;
		$nestedData[] = $rows->P17;
		$nestedData[] = $rows->M18;
		$nestedData[] = $rows->P18;
		$nestedData[] = $rows->M19;
		$nestedData[] = $rows->P19;
		$nestedData[] = $rows->M20;
		$nestedData[] = $rows->P20;
		$nestedData[] = $rows->M21;
		$nestedData[] = $rows->P21;
		$nestedData[] = $rows->M22;
		$nestedData[] = $rows->P22;
		$nestedData[] = $rows->M23;
		$nestedData[] = $rows->P23;
		$nestedData[] = $rows->M24;
		$nestedData[] = $rows->P24;
		$nestedData[] = $rows->M25;
		$nestedData[] = $rows->P25;
		$nestedData[] = $rows->M26;
		$nestedData[] = $rows->P26;
		$nestedData[] = $rows->M27;
		$nestedData[] = $rows->P27;
		$nestedData[] = $rows->M28;
		$nestedData[] = $rows->P28;
		$nestedData[] = $rows->M29;
		$nestedData[] = $rows->P29;
		$nestedData[] = $rows->M30;
		$nestedData[] = $rows->P30;
		$nestedData[] = $rows->M31;
		$nestedData[] = $rows->P31;
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
	
	
	

//----------------------------------------------------------------------------------

	
	
	
	
	
	

	
  
    
	
	
	
	
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

	
}