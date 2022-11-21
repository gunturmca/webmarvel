<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class signup extends CI_Controller {

	function __construct(){
		parent::__construct();
		// $this->load->helper(array('url','form'));
		 $this->load->model('msignup');
	}

	public function index()
	{
		$this->load->view('signup');
		
	}


	function getjsonsample()
    {
		
		echo $this->msignup->getjson();
		
    }
	
	
	function insertdata(){
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong);

		$field =  $myjson->nik;

		$query = $this->db->query("SELECT * from tpeserta where nik ='$field'  ");
		$check_insert = 0;
		$total=$query->num_rows();
			if( $total < 1)
			{
				$table =  'tpeserta';
				$bagong = $this->input->get('myjson');
				$myjson =json_decode($bagong,true);
				$check_insert =  $this->db->insert($table, $myjson );
			}
			if($check_insert == 1 && $total < 1){
                $response['status'] = 'true';
                $response['msg'] = 'Data Tersimpan';
            }

			else
			{
				$response['status'] = 'false';
				$response['msg'] = 'Data NIK ( ' .$field. ' ) Sudah Ada';
				
			}
				echo json_encode($response);
	}
	

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */