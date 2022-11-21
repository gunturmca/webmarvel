<?php

class msurat_panggilan extends CI_Model {

	public function __construct() {
        parent::__construct();
    }
   
				
	function surat_panggilan(){
	$idkaryawan = $this->session->userdata('idkaryawan'); 	
	$hsl=$this->db->query("SELECT a.nik,a.`nama`,c.`mgroup_kerja`, b.`departemen`,d.pendidikan,a.`tanggal_masuk`,'' AS lama_kerja, 
b.`periodetglgaji`,b.`s1`,b.`s2`,b.`c1`,b.`c1a`,b.`c1b`,b.`c2`,b.`c1a`,b.`c1b`,b.`c2a`,b.`c`,b.`m`,b.`p`,b.`p1`,
b.`p2`,b.l,b.mhk, b.`gapok`,b.`tunj_jabatan`,b.`tunj_prestasi`,b.`premi_hadir`,b.`qtyotasli`,b.`premi_shift`,
b.`tunj_masakerja`, b.`totgaji`,b.`pot_absen`,b.`pot_astek`,b.`pot_spsi`,b.`pot_koperasi`,b.`pot_bisnis`,b.`gaji_bersih` 
FROM tkaryawan AS a LEFT JOIN tslipgaji AS b ON a.`idkaryawan` = b.`idkaryawan` LEFT JOIN 
tmgroup_kerja AS c ON a.`idgroup` = c.`idmgroup_kerja` LEFT JOIN tpendidikan AS d ON a.`idpendidikan` = d.`idpendidikan` where a.idkaryawan = '$idkaryawan' ");
		return $hsl;
		
	}

	
}