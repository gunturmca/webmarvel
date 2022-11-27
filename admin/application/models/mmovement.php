<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mmovement extends CI_Model {

	public function tampil()
	 {
		return  $this->db->query("");
  
    }
	public function hdr($field,$fromdate,$todate,$qhour)
	 {
  		$arr = array();
		$where = "  (a.movedate between '$fromdate' and '$todate') and a.SageStatus = '0' and  qhour = '$qhour'";
		$sql = "WITH
		group1 as (
					SELECT   row_number() over (partition by b.qProdCode order by a.movetime)  AS RowNo,b.qProdCode,a.Loc_From,a.Loc_Dest,b.qlot
		
						from trnMovement as a inner join mFabricRoll as b on a.QRNumber = b.QRNumber where (b.qProdCode is not null or b.qProdCode <> '') and  (b.qPO is not null or b.qPO <> '') and  (b.qLot is not null or b.qLot <> '')
						and (a.movedate between '$fromdate' and '$todate')  and  format(a.movetime,'HH') = '$qhour'  
						group by a.Loc_From,a.Loc_Dest,b.qProdCode,b.qLot,a.movetime
				),
		 movement AS 
				(
					SELECT  top 10000 ROW_NUMBER() OVER(partition by b.qProdCode,a.movetime ORDER BY b.qProdCode,a.movetime ) AS RowNo, a.OnSite,a.QRNumber,a.MoveDate,a.movetime,format(a.movetime,'HH') as qHour, b.qProdCode,b.qProdDesc,b.qPO,b.qLot,a.QtyYard,a.QtyKgs,a.Loc_From,a.Loc_Dest
					,a.SageStatus,a.SageUpdateBy, a.SageUpdateTime,a.SageMoveId
						from trnMovement as a inner join mFabricRoll as b on a.QRNumber = b.QRNumber where (b.qProdCode is not null or b.qProdCode <> '') and  (b.qPO is not null or b.qPO <> '') and  (b.qLot is not null or b.qLot <> '')
						and (a.movedate between '$fromdate' and '$todate')  and  format(a.movetime,'HH') = '$qhour'  
				),
		movement2 as (
						select distinct row_number() over (partition by a.MoveDate,a.qHour,a.qProdCode,a.qLot order by a.qProdCode,a.qLot,a.Loc_Dest,Loc_From ) as rn,a.OnSite,a.MoveDate,qHour, a.qProdCode,a.qLot,a.qProdDesc,a.qPO,a.Loc_From,a.Loc_Dest,b.LocationType,
						sum(a.QtyYard) as QtyYard,sum(a.QtyKgs) as QtyKgs ,iif (a.SageStatus <> 0,'checked','unchecked') as SageStatus , a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId ,'' as chk,
						a.SageMoveId as SageMoveId1 from movement as a left join [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.DimSTOCKLOC AS b on
						a.Loc_from COLLATE DATABASE_DEFAULT = b.Location COLLATE DATABASE_DEFAULT
						where a.SageStatus = '0' and Loc_From <> a.Loc_Dest
						group by a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot,a.Loc_From,a.Loc_Dest,a.SageStatus,a.SageUpdateBy,a.SageUpdateTime, a.SageMoveId,b.LocationType
						),
		movement3 as (
				   SELECT distinct a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , Loc_From,a.Loc_Dest, SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId,
				   a.chk,a.LocationType,d.StockUnit
					from movement2 as a inner join [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.DimPORDERD AS d
					On a.qPO COLLATE DATABASE_DEFAULT = d.PONumber COLLATE DATABASE_DEFAULT and a.qProdCode COLLATE DATABASE_DEFAULT = d.Item COLLATE DATABASE_DEFAULT),
		movement4 as ( 
				   SELECT distinct row_number() over (partition by a.MoveDate,a.qHour,a.qProdCode order by a.qProdCode,a.qLot,a.Loc_Dest,Loc_From ) as rn,a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , Loc_From,a.Loc_Dest, SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId,
				   a.chk,a.LocationType,a.StockUnit from movement3 as a )
				   select * from movement4 where (Loc_From <> '' and Loc_From <> '-') and (Loc_Dest <> '' and Loc_Dest <> '-') order by rn,qHour,qProdCode";
		
		/*"WITH
		
		movement AS 
				   (
					 SELECT  top 10000 ROW_NUMBER() OVER(ORDER BY b.qProdCode,a.movetime asc) AS RowNo,a.OnSite,a.QRNumber,a.MoveDate,a.movetime,format(a.movetime,'HH') as qHour, b.qProdCode,b.qProdDesc,b.qPO,b.qLot,a.QtyYard,a.QtyKgs,a.Loc_From,a.Loc_Dest
					   ,a.SageStatus,a.SageUpdateBy, a.SageUpdateTime,a.SageMoveId
					   from trnMovement as a inner join mFabricRoll as b on a.QRNumber = b.QRNumber where (b.qProdCode is not null or b.qProdCode <> '') and  (b.qPO is not null or b.qPO <> '') and  (b.qLot is not null or b.qLot <> '')
					   and (a.movedate between '$fromdate' and '$todate')  and  format(a.movetime,'HH') = '$qhour'  
				   ),
	   movement2 as (
					   select a.OnSite,a.MoveDate,qHour, a.qProdCode,a.qLot,a.qProdDesc,a.qPO,a.Loc_From,a.Loc_Dest,
					   sum(a.QtyYard) as QtyYard,sum(a.QtyKgs) as QtyKgs ,iif (a.SageStatus <> 0,'checked','unchecked') as SageStatus , a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId ,'' as chk,
					   a.SageMoveId as SageMoveId1,b.LocationType from movement as a left join [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.DimSTOCKLOC AS b on
					   a.Loc_from COLLATE DATABASE_DEFAULT = b.Location COLLATE DATABASE_DEFAULT
					   where a.SageStatus = '0' and Loc_From <> a.Loc_Dest
					   group by a.OnSite,a.MoveDate,a.qHour,b.LocationType,a.qProdCode,a.qProdDesc,a.qPO,a.qLot,a.Loc_From,a.Loc_Dest,a.SageStatus,a.SageUpdateBy,a.SageUpdateTime, a.SageMoveId
					 ),
	   movement3 as (
				  SELECT distinct a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , Loc_From,a.Loc_Dest, SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId,
				  a.chk,a.LocationType,d.StockUnit
				  
				   from movement2 as a inner join [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.DimPORDERD AS d
				   On a.qPO COLLATE DATABASE_DEFAULT = d.PONumber COLLATE DATABASE_DEFAULT and a.qProdCode COLLATE DATABASE_DEFAULT = d.Item COLLATE DATABASE_DEFAULT),
	   
		movement4 as (
					SELECT distinct row_number() over (partition by a.MoveDate,a.qHour,a.qProdCode,a.qLot order by a.qProdCode ) as rn,a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , Loc_From,a.Loc_Dest, SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId,
					a.chk,a.LocationType,a.StockUnit from movement3 as a 
					)
					
		 
					SELECT  a.rn,a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , Loc_From,a.Loc_Dest,  SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId,
					a.chk,a.LocationType,a.StockUnit   from movement4 as a order by a.rn";
			  
				  
		*/
		$query = $this->db->query($sql);
		/*$query = $this->db->query(
 "WITH 
 movement AS 
		(
			SELECT a.OnSite,a.QRNumber,a.MoveDate,a.movetime,format(a.movetime,'HH') as qHour, b.qProdCode,b.qProdDesc,b.qPO,b.qLot,a.QtyYard,a.QtyKgs,a.Loc_From,a.Loc_Dest
			,a.SageStatus,a.SageUpdateBy, a.SageUpdateTime,a.SageMoveId
				from trnMovement as a inner join mFabricRoll as b on a.QRNumber = b.QRNumber where (b.qProdCode is not null or b.qProdCode <> '') and  (b.qPO is not null or b.qPO <> '') and  (b.qLot is not null or b.qLot <> '')
				and (a.movedate between '$fromdate' and '$todate')  and  format(a.movetime,'HH') = '$qhour'
		),

		movement2 as (
			select a.OnSite,a.MoveDate,qHour, a.qProdCode,a.qLot,a.qProdDesc,a.qPO,a.Loc_From,a.Loc_Dest,
			sum(a.QtyYard) as QtyYard,sum(a.QtyKgs) as QtyKgs ,iif (a.SageStatus <> 0,'checked','unchecked') as SageStatus , a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId ,'' as chk,
			a.SageMoveId as SageMoveId1,b.LocationType from movement as a left join [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.DimSTOCKLOC AS b on
			a.Loc_from COLLATE DATABASE_DEFAULT = b.Location COLLATE DATABASE_DEFAULT
			where a.SageStatus = '0' and Loc_From <> a.Loc_Dest
			group by a.OnSite,a.MoveDate,a.qHour,b.LocationType,a.qProdCode,a.qProdDesc,a.qPO,a.qLot,a.Loc_From,a.Loc_Dest,a.SageStatus,a.SageUpdateBy,a.SageUpdateTime, a.SageMoveId
		  )

		  SELECT distinct a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , a.Loc_From,a.Loc_Dest, SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId ,
		  a.chk,a.LocationType,a.SageMoveId,d.StockUnit from movement2 as a inner join [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.DimPORDERD AS d
		   On a.qPO COLLATE DATABASE_DEFAULT = d.PONumber COLLATE DATABASE_DEFAULT and a.qProdCode COLLATE DATABASE_DEFAULT = d.Item COLLATE DATABASE_DEFAULT
		 

 
 

 ");
*/
        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }

	public function srchdr($fromdate,$todate,$statussage,$qhour)
	 {
  		$arr = array();
		
		  if ($fromdate !== '' && $todate !== '' && ($statussage > 0 or $statussage ==0) && $qhour !== '' && $qhour !== 'AL')
		  	{	if ($statussage < 2 )
				{	
				  $where = " (a.movedate between '$fromdate' and '$todate') and sagestatus = '$statussage' and qhour = '$qhour'";
				}
				else if ($statussage == 2 )
				{
					$where = " (a.movedate between '$fromdate' and '$todate')   and qhour = '$qhour'";
				}
			  }
		  if ($fromdate !== '' && $todate !== '' && ($statussage=='') && $qhour !== '')
		 	{
				$where = " (a.movedate between '$fromdate' and '$todate')  and sagestatus = '$statussage' and qhour = '$qhour'";
			  }

		if ($fromdate !== '' && $todate !== '' && ($statussage > 0 or $statussage ==0) && $qhour !== '' && $qhour == 'Al')
		  	{	if ($statussage < 2 )
				{	
				  $where = " (a.movedate between '$fromdate' and '$todate') and sagestatus = '$statussage' ";
				}
				else if ($statussage == 2 )
				{
					$where = " (a.movedate between '$fromdate' and '$todate')   ";
				}
				
			  }

			  $sql = "WITH
			  group1 as (
						  SELECT   row_number() over (partition by b.qProdCode order by a.movetime)  AS RowNo,b.qProdCode,a.Loc_From,a.Loc_Dest,b.qlot
			  
							  from trnMovement as a inner join mFabricRoll as b on a.QRNumber = b.QRNumber where (b.qProdCode is not null or b.qProdCode <> '') and  (b.qPO is not null or b.qPO <> '') and  (b.qLot is not null or b.qLot <> '')
							  and (a.movedate between '$fromdate' and '$todate') 
							  group by a.Loc_From,a.Loc_Dest,b.qProdCode,b.qLot,a.movetime
					  ),
			   movement AS 
					  (
						  SELECT  top 10000 ROW_NUMBER() OVER(partition by b.qProdCode,a.movetime ORDER BY b.qProdCode,a.movetime ) AS RowNo, a.OnSite,a.QRNumber,a.MoveDate,a.movetime,format(a.movetime,'HH') as qHour, b.qProdCode,b.qProdDesc,b.qPO,b.qLot,a.QtyYard,a.QtyKgs,a.Loc_From,a.Loc_Dest
						  ,a.SageStatus,a.SageUpdateBy, a.SageUpdateTime,a.SageMoveId
							  from trnMovement as a inner join mFabricRoll as b on a.QRNumber = b.QRNumber where (b.qProdCode is not null or b.qProdCode <> '') and  (b.qPO is not null or b.qPO <> '') and  (b.qLot is not null or b.qLot <> '')
							  and (a.movedate between '$fromdate' and '$todate') 
					  ),
			  movement2 as (
							  select distinct row_number() over (partition by a.MoveDate,a.qHour,a.qProdCode,a.qLot order by a.qProdCode,a.qLot,a.Loc_Dest,Loc_From ) as rn,a.OnSite,a.MoveDate,qHour, a.qProdCode,a.qLot,a.qProdDesc,a.qPO,a.Loc_From,a.Loc_Dest,b.LocationType,
							  sum(a.QtyYard) as QtyYard,sum(a.QtyKgs) as QtyKgs ,iif (a.SageStatus <> 0,'checked','unchecked') as SageStatus , a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId ,'' as chk,
							  a.SageMoveId as SageMoveId1 from movement as a left join [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.DimSTOCKLOC AS b on
							  a.Loc_from COLLATE DATABASE_DEFAULT = b.Location COLLATE DATABASE_DEFAULT
							  where " .$where. " and Loc_From <> a.Loc_Dest
							  group by a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot,a.Loc_From,a.Loc_Dest,a.SageStatus,a.SageUpdateBy,a.SageUpdateTime, a.SageMoveId,b.LocationType
							  ),
			  movement3 as (
						 SELECT distinct a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , Loc_From,a.Loc_Dest, SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId,
						 a.chk,a.LocationType,d.StockUnit
						  from movement2 as a inner join [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.DimPORDERD AS d
						  On a.qPO COLLATE DATABASE_DEFAULT = d.PONumber COLLATE DATABASE_DEFAULT and a.qProdCode COLLATE DATABASE_DEFAULT = d.Item COLLATE DATABASE_DEFAULT),
			  movement4 as ( 
						 SELECT distinct row_number() over (partition by a.MoveDate,a.qHour,a.qProdCode order by a.qProdCode,a.qLot,a.Loc_Dest,Loc_From ) as rn,a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , Loc_From,a.Loc_Dest, SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId,
						 a.chk,a.LocationType,a.StockUnit from movement3 as a )
						 select * from movement4  where (Loc_From <> '' and Loc_From <> '-')  and (Loc_Dest <> '' and Loc_Dest <> '-') order by rn,qHour,qProdCode";
			  
			 
			 /*
			  "WITH
		movement AS 
				   (
					   SELECT  top 10000 ROW_NUMBER() OVER(ORDER BY b.qProdCode,a.movetime asc) AS RowNo, a.OnSite,a.QRNumber,a.MoveDate,a.movetime,format(a.movetime,'HH') as qHour, b.qProdCode,b.qProdDesc,b.qPO,b.qLot,a.QtyYard,a.QtyKgs,a.Loc_From,a.Loc_Dest
					   ,a.SageStatus,a.SageUpdateBy, a.SageUpdateTime,a.SageMoveId
					   from trnMovement as a inner join mFabricRoll as b on a.QRNumber = b.QRNumber where (b.qProdCode is not null or b.qProdCode <> '') and  (b.qPO is not null or b.qPO <> '') and  (b.qLot is not null or b.qLot <> '')
					   and (a.movedate between '$fromdate' and '$todate') 
				   ),
	   movement2 as (
					   select ROW_NUMBER() OVER(partition by a.MoveDate,a.qHour,a.qProdCode,a.qLot ORDER BY a.qProdCode) AS RowNo,a.OnSite,a.MoveDate,qHour, a.qProdCode,a.qLot,a.qProdDesc,a.qPO,a.Loc_From,a.Loc_Dest,
					   sum(a.QtyYard) as QtyYard,sum(a.QtyKgs) as QtyKgs ,iif (a.SageStatus <> 0,'checked','unchecked') as SageStatus , a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId ,'' as chk,
					   a.SageMoveId as SageMoveId1,b.LocationType from movement as a left join [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.DimSTOCKLOC AS b on
					   a.Loc_from COLLATE DATABASE_DEFAULT = b.Location COLLATE DATABASE_DEFAULT
					   where " .$where. " and Loc_From <> a.Loc_Dest
					   group by a.OnSite,a.MoveDate,a.qHour,b.LocationType,a.qProdCode,a.qProdDesc,a.qPO,a.qLot,a.Loc_From,a.Loc_Dest,a.SageStatus,a.SageUpdateBy,a.SageUpdateTime, a.SageMoveId
					 ),
	   movement3 as (
				  SELECT distinct a.RowNo,a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , Loc_From,a.Loc_Dest, SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId,
				  a.chk,a.LocationType,d.StockUnit
				  
				   from movement2 as a inner join [192.168.2.8\SQLEXPRESS,41798].DBWarehouse.dbo.DimPORDERD AS d
				   On a.qPO COLLATE DATABASE_DEFAULT = d.PONumber COLLATE DATABASE_DEFAULT and a.qProdCode COLLATE DATABASE_DEFAULT = d.Item COLLATE DATABASE_DEFAULT),
	   
	 movement4 as (
					SELECT distinct a.RowNo,a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , Loc_From,a.Loc_Dest, SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId,
					a.chk,a.LocationType,a.StockUnit from movement3 as a 
					)
					
		 
					SELECT  a.RowNo as rn,a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , Loc_From,a.Loc_Dest,  SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId,
					a.chk,a.LocationType,a.StockUnit   from movement4 as a order by rn asc ";
				  
				  
		movement5 as (
				  SELECT  distinct top 2000 a.rn,a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , Loc_From,a.Loc_Dest,  SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId,
				  a.chk,a.LocationType,a.StockUnit   from movement4 as a order by a.rn desc 
				  ),
	   movement6 as (
				  select  row_number() over (partition by a.MoveDate,a.qHour,a.qProdCode,a.qLot, a.QtyYard,a.QtyKgs  order by a.rn desc) as nb,* from movement5 as a 
				  )
				  select  a.OnSite,a.MoveDate,a.qHour,a.qProdCode,a.qProdDesc,a.qPO,a.qLot, a.QtyYard,a.QtyKgs , Loc_From,a.Loc_Dest,  SageStatus ,a.SageUpdateBy,a.SageUpdateTime,a.SageMoveId,
				  a.chk,a.LocationType,a.StockUnit  from movement6 as a where a.nb = 1 ";*/
				  
			  $query = $this->db->query($sql);
			

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
	public function dtl($qProdCode,$qPO,$qLot,$Loc_From,$fromdate,$Loc_Dest,$statussage,$qhour)
	 {
  		$arr = array();
		  if ($statussage==2)
		{
			$statussage1 = '';
		}
		else
		{
			$statussage1= "and SageStatus = '$statussage'";
		}
		
	
		$query = $this->db->query("select a.OnSite,a.MoveDate,format(a.movetime,'HH') as qHour,a.QRNumber,a.Bluebin_from,a.Bluebin_to,a.Loc_From,a.Loc_Dest,a.QtyYard,a.QtyKgs,a.MoveBy,a.MoveDate,b.qLinkGrn
		from trnMovement as a left join mFabricRoll as b on a.QRNumber = b.QRNumber where b.qProdCode='$qProdCode' and b.qPO='$qPO' and b.qLot='$qLot' and a.Loc_From = '$Loc_From' and a.Loc_Dest = '$Loc_Dest' and (a.movedate = '$fromdate') ". $statussage1 . " and format(a.movetime,'HH')  = '$qhour' ");

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	public function loadqrnumber($qProdCode,$qPO,$qLot,$Loc_Dest,$SageMoveId,$tgl,$qhour,$Loc_From)
	 {
  		$arr = array();

		$QRNumber='';
		$query = $this->db->query("select a.QRNumber, a.SageMoveId,a.SageStatus 
		from trnMovement as a inner join mFabricRoll as b on a.QRNumber = b.QRNumber where b.qProdCode='$qProdCode' and b.qPO='$qPO' and b.qLot='$qLot' and a.Loc_Dest = '$Loc_Dest'  and Loc_Dest <> Loc_From and format(movetime,'HH') = '$qhour'");

        foreach($query->result_array() as $rows )
        {
            $QRNumber= $rows['QRNumber'];
			//echo "<script> alert('$QRNumber') ; </script>";
			$query = $this->db->query("update trnMovement set SageStatus='1', SageMoveId='$SageMoveId' where QRNumber = '$QRNumber' and MoveDate = '$tgl'  and Loc_From = '$Loc_From' and Loc_Dest = '$Loc_Dest' ");
			
        }
		
		if ($query)
			{
			$query=json_encode(array('status' => 'Saved Data'));
			return  $query;
		}
		else{
			$query=json_encode(array('status' => 'Data not saved'));
			return  $query;
		}

    }
	public function loadqrnumber0($qProdCode,$qPO,$qLot,$Loc_Dest,$SageMoveId)
	 {
  		$arr = array();

		$QRNumber='';
		$query = $this->db->query("select a.QRNumber, a.SageMoveId,a.SageStatus 
		from trnMovement as a left join mFabricRoll as b on a.QRNumber = b.QRNumber where b.qProdCode='$qProdCode' and b.qPO='$qPO' and b.qLot='$qLot' and a.Loc_Dest = '$Loc_Dest' and Loc_Dest <> Loc_From");

        foreach($query->result_array() as $rows )
        {
            $QRNumber= $rows['QRNumber'];
			//echo "<script> alert('$QRNumber') ; </script>";
			$query = $this->db->query("update trnMovement set SageStatus='0', SageMoveId='$SageMoveId' where QRNumber = '$QRNumber' ");
			
        }
		
		if ($query)
			{
			$query=json_encode(array('status' => 'Saved Data'));
			return  $query;
		}
		else{
			$query=json_encode(array('status' => 'Data not saved'));
			return  $query;
		}

    }
	
	public function akundtl($thnajaran,$idakun)
	 {
  		$arr = array();

		$query = $this->db->query("SELECT c.idakun,a.idakun,b.kdakundtl,b.akundtl,b.satuan,a.pagu
FROM takun_transaksi AS a LEFT JOIN takundtl AS b ON b.idakundtl = a.idakun LEFT JOIN takun AS c ON c.idakun = b.`idakun`  where (c.idakun=$idakun and a.thn_ajaran= '" . $thnajaran . "' ) ");

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
	public function simpandtl($data,$thn_ajaran)
	 {
		 
		 $thn_ajaran = json_decode( $thn_ajaran, true );
		 $query = $this->db->query("SELECT * from takun_transaksi where thn_ajaran = '" . $thn_ajaran . "' ");
		 $total = $query->num_rows();
		 if ($total > 0 )
		 {
			
			$data = json_decode( $data, true );
			$this->db->insert_batch('takun_transaksi',$data);
		 }
		 else
		 {
			$this->db->query("update takun_transaksi set flag=0 where flag = '1' ");
			$data = json_decode( $data, true );
			$this->db->insert_batch('takun_transaksi',$data);
		 }
		 
    }
	
	public function updatedtl($data)
	 {
		 $data = json_decode( $data, true );
		return $this->db->update_batch('takun_transaksi',$data,'idakun_transaksi');
    }

	public function deletedtl($data){
		$data = json_decode( $data, true );
        $this->db->where_in('idakun_transaksi', $data);
    	return $this->db->delete('takun_transaksi');
  	}
	
	public function akundtlshow()
	 {
  		$arr = array();

		$query = $this->db->query("SELECT b.idakundtl,c.akun AS kategori,b.kdakundtl,b.akundtl,b.satuan
FROM takundtl AS b   LEFT JOIN takun AS c ON c.idakun = b.`idakun`   ");

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
	public function akundtlshowedit($thnajaran)
	 {
  		$arr = array();

		$query = $this->db->query("SELECT d.idakun_transaksi,c.akun AS kategori,b.kdakundtl,b.akundtl,b.satuan,IF (b.idakundtl>0, 'true', 'false') as chk,d.pagu
FROM takundtl AS b   LEFT JOIN takun AS c ON c.idakun = b.`idakun` left join takun_transaksi as d ON b.idakundtl = d.idakun where d.thn_ajaran like '" . $thnajaran . "'  ");

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
	public function hapusmovement($id)
	{
	
		return $this->db->delete('takun_transaksi', array('idakun_transaksi' => $id));
	}
	
	public function editakun_transaksi($id)
	{
		return $this->db->get_where('takun_transaksi',array('thn_ajaran'=>$id));
	}
	
	
	public function get_filterdata($field)
    {
        $arr = array();

		$query = $this->db->query("SELECT * from takun_transaksi as b   where b.akundtl like '" . $field . "%' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }
	
		public function getjson()
    {
        $arr = array();
		
		 $query = $this->db->query("SELECT  column_name, column_type,column_comment FROM database_schema WHERE table_name =  'takun_transaksi' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }

	
	public function mgetjsonshow($id)
    {
        $arr = array();


		$query = $this->db->query("SELECT * from takun_transaksi as a where a.thn_ajaran = '$id'");	
        
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
