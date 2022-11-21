<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cuser extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}
		// $this->load->helper(array('url','form'));
		 $this->load->model('muser');
	}



	/* Fungsi Jenis Surat */
	function tampil(){
		$field =  $this->input->post('table_search');
		$a['data']	= $this->muser->tampil($field)->result_object();
		$a['page']	= "user";
		
		$this->load->view('admin/index', $a);
	}

	function tambah_user(){
		
		$a['page']	= "user/tambah_user";
		$this->load->view('admin/index', $a);
	}

	function insertdata(){

		$table =  'sysuser';
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->insert($table, $myjson );
		redirect('cuser/tampil','refresh');
	}



	function edituser($id){
		$a['page']	= "user/edit_user";
		$this->load->view('admin/index', $a, $id);
	}

	function updatedata(){
		$table =   'sysuser';
		$idtable =  'iduser';
		$id = $_GET['id'];
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->where( $idtable, $id);
		$this->db->update($table, $myjson); 


	}

	

	function hapususer($id){
		$this->muser->hapususer($id);
		redirect('cuser/tampil','refresh');
	}

	function getjsonsample()
    {
		echo $this->muser->getjson();
    }

	
	function urlcmb()
    {

		echo $this->muser->url();
    }
	
	
	
	function getjsonshow()
    {
	$id = $_GET['id'];
  	echo $this->muser->mgetjsonshow($id);
    }
	
	function getjson_popup()
    {
	
		$string =  $_GET['fields'];
		echo $this->muser->get_datapopup($string);
    }
	function getjson_headerpopup()
    {
	
		$string =  $_GET['fields'];
		echo $this->muser->get_headerpopup($string);
    }


}

