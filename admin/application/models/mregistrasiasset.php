<?php

class mregistrasiasset extends CI_Model {

	public function __construct() {
        parent::__construct();
    }
   
				
	function tampildata($field,$OnSite,$clm)
	 {
        $arr = array();
        $and='';
        
		if ($clm == '' && $field == '')
        {
            $and= "onsite = '$OnSite'";
        }
        else
        {
            $and= " onsite = '$OnSite'  and  (lower (" . $clm . ") like '%" . strtolower($field) . "%' )";
        }
        $sql  ="SELECT  * from tlowvalue_asset where  " .  $and . "     order by idfixedassets desc";
         $query  = $this->db->query($sql);
        
         
		foreach($query->result_object() as $rows )
        {

            $arr[] = $rows;
			
        }
        return  json_encode($arr);
       
       
    }

    public function dataLocName()
    {
		$idkaryawan = $this->session->userdata('userid'); 
        $arr = array();
		
		 $query = $this->db->query("WITH CTE
         AS
         (
            select distinct LocationCode as LocName
             FROM ttransaction_asset where LocationCode <> '' and LocationCode is not null
             UNION ALL
            select distinct LocationCode 
             FROM tlowvalue_asset where LocationCode <> '' and LocationCode is not null
         )
         SELECT * FROM CTE ORDER BY LocName asc" );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

    public function dataLineName()
    {
		$idkaryawan = $this->session->userdata('userid'); 
        $arr = array();
		
		 $query = $this->db->query("WITH CTE
         AS
         (
            select distinct ProductionLineCode as LineCode
             FROM ttransaction_asset where ProductionLineCode <> '' and ProductionLineCode is not null
             UNION ALL
            select distinct ProductionLineCode 
             FROM tlowvalue_asset where ProductionLineCode <> '' and ProductionLineCode is not null
         )
         SELECT * FROM CTE ORDER BY LineCode asc" );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

    public function dataSupplierName()
    {
		$idkaryawan = $this->session->userdata('userid'); 
        $arr = array();
		
		 $query = $this->db->query("WITH CTE
         AS
         (
            select distinct SupplierName 
			FROM [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.DimSUPPLIERD  where SupplierName <> '' and SupplierName is not null
             
         )
         SELECT SupplierName  FROM CTE order by SupplierName asc " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

    public function dataDepartment()
    {
		$idkaryawan = $this->session->userdata('userid'); 
        $arr = array();
		
		 $query = $this->db->query("
         select distinct AnalyticalDimDesc as Department 
         FROM [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.DimFXDASSETSD  where AnalyticalDimDesc <> '' and AnalyticalDimDesc is not null order by AnalyticalDimDesc asc " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

    public function dataSection()
    {
		$idkaryawan = $this->session->userdata('userid'); 
        $arr = array();
		
		 $query = $this->db->query("WITH CTE
         AS
         (
            select distinct Section COLLATE DATABASE_DEFAULT as  Section
			FROM [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.FixedAsset  where Section <> '' and Section is not null
             UNION ALL
            select distinct Section  COLLATE DATABASE_DEFAULT  as  Section
             FROM tlowvalue_asset where Section COLLATE DATABASE_DEFAULT  <> '' and Section is not null 
         )
         SELECT distinct Section COLLATE DATABASE_DEFAULT as Section FROM CTE order by Section asc " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

    function getfabric()
	 {
        $arr = array();
        
         $query  = $this->db->query(" SELECT distinct fabtype as id,fabtype as nama FROM tlowvalue_asset order by fabtype asc");
        
         
		foreach($query->result_object() as $rows )
        {

            $arr[] = $rows;
			
        }
        return  json_encode($arr);
       
       
    }

    
	public function hapusregistrasiasset($id)
	{
	
		return $query = $this->db->query("delete tlowvalue_asset    where idfixedassets = $id " );
	}
	
	public function edimregistrasiasset($id)
	{
		return $this->db->get_where('tlowvalue_asset',array('idregistrasiasset'=>$id));
	}
	
	
	public function get_filterdata($field)
    {
        $arr = array();

		$query = $this->db->query("SELECT * from tlowvalue_asset as b   where b.nama like '" . $field . "%' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
		public function getjson()
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT  lower(column_name) as  column_name, lower(data_type) as  data_type FROM database_schema WHERE table_name =  'tlowvalue_asset' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

	
	public function mgetjsonshow($id)
    {
        $arr = array();


		$query = $this->db->query("SELECT * from tlowvalue_asset as a where a.idfixedassets = '$id'  ");	
        
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