<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mjabatan extends CI_Model {

	
	public function tampil($field)
	 {
		return  $this->db->query("SELECT * from tjabatan as b  where (b.jabatan like '" . $field . "%' or b.kdjabatan like '" . $field . "%') limit 1000  ");
  
    }
	public function hapusjabatan($id)
	{
	
		return $this->db->delete('tjabatan', array('idjabatan' => $id));
	}
	
	public function editjabatan($id)
	{
		return $this->db->get_where('tjabatan',array('idjabatan'=>$id));
	}
	
	
	public function get_filterdata($field)
    {
        $arr = array();

		$query = $this->db->query("SELECT * from tjabatan as b   where b.kdjabatan like '" . $field . "%' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
		public function getjson()
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT  column_name, column_type,column_comment FROM database_schema WHERE table_name =  'tjabatan' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

	
	public function mgetjsonshow($id)
    {
        $arr = array();


		$query = $this->db->query("SELECT * from tjabatan as a where a.idjabatan = '$id'");	
        
		foreach($query->result_object() as $rows )
        {
		foreach ($query->list_fields() as $field)
			{
				$arr[$field] =$rows->$field ;
			}	   	
       }

        return  json_encode($arr);

    }
	
}
