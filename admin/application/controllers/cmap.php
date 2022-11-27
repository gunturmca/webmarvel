<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cmap extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		// $this->load->helper(array('url','form'));
		$this->session->unset_userdata('idbencana');
		 $this->load->model('mbencana');
	}



	/* Fungsi Jenis Surat */
	

	function tampilmap(){
		
  		echo $this->mbencana->mtampilmap();
    }
	
	
	


}

