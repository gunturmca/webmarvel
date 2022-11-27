<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cgambar extends CI_Controller {

	function __construct(){
		parent::__construct();
		// $this->load->helper(array('url','form'));
		/*if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}*/
		 $this->load->model('mgambar');
		 $idbencana = $this->session->userdata('idbencana');

		 if (empty($idbencana) or $idbencana == 'img' )
		 {
		 	
		 	$this->session->set_userdata('idbencana', $this->uri->segment(3));
		 }
		 
	}
	


		
	  function upload(){
			$config['upload_path'] = './assets/images';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']     = '1024';
			$config['max_width'] = '0';
			$config['max_height'] = '0';
	
			$this->load->library('upload',$config);
				
			$field_name = "uploadFile";
			if ( ! $this->upload->do_upload($field_name)) {
				// return the error message and kill the script
				//echo $this->upload->display_errors(); die();
				redirect('cgambar/tambah_gambar','refresh');
				echo "error";
				
				
			} else {
				 redirect('cgambar/tambah_gambar','refresh');
				 return true;
			}
		}



	/* Fungsi Jenis Surat */
	function tampil(){
		
		
		$field =  $this->input->post('table_search');
		$a['data']	= $this->mgambar->tampil($field)->result_object();
		$a['page']	= "gambar";
		
		$this->load->view('admin/index', $a);
	}

	function tambah_gambar(){
		
		$a['page']	= "gambar/tambah_gambar";
		$this->load->view('admin/index', $a);
	}

	function insertdata(){
		$table =  'tgambar';
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->insert($table, $myjson );
		redirect('cgambar/tampil','refresh');
	}



	function editgambar($id){
		$a['page']	= "gambar/edit_gambar";
		$this->load->view('admin/index', $a, $id);
	}

	function updatedata(){
		$table =   'tgambar';
		$idtable =  'idgambar';
		$id = $_GET['id'];
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->where( $idtable, $id);
		$this->db->update($table, $myjson); 


	}

	

	function hapusgambar($id){
		$this->mgambar->hapusgambar($id);
		redirect('cgambar/tampil','refresh');
	}

	function getjsonsample()
    {
		echo $this->mgambar->getjson();
    }

	
	function urlcmb()
    {

		echo $this->mgambar->url();
    }
	
	
	
	function getjsonshow()
    {
	$id = $_GET['id'];
  	echo $this->mgambar->mgetjsonshow($id);
    }
	
	function getjson_popup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mgambar->get_datapopup($string);
    }
	function getjson_headerpopup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mgambar->get_headerpopup($string);
    }


}

