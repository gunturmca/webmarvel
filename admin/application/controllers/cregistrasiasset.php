<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cregistrasiasset extends CI_Controller {

	    public function __construct() {
        parent::__construct();
		if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}
        $this->load->model('mregistrasiasset');
    }
    
    public function parah() {
      

       $this->load->view('admin/registrasiasset');
    }
	
	function dataLocName()
	{
			echo $this->mregistrasiasset->dataLocName();
	}
	function dataLineName()
	{
			echo $this->mregistrasiasset->dataLineName();
	}
	
	function dataSupplierName()
	{
			echo $this->mregistrasiasset->dataSupplierName();
	}
	
	function dataDepartment()
	{
			echo $this->mregistrasiasset->dataDepartment();
	}
	function dataSection()
	{
			echo $this->mregistrasiasset->dataSection();
	}

	function tampil(){
		
		$a['page']	= "registrasi_asset";

		$this->load->view('admin/index', $a);
	}
	function tampilgrid(){
		$OnSite= $this->session->userdata('onsite');
		$field = $this->input->get('field');
		$clm= $this->input->get('clm');
		echo $this->mregistrasiasset->tampildata($field,$OnSite,$clm);
	}
	
	function json() {
	 $field=$this->input->post('field');
       echo $this->mregistrasiasset->json($field);
    }

/*    public function json() {
	$field =  $this->input->post('field');
        echo $this->mregistrasiasset->json($field);
    }*/

	function upload(){
			$config['upload_path'] = './assets/imgregistrasiasset';
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
		$table =  'tlowvalue_asset';
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);

		$insert = $this->db->insert($table, $myjson );
		if ($insert==1)
		{echo $insert;}
		else
		{echo $insert=0;}
		

		
		
		//redirect('cregistrasiasset/tampil','refresh');
	}




	function updatedata(){
		$table =   'tlowvalue_asset';
		$idtable =  'idfixedassets';
		$id = $_GET['id'];
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		//$StyleCode=$myjson['stylecode'];
		//$fabtype=$myjson['fabtype'];
		//$StandardValue=$myjson['standardvalue'];
		$this->db->where( $idtable, $id);
		$update = $this->db->update($table, $myjson); 
		//$update = $this->db->query("update tlowvalue_asset set  FabType = '$fabtype',StandardValue = '$StandardValue' where idfixedassets= '$id'"); 
		//echo "<script> alert('$id') ; </script>";
		if ($update==1)
		{echo $update;}
		else
		{echo $update=0;}
		

	}

	

	function hapusregistrasiasset(){
		$id = $_POST['id'];
		$delete = $this->mregistrasiasset->hapusregistrasiasset($id);
		echo $delete;
	}

	function getjsonsample()
    {
		
		echo $this->mregistrasiasset->getjson();
    }

	function getfabric()
    {

		echo $this->mregistrasiasset->getfabric();
    }

	function urlcmb()
    {

		echo $this->mregistrasiasset->url();
    }
	
	
	
	function getjsonshow()
    {
	$id = $_GET['id'];
  	echo $this->mregistrasiasset->mgetjsonshow($id);
    }
	
	function getjson_popup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mregistrasiasset->get_datapopup($string);
    }
	function getjson_headerpopup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mregistrasiasset->get_headerpopup($string);
    }


}


