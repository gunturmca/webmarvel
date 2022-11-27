<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class chakakses extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}
		// $this->load->helper(array('url','form'));
		 $this->load->model('mhakakses');
	}



	/* Fungsi Jenis Surat */
	function tampil(){
		$field =  $this->input->post('table_search');

		$a['page']	= "hakakses";
		
		$this->load->view('admin/index', $a);
	}

	function tambah_hakakses(){
		
		$a['page']	= "hakakses/tambah_hakakses";
		$this->load->view('admin/index', $a);
	}
	
	function carikaryawan(){
		 $id=$this->input->get('id');
		echo $this->mhakakses->getkaryawan($id);
		
	}
	function tandaibox(){
		 $id=$this->input->get('id');
		echo $this->mhakakses->gettandaibox($id);
		
	}
	function insertdata(){
		$table =  'sysuseraccess';
		$data=array ('idjabatan' => $this->input->post('idjabatan'),
		'fcode' => $this->input->post('fcode'),
		'update_by' =>  $this->input->post('userid'),
		'update_time' =>  date('yy-m-d'));
		$this->db->insert($table, $data );
	}

	function simpandtl(){
			$data= $this->input->get('arr');
			echo $this->mhakakses->simpandtl($data);
			
		
		}

	function edithakakses($id){
		$a['page']	= "hakakses/edit_hakakses";
		$this->load->view('admin/index', $a, $id);
	}

	function updatedata(){
		$table =   'thakakses';
		$idtable =  'idhakakses';
		$id = $_GET['id'];
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->where( $idtable, $id);
		$this->db->update($table, $myjson); 


	}

	

	function hapushakakses(){
	 $id=$this->input->post('id');
		$this->mhakakses->hapushakakses($id);

	}

	function getjsonsample()
    {
		echo $this->mhakakses->getjson();
    }

	
	function urlcmb()
    {

		echo $this->mhakakses->url();
    }
	
	
	
	function getjsonshow()
    {
	$id = $_GET['id'];
  	echo $this->mhakakses->mgetjsonshow($id);
    }
	
	function getjson_popup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mhakakses->get_datapopup($string);
    }
	function getjson_headerpopup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mhakakses->get_headerpopup($string);
    }


}

