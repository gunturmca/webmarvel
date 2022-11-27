<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cmenu extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}
		// $this->load->helper(array('url','form'));
		 $this->load->model('mmenu');
	}



	/* Fungsi Jenis Surat */
	function tampil(){
		$field =  $this->input->post('table_search');
		$a['data']	= $this->mmenu->tampil($field)->result_object();
		$a['page']	= "menu";
		
		$this->load->view('admin/index', $a);
	}

	function tambah_menu(){
		
		$a['page']	= "menu/tambah_menu";
		$this->load->view('admin/index', $a);
	}

	function insertdata(){
		$table =  'sysappmenu';
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->insert($table, $myjson );
		redirect('cmenu/tampil','refresh');
	}



	function editmenu($id){
		$a['page']	= "menu/edit_menu";
		$this->load->view('admin/index', $a, $id);
	}

	function updatedata(){
		$table =   'sysappmenu';
		$idtable =  'idmenu';
		$id = $_GET['id'];
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->where( $idtable, $id);
		$this->db->update($table, $myjson); 


	}

	

	function hapusmenu($id){
		$this->mmenu->hapusmenu($id);
		redirect('cmenu/tampil','refresh');
	}

	function getjsonsample()
    {
		echo $this->mmenu->getjson();
    }

	
	function urlcmb()
    {

		echo $this->mmenu->url();
    }
	
	
	
	function getjsonshow()
    {
	$id = $_GET['id'];
  	echo $this->mmenu->mgetjsonshow($id);
    }
	
	function getjson_popup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mmenu->get_datapopup($string);
    }
	function getjson_headerpopup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mmenu->get_headerpopup($string);
    }


}

