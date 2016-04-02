<?php
session_start();
include "../../config/koneksi.php";
include "../../config/rp.php";
error_reporting(0);
require('html2fpdf.php');
ob_start();


?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../../css/report.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="1092" height="176" border="0">
  <tr>
    <td width="1139" height="172"><div align="center"><img src="../../img/2.jpg" width="1068" height="140" /></div></td>
  </tr>
</table>

<table width="100%" border="1" class="substdreport" />
  <tr>
  
   <td colspan="10"><div align="center"><h2><strong>Report Engine Maintenance</strong></h2></div></td>
  </tr>
  <tr>
    <th>ID</th>
    <th>Factory Name</th>
    <th>Engine</th>
    <th>Date Entry Maintenance</th>
    <th>Estimates Completes Maintenance</th>
    <th>Description</th>
    <th>Part Package</th>
    <th>Total</th>
    
    
    
  </tr>
  <?php
  $que=mysql_query("
  select 
d_jadwal_maintenance.id_detail_jadwal,
d_jadwal_maintenance.tgl_mulai,
d_jadwal_maintenance.tgl_selesai,
d_jadwal_maintenance.deskripsi,
jamputar_mesin.id_jamputar,
t_komponen.id_komponen,
pabrik.id_pabrik,
pabrik.nama_pabrik,
master_mesin.id_mesin,
master_mesin.nama_mesin,
sparepart.idsparepart,
sparepart.part_package
from d_jadwal_maintenance inner join jamputar_mesin on jamputar_mesin.id_jamputar=d_jadwal_maintenance.id_jamputar
inner join t_komponen on jamputar_mesin.id_komponen=t_komponen.id_komponen
inner join pabrik on t_komponen.id_pabrik=pabrik.id_pabrik
inner join master_mesin on t_komponen.id_mesin=master_mesin.id_mesin
inner join sparepart on d_jadwal_maintenance.idsparepart=sparepart.idsparepart");
  while ($r=mysql_fetch_array($que)){
  $subtotal = 0;
  
  ?>
  <tr>
  <td><?php echo($r[0]); ?></td>
  <td><?php echo($r[7]); ?></td>
  <td><?php echo($r[9]); ?></td>
  <td><?php
			$tanggals = $r[1];
			$tanggalbarus = date('D, j-M-Y', strtotime($tanggals ));
			echo($tanggalbarus);  ?></td>
  <td><?php
			$tanggals1 = $r[2];
			$tanggalbarus1 = date('D, j-M-Y', strtotime($tanggals1 ));
			echo($tanggalbarus1);  ?></td>
 

 <?php
  $qd=mysql_query("select sum(unit_price) from d_sparepart where idsparepart = '$r[10]' order by iddetailsp ASC");
   while ($rd=mysql_fetch_array($qd)){
	$total = ($rd[0]);
	$grand_total = $grand_total + $total;
	$subtotal = $subtotal + $total;
	$totalall = $totalall + $total;
	$total_rp = format_rupiah($total);
	$grand_total_rp = format_rupiah($grand_total);
	} 
   ?>
    <td><?php echo($r[3]);?></td>
   <td><?php echo($r[11]); ?></td>
   <td>Rp <?php echo($total_rp); ?></td>
  

 
  </tr>
  <?php
  }
  ?>
   <tr>
  <td>
  Grand Total
  </td>
  <td colspan="6">
  </td>
  <td>Rp
  <?php
  echo ($grand_total_rp);  
  ?>
  </td>
  </tr>
  </table>
</body>
</html>
<?php
// Output-Buffer in variable:
$html=ob_get_contents();
ob_end_clean();
$pdf=new HTML2FPDF();
$pdf->AddPage();
$pdf->WriteHTML($html);
if (preg_match("/MSIE/i", $_SERVER["HTTP_USER_AGENT"])){
    header("Content-type: application/PDF");
} else {
    header("Content-type: application/PDF");
    header("Content-Type: application/pdf");
}
$pdf->Output("sample2.pdf","I");

?>
