<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class csubmenu extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}
		// $this->load->helper(array('url','form'));
		 $this->load->model('msubmenu');
	}



	/* Fungsi Jenis Surat */
	function tampil(){
		$field =  $this->input->post('table_search');
		$a['data']	= $this->msubmenu->tampil($field)->result_object();
		$a['page']	= "submenu";
		
		$this->load->view('admin/index', $a);
	}

	function tambah_submenu(){
		
		$a['page']	= "submenu/tambah_submenu";
		$this->load->view('admin/index', $a);
	}

	function insertdata(){
		$table =  'sysappmenuitem';
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->insert($table, $myjson );
		redirect('csubmenu/tampil','refresh');
	}



	function editsubmenu($id){
		$a['page']	= "submenu/edit_submenu";
		$this->load->view('admin/index', $a, $id);
	}

	function updatedata(){
		$table =   'sysappmenuitem';
		$idtable =  'idmenuitem';
		$id = $_GET['id'];
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->where( $idtable, $id);
		$this->db->update($table, $myjson); 


	}

	

	function hapussubmenu($id){
		$this->msubmenu->hapussubmenu($id);
		redirect('csubmenu/tampil','refresh');
	}

	function getjsonsample()
    {
		echo $this->msubmenu->getjson();
    }

	
	function urlcmb()
    {

		echo $this->msubmenu->url();
    }
	
	
	
	function getjsonshow()
    {
	$id = $_GET['id'];
  	echo $this->msubmenu->mgetjsonshow($id);
    }
	
	function getjson_popup()
    {
	
		$string =  $_GET['fields'];
		echo $this->msubmenu->get_datapopup($string);
    }
	function getjson_headerpopup()
    {
	
		$string =  $_GET['fields'];
		echo $this->msubmenu->get_headerpopup($string);
    }


}

