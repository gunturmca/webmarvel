<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cstandardgramasi extends CI_Controller {

	    public function __construct() {
        parent::__construct();
		/*if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}*/
        $this->load->model('mstandardgramasi');
    }
    
    public function parah() {
      

       $this->load->view('admin/standardgramasi');
    }
	
	function tampil(){
		
		$a['page']	= "standardgramasi";

		$this->load->view('admin/index', $a);
	}
	function tampilgrid(){
		$field = $this->input->get('field');
		echo $this->mstandardgramasi->tampildata($field);
	}
	
	function json() {
	 $field=$this->input->post('field');
       echo $this->mstandardgramasi->json($field);
    }

/*    public function json() {
	$field =  $this->input->post('field');
        echo $this->mstandardgramasi->json($field);
    }*/

	function upload(){
			$config['upload_path'] = './assets/imgstandardgramasi';
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


	function insertdata(){
		$table =  'mDataStandardGramasi';
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$insert = $this->db->insert($table, $myjson );
		if ($insert==1)
		{echo $insert;}
		else
		{echo $insert=0;}
		

		
		
		//redirect('cstandardgramasi/tampil','refresh');
	}




	function updatedata(){
		$table =   'mDataStandardGramasi';
		$idtable =  'idstyle';
		$id = $_GET['id'];
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		//$StyleCode=$myjson['stylecode'];
		$fabtype=$myjson['fabtype'];
		$StandardValue=$myjson['standardvalue'];
		//$this->db->where( $idtable, $id);
		//$update = $this->db->update($table, $myjson); 
		$update = $this->db->query("update mDataStandardGramasi set  FabType = '$fabtype',StandardValue = '$StandardValue' where idstyle= '$id'"); 
		//echo "<script> alert('$id') ; </script>";
		if ($update==1)
		{echo $update;}
		else
		{echo $update=0;}
		

	}

	

	function hapusstandardgramasi(){
		$id = $_POST['id'];
		$delete = $this->mstandardgramasi->hapusstandardgramasi($id);
		echo $delete;
	}

	function getjsonsample()
    {
		
		echo $this->mstandardgramasi->getjson();
    }

	function getfabric()
    {

		echo $this->mstandardgramasi->getfabric();
    }

	function urlcmb()
    {

		echo $this->mstandardgramasi->url();
    }
	
	
	
	function getjsonshow()
    {
	$id = $_GET['id'];
  	echo $this->mstandardgramasi->mgetjsonshow($id);
    }
	
	function getjson_popup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mstandardgramasi->get_datapopup($string);
    }
	function getjson_headerpopup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mstandardgramasi->get_headerpopup($string);
    }


}


