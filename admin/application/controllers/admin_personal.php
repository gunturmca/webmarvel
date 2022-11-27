<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_personal extends CI_Controller {

	function __construct(){
		parent::__construct();
		 $this->load->helper(array('url','form'));
		
		 $this->load->model('model_admin_personal');
		 
	}

	function index(){
		/*if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}*/
	    $iduser = $this->session->userdata('userid');

		$a['datapersonal']	= $this->model_admin_personal->datapersonal($iduser)->result_object();
		$a['nilaiakhir']	= $this->model_admin_personal->nilaiakhir($iduser)->result_object();
		$a['angsuran']	= $this->model_admin_personal->angsuran()->result_object();

		
		
		
		$a['page']	= "home_personal";

		$this->load->view('admin/index', $a);
	}	
	function getjsonshow()
    {
		$id =  $this->input->get('id');
  		echo $this->model_admin_personal->mgetjsonshow($id);
    }
	function getjsonsample()
    {
		echo $this->model_admin_personal->getjson();
    }
	
	function updatedata(){
		$table =   'tpeserta';
		$idtable =  'idpeserta';
		$id = $_GET['id'];
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->where( $idtable, $id);
		$this->db->update($table, $myjson); 


	}
	function updatepassword(){
		/*$tgl=$this->input->post('tgl');
		$table =  'tpelanggaran';
		$data=array ('status' => '1'));
		$this->db->where( 'tglberakhir_sangsi', $tgl);
		$this->db->update($table, $data);*/
		$passbaru = $this->input->get('passbaru');
		$passlama = $this->input->get('passlama');
		$user = $this->input->get('user');
		/*echo '<script> alert (' . $tgl . ') </script>';*/
		echo $this->db->query("update sysuser set password = '$passbaru'  where username='$user' and password ='$passlama'");
		
	
	}
	/* Fungsi Manage User */

	
	

	function tambah_user(){
		$a['page']	= "tambah_user";
		
		$this->load->view('admin/index', $a);
	}






	function hideshowdashboard(){
		
	   $field =  $this->session->userdata('idjabatan');
       echo $this->model_admin_personal->hideshowdashboard($field);
	}	
	
	function getjson()
    {
	
	$field =  $this->input->get('field');
  
       echo $this->model_admin_personal->get_filterdata($field);
	   
    }
	function urlcmb()
    {

		echo $this->model_admin_personal->url();
    }
function getjson_popup()
    {
	
	$field =  $this->input->get('field');
  	echo $this->model_admin_personal->get_datapopup($field);
    }
}

