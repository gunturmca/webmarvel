<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class cimport extends CI_Controller {
    function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}
		// $this->load->helper(array('url','form'));
		  $this->load->library('session');
		  $this->load->model('Import_model');
	}
    public function uploadData()
    {
        $user = $this->session->userdata('username');
        $OnSite = $this->session->userdata('onsite');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'doc' . time();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('importexcel')) {
            $file = $this->upload->data();

            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->setShouldFormatDates(true);

            $reader->open('uploads/' . $file['file_name']);

            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 1;
                foreach ($sheet->getRowIterator() as $row) {

                    // $Date = $row->getCellAtIndex(24)->format('d/m/Y');



                    // $newDate = DateTime::createFromFormat("l dS F Y", $row->getCellAtIndex(24));
                    // $newDate = $newDate->format('Y/m/d'); 

                    // $Date = $row->getCellAtIndex(24);
                    // $Date = $row['valdate']->format('d/m/Y');

                    if ($numRow > 1) {

                        // $arrDate = explode("/", $row->getCellAtIndex(24));
                        // $date = $arrDate[2] . '-' . $arrDate[1] . '-' . $arrDate[0];




                        // $date = $row->getCellAtIndex(24);
                        // $potong = substr($date, 6);
                        // $keyword_array=explode(",", trim($row->getCellAtIndex(24)));
                        // print_r($keyword_array); 
                        // var_dump($row->getCellAtIndex(24));
                        // die;

                        $data = array(
                            'GR_NO' => $row->getCellAtIndex(9),
                            'SIZE_NO' => $row->getCellAtIndex(2),
                            // 'SIZE_SORT' => $row->getCellAtIndex(2),
                            'RATIO' => $row->getCellAtIndex(3),
                            'TOTAL_RATIO' => $row->getCellAtIndex(10),
                            'BUYER' => $row->getCellAtIndex(4),
                            'PRINT_STAT' => $row->getCellAtIndex(5),
                            'PRINT_PART_QTY' => $row->getCellAtIndex(6),
                            'EMBRO_STAT' => $row->getCellAtIndex(7),
                            'EMBRO_PART_QTY' => $row->getCellAtIndex(8),
                            'MARKER_LENGTH' => $row->getCellAtIndex(11),
                            'STYLE' => $row->getCellAtIndex(12),
                            'ORDER_NO' => $row->getCellAtIndex(13),
                            'COLOR_DESC' => $row->getCellAtIndex(14),
                            'WO_NO' => $row->getCellAtIndex(15),
                            // 'FabricPO' => $row->getCellAtIndex(16), //BARU UPDATE
                            'PRODUCT_CODE' => $row->getCellAtIndex(17),
                            'PORTION' => $row->getCellAtIndex(18),
                            // 'LAYOUT' => $row->getCellAtIndex(19), //BARU UPDATE
                            'FAB_MAT' => $row->getCellAtIndex(20),
                            'FAB_WIDTH' => $row->getCellAtIndex(21),
                            'FAB_WEIGHT' => $row->getCellAtIndex(22),
                            'MD_CONS' => $row->getCellAtIndex(23),
                            'CUT_CONS' => $row->getCellAtIndex(24),
                            'MARKER_NO' => $row->getCellAtIndex(25),
                            'TOD' => $row->getCellAtIndex(26),
                            'SEASON' => $row->getCellAtIndex(27),
                            'TABLE_INDEX' => $row->getCellAtIndex(28),
                            'QTY_LBR' => $row->getCellAtIndex(29),
                            'TOTAL_QTY' => $row->getCellAtIndex(30),
                            'YARD_REQ' => $row->getCellAtIndex(31), //set integer
                            'KG_REQ' => $row->getCellAtIndex(32),

                            // 'STATUS_SPREADING' => $row->getCellAtIndex(29),
                            // 'AutoNum' => $row->getCellAtIndex(29)
                        );
                        $this->Import_model->import_data($data);
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_name']);

                $sql_sp = "SP_GENERATE_GELAR_REPORT '$OnSite', '$user'";
                $data = $this->db->query($sql_sp);

                $this->session->set_flashdata('flash', 'Import Success');
                redirect('ccalculationplan/tampil');
            }
        } else {
            echo "Error :" . $this->upload->display_errors();
        };
    }
}