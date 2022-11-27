<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cadduser extends CI_Controller {

	    public function __construct() {
        parent::__construct();
		if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}
       // $this->load->model('mregistrasiasset');
    }
    
    function updatepassword(){
		/*$tgl=$this->input->post('tgl');
		$table =  'tpelanggaran';
		$data=array ('status' => '1'));
		$this->db->where( 'tglberakhir_sangsi', $tgl);
		$this->db->update($table, $data);*/
		
		$passlama = $this->input->get('passlama');
		$passbaru = $this->input->get('passbaru');
		$user = $this->input->get('user');
		$hasil = 0;
		$query = $this->db->query("SELECT count(*) as jml FROM  mdatauser where userID='$user' and userPassword ='$passlama'");
		foreach ($query->result() as $row)
					{
						$jml= $row->jml;	
					}
		if ($jml)
			{
				$hasil =  $this->db->query("update mdatauser set userPassword = '$passbaru'  where userID='$user' and userPassword ='$passlama'");
				$hasil = 1;
			}
		
			
			echo $hasil ;
	
	}


}


