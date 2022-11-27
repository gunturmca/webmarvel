<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_admin_personal extends CI_Model {

	public function mgetjsonshow($id)
    {
        $arr = array();


		$query = $this->db->query("SELEcT * from tpeserta as a where a.idpeserta = '$id'");	
        
		foreach($query->result_object() as $rows )
        {
		foreach ($query->list_fields() as $field)
			{
				$arr[$field] =$rows->$field ;
			}	   	
       }

        return  json_encode($arr);

    }
	
	public function getjson()
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT  column_name, column_type,column_comment FROM database_schema WHERE table_name =  'tpeserta' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
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
	public function datapersonal($iduser)
		 {
			return  $this->db->query("SELECT b.idpeserta,b.nilai,a.idkelas,a.idpelajaran,d.nama,c.kelas,e.nmpelajaran
FROM tnilaiharian  AS a LEFT JOIN tnilaihariandtl AS b ON a.`idnilaiharian` = b.`idnilaiharian`
LEFT JOIN tkelas AS c ON a.`idkelas` = c.`idkelas`LEFT JOIN tpeserta AS d ON b.`idpeserta` = d.`idpeserta`
LEFT JOIN tpelajaran AS e ON a.`idpelajaran` = e.`idpelajaran` where d.idpeserta ='$iduser'");
									
  
    }
	
	public function nilaiakhir($iduser)
		 {
			return  $this->db->query("SELECT a.idnilaiakhir,a.tgl,b.nmkaryawan AS pengajar,c.kelas,d.nmpelajaran AS pelajaran,f.mendengar,f.membaca,f.kosakata,f.percakapan 
FROM tnilaiakhir AS a LEFT JOIN tkaryawan AS b ON a.`idpengajar` = b.`idkaryawan`
LEFT JOIN tkelas AS c ON a.`idkelas` = c.`idkelas` LEFT JOIN tpelajaran AS d ON a.idpelajaran = d.idpelajaran left join tnilaiakhirdtl as f on a.idnilaiakhir = f.idnilaiakhir where f.idpeserta ='$iduser'");
									
  
    }
	
	
	public function sisa_cuti($idkaryawan)
		 {
			return  $this->db->query("SELECT a.nik,a.nama,IFNULL(e.penggunaan_cuti,0) AS cuti_digunakan,IFNULL(c.cutilembur,0) AS 	cutilembur,
		IFNULL(t1.cutitahunan,0) AS cutitahunan,IFNULL(b.cutikip,0) AS cutikip,IFNULL(d.cutiip,0) AS cutiip,
		IFNULL(c.cutilembur,0) + IFNULL(t1.cutitahunan,0) + IFNULL(b.cutikip,0) + IFNULL(d.cutiip,0) AS jmlcuti,
		(IFNULL(c.cutilembur,0) + IFNULL(t1.cutitahunan,0) + IFNULL(b.cutikip,0) + IFNULL(d.cutiip,0))-IFNULL(e.penggunaan_cuti,0)  AS sisa_cuti
		FROM tkaryawan AS a LEFT JOIN 
			(
			  SELECT  a.nik,SUM(jmlcuti)-cuti_tahunan.cuti_tahunan_digunakan AS cutitahunan FROM  tcutitahunan AS a 
			  LEFT JOIN
				(
				  SELECT b.idkaryawan,COUNT(b.idcuti) AS cuti_tahunan_digunakan FROM
				  tlistcuti AS b  WHERE b.idcuti = 19 GROUP BY b.idkaryawan
				 )  cuti_tahunan ON a.idkaryawan = cuti_tahunan.idkaryawan GROUP BY a.nik
			 ) t1  ON a.`nik` = t1.nik LEFT JOIN 
			 (

			  SELECT  a.nik,SUM(jmlcuti)-cuti_kip.cuti_kip_digunakan AS cutikip FROM  tkip AS a 
			  LEFT JOIN
				(
				  SELECT b.idkaryawan,COUNT(b.idcuti) AS cuti_kip_digunakan FROM
				  tlistcuti AS b  WHERE b.idcuti = 25 GROUP BY b.idkaryawan
				 )  cuti_kip ON a.idkaryawan = cuti_kip.idkaryawan GROUP BY a.nik
			 ) AS b ON a.nik  = b.nik LEFT JOIN 
			 (
			  SELECT  a.nik,COUNT(a.nik)-cuti_lembur.cuti_lembur_digunakan AS cutilembur FROM  tcuti_uang AS a 
			  LEFT JOIN
				(
				  SELECT c.nik,b.idkaryawan,COUNT(b.idcuti) AS cuti_lembur_digunakan FROM
				  tlistcuti AS b LEFT JOIN tkaryawan AS c ON b.idkaryawan = c.idkaryawan WHERE b.idcuti = 27 GROUP BY b.idkaryawan
				 )  cuti_lembur ON a.nik = cuti_lembur.idkaryawan GROUP BY a.nik
			  
			 ) AS c ON a.nik  = c.nik LEFT JOIN
			 (
			   SELECT  a.nik,SUM(jmlcuti)-cuti_ip.cuti_ip_digunakan AS cutiip FROM  tip AS a 
			  LEFT JOIN
				(
				  SELECT b.idkaryawan,COUNT(b.idcuti) AS cuti_ip_digunakan FROM
				  tlistcuti AS b  WHERE b.idcuti = 26 GROUP BY b.idkaryawan
				 )  cuti_ip ON a.idkaryawan = cuti_ip.idkaryawan GROUP BY a.nik
			 ) AS d ON a.nik  = d.nik LEFT JOIN 
			 (
			  SELECT  c.idkaryawan,COUNT(idkaryawan) AS penggunaan_cuti FROM  tlistcuti AS c 
			WHERE c.idcuti IN (19,25,26) 
			  GROUP BY c.idkaryawan
			 ) AS e ON a.idkaryawan  = e.idkaryawan

   WHERE (a.idkaryawan = '$idkaryawan')  ");								
    }

	public function angsuran()
		 {
			 $flag =  $this->session->userdata('flag');
			$userid =  $this->session->userdata('userid');
			$thn_pelajarn_aktif =  $this->session->userdata('thn_pelajarn_aktif');
			
			if ($flag == 1 )
			{$and = " where idpeserta = $userid"; }
			else
			{$and = ''; }
			
			return  $this->db->query("SELECT  a.tgl,a.nota,d.`akundtl`,c.angsuran
FROM tangsuran AS a LEFT JOIN tangsurandtl AS c ON a.`idangsuran` = c.`idangsuran`
LEFT JOIN tlistregistrasidtl AS b ON c.`idakun` = b.`idakun` LEFT JOIN takundtl AS d ON b.`idakun` = d.`idakundtl`
LEFT JOIN tlistregistrasi AS e ON b.`idlistregistrasi` = e.`idlistregistrasi`" . $and . " and e.`thn_ajaran`= '$thn_pelajarn_aktif'" );							
    	}
	
/*
	public function edit_jenis($id)
	{
		return $this->db->get_where('tkeluarga',array('jenis_id'=>$id));
	}
*/
	

	public function cek_login($user, $pass)
	{
		return  $this->db->query("SELECT a.iduser,a.username,a.idkaryawan,a.nama,b.tanggal_masuk as masuk FROM sysuser AS a LEFT JOIN tkaryawan AS b ON a.idkaryawan = b.idkaryawan where a.username = '$user' and password = '$pass'");
	}
	
	public function cek_login_personal($user, $pass)
	{
		return  $this->db->query("SELECT a.idkaryawan,a.nama,a.tanggal_masuk as masuk FROM tkaryawan AS a  where a.nik = '$user' ");
	}
	

	
	
	



	
	
	
	
	
	
	
	
}
