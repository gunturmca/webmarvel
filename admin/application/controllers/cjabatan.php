<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cjabatan extends CI_Controller {

	function __construct(){
		parent::__construct();
		// $this->load->helper(array('url','form'));

		 $this->load->model('mjabatan');
	}



	/* Fungsi Jenis Surat */
	function tampil(){
		$field =  $this->input->post('table_search');
		$a['data']	= $this->mjabatan->tampil($field)->result_object();
		$a['page']	= "jabatan";
		
		$this->load->view('admin/index', $a);
	}

	function tambah_jabatan(){
		
		$a['page']	= "jabatan/tambah_jabatan";
		$this->load->view('admin/index', $a);
	}

	function insertdata(){
		$table =  'tjabatan';
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->insert($table, $myjson );
		redirect('cjabatan/tampil','refresh');
	}



	function editjabatan($id){
		$a['page']	= "jabatan/edit_jabatan";
		$this->load->view('admin/index', $a, $id);
	}

	function updatedata(){
		$table =   'tjabatan';
		$idtable =  'idjabatan';
		$id = $_GET['id'];
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->where( $idtable, $id);
		$this->db->update($table, $myjson); 


	}

	

	function hapusjabatan($id){
		$this->mjabatan->hapusjabatan($id);
		redirect('cjabatan/tampil','refresh');
	}

	function getjsonsample()
    {
		echo $this->mjabatan->getjson();
    }

	
	function urlcmb()
    {

		echo $this->mjabatan->url();
    }
	
	
	
	function getjsonshow()
    {
	$id = $_GET['id'];
  	echo $this->mjabatan->mgetjsonshow($id);
    }
	
	function getjson_popup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mjabatan->get_datapopup($string);
    }
	function getjson_headerpopup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mjabatan->get_headerpopup($string);
    }


}

