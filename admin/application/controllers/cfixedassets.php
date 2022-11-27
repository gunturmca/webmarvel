<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('../vendor/autoload.php');
include_once APPPATH . '/third_party/fpdf/fpdf.php';

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class cfixedassets extends CI_Controller {

	function __construct(){
		parent::__construct();
		/*if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}*/
		// $this->load->helper(array('url','form'));
		 $this->load->model('mfixedassets');
		 $this->load->library('pdf');
	}

	function tampil()
	{
		
			/*$field = $this->input->get('table_search');
			$clm= $this->input->get('column');
			
			if ($field!=='' & $clm!=='')
			{$this->session->set_userdata('field',$field);
				$this->session->set_userdata('clm',$clm);
			}
			else
			{$this->session->unset_userdata('field');
				$this->session->unset_userdata('clm');}
		 	
		  
			//echo "<script> alert('$field1') ; </script>";*/
		
		
		$a['page']	= "fixedassets";
		$this->load->view('admin/index', $a);
		// $OnSite= $this->session->userdata('onsite');
		// $field = $this->input->get('field');
		// $clm= $this->input->get('clm');
		// echo $this->mfixedassets->tampildata($field,$OnSite,$clm);

	}
	function sample1()
	{
		
		
		
		$a['page']	= "karyawan";
		$this->load->view('admin/index', $a);
	}


	function tampilgrid(){
	
		$OnSite= $this->session->userdata('onsite');
		$field = $this->input->get('field');
		$clm= $this->input->get('clm');
		
		
			
			echo $this->mfixedassets->tampildata($field,$OnSite,$clm);
			
		
		
			//$this->session->unset_userdata('field');
		
	}
	function loadqrcode(){
			$this->load->view('admin/label');
			//$arr = $this->input->get('arr');
			//echo $this->mfixedassets->loadqrcode($arr);
		
		
	}
	function dataLocName()
	{
			echo $this->mfixedassets->dataLocName();
	}
	function dataLineName()
	{
			echo $this->mfixedassets->dataLineName();
	}
	public function createExcel() {
		//$field=$this->input->post('field');
		$arr=json_decode($this->input->post('arr'));
		$array = array();
		
		//echo "<script> alert('$array') ; </script>";
		/*foreach($arr as $obj) {
			
			$field= $obj->field ;
			$clm= $obj->clm ;
			//array_push($array,$asset);
		}*/
		//$obj = json_decode($input);
		$field= $arr->field;
		$clm= $arr->clm;
		$OnSite= $this->session->userdata('onsite');
		//$field2= "'" . implode ( "', '", $array ) . "'";	
		//echo "<script> alert('$field2') ; </script>";
		
		
		$fileName = 'fixedassets.xlsx';  
		//$data['employeeData'] = $this->mfixedassets->exporttoexel($field2);
		$spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Supplier Name')
			->setCellValue('C1', 'Supplier Invoice')
			->setCellValue('D1', 'L/I')
			->setCellValue('E1', 'Document Link')
			->setCellValue('F1', 'BC Doc') 
			
			->setCellValue('G1', 'Acq. Date')
			->setCellValue('H1', 'Ref. Sage')
			->setCellValue('I1', 'Sage COA')
			->setCellValue('J1', 'FA Tag No')
			->setCellValue('K1', 'FA Description')
			->setCellValue('L1', 'FA Sub-Desc') 
			
			->setCellValue('M1', 'Qty')
			->setCellValue('N1', 'Unit')
			->setCellValue('O1', 'ExcRate')
			->setCellValue('P1', 'Acq. Cost')
			->setCellValue('Q1', 'Depreciation (Years)')
			->setCellValue('R1', 'Department') 
			
			->setCellValue('S1', 'Section')
			->setCellValue('T1', 'Location')
			->setCellValue('U1', 'Line Code')
			->setCellValue('V1', 'Serial Number');

			

			
 		
		      
        $rows = 2;
		$data	= $this->mfixedassets->exporttoexel($field,$clm,$OnSite)->result_object();
		$sheet = $spreadsheet->getActiveSheet();
		
		/*set warna backgroun*/
		$spreadsheet->getActiveSheet()->getStyle('A1:Z1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFE699');
		$sheet->getStyle('A1:Z1')->getAlignment()->setHorizontal('center');	
		$sheet->getStyle('A1:Z1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
		$sheet->getStyle('A1:Z1')->getFont()->setBold(true);	
		foreach ($sheet->getColumnIterator() as $column) {
			$sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
		}

        foreach ($data as $val){
			$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
			$spreadsheet->setActiveSheetIndex(0)
			
			->setCellValue('A'.$rows, $rows-1)
			->setCellValue('B'. $rows, $val->SupplierName)
			->setCellValue('C'. $rows, $val->SupplierInvoice)
			->setCellValue('D'. $rows, $val->Local_Import)
			->setCellValue('E'. $rows, $val->LinkDoc)
			->setCellValue('F'. $rows, $val->BeacukaiDoc) 
			
			->setCellValue('G'. $rows, $val->AcqDate)
			->setCellValue('H'. $rows, $val->RefSage)
			->setCellValue('I'. $rows, $val->SageCOA)
			->setCellValue('J'. $rows, $val->FATagNo)
			->setCellValue('K'. $rows, $val->FADesc)
			->setCellValue('L'. $rows, $val->FASubDesc) 
			
			->setCellValue('M'. $rows, $val->FAQty)
			->setCellValue('N'. $rows, $val->FAUnit)
			->setCellValue('O'. $rows, $val->ExcRate)
			->setCellValue('P'. $rows, $val->AcqCost)
			->setCellValue('Q'. $rows, $val->DepreciationYears)
			->setCellValue('R'. $rows, $val->DeptName) 
			
			->setCellValue('S'. $rows, $val->SectName)
			->setCellValue('T'. $rows, $val->LocName)
			->setCellValue('U'. $rows, $val->LineCode)
			->setCellValue('V'. $rows, $val->SerialNumber);

			
			
            $rows++;
        } 
   $writer = new Xlsx($spreadsheet);
    $fileName = 'Fixes Assest';

    // Redirect hasil generate xlsx ke web client
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');         
    }


	/* Fungsi Jenis Surat */
	
	function json() {
	  $field=$this->input->post('field');
       echo $this->mfixedassets->json($field);
    }
	
	
	function getdatasection()
    {
		 $id=$this->input->get('id');
		echo $this->mfixedassets->datasection($id);
    }
	
	function getdataline()
    {
		 $id=$this->input->get('id');
		echo $this->mfixedassets->dataline($id);
    }

	function tambah_fixedassets(){
		
		$a['page']	= "fixedassets/tambah_fixedassets";
		$this->load->view('admin/index', $a);
	}

	function insertdata(){
		$table =  'lygdatafixedasset';
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		
		$this->db->insert($table, $myjson );
		redirect('cfixedassets/tampil','refresh');
	}

	function simpan()
	{
		date_default_timezone_set('Asia/Jakarta');
		$array = json_decode($this->input->post('arr1'));
		$ok=0;
		foreach($array as $obj) {
		
				
				$username = $this->session->userdata('username'); 
				$asset= $obj->Asset;
				$ProductionLineCode = trim($obj->ProductionLineCode);
				$LocationCode=  trim($obj->LocationCode);
				$sn=  trim($obj->sn);
				$userid=  trim($obj->userid);
				$ModifiedDate = date("Y-m-d H:i:s");
				
				//echo "<script> alert('$asset') ; </script>";
			
				$OnSite= $this->session->userdata('onsite');
				$query = $this->db->query("SELECT count(b.asset) as jml FROM  ttransaction_asset AS b where b.asset = '$asset'");
				foreach ($query->result() as $row)
					{
						$jml= $row->jml;	
					}
	
				if ($jml > 0)
				{
					$ok =$this->db->query("update ttransaction_asset set asset = '$asset',onsite = '$OnSite',ModifiedBy = '$userid',ModifiedDate = '$ModifiedDate', ProductionLineCode = '$ProductionLineCode',LocationCode = '$LocationCode',sn = '$sn'  where asset = '$asset'");
					$ok1 =$this->db->query("update tlowvalue_asset set userID = '$userid',ModifiedBy = '$username',ModifiedDate = '$ModifiedDate', ProductionLineCode = '$ProductionLineCode',LocationCode = '$LocationCode' where asset = '$asset'");
					
				}
				else
				{
					$ok =$this->db->query("insert into ttransaction_asset (asset,onsite,ProductionLineCode,LocationCode,CreateDate,CreateBy) values ('$asset', '$OnSite', '$ProductionLineCode', '$LocationCode', '$ModifiedDate','$userid')");
					$ok1 =$this->db->query("update tlowvalue_asset set userID = '$userid',ModifiedBy = '$username',ModifiedDate = '$ModifiedDate', ProductionLineCode = '$ProductionLineCode',LocationCode = '$LocationCode' where asset = '$asset'");
					 
				}
				//echo "<script> alert('$ok') ; </script>";
					
				
          			
			}
			echo $ok;

	}
	function simpanpopup()
	{
		date_default_timezone_set('Asia/Jakarta');
		$array = json_decode($this->input->post('arr1'));
		$ok=0;
		
		
				
				$username = $this->session->userdata('username'); 
				$asset= $this->input->post('asset');
				$last_movement_date= $this->input->post('last_movement_date') . ' ' . date("h:i:s");
				$ProductionLineCode = trim($this->input->post('ProductionLineCode')) ;
				$LocationCode=  trim($this->input->post('LocationCode')) ; 
				$sn=  NULL;
				$userid=  $this->session->userdata('userid');
				$ModifiedDate = date("Y-m-d H:i:s");
				
				//echo "<script> alert('$asset') ; </script>";
			
				$OnSite= $this->session->userdata('onsite');
				$query = $this->db->query("SELECT count(b.asset) as jml FROM  ttransaction_asset AS b where b.asset = '$asset'");
				foreach ($query->result() as $row)
					{
						$jml= $row->jml;	
					}
	
				if ($jml > 0)
				{
					
					$ok =$this->db->query("update ttransaction_asset set asset = '$asset',onsite = '$OnSite',ModifiedBy = '$userid',ModifiedDate = '$ModifiedDate', ProductionLineCode = '$ProductionLineCode',LocationCode = '$LocationCode',sn = '$sn',last_movement_date='$last_movement_date',lastmovement_createBy='$userid'  where asset = '$asset'");
					$ok1 =$this->db->query("update tlowvalue_asset set userID = '$userid',ModifiedBy = '$username',ModifiedDate = '$ModifiedDate', ProductionLineCode = '$ProductionLineCode',LocationCode = '$LocationCode' where asset = '$asset'");
					
				}
				else
				{
					$ok =$this->db->query("insert into ttransaction_asset (asset,onsite,ProductionLineCode,LocationCode,CreateDate,CreateBy,last_movement_date) values ('$asset', '$OnSite', '$ProductionLineCode', '$LocationCode', '$ModifiedDate','$userid','$last_movement_date')");
					$ok1 =$this->db->query("update tlowvalue_asset set userID = '$userid',ModifiedBy = '$username',ModifiedDate = '$ModifiedDate', ProductionLineCode = '$ProductionLineCode',LocationCode = '$LocationCode' where asset = '$asset'");
					 
				}
				//echo "<script> alert('$ok') ; </script>";
					
				
          			
			
			echo $ok;

	}


	function printqr1()
	{

		
		$print_time = 0;
		date_default_timezone_set('Asia/Jakarta');
		$print_date = date("Y-m-d H:i:s");
		$array = json_decode($this->input->post('arr'));
		foreach($array as $obj) {
		
			
				$asset= $obj->Asset;
				$ProductionLineCode = trim($obj->ProductionLineCode);
				$LocationCode=  trim($obj->LocationCode);
				$userid=  trim($obj->userid);
				
				
				//$asset='AC-LGD1-040000-00001';
				$print_time=0;
				$OnSite= $this->session->userdata('onsite');
				$query = $this->db->query("SELECT count(b.asset) as jml,sum(print_time) as print_time FROM  ttransaction_asset AS b where b.asset = '$asset'");
				foreach ($query->result() as $row)
					{
						$jml= $row->jml;
						$print_time= $row->print_time;
							
					}
					
						
				if ($jml > 0)
				{
					$print_time = $print_time+1;
					$this->db->query("update ttransaction_asset set onsite = '$OnSite',print_time = '$print_time',
										print_date = '$print_date',ProductionLineCode = '$ProductionLineCode',LocationCode = '$LocationCode',userID = '$userid'  where asset = '$asset'");
				}
				else
				{
					$print_time = 1;
					$this->db->query("insert into ttransaction_asset (asset,onsite,print_time,print_date,ProductionLineCode,LocationCode,userID) values ('$asset', '$OnSite', '$print_time', '$print_date', '$ProductionLineCode', '$LocationCode','$userid')");
				}

			}
			


	}
	function printqr2()
	{
		$this->load->view('admin/label');
		$this->printqr1();
	}
	function printqr()
	{
		//$query = shell_exec("powershell.exe -executionpolicy bypass -NoProfile -File C:/xampp/htdocs/fixedasset/admin/assets/rpt/exporttopdf.ps1");
		/*
		$psPath = 'powershell.exe -executionpolicy bypass -NoProfile -File C:/xampp/htdocs/fixedasset/admin/assets/rpt/exporttopdf.ps1';
		$psDIR = 'C:/xampp/htdocs/fixedasset/admin/assets/rpt/';
		$psScript = 'exporttopdf.ps1';
		$runScript = $psDIR. $psScript;
		$runCMD = $psPath; 


		exec( $runCMD,$out,$ret);

		/*echo '<pre>';
		print_r($out);
		print_r($ret);
		echo '</pre>';

		
		// Else the user hit submit without all required fields being filled out:
	

		error_reporting(E_ALL);
		$path =  base_url().'/assets/rpt/TagLabelAsset.pdf';
		//echo $path;
		print "<embed src=" . $path . " width=\"100%\" height=\"100%\">";

		*/

	}

	function editfixedassets($id){
		$a['page']	= "fixedassets/edit_fixedassets";
		$this->load->view('admin/index', $a, $id);
	}

	function updatedata(){
		$table =   'lygdatafixedasset';
		$idtable =  'idfixedassets';
		$id = $_GET['id'];
		$bagong = $this->input->get('myjson');
		$myjson =json_decode($bagong,true);
		$this->db->where( $idtable, $id);
		$this->db->update($table, $myjson); 


	}

	

	function deletedtl1(){
		$idfixedassetsdtl = $this->input->get('idfixedassetsdtl');
		
		echo $this->mfixedassets->deletedtl1($idfixedassetsdtl);
		
	}
	
	function hapusfixedassets($id){
		$this->mfixedassets->hapusfixedassets($id);
		redirect('cfixedassets/tampil','refresh');
	}

	function getjsonsample()
    {
		echo $this->mfixedassets->getjson();
    }

	
	function urlcmb()
    {

		echo $this->mfixedassets->url();
    }
	
	function tampiledit(){
		$field =  $this->input->get('idfixedassets');	
		echo $this->mfixedassets->tampiledit($field);
	}
	
	function datafixedassets(){	
		echo $this->mfixedassets->datafixedassets();
	}
	
	function datapeserta(){	
		echo $this->mfixedassets->datapeserta();
	}
	
	function datasikap(){	
		echo $this->mfixedassets->datasikap();
	}
	
	
	function getjsonshow()
    {
		$id = $field =  $this->input->get('id');	
		echo $this->mfixedassets->mgetjsonshow($id);
    }

	function getstatusbutton()
    {
		
		echo $this->mfixedassets->getstatusbutton();
    }

	function dtl(){
		$Asset=$this->input->get('Asset');
		

		echo $this->mfixedassets->dtl($Asset);
	}

	function getjson_popup()
    {
	
		$string =  $this->input->get('fields');	
		echo $this->mfixedassets->get_datapopup($string);
    }
	function getjson_headerpopup()
    {
	
		$string =  $_GET['fields'];
		echo $this->mfixedassets->get_headerpopup($string);
    }
	
	function urlautonumber()
    {
		echo $this->mfixedassets->urlnumber();
    }
	
	function cekidfixedassets()
	{
		$nota = $this->input->get('nota');
		echo $this->mfixedassets->idfixedassets($nota);
	}
	function simpandtl(){
			$data= $this->input->get('arr');
			echo $this->mfixedassets->simpandtl($data);
			
		
		}
	function updatedtl(){
			$data= $this->input->get('arr');
			 
			echo $this->mfixedassets->updatedtl($data);
			
		
		}
}

