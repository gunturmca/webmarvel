<?php

class mstandardgramasi extends CI_Model {

	public function __construct() {
        parent::__construct();
    }
   
				
	function tampildata($field)
	 {
        $arr = array();
        $and='';
        $and= "  lower (stylecode) like '%" . strtolower($field) . "%' or lower (fabtype) like '%" . strtolower($field) . "%' or lower (standardvalue) like '%" . strtolower($field) . "%' ";

         $query  = $this->db->query(" SELECT stylecode,fabtype,fabtype as fabvalue,standardvalue,idstyle from mDataStandardGramasi  where  " .  $and . "   order by stylecode asc");
        
         
		foreach($query->result_object() as $rows )
        {

            $arr[] = $rows;
			
        }
        return  json_encode($arr);
       
       
    }

    function getfabric()
	 {
        $arr = array();
        
         $query  = $this->db->query(" SELECT distinct fabtype as id,fabtype as nama FROM mDataStandardGramasi order by fabtype asc");
        
         
		foreach($query->result_object() as $rows )
        {

            $arr[] = $rows;
			
        }
        return  json_encode($arr);
       
       
    }

    
	public function hapusstandardgramasi($id)
	{
	
		return $query = $this->db->query("delete mDataStandardGramasi    where idstyle = $id " );
	}
	
	public function edimDataStandardGramasi($id)
	{
		return $this->db->get_where('mDataStandardGramasi',array('idstandardgramasi'=>$id));
	}
	
	
	public function get_filterdata($field)
    {
        $arr = array();

		$query = $this->db->query("SELECT * from mDataStandardGramasi as b   where b.nama like '" . $field . "%' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
		public function getjson()
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT  lower(column_name) as  column_name, lower(data_type) as  data_type FROM database_schema WHERE table_name =  'mDataStandardGramasi' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

	
	public function mgetjsonshow($id)
    {
        $arr = array();


		$query = $this->db->query("SELECT stylecode,fabtype,fabtype as idstyle1 ,standardvalue from mdatastandardgramasi as a where a.idstyle = '$id'  ");	
        
		foreach($query->result_object() as $rows )
        {
                for ($i = 1; $i <= $query->num_fields(); $i++)
                {                   
                    $field = odbc_field_name($query->result_id, $i);
                    $arr[odbc_field_name($query->result_id, $i)]  =$rows->$field; 
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