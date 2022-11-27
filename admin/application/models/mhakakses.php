<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mhakakses extends CI_Model {

	
	public function tampil()
	 {
	 
		
    }
	function getkaryawan($id){
		$arr = array();
		$query = $this->db->query("SELECT DISTINCT a.idkaryawan,a.nik,a.iduser FROM sysuser AS a WHERE a.iduser='$id' " );
		
		
        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr); 
    }
	function gettandaibox($id){
		$arr = array();
		$query = $this->db->query("SELECT idjabatan,fcode FROM sysuseraccess where idjabatan='$id' " );
		
		
        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr); 
    }
	public function hapushakakses($id)
	{
	
		return $this->db->delete('sysuseraccess', array('idjabatan' => $id));
	}
	
	public function edithakakses($id)
	{
		return $this->db->get_where('thakakses',array('idhakakses'=>$id));
	}
	
	public function simpandtl($data)
	 {
		 $data = json_decode( $data, true );
		 return $this->db->insert_batch('sysuseraccess',$data);
  		 
    }
	
	public function get_filterdata($field)
    {
        $arr = array();

		$query = $this->db->query("SELECT * from thakakses as b   where b.depatemen like '" . $field . "%' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
		public function getjson()
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT  column_name, column_type,column_comment FROM database_schema WHERE table_name =  'thakakses' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

	
	public function mgetjsonshow($id)
    {
        $arr = array();


		$query = $this->db->query("SELECT * from thakakses as a where a.idhakakses = '$id'");	
        
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
