<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Import_model extends CI_Model
{


    public function import_data($data)
    {

        // var_dump($data);
        // die;
        $jumlah = count($data);
        // var_dump($jumlah);
        // die;

        if ($jumlah > 0) {

            $this->db->insert('CuttingPlan', $data);
        }
    }
}