<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mfixedassets extends CI_Model {

		public function __construct() {
        parent::__construct();
    }
    function tampildata($field,$OnSite,$clm)
	 {
        $arr = array();
        $and='';
        
		if ($clm == '' && $field == '')
        {
            $and= "FinancialSite COLLATE DATABASE_DEFAULT = '$OnSite'";
           
            
        }
        else
        {
            $clm = substr($clm,2) . " COLLATE DATABASE_DEFAULT";
            $and= " FinancialSite COLLATE DATABASE_DEFAULT = '$OnSite'  and  (lower (" . $clm . ") COLLATE DATABASE_DEFAULT like '%" . strtolower($field) . "%' )";
           
            
        }
        
         $query  = $this->db->query("WITH CTE
         AS
         (
		SELECT  a.onsite  as FinancialSite,a.SupplierName,a.InvoiceRef,CASE
			WHEN lower(left(a.LocalOrImport,6))='import' THEN 'Import'
			WHEN lower(left(a.LocalOrImport,5))='local' THEN 'Local'
			ELSE ''
		END as LocalOrImport,b.last_movement_date,b.ModifiedDate,
		a.DocLink,a.BCNo,CAST(a.AllocationDate AS DATE) as AllocationDate,a.ReferenceNo,a.COA,a.Asset,a.Description,
         a.Description2 ,CAST(a.Quantity as Decimal(18,2)) as Quantity,a.Unit,a.ExcRate,a.AcquisitionCost,a.DepreciationYear,a.Department,a.Section,a.LocationCode,a.ProductionLineCode,a.SerialNo,iif(b.Print_Time < 1, NULL,b.Print_Time) as Print_Time,print_date,c.userID + ' ( ' + c.userName + ' )' as userID ,'unchecked' as chk, '' as PhysicalTagNo
         FROM tlowvalue_asset as a left join ttransaction_asset as b ON a.Asset COLLATE DATABASE_DEFAULT = b.asset COLLATE DATABASE_DEFAULT left join mdatauser as c ON b.userID = c.userID 

		union 

		SELECT a.FinancialSite  COLLATE DATABASE_DEFAULT ,a.SupplierName  COLLATE DATABASE_DEFAULT,a.InvoiceRef  COLLATE DATABASE_DEFAULT,CASE
			WHEN lower(left(a.LocalOrImport,6))='import' THEN 'Import'
			WHEN lower(left(a.LocalOrImport,5))='local' THEN 'Local'
			ELSE ''
		END  COLLATE DATABASE_DEFAULT  as LocalOrImport ,b.last_movement_date,b.ModifiedDate,

		a.DocLink COLLATE DATABASE_DEFAULT ,a.BCNo  COLLATE DATABASE_DEFAULT,CAST(a.AllocationDate AS DATE)  as AllocationDate  ,a.ReferenceNo  COLLATE DATABASE_DEFAULT,a.COA  COLLATE DATABASE_DEFAULT ,a.Asset  COLLATE DATABASE_DEFAULT,a.Description COLLATE DATABASE_DEFAULT as Description ,
         a.Description2  COLLATE DATABASE_DEFAULT,CAST(a.Quantity as Decimal(18,2))   as Quantity ,a.Unit  COLLATE DATABASE_DEFAULT ,  CAST(a.ExcRate as Decimal(18,2))  as ExcRate  , CAST(a.AcquisitionCost as Decimal(18,2)) as AcquisitionCost  , CAST(a.DepreciationYear as Decimal(18,2)) as DepreciationYear  ,a.Department  COLLATE DATABASE_DEFAULT,a.Section  COLLATE DATABASE_DEFAULT,
			b.LocationCode,b.ProductionLineCode,
		
		 a.SerialNo  COLLATE DATABASE_DEFAULT,iif(b.Print_Time < 1, NULL,b.Print_Time) as Print_Time  ,print_date ,c.userID + ' ( ' + c.userName + ' )' as userID ,'unchecked' as chk, PhysicalTagNo as PhysicalTagNo
         FROM [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.FixedAsset as a left join ttransaction_asset as b ON a.Asset COLLATE DATABASE_DEFAULT = b.asset COLLATE DATABASE_DEFAULT left join mdatauser as c ON b.userID = c.userID 
		  where a.asset COLLATE DATABASE_DEFAULT not in (select d.Asset from tlowvalue_asset as d )
)
		SELECT 
         FinancialSite  as FinancialSite,
		 SupplierName as SupplierName,
         PhysicalTagNo as PhysicalTagNo,
		 InvoiceRef as InvoiceRef,
		 LocalOrImport as LocalOrImport,
		 DocLink as DocLink,
		 BCNo as BCNo,
		 AllocationDate,
		 ReferenceNo as ReferenceNo,
		 COA as COA,
		 Asset as Asset,
		 Description,
		 Description2 as Description2,
		 Quantity ,
		 Unit as Unit,
		 ExcRate ,
		 AcquisitionCost ,
		 DepreciationYear ,
		 Department as Department,
		 Section as Section,
		 LocationCode as LocationCode,
		 ProductionLineCode as ProductionLineCode,
		 SerialNo as SerialNo,
		  Print_Time,
		  print_date,
          last_movement_date,ModifiedDate,
		  userID ,
		  'unchecked' as chk
		 FROM CTE   where  " .  $and . "   order by Asset desc");
		foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
       return json_encode ($arr, JSON_INVALID_UTF8_SUBSTITUTE);
    }
    public function dtl($Asset)
	 {
  		$arr = array();
	
		
		
		$query = $this->db->query("select *
		from ttransaction_asset_history as a  where a.Asset='$Asset' order by date desc ");

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
    public function loadqrcode($field)
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT  SupplierName,InvoiceRef,CASE
         WHEN lower(left(a.LocalOrImport,6))='import' THEN 'Import'
         WHEN lower(left(a.LocalOrImport,5))='local' THEN 'Local'
         ELSE ''
     END as LocalOrImport,DocLink,BCNo,CAST(AllocationDate AS DATE) as AllocationDate,ReferenceNo,COA,Asset,PhysicalTagNo,Description,
         Description2,CAST(Quantity as Decimal(10,2)) as Quantity,Unit,ExcRate,AcquisitionCost,DepreciationYear,Department,Section,LocationCode,ProductionLineCode,SerialNo,b.Print_Time,print_date,userID,'unchecked' as chk
         FROM [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.FixedAsset where Asset IN ($field)  order by Asset asc" );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);

        
    }    public function dataLocName()
    {
        $arr = array();
		
		 $query = $this->db->query("select distinct LocationCode as LocCode, LocationCode as LocName FROM  ttransaction_asset where LocationCode <> '' and LocationCode is not null " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

    public function dataLineName()
    {
        $arr = array();
		
		 $query = $this->db->query("select distinct ProductionLineCode as LineCode, ProductionLineCode as LineName FROM  ttransaction_asset where ProductionLineCode <> '' and ProductionLineCode is not null" );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }
	

	public function exporttoexel($field,$clm,$OnSite)
    {
        $arr = array();
		
        /*SELECT top 3 SupplierName,InvoiceRef,left(LocalOrImport,5) as LocalOrImport,DocLink,BCNo,CAST(AllocationDate AS DATE) as AllocationDate,ReferenceNo,COA,Asset,Description,
         Description2,CAST(Quantity as Decimal(10,2)) as Quantity,Unit,ExcRate,AcquisitionCost,DepreciationYear,Department,Section,LocationCode,ProductionLineCode,SerialNo,'unchecked' as chk
         FROM FixedAsset  where FinancialSite = '$OnSite' 
		  order by Asset desc*/

         	 
          
		 /*return $query = $this->db->query("
         select  a.SupplierName,a.InvoiceRef as SupplierInvoice,left(a.LocalOrImport,5) as Local_Import,a.DocLink as LinkDoc,a.BCNo as BeacukaiDoc,CAST(a.AllocationDate AS DATE) as AcqDate,a.ReferenceNo as RefSage,
         a.COA as SageCOA,a.Asset as FATagNo,a.Description as FADesc,
         a.Description2 as FASubDesc,CAST(a.Quantity as Decimal(10,2)) as FAQty,a.Unit as FAUnit,a.ExcRate,AcquisitionCost as AcqCost,a.DepreciationYear as DepreciationYears,a.Department as DeptName,a.Section as SectName,
         b.LocationCode as LocName,b.ProductionLineCode as LineCode,a.SerialNo as SerialNumber FROM [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.FixedAsset
         as a left join ttransaction_asset as b  ON a.Asset COLLATE DATABASE_DEFAULT = b.asset COLLATE DATABASE_DEFAULT
         where a.Asset IN ($field2)" );*/


         if ($clm == '' && $field == '')
        {
            $and= "FinancialSite = '$OnSite'";
           
            
        }
        else
        {
            $and= " FinancialSite = '$OnSite'  and  (lower (" . $clm . ") like '%" . strtolower($field) . "%' )";
           
            
        }
        return $query  = $this->db->query("
        select  a.SupplierName,a.InvoiceRef as SupplierInvoice,CASE
        WHEN lower(left(a.LocalOrImport,5))='local' THEN 'Local'
        WHEN lower(left(a.LocalOrImport,6))='import' THEN 'Import'
        ELSE ''
    END  as Local_Import,a.DocLink as LinkDoc,a.BCNo as BeacukaiDoc,CAST(a.AllocationDate AS DATE) as AcqDate,a.ReferenceNo as RefSage,
        a.COA as SageCOA,a.Asset as FATagNo,a.Description as FADesc,
        a.Description2 as FASubDesc,CAST(a.Quantity as Decimal(10,2)) as FAQty,a.Unit as FAUnit,a.ExcRate,AcquisitionCost as AcqCost,a.DepreciationYear as DepreciationYears,a.Department as DeptName,a.Section as SectName,
        b.LocationCode as LocName,b.ProductionLineCode as LineCode,a.SerialNo as SerialNumber FROM [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.FixedAsset
        as a left join ttransaction_asset as b  ON a.Asset COLLATE DATABASE_DEFAULT = b.asset COLLATE DATABASE_DEFAULT where  " .  $and . "   order by a.Asset asc");

        
    }
	
	
	
	
	public function simpandtl($data)
	 {
		 $data = json_decode( $data, true );
		 $this->db->insert_batch('tnilaisikapdtl',$data);
  		 
    }
	public function updatedtl($data)
	 {
		 $data = json_decode( $data, true );
		 $query = $this->db->update_batch('tnilaisikapdtl',$data,'idnilaisikapdtl');
  		 return  json_encode($query);
    }

	public function deletedtl1($id)
	{
		return $this->db->delete('tnilaisikapdtl', array('idnilaisikapdtl' => $id));
	}
	
	public function hapusnilaisikap($id)
	{
		return $this->db->delete('tnilaisikap', array('idnilaisikap' => $id));
	}
	
	public function editnilaisikap($id)
	{
		return $this->db->get_where('tnilaisikap',array('idnilaisikap'=>$id));
	}
	
	
	public function datasection($id)
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT sectcode as id, sectname name FROM lygsection where deptcode = '$id' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }
	public function dataline($id)
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT lineCode as id, linename name FROM lygline where sectcode = '$id' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }
	
	
	
	public function datapeserta()
    {
        $arr = array();
		
		 $query = $this->db->query("select  a.idpeserta,a.nik,a.nama,b.kelas,a.idkelas from tpeserta as a left join tkelas as b on a.idkelas = b.idkelas" );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }
	
	public function datasikap()
    {
        $arr = array();
		
		 $query = $this->db->query("select  a.idsikapdtl as idsikap,b.sikap as kategori,a.sikapdtl as sikap,a.bobot from tsikapdtl as a left join tsikap as b on a.idsikap = b.idsikap" );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }
	
	
	
	public function get_filterdata($field)
    {
        $arr = array();

		$query = $this->db->query("SELECT * from tnilaisikap as b   where b.nmnilaisikap like '" . $field . "%' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
	public function urlnumber()
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
	
	
	
	public function datanilaisikap()
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT b.kdakundtl as kode,b.akundtl as akun,a.idakun,b.`satuan` FROM takun_nilaisikap AS a LEFT JOIN takundtl AS b ON a.`idakun` = b.`idakundtl` where flag='1'" );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }
	
	
		public function getjson()
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT  column_name, column_type,column_comment FROM database_schema WHERE table_name =  'lygdatafixedasset' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

	
	public function mgetjsonshow($id)
    {
        $arr = array();


		$query = $this->db->query("SELECT a.idfixedassets,a.SupplierName,a.SupplierInvoice,a.Local_Import,a.LinkDoc,a.BeacukaiDoc,CAST(a.AcqDate AS DATE) as AcqDate,a.RefSage,a.SageCOA,a.FATagNo,a.FADesc,a.
FASubDesc,a.FAQty ,a.FAUnit,a.AcqCost,a.ExcRate,a.DepreciationYears,a.DeptName,a.SectName,a.SubSectName,a.LocName,a.LineCode ,a.SerialNumber,a.
LiveTime,a.ConditionStatus,a.Remark,b.`DeptCode`,c.`SectCode` as `SectCode1`, d.`LocCode`,a.LineCode AS LineCode1
 FROM lygdatafixedasset AS a LEFT JOIN lygdepartment AS b ON a.DeptName = b.`DeptName`
 LEFT JOIN lygsection AS c ON a.`SectName` = c.`SectName` LEFT JOIN lyglocation AS d ON a.`LocName` = d.`LocName`  where a.idfixedassets = '$id'");	
        
		foreach($query->result_object() as $rows )
        {
		foreach ($query->list_fields() as $field)
			{
				$arr[$field] =$rows->$field ;
			}	   	
       }

        return  json_encode($arr);

    }
	
	public function get_datapopup($field)
    {
       $arr = array();
		
	$query = $this->db->query("SELECT a.idnilaisikap ,a.nik,a.nmnilaisikap  FROM  tnilaisikap AS a  where (a.nmnilaisikap like '" . $field . "%' or a.nik like '" . $field . "%')   limit 1000 ");
		
		
        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  "{\"data\":" .json_encode($arr). "}";
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
