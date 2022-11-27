<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class msubmenu extends CI_Model {

	
	public function tampil($field)
	 {
		return  $this->db->query(" SELECT a.idmenuitem,a.code,a.fcode,a.nameof,a.filename,a.icon,b.nameof AS menu,@no:=@no+1 AS heh 
FROM sysappmenuitem AS a LEFT JOIN sysappmenu AS b ON a.fcode = b.code ,(SELECT @no:= 0) AS NO where (a.nameof like '" . $field . "%' or a.code like '" . $field . "%')
 ORDER BY a.code ASC LIMIT 1000;");
  
    }
	public function hapussubmenu($id)
	{
	
		return $this->db->delete('sysappmenuitem', array('idmenuitem' => $id));
	}
	
	public function editsubmenu($id)
	{
		return $this->db->get_where('sysappmenuitem',array('idmenuitem'=>$id));
	}
	
	
	public function get_filterdata($field)
    {
        $arr = array();

		$query = $this->db->query("SELECT * from sysappmenuitem as b   where b.nameof like '" . $field . "%' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
		public function getjson()
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT  column_name, column_type,column_comment FROM database_schema WHERE table_name =  'sysappmenuitem' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

	
	public function mgetjsonshow($id)
    {
        $arr = array();


		$query = $this->db->query("SELECT * from sysappmenuitem as a where a.idmenuitem = '$id'");	
        
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
