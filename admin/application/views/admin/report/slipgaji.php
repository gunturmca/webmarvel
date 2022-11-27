<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Slip Gaji</title>
    <meta charset="utf-8">

</head>
<body onLoad="window.print()">
<div id="laporan">


<table border="0" align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:0px;">
<tr>
    
</tr>
                       
</table>

<table width="659" border="0" align="center" style="width:700px;border:none;">
<?php 
  foreach ($data->result_array() as $b) {
	 
?>
        <tr>
            <th width="92" style="text-align:left;">Nama</th>
            <th width="148" style="text-align:left;">: <?php echo $b['nama'];?></th>
            <th width="75" style="text-align:left;">&nbsp;</th>
            <th width="133" style="text-align:left;">&nbsp;</th>
            <th width="83" style="text-align:left;">No</th>
            <th width="143" style="text-align:left;"></th>
        </tr>
        <tr>
            <th style="text-align:left;">NIK</th>
            <th style="text-align:left;">: <?php echo $b['nik'];?></th>
            <th style="text-align:left;">Group</th>
            <th style="text-align:left;">: <?php echo $b['mgroup_kerja'];?></th>
            <th style="text-align:left;">Departemen</th>
            <th style="text-align:left;">: <?php echo $b['departemen'];?></th>
        </tr>
        <tr>
            <th style="text-align:left;">PDK</th>
            <th style="text-align:left;">: <?php echo $b['pendidikan'];?></th>
            <th style="text-align:left;">Tgl Masuk</th>
            <th style="text-align:left;">: <?php echo $b['tanggal_masuk'];?></th>
            <th style="text-align:left;">Lama kerja</th>
            <th style="text-align:left;">:</th>
        </tr>
        <tr>
          <th style="text-align:left;">Upah Periode</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
        </tr>
</table>
<table width="439" border="0" align="center" style="width:700px;border:none;">
        <tr>
            <th width="32" style="text-align:left;">1/2H</th>
            <th width="25" style="text-align:left;">:<?php echo $b['p2'];?></th>
            <th width="20" style="text-align:left;">M</th>
            <th width="28" style="text-align:left;">: <?php echo $b['m'];?></th>
            <th width="19" style="text-align:left;">S</th>
             <th width="30" style="text-align:left;">: <?php echo $b['p2'];?></th>
             <th width="19" style="text-align:left;">C1</th>
            <th width="21" style="text-align:left;">:<?php echo $b['c1'];?></th>
            <th width="21" style="text-align:left;">CL</th>
             <th width="27" style="text-align:left;">: <?php echo $b['p2'];?></th>
            <th width="44" style="text-align:left;">C2</th>
            <th width="30" style="text-align:left;">: <?php echo $b['c2'];?></th>
            <th width="9" style="text-align:left;">P</th>
            <th width="30" style="text-align:left;">: <?php echo $b['p'];?></th>
            <th width="19" style="text-align:left;">P1</th>
            <th width="260" style="text-align:left;">: <?php echo $b['p1'];?></th>
        </tr>
        <tr>
            <th width="32" style="text-align:left;">CL</th>
            <th width="25" style="text-align:left;">:<?php echo $b['p1'];?></th>
            <th width="20" style="text-align:left;">SC</th>
            <th width="28" style="text-align:left;">: <?php echo $b['p1'];?></th>
            <th width="19" style="text-align:left;">U1</th>
             <th width="30" style="text-align:left;">: <?php echo $b['p1'];?></th>
             <th width="19" style="text-align:left;">U2</th>
            <th width="21" style="text-align:left;">:<?php echo $b['p1'];?></th>
            <th width="21" style="text-align:left;">U3</th>
             <th width="27" style="text-align:left;">:<?php echo $b['p1'];?></th>
            <th width="44" style="text-align:left;">LB/LZ</th>
            <th width="30" style="text-align:left;">: <?php echo $b['p1'];?></th>
            <th width="9" style="text-align:left;">&nbsp;</th>
            <th width="30" style="text-align:left;">&nbsp;</th>
            <th width="19" style="text-align:left;">&nbsp;</th>
            <th width="260" style="text-align:left;">&nbsp;</th>
        </tr>
</table>
<table width="700" border="0" align="center" style="width:700px;border:none;">
        <tr>
            <th width="175" style="text-align:left;">Gaji Pokok</th>
            <th width="20" style="text-align:left;">:</th>
            <th width="138" style="text-align:left;"><?php echo $b['mhk'];?></th>
            <th width="19" style="text-align: center">X</th>
            <th width="75" style="text-align:left;"><?php echo number_format($b['gapok']/$b['mhk'],2,',','.');?></th>
             <th width="16" style="text-align:left;">=</th>
             <th width="227" style="text-align:left;"><?php echo number_format($b['gapok'],2,',','.');?></th>
        </tr>
        <tr>
          <th style="text-align:left;">Jabatan</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;"><?php echo $b['mhk'];?></th>
          <th style="text-align: center">X</th>
          <th style="text-align:left;"><?php echo number_format($b['tunj_jabatan']/$b['mhk'],2,',','.');?></th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo number_format($b['tunj_jabatan'],2,',','.');?></th>
        </tr>
        <tr>
          <th style="text-align:left;">Prestasi</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;"><?php echo $b['mhk'];?></th>
          <th style="text-align: center">X</th>
          <th style="text-align:left;"><?php echo number_format($b['tunj_prestasi']/$b['mhk'],2,',','.') ;?></th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo number_format($b['tunj_prestasi'],2,',','.'); ?></th>
        </tr>
        <tr>
          <th style="text-align:left;">Premi HDR + 5%</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo number_format($b['premi_hadir'],2,',','.');?></th>
        </tr>
        <tr>
          <th style="text-align:left;">Lembur (P/S)</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">0.0</th>
          <th style="text-align: center">X</th>
          <th style="text-align:left;">17,441</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;">&nbsp;</th>
        </tr>
        <tr>
          <th style="text-align:left;">Lembur (M)</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">0.0</th>
          <th style="text-align: center">X</th>
          <th style="text-align:left;">17,441</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;">&nbsp;</th>
        </tr>
        <tr>
          <th style="text-align:left;">SPKL (P/S)</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">0.0</th>
          <th style="text-align: center">X</th>
          <th style="text-align:left;">17,441</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo $b['qtyotasli'];?></th>
        </tr>
        <tr>
          <th style="text-align:left;">SPKL (M)</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">0.0</th>
          <th style="text-align: center">X</th>
          <th style="text-align:left;">17,441</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;">&nbsp;</th>
        </tr>
        <tr>
          <th style="text-align:left;">T.KRS + P. Shift</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo number_format($b['premi_shift'],2,',','.');?></th>
        </tr>
        <tr>
          <th style="text-align:left;">Premi Kerja</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo number_format($b['tunj_masakerja'],2,',','.');?></th>
        </tr>
        <tr>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">Sub Total</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo number_format($b['totgaji'],2,',','.');?></th>
        </tr>
        <tr>
          <th style="text-align:left;">Pot. Absen</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo number_format($b['pot_absen'],2,',','.');?></th>
        </tr>
        <tr>
          <th style="text-align:left;">Pot. Astek</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo number_format($b['pot_astek'],2,',','.');?></th>
        </tr>
        <tr>
          <th style="text-align:left;">Pot. SPSI</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo number_format($b['pot_spsi'],2,',','.');?></th>
        </tr>
        <tr>
          <th style="text-align:left;">Pot. Koperasi</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo number_format($b['pot_koperasi'],2,',','.');?></th>
        </tr>
        <tr>
          <th style="text-align:left;">Sisa Upah</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;">&nbsp;</th>
        </tr>
        <tr>
          <th style="text-align:left;">Pot. Bisnis</th>
          <th style="text-align:left;">:</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo number_format($b['pot_bisnis'],2,',','.');?></th>
        </tr>
        <tr>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">Tambahan Lain (+)</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;">&nbsp;</th>
        </tr>
        <tr>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">Bonus Target (+)</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;">&nbsp;</th>
        </tr>
        <tr>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">Total</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;"><?php echo number_format($b['gaji_bersih'],2,',','.');?></th>
        </tr>
        <tr>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">Uang Muka</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;">&nbsp;</th>
        </tr>
        <tr>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">Yang Dibayarkan</th>
          <th style="text-align: center">&nbsp;</th>
          <th style="text-align:left;">&nbsp;</th>
          <th style="text-align:left;">=</th>
          <th style="text-align:left;">&nbsp;</th>
        </tr>
        <?php }?>
  </table>

</div>
</body>
</html>