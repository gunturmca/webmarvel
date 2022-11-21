<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mmenu extends CI_Model {

	
	public function tampil($field)
	 {
		return  $this->db->query("SELECT * from sysappmenu where (nameof like '" . $field . "%' or code like '" . $field . "%') limit 1000 ");
  
    }
	public function hapusmenu($id)
	{
	
		return $this->db->delete('sysappmenu', array('idmenu' => $id));
	}
	
	public function edisysappmenu($id)
	{
		return $this->db->get_where('sysappmenu',array('idmenu'=>$id));
	}
	
	
	public function get_filterdata($field)
    {
        $arr = array();

		$query = $this->db->query("SELECT * from sysappmenu as b   where b.uraian like '" . $field . "%' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
		public function getjson()
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT  column_name, column_type,column_comment FROM database_schema WHERE table_name =  'sysappmenu' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

	
	public function mgetjsonshow($id)
    {
        $arr = array();


		$query = $this->db->query("SELECT * from sysappmenu as a where a.idmenu = '$id'");	
        
		foreach($query->result_object() as $rows )
        {
		foreach ($query->list_fields() as $field)
			{
				$arr[$field] =$rows->$field ;
			}	   	
       }

        return  json_encode($arr);

    }
	public function url()
    {
        $arr = array();
		$link=decrypt_url($_GET['link']);
		$query = $this->db->query($link );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  json_encode($arr);
    }
	
}
