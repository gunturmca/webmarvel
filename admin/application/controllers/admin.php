<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}
		 $this->load->helper(array('url','form'));
		
		 $this->load->model('model_admin');
		 
	}
	

	function index(){
		if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}
	    $userid = $this->session->userdata('userid');
		/*$a['kesiangan']	= $this->model_admin->kesiangan()->result_object();
		$a['mangkir']	= $this->model_admin->mangkir()->result_object();
		$a['pelbaru']	= $this->model_admin->pelbaru()->result_object();
		$a['pelaktif']	= $this->model_admin->pelaktif()->result_object();
		$a['pelberakhir']	= $this->model_admin->pelberakhir()->result_object();
		$a['approve']	= $this->model_admin->approve()->result_object();
		$a['approved']	= $this->model_admin->approved()->result_object();
		$a['reject']	= $this->model_admin->reject()->result_object();*/
		
		/*$a['profile1']	= $this->model_admin->profile1($idkaryawan)->result_object();
		
		$a['kontrakberakhir']	= $this->model_admin->kontrakberakhir()->result_object();*/

		/*$a['mangkir']	= $this->model_admin->tampil_demografi()->num_rows();
		
		$a['approve']	= $this->model_admin->tampil_demografi()->num_rows();
		$a['approve']	= $this->model_admin->tampil_demografi()->num_rows();
		$a['reject']	= $this->model_admin->tampil_demografi()->num_rows();
		
		$a['pelbaru']	= $this->model_admin->tampil_demografi()->num_rows();
		$a['pelaktif']	= $this->model_admin->tampil_demografi()->num_rows();*/

		/*$a['meninggal']	= $this->model_admin->tampil_meninggal()->num_rows();*/
		
		
		
		$a['page']	= "home";

		$this->load->view('admin/index', $a);
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
	

	

	
	
			
	
	
	
	
	
	
	

	function hideshowdashboard(){
		
	   $field =  $this->session->userdata('idjabatan');
	   $flag =  $this->session->userdata('flag');
		if ($flag == 1 )
		{$card='201';}
		else
		{$card='301';}

	    echo $this->model_admin->hideshowdashboard($field);

	}	
	
	function getjson()
    {
	
	$field =  $this->input->get('field');
  
       echo $this->model_admin->get_filterdata($field);
	   
    }
function getjson_popup()
    {
	
	$field =  $this->input->get('field');
  	echo $this->model_admin->get_datapopup($field);
    }
}

