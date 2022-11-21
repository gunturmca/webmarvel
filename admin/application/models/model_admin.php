<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_admin extends CI_Model {

	

	
	
	

	
	
	
	
	
	
	
	public function profile1($idkaryawan)
		 {
			/*return  $this->db->query("SELECT 		a.idkaryawan,a.pin,a.nik,a.noktp,a.nobpjs,a.bpjstk,a.nama,a.tempat_lahir,a.tanggal_lahir,a.agama,a.jk,a.jmlcuti,f.name,a.photo,
				CONCAT_WS(' ',a.alamat, e.name ,f.name,g.name ,h.name) as alt,a.tlp,j.divisi,
				a.hp,b.pendidikan,c.jabatan,d.departemen,i.mgroup_kerja ,a.jobdesk,a.tanggal_masuk,a.tanggal_keluar,a.`tanggal_diangkat`
				
				FROM tkaryawan AS a LEFT JOIN tpendidikan AS b ON a.idpendidikan = b.`idpendidikan`
				LEFT JOIN tjabatan AS c ON a.`idjabatan` = c.`idjabatan`
				LEFT JOIN tdepartemen AS d ON a.`iddepartemen` = d.`iddepartemen` left join villages as e ON a.iddesa = e.id
				left join districts as f on a.idkecamatan = f.id
				left join regencies as g on a.idkota = g.id
				left join provinces as h on a.idpropinsi = h.id
				left join tmgroup_kerja as i on a.idgroup = i.idmgroup_kerja
				left join tdivisi as j on a.iddivisi = j.iddivisi where a.idkaryawan ='$idkaryawan'");*/								
    }
	
	
	
	

/*
	public function edit_jenis($id)
	{
		return $this->db->get_where('tkeluarga',array('jenis_id'=>$id));
	}
*/
	

	public function cek_login($user, $pass)
	{
		
		return  $this->db->query("SELECT b.userID AS iduser,b.userPassword as pass,b.userName AS username,b.OnSite as onsite,b.LastModifyBy FROM  mdatauser AS b where b.userID = '$user' and  userPassword = '$pass' ");
	}
	
	
	
	/*public function cek_login_personal($user, $pass)
	{
		return  $this->db->query("SELECT a.idkaryawan,a.nama,a.tanggal_masuk as masuk FROM tkaryawan AS a  where a.nik = '$user' ");
	}*/
	
	
	public function alertuser()
	{
		 $arr = array();

		$query = $this->db->query("SELECT a.jmlijin,b.jmlspl,c.jmlmutasi,IFNULL(a.jmlijin,0) + IFNULL(b.jmlspl,0) + IFNULL(c.jmlmutasi,0) AS jml FROM
			(
				SELECT CONCAT(COUNT(idijin),' Persetujuan ijin') AS jmlijin FROM tijin WHERE flag IS  NULL OR (flag <> 1 and flag <> 2)
			 ) AS a,
			 (
				SELECT CONCAT(COUNT(idspl),' Persetujuan Lembur') AS jmlspl FROM tspl  WHERE acc <> '1'
			 ) AS b ,
			 (
				SELECT CONCAT(COUNT(idmutasi),' Persetujuan Mutasi') AS jmlmutasi FROM tmutasi
			 ) AS c
			  " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  json_encode($arr);
	}
	
	public function hideshowdashboard($field)
	{
		$arr = array();
		$flag =  $this->session->userdata('flag');
		if ($flag == 1 )
		{$card='201';}
		else
		{$card='301';}
		$query = $this->db->query("SELECt DISTINCT  b.code,b.nameof,b.filename,b.icon  FROM sysuseraccess AS a LEFT JOIN 
				sysappmenuitem AS b ON a.fcode = b.code LEFT JOIN sysappmenu AS c ON b.fcode=c.code 
				WHERE  idjabatan = '$field' and b.fcode = '$card' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  json_encode($arr);
	}


	public function tampil_user()
	{
		return $this->db->get('login');
	}

	public function insert_user($object)
	{
		$this->db->insert('login', $object);
	}

	public function edit_user($id)
	{
		return $this->db->get_where('login',array('id_user'=>$id));
	}

	public function update_user($id, $object)
	{
		$this->db->where('id_user', $id);
		$this->db->update('login', $object); 
	}

	public function hapus_user($id)
	{
		return $this->db->delete('login', array('id_user' => $id));
	}
	
	
	
	
	
	
	
	
}
