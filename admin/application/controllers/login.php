<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		// $this->load->helper(array('url','form'));

		 $this->load->model('model_admin');
	}

	public function index()
	{
		
		/*if($this->session->userdata('admin_valid') == TRUE && $this->session->userdata('user') == 'admin' ){
			
			
			redirect("admin");
		}*/
	/*	if($this->session->userdata('admin_valid') == TRUE && $this->session->userdata('user') == 'personal' ){
			redirect("admin_personal");
		}*/

		
		$this->load->view('login');
	}

	public function do_login()
	{
	
		$u = $this->input->post("userID");
		$p = md5($this->input->post("userPassword"));
		
		//$p = $_COOKIE['src'];
			/*echo "<script> alert('$p') ; </script>";*/
		// echo json_encode('user' => $user, 'pass' => $pass);
		// echo $u."<br>".$p;
		//$sql = "SELECT b.userID AS iduser,b.userPassword as pass,b.userName AS username,b.LastModifyBy FROM  dbo.mdatauser AS b where b.userID = '150006927' and  userPassword = 'b706835de79a2b4e80506f582af3676a' ";
		
		//$query = $this->db->query($sql);
		$cari = $this->model_admin->cek_login($u, $p)->row();
		$hitung = $this->model_admin->cek_login($u, $p)->num_rows();
	/*	$cari_personal = $this->model_admin->cek_login_personal($u, $p)->row();
		$personal = $this->model_admin->cek_login_personal($u, $p)->num_rows();*/
	
		$cari = $this->model_admin->cek_login($u, $p)->row();
		$hitung = $this->model_admin->cek_login($u, $p)->num_rows();
	/*	$cari_personal = $this->model_admin->cek_login_personal($u, $p)->row();
		$personal = $this->model_admin->cek_login_personal($u, $p)->num_rows();*/
	
		if ($hitung > 0) {
				

			$and = ' and a.insert_by =' . $cari->iduser;
			
			$data = array('userid' => $cari->iduser ,
							'username' => $cari->username,   
							'onsite' => $cari->onsite,
							'and' => $and, 
							'admin_valid' => TRUE			
			);
			
			
			$this->session->set_userdata($data);
			/*$and = $this->session->userdata('and');*/
			redirect('admin','refresh');

		}
		
		else{
			echo "Wrong Username or Password";
		}
		
		
		
	}

	public function logout()
	{

		$this->session->sess_destroy();
		redirect('login','refresh');
	}
	public function gantilogin()
	{


		redirect('./login/gantilogin');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */