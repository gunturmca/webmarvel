<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class muser extends CI_Model {

	
	public function tampil($field)
	 {
		return  $this->db->query("SELECT * from sysuser where (username like '" . $field . "%' or nik like '" . $field . "%' or nama like '" . $field . "%') limit 1000 ");
  
    }
	public function hapususer($id)
	{
	
		return $this->db->delete('sysuser', array('iduser' => $id));
	}
	
	public function edisysuser($id)
	{
		return $this->db->get_where('sysuser',array('iduser'=>$id));
	}
	
	
	public function get_filterdata($field)
    {
        $arr = array();

		$query = $this->db->query("SELECT * from sysuser as b   where b.username like '" . $field . "%' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
		public function getjson()
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT  column_name, column_type,column_comment FROM database_schema WHERE table_name =  'sysuser' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

	
	public function mgetjsonshow($id)
    {
        $arr = array();


		$query = $this->db->query("SELECT * from sysuser as a where a.iduser = '$id'");	
        
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
