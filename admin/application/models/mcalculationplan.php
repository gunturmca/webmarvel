<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mcalculationplan extends CI_Model {

	public function tampil()
	 {
		return  $this->db->query("");
    }

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

    //UNTUK TAMPILAN AWAL
    function tampildata(){
        $arr = array();
        $query = $this->db->query("SELECT  CP.ORDER_NO, LTRIM(RTRIM(CP.STYLE)) AS STYLE, CP.COLOR_DESC, Y.TOTAL_QTY, ISNULL(X.TotalCutting, 0) AS TOTAL_CUTTING,
            CONVERT(DECIMAL(18,2), (CONVERT(DECIMAL(18,2), ISNULL(X.TotalCutting, 0)) / CONVERT(DECIMAL(18,2), Y.TOTAL_QTY) * 100)) AS PercentageCutting, Z.MinCTDate, Z.MaxCTDate
            FROM CutSpread_Plan CP LEFT JOIN (
                SELECT N.OrderNumber, N.StyleDesc, N.ColorDesc, SUM(N.TotalPCS) AS TotalCutting FROM (
                    SELECT H.GRNo, H.OrderNumber, H.StyleDesc, H.ColorDesc, H.Portion, H.TableNo, D.TotalLayer, C.TOTAL_RATIO, (D.TotalLayer * C.TOTAL_RATIO) AS TotalPCS
                    FROM trnSpreadingH H
                        INNER JOIN (SELECT GRNo, SUM(TotalLayer) AS TotalLayer FROM trnSpreadingD GROUP BY GRNo) D ON H.GRNo = D.GRNo
                        INNER JOIN CutSpread_Plan C ON H.GRNo = C.GR_NO
                    WHERE H.Portion LIKE '%BODY%' AND C.STATUS_CUTTING = 3
                    GROUP BY H.GRNo, H.OrderNumber, H.StyleDesc, H.ColorDesc, H.Portion, D.TotalLayer, H.TableNo, C.TOTAL_RATIO
                ) N
                GROUP BY N.OrderNumber, N.StyleDesc, N.ColorDesc
            ) X ON CP.ORDER_NO = X.OrderNumber AND LTRIM(RTRIM(CP.STYLE)) = LTRIM(RTRIM(X.StyleDesc)) AND CP.COLOR_DESC = X.ColorDesc LEFT JOIN (
                SELECT ORDER_NO, STYLE, COLOR_DESC, SUM(TOTAL_QTY) AS TOTAL_QTY FROM (
                SELECT GR_NO, ORDER_NO, STYLE, COLOR_DESC, TABLE_INDEX, TOTAL_QTY
                FROM CutSpread_Plan
            GROUP BY GR_NO, ORDER_NO, STYLE, COLOR_DESC, TABLE_INDEX, TOTAL_QTY) S GROUP BY ORDER_NO, STYLE, COLOR_DESC
            ) Y ON CP.ORDER_NO = Y.ORDER_NO AND LTRIM(RTRIM(CP.STYLE)) = LTRIM(RTRIM(Y.STYLE)) AND CP.COLOR_DESC = Y.COLOR_DESC LEFT JOIN (
                SELECT B.ORDER_NO, B.STYLE, B.COLOR_DESC, MIN(CONVERT(DATE, A.CuttingDate)) AS MinCTDate, MAX(CONVERT(DATE, A.CuttingDate)) AS MaxCTDate
                FROM dbo.trnSpreadCuttingH AS A INNER JOIN
                    dbo.CutSpread_Plan AS B ON A.GRNo = B.GR_NO
                GROUP BY B.ORDER_NO, B.STYLE, B.COLOR_DESC
            ) Z ON CP.ORDER_NO = Z.ORDER_NO AND LTRIM(RTRIM(CP.STYLE)) = LTRIM(RTRIM(Z.STYLE)) AND CP.COLOR_DESC = Z.COLOR_DESC
            WHERE CP.PORTION LIKE '%BODY%'
            GROUP BY CP.ORDER_NO, LTRIM(RTRIM(CP.STYLE)), CP.COLOR_DESC, Y.TOTAL_QTY, ISNULL(X.TotalCutting, 0), Z.MinCTDate, Z.MaxCTDate
            ORDER BY MAX(CP.GR_NO) DESC, CP.ORDER_NO, LTRIM(RTRIM(CP.STYLE)), CP.COLOR_DESC");
        foreach($query->result_object() as $rows )
        {

            $arr[] = $rows;
			
        }
        return  json_encode($arr);
    }

    function tampilDataDetailHeader($ORDER_NO, $STYLE, $COLOR_DESC){
        $arr = array();
        $query = $this->db->query("SELECT CP.GR_NO, CP.ORDER_NO, CP.WO_NO, CP.COLOR_DESC, CP.PRODUCT_CODE, CP.PORTION, CP.TABLE_INDEX, CP.STYLE, CP.TOTAL_QTY,  ISNULL(CT.OutputQty, 0) AS TOTAL_CUTTING,
        CASE WHEN CT.OutputQty IS NULL THEN 0 ELSE CONVERT(DECIMAL(18,2), ((CONVERT(DECIMAL(18,2), ISNULL(CT.OutputQty, 0)) / CONVERT(DECIMAL(18,2), CP.TOTAL_QTY)) * 100)) END as PercentageCutting
        FROM CutSpread_Plan CP LEFT JOIN trnSpreadCuttingH CT ON CP.GR_NO = CT.GRNo WHERE ORDER_NO = '$ORDER_NO' AND STYLE = '$STYLE' AND COLOR_DESC = '$COLOR_DESC'
        GROUP BY CP.GR_NO, CP.ORDER_NO, CP.WO_NO, CP.COLOR_DESC, CP.PRODUCT_CODE, CP.PORTION, CP.TABLE_INDEX, CP.STYLE, CP.TOTAL_QTY,  ISNULL(CT.OutputQty, 0),
        CASE WHEN CT.OutputQty IS NULL THEN 0 ELSE CONVERT(DECIMAL(18,2), ((CONVERT(DECIMAL(18,2), ISNULL(CT.OutputQty, 0)) / CONVERT(DECIMAL(18,2), CP.TOTAL_QTY)) * 100)) END
        ORDER BY CP.GR_NO");
        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
       return json_encode ($arr, JSON_INVALID_UTF8_SUBSTITUTE);
    }

    function tampilDataDetailMenu($GR_NO){
        $arr = array();
        $query = $this->db->query("SELECT * FROM vWebCutPlanDetail WHERE GRNo = '$GR_NO'");
//         $query = $this->db->query("SELECT M.QRNumber,
//         F.qPO AS [PO],
//         F.qProdCode, F.qProdDesc, F.qColorDesc,
//         F.qFabType, F.qGrouping, F.qLot,
//         F.qSuppKgs as [QtyStickerKG],
//         F.qSuppYard as [QtyStickerYD],
//         F.InspectStatus as [Inspect], --CHECKLIST
//         F.qActKgs AS [ActualKG],
//         F.qActYard AS [ActualYD],
//         F.qActWidth AS [ActWidth],
//         CP.FAB_WIDTH AS [PlanWidth],
//         CASE WHEN SP.Actual_Kg IS NULL THEN 0 ELSE 1 END AS [Spreading], --CHECKLIST
//         ISNULL(SP.Actual_Kg, 0) AS [ConsKG],
//         ISNULL(SP.Actual_Yd, 0) AS [ConsYD],
//         ISNULL(SP.TotalLayer, 0) AS [TtlLayer],
//         ISNULL(SP.RejectRoll, 0) AS RejectRoll,
//         ISNULL(SP.MatResidue, 0) AS Residue
//         FROM    dbo.trnSpreadingD AS M INNER JOIN
//                 dbo.mFabricRoll AS F ON M.QRNumber = F.QRNumber INNER JOIN
//                 dbo.CutSpread_Plan AS CP ON M.GRNo = CP.GR_NO LEFT OUTER JOIN
//                 dbo.trnSpreadingD AS SP ON M.QRNumber = SP.QRNumber AND M.GRNo = SP.GRNo
//                 WHERE  M.GRNo = '$GR_NO'         
// --WHERE M.GR_NO = 'GR22102800021'/'GR22102800022'
// GROUP BY M.GRNo, M.QRNumber, F.qPO, F.qProdCode, F.qProdDesc, F.qColorDesc, F.qFabType, F.qGrouping, F.qLot, F.qSuppKgs, F.qSuppYard, F.InspectStatus, SP.Actual_Kg,
//                 SP.Actual_Yd, SP.TotalLayer, SP.RejectRoll, SP.MatResidue, F.qActYard, F.qActKgs, F.qActWidth, CP.FAB_WIDTH");
        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
        return  "{\"data\":" .json_encode($arr). "}";
    }

    public function list()
    {
        // return $this->db->query("SELECT CP.ORDER_NO, CP.STYLE, CP.COLOR_DESC, SUM(CP.TOTAL_QTY) AS TOTAL_QTY, ISNULL(X.TotalCutting, 0) AS TOTAL_CUTTING, CONVERT(DECIMAL(18,2), (CONVERT(DECIMAL(18,2), ISNULL(X.TotalCutting, 0)) / CONVERT(DECIMAL(18,2), SUM(CP.TOTAL_QTY)) * 100)) AS PercentageCutting
        // FROM CutSpread_Plan CP LEFT JOIN (
        //     SELECT N.OrderNumber, N.StyleDesc, N.ColorDesc, SUM(N.TotalPCS) AS TotalCutting FROM (
        //     SELECT H.GRNo, H.OrderNumber, H.StyleDesc, H.ColorDesc, (SUM(D.TotalLayer) * C.TOTAL_RATIO) AS TotalPCS FROM trnSpreadingH H INNER JOIN
        //     (SELECT GRNo, SUM(TotalLayer) AS TotalLayer FROM trnSpreadingD GROUP BY GRNo) D ON H.GRNo = D.GRNo INNER JOIN
        //         CutSpread_Plan C ON H.GRNo = C.GR_NO
        //         WHERE H.Portion LIKE '%BODY%' AND C.STATUS_CUTTING = 3
        //         GROUP BY H.GRNo, H.OrderNumber, H.StyleDesc, H.ColorDesc, C.TOTAL_RATIO
        //     ) N
        //     GROUP BY N.OrderNumber, N.StyleDesc, N.ColorDesc
        // ) X ON CP.ORDER_NO = X.OrderNumber AND CP.STYLE = X.StyleDesc AND CP.COLOR_DESC = X.ColorDesc
        // WHERE CP.PORTION LIKE '%BODY%'
        // GROUP BY CP.ORDER_NO, CP.STYLE, CP.COLOR_DESC, ISNULL(X.TotalCutting, 0)
        // ORDER BY MAX(GR_NO) DESC, CP.ORDER_NO, CP.STYLE, CP.COLOR_DESC")->result_array();

        return $this->db->query("SELECT  CP.ORDER_NO, LTRIM(RTRIM(CP.STYLE)) AS STYLE, CP.COLOR_DESC, Y.TOTAL_QTY, ISNULL(X.TotalCutting, 0) AS TOTAL_CUTTING,
                CONVERT(DECIMAL(18,2), (CONVERT(DECIMAL(18,2), ISNULL(X.TotalCutting, 0)) / CONVERT(DECIMAL(18,2), Y.TOTAL_QTY) * 100)) AS PercentageCutting, Z.MinCTDate, Z.MaxCTDate
        FROM CutSpread_Plan CP LEFT JOIN (
            SELECT N.OrderNumber, N.StyleDesc, N.ColorDesc, SUM(N.TotalPCS) AS TotalCutting FROM (
                SELECT H.GRNo, H.OrderNumber, H.StyleDesc, H.ColorDesc, H.Portion, H.TableNo, D.TotalLayer, C.TOTAL_RATIO, (D.TotalLayer * C.TOTAL_RATIO) AS TotalPCS
                FROM trnSpreadingH H
                    INNER JOIN (SELECT GRNo, SUM(TotalLayer) AS TotalLayer FROM trnSpreadingD GROUP BY GRNo) D ON H.GRNo = D.GRNo
                    INNER JOIN CutSpread_Plan C ON H.GRNo = C.GR_NO
                WHERE H.Portion LIKE '%BODY%' AND C.STATUS_CUTTING = 3
                GROUP BY H.GRNo, H.OrderNumber, H.StyleDesc, H.ColorDesc, H.Portion, D.TotalLayer, H.TableNo, C.TOTAL_RATIO
            ) N
            GROUP BY N.OrderNumber, N.StyleDesc, N.ColorDesc
        ) X ON CP.ORDER_NO = X.OrderNumber AND LTRIM(RTRIM(CP.STYLE)) = LTRIM(RTRIM(X.StyleDesc)) AND CP.COLOR_DESC = X.ColorDesc LEFT JOIN (
            SELECT ORDER_NO, STYLE, COLOR_DESC, SUM(TOTAL_QTY) AS TOTAL_QTY FROM (
            SELECT GR_NO, ORDER_NO, STYLE, COLOR_DESC, TABLE_INDEX, TOTAL_QTY
              FROM CutSpread_Plan
          GROUP BY GR_NO, ORDER_NO, STYLE, COLOR_DESC, TABLE_INDEX, TOTAL_QTY) S GROUP BY ORDER_NO, STYLE, COLOR_DESC
        ) Y ON CP.ORDER_NO = Y.ORDER_NO AND LTRIM(RTRIM(CP.STYLE)) = LTRIM(RTRIM(Y.STYLE)) AND CP.COLOR_DESC = Y.COLOR_DESC LEFT JOIN (
            SELECT B.ORDER_NO, B.STYLE, B.COLOR_DESC, MIN(CONVERT(DATE, A.CuttingDate)) AS MinCTDate, MAX(CONVERT(DATE, A.CuttingDate)) AS MaxCTDate
              FROM dbo.trnSpreadCuttingH AS A INNER JOIN
                   dbo.CutSpread_Plan AS B ON A.GRNo = B.GR_NO
            GROUP BY B.ORDER_NO, B.STYLE, B.COLOR_DESC
        ) Z ON CP.ORDER_NO = Z.ORDER_NO AND LTRIM(RTRIM(CP.STYLE)) = LTRIM(RTRIM(Z.STYLE)) AND CP.COLOR_DESC = Z.COLOR_DESC
        WHERE CP.PORTION LIKE '%BODY%'
        GROUP BY CP.ORDER_NO, LTRIM(RTRIM(CP.STYLE)), CP.COLOR_DESC, Y.TOTAL_QTY, ISNULL(X.TotalCutting, 0), Z.MinCTDate, Z.MaxCTDate
        ORDER BY MAX(CP.GR_NO) DESC, CP.ORDER_NO, LTRIM(RTRIM(CP.STYLE)), CP.COLOR_DESC")->result_array();
    }




    // UNTUK TABEL INDEX
    public function getAllData()
    {
        // return $this->db->query("SELECT DISTINCT ORDER_NO, STYLE, COLOR_DESC
        // FROM CutSpread_Plan")->result_array();
        return $this->db->query("SELECT DISTINCT ORDER_NO, STYLE, COLOR_DESC 
		FROM CuttingPlan")->result_array();
    }

    //UNTUK MASUK DETAIL
    public function getDataDetail($ORDER_NO, $STYLE, $COLOR_DESC)
    {
        // return $this->db->query("SELECT DISTINCT ORDER_NO, WO_NO, COLOR_DESC, PRODUCT_CODE, PORTION, TABLE_INDEX, GR_NO, STYLE
        // FROM CutSpread_Plan WHERE ORDER_NO = '$ORDER_NO' AND STYLE = '$STYLE' AND COLOR_DESC = '$COLOR_DESC' ORDER BY GR_NO")->result();

        return $this->db->query("SELECT CP.GR_NO, CP.ORDER_NO, CP.WO_NO, CP.COLOR_DESC, CP.PRODUCT_CODE, CP.PORTION, CP.TABLE_INDEX, CP.STYLE, CP.TOTAL_QTY,  ISNULL(CT.OutputQty, 0) AS TOTAL_CUTTING,
        CASE WHEN CT.OutputQty IS NULL THEN 0 ELSE CONVERT(DECIMAL(18,2), ((CONVERT(DECIMAL(18,2), ISNULL(CT.OutputQty, 0)) / CONVERT(DECIMAL(18,2), CP.TOTAL_QTY)) * 100)) END as PercentageCutting
        FROM CutSpread_Plan CP LEFT JOIN trnSpreadCuttingH CT ON CP.GR_NO = CT.GRNo WHERE ORDER_NO = '$ORDER_NO' AND STYLE = '$STYLE' AND COLOR_DESC = '$COLOR_DESC'
        GROUP BY CP.GR_NO, CP.ORDER_NO, CP.WO_NO, CP.COLOR_DESC, CP.PRODUCT_CODE, CP.PORTION, CP.TABLE_INDEX, CP.STYLE, CP.TOTAL_QTY,  ISNULL(CT.OutputQty, 0),
        CASE WHEN CT.OutputQty IS NULL THEN 0 ELSE CONVERT(DECIMAL(18,2), ((CONVERT(DECIMAL(18,2), ISNULL(CT.OutputQty, 0)) / CONVERT(DECIMAL(18,2), CP.TOTAL_QTY)) * 100)) END
        ORDER BY CP.GR_NO")->result();
    }

    //UNTUK MASUK EXTEND DATA
    public function getDataCoba($ORDER_NO, $STYLE, $COLOR_DESC)
    {
        return $this->db->query("SELECT M.QRNumber,
        F.qOrderNo AS [ON By PO],
        F.qProdCode, F.qProdDesc, F.qColorDesc,
        F.qFabType, F.qGrouping, F.qLot,
        F.qSuppKgs as [Qty Sticker (KG)],
        F.qSuppYard as [Qty Sticker (YD)],
        F.InspectStatus as [Inspect], --CHECKLIST
        F.qActKgs AS [Actual KG],
        F.qActYard AS [Actual YD],
        F.qActWidth AS [Act. Width],
        CP.FAB_WIDTH AS [Plan Width],
        CASE WHEN SP.Actual_Kg IS NULL THEN 0 ELSE 1 END AS [Spreading], --CHECKLIST
        ISNULL(SP.Actual_Kg, 0) AS [Cons KG],
        ISNULL(SP.Actual_Yd, 0) AS [Cons YD],
        ISNULL(SP.TotalLayer, 0) AS [Ttl Layer],
        ISNULL(SP.RejectRoll, 0) AS RejectRoll,
        ISNULL(SP.MatResidue, 0) AS Residue
FROM            dbo.MaterialSubDetail AS M INNER JOIN
                dbo.mFabricRoll AS F ON M.QRNumber = F.QRNumber INNER JOIN
                dbo.CutSpread_Plan AS CP ON M.GR_NO = CP.GR_NO LEFT OUTER JOIN
                dbo.trnSpreadingD AS SP ON M.QRNumber = SP.QRNumber AND M.GR_NO = SP.GRNo
                WHERE ORDER_NO = '$ORDER_NO' AND STYLE = '$STYLE' AND COLOR_DESC = '$COLOR_DESC'
--WHERE M.GR_NO = 'GR22102800021'/'GR22102800022'
GROUP BY M.GR_NO, M.QRNumber, F.qOrderNo, F.qProdCode, F.qProdDesc, F.qColorDesc, F.qFabType, F.qGrouping, F.qLot, F.qSuppKgs, F.qSuppYard, F.InspectStatus, SP.Actual_Kg,
                SP.Actual_Yd, SP.TotalLayer, SP.RejectRoll, SP.MatResidue, F.qActYard, F.qActKgs, F.qActWidth, CP.FAB_WIDTH")->result();
    }



    //MASUK QUERY EDIT

    //EDIT MENGAMBIL DETAIL BY GRN
    public function getAllCalcu($GR_NO)
    {
        return $this->db->get_where('CutSpread_Plan', ['GR_NO' => $GR_NO])->row_array();
    }

    // MENGAMBIL JUMLAH KOLOM
    public function getCollSpan($GR_NO)
    {
        return $this->db->query("SELECT *
		FROM CutSpread_Plan WHERE GR_NO = '$GR_NO' ")->num_rows();
    }

    public function getSizeRatio($GR_NO)
    {
        return $this->db->query("SELECT SIZE_NO, RATIO, STYLE, COLOR_DESC
		FROM CutSpread_Plan WHERE GR_NO = '$GR_NO' ORDER BY AutoNum ")->result();
    }


    // INSERT ADD PLAN TO DB
    public function editDetail()
    {


        // $no = $Grn['MaxGRN'];
        // $no++;
        // $GR = "GR";
        // $date = date("ymd");
        // $GRNO = $GR . $date . sprintf("%06s", $no);

        // $GR_NO = $GRNO;
        $GR_NO = $this->input->post('GR_NO');
        $SIZE_NO = $this->input->post('sizeNoList[]');
        $RATIO = $this->input->post('totRatio[]');
        $TOTAL_RATIO = $this->input->post('input_total_ratio');
        $BUYER = $this->input->post('buyer');
        $PRINT_STAT = $this->input->post('print_stat');
        $PRINT_PART_QTY = $this->input->post('print_part_qty');
        $EMBRO_STAT = $this->input->post('embro_stat');
        $EMBRO_PART_QTY = $this->input->post('embro_part_qty');
        $MARKER_LENGTH = $this->input->post('marker_length_input');
        $STYLE = $this->input->post('style');
        $ORDER_NO = $this->input->post('on');
        $COLOR_DESC = $this->input->post('color');
        $WO_NO = $this->input->post('wo_no');
        $PRODUCT_CODE = $this->input->post('product_code');
        $PORTION = $this->input->post('portion');
        $FAB_MAT = $this->input->post('fab_mat');
        $FAB_WIDTH = $this->input->post('fab_width');
        $FAB_WEIGHT = $this->input->post('fab_weight');
        $MD_CONS = $this->input->post('md_cons');
        $CUT_CONS = $this->input->post('cut_cons');
        $MARKER_NO = $this->input->post('marker_no');
        $TOD = $this->input->post('tod');
        $SEASON = $this->input->post('season');
        $TABLE_INDEX = $this->input->post('table_index');
        $QTY_LBR = $this->input->post('input_qty_layer');
        $TOTAL_QTY = $this->input->post('input_total_qty');
        $YARD_REQ = $this->input->post('yard_req');
        $KG_REQ = $this->input->post('kg_req');

        // "AutoNum" => '';

        // $data = array();
        $data = array(
            "GR_NO" => $GR_NO,
            "SIZE_NO" => $SIZE_NO,
            "RATIO" => $RATIO,
            "TOTAL_RATIO" => $TOTAL_RATIO,
            "BUYER" => $BUYER,
            "PRINT_STAT" => $PRINT_STAT,
            "PRINT_PART_QTY" => $PRINT_PART_QTY,
            "EMBRO_STAT" => $EMBRO_STAT,
            "EMBRO_PART_QTY" => $EMBRO_PART_QTY,
            "MARKER_LENGTH" => $MARKER_LENGTH,
            "STYLE" => $STYLE,
            "ORDER_NO" => $ORDER_NO,
            "COLOR_DESC" => $COLOR_DESC,
            "WO_NO" => $WO_NO,
            "PRODUCT_CODE" => $PRODUCT_CODE,
            "PORTION" => $PORTION,
            "FAB_MAT" => $FAB_MAT,
            "FAB_WIDTH" => $FAB_WIDTH,
            "FAB_WEIGHT" => $FAB_WEIGHT,
            "MD_CONS" => $MD_CONS,
            "CUT_CONS" => $CUT_CONS,
            "MARKER_NO" => $MARKER_NO,
            "TOD" => $TOD,
            "SEASON" => $SEASON,
            "TABLE_INDEX" => $TABLE_INDEX,
            "QTY_LBR" => $QTY_LBR,
            "TOTAL_QTY" => $TOTAL_QTY,
            "YARD_REQ" => $YARD_REQ,
            "KG_REQ" => $KG_REQ
        );
        // var_dump($data);
        // die();

        foreach ($SIZE_NO as $index => $value) {
            $data['SIZE_NO'] = $SIZE_NO[$index];
            $data['RATIO'] = $RATIO[$index];

            // var_dump($data);
            // die;

            $this->db->where('GR_NO', $GR_NO);
            $this->db->update('CutSpread_Plan', $data);
        }


        // $s = array_merge_recursive($data,$data1,$data2);
        // print_r($data);
        // die();
        // $this->db->insert_batch('CuttingPlan', $s);
        $this->session->set_flashdata('flash', 'Edited');
        redirect('import');






        // $this->db->insert('CuttingPlan', $data);
    }

    // PDF
    public function getHeader($GR_NO)
    {
        return $this->db->query("SELECT DISTINCT *
		FROM CutSpread_Plan WHERE GR_NO = '$GR_NO'")->row();
    }

    // END PDF

    //DELETE DI DETAIL
    public function delete($GR_NO)
    {
        return $this->db->query("DELETE CuttingPlan WHERE GR_NO = '$GR_NO' ");
    }




    // DELETE DI INDEX
    public function deleteIndex($ORDER_NO, $STYLE, $COLOR_DESC)
    {
        return $this->db->query("DELETE CuttingPlan WHERE ORDER_NO = '$ORDER_NO' AND STYLE = '$STYLE' AND COLOR_DESC = '$COLOR_DESC'");
    }


    public function ubahData()
    {


        $GR_NO = $this->input->post('GR_NO');
        $SIZE_NO = $this->input->post('sizeNoList[]'); //dari JS
        $TOTAL_RATIO = $this->input->post('input_total_ratio');
        $RATIO = $this->input->post('totRatio[]');
        $BUYER = $this->input->post('buyer');
        $PRINT_STAT = $this->input->post('print_stat');
        $PRINT_PART_QTY = $this->input->post('print_part_qty');
        $EMBRO_STAT = $this->input->post('embro_stat');
        $EMBRO_PART_QTY = $this->input->post('embro_part_qty');
        $MARKER_LENGTH = $this->input->post('marker_length_input'); //dari JS
        $STYLE = $this->input->post('style'); //dari JS
        $ORDER_NO = $this->input->post('on');
        $COLOR_DESC = $this->input->post('color'); //dari JS (WORK)
        $WO_NO = $this->input->post('wo_no');
        $PRODUCT_CODE = $this->input->post('product_code');
        $PORTION = $this->input->post('portion');
        $FAB_MAT = $this->input->post('fab_mat');
        $FAB_WIDTH = $this->input->post('fab_width');
        $FAB_WEIGHT = $this->input->post('fab_weight');
        $MD_CONS = $this->input->post('md_cons');
        $CUT_CONS = $this->input->post('cut_cons');
        $MARKER_NO = $this->input->post('marker_no');
        $TOD = $this->input->post('tod');
        $SEASON = $this->input->post('season');
        $TABLE_INDEX = $this->input->post('table_index');
        $QTY_LBR = $this->input->post('input_qty_layer'); //dari JS
        $TOTAL_QTY = $this->input->post('input_total_qty'); //dari JS
        $YARD_REQ = $this->input->post('yard_req');
        $KG_REQ = $this->input->post('kg_req');
        // $TOTARATIO = "2";
        // "AutoNum" => '';




        // $data = array();
        $data = array(
            "GR_NO" => $GR_NO,
            // "SIZE_NO" => $SIZE_NO,
            // "RATIO" => $RATIO,
            "TOTAL_RATIO" => $TOTAL_RATIO,
            "BUYER" => $BUYER,
            "PRINT_STAT" => $PRINT_STAT,
            "PRINT_PART_QTY" => $PRINT_PART_QTY,
            "EMBRO_STAT" => $EMBRO_STAT,
            "EMBRO_PART_QTY" => $EMBRO_PART_QTY,
            "MARKER_LENGTH" => $MARKER_LENGTH,
            "STYLE" => $STYLE,
            "ORDER_NO" => $ORDER_NO,
            "COLOR_DESC" => $COLOR_DESC,
            "WO_NO" => $WO_NO,
            "PRODUCT_CODE" => $PRODUCT_CODE,
            "PORTION" => $PORTION,
            "FAB_MAT" => $FAB_MAT,
            "FAB_WIDTH" => $FAB_WIDTH,
            "FAB_WEIGHT" => $FAB_WEIGHT,
            "MD_CONS" => $MD_CONS,
            "CUT_CONS" => $CUT_CONS,
            "MARKER_NO" => $MARKER_NO,
            "TOD" => $TOD,
            "SEASON" => $SEASON,
            "TABLE_INDEX" => $TABLE_INDEX,
            "QTY_LBR" => $QTY_LBR,
            "TOTAL_QTY" => $TOTAL_QTY,
            "YARD_REQ" => $YARD_REQ,
            "KG_REQ" => $KG_REQ
        );

        foreach ($SIZE_NO as $index => $value) {
            $data['SIZE_NO'] = $SIZE_NO[$index];
            $data['RATIO'] = $RATIO[$index];
            // print_r($data);
            // die;
            $this->db->where('GR_NO', $this->input->post('GR_NO'))
                ->where('SIZE_NO', $SIZE_NO[$index])
                ->update('CutSpread_Plan', $data);
        }
        // var_dump($data);
        // die();

        // die;
        // $this->db->where('GR_NO', $this->input->post('GR_NO'));
        // $this->db->update('CuttingPlan', $data);




        $this->session->set_flashdata('flash', 'Data Berhasil Di Edit');
        redirect('import');
        
        // $this->db->insert('CuttingPlan', $data);
    }
}