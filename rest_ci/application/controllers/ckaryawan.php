<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ckaryawan extends CI_Controller {

	    public function __construct() {
        parent::__construct();
		if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}
        $this->load->model('mkaryawan');
    }
    
    public function parah() {
      

       $this->load->view('admin/karyawan');
    }
	
	function tampil(){
		
		$a['page']	= "karyawan";

		$this->load->view('admin/index', $a);
	}
	
	
	function json() {
	 $field=$this->input->post('field');
       echo $this->mkaryawan->json($field);
    }

/*    public function json() {
	$field =  $this->input->post('field');
        echo $this->mkaryawan->json($field);
    }*/

	function upload(){
			$config['upload_path'] = './assets/imgkaryawan';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']     = '5000';
			$config['max_width'] = '0';
			$config['max_height'] = '0';
			
			
			
	
			$this->load->library('upload',$config);
				
			$field_name = "uploadFile";
			if ( ! $this->upload->do_upload($field_name)) {
				// return the error message and kill the script
				//echo $this->upload->display_errors(); die();
				
			
			} else {
			
			}
		}



	/* Fungsi Jenis Surat */
	function getkota(){
        $id=$this->input->get('id');
		echo $this->mkaryawan->getkota($id);
    }
	function getkecamatan(){
        $id=$this->input->get('id');
		echo $this->mkaryawan->getkecamatan($id);
    }
	function getdesa(){
        $id=$this->input->get('id');
		echo $this->mkaryawan->getdesa($id);
    }
	
	

	function tambah_karyawan(){
		
		$a['page']	= "karyawan/tambah_karyawan";
		$this->load->view('admin/index', $a);
	}

	function insertdata(){
		$table =  'tkaryawan';
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->insert($table, $myjson );
		redirect('ckaryawan/tampil','refresh');
	}



	function editkaryawan($id){
		$a['page']	= "karyawan/edit_karyawan";
		$this->load->view('admin/index', $a, $id);
	}

	function updatedata(){
		$table =   'tkaryawan';
		$idtable =  'idkaryawan';
		$id = $_GET['id'];
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->where( $idtable, $id);
		$this->db->update($table, $myjson); 


	}

	

	function hapuskaryawan($id){
		$this->mkaryawan->hapuskaryawan($id);
		redirect('ckaryawan/tampil','refresh');
	}

	function getjsonsample()
    {
		echo $this->mkaryawan->getjson();
    }

	
	function urlcmb()
    {

		echo $this->mkaryawan->url();
    }
	
	
	
	function getjsonshow()
    {
	$id = $_GET['id'];
  	echo $this->mkaryawan->mgetjsonshow($id);
    }
	
	function getjson_popup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mkaryawan->get_datapopup($string);
    }
	function getjson_headerpopup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mkaryawan->get_headerpopup($string);
    }


}


