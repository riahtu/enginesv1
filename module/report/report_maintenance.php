<?php
session_start();
include "../../config/koneksi.php";
include "../../config/rp.php";
error_reporting(0);
?>
<script>
function setVisible(obj, bool){
		if(typeof obj == "string") obj = document.getElementById(obj);
		
		if(bool == false){
			if(obj.style.visibility != 'hidden');
				obj.style.visibility = 'hidden';
			} else {
			if(obj.style.visibility != 'visible');
			obj.style.visibility = 'visible';
		}
	}	
	function goprint(){
		setVisible('tomato',false);
		setTimeout("window.print()", 1000);
		setTimeout("setVisible('tomato',true)", 15000);
	}	
</script>

<?php
$cmd=$_REQUEST['cmd'];
$pilih=$_REQUEST['pilih'];

if($cmd == 'cetak'){

$tanggal=$_REQUEST['hari'];
$bulan=$_REQUEST['bulan'];
$tahun=$_REQUEST['tahun'];

if($pilih=='BULANAN'){
	
if($bulan=='1')
{$bln1="01-01";$bln2="01-31";$bln="JANUARI";}
elseif($bulan=='2')
{$bln1="02-01";if($tahun%4<>0){$bln2="02-28";}else{$bln2="02-29";};$bln="FEBRUARI";}
elseif($bulan=='3')
{$bln1="03-01";$bln2="03-31";$bln="MARET";}
elseif($bulan=='4')
{$bln1="04-01";$bln2="04-30";$bln="APRIL";}
elseif($bulan=='5')
{$bln1="05-01";$bln2="05-31";$bln="MEI";}
elseif($bulan=='6')
{$bln1="06-01";$bln2="06-30";$bln="JUNI";}
elseif($bulan=='7')
{$bln1="07-01";$bln2="07-31";$bln="JULI";}
elseif($bulan=='8')
{$bln1="08-01";$bln2="08-31";$bln="AGUSTUS";}
elseif($bulan=='9')
{$bln1="09-01";$bln2="09-30";$bln="SEPTEMBER";}
elseif($bulan=='10')
{$bln1="10-01";$bln2="10-31";$bln="OKTOBER";}
elseif($bulan=='11')
{$bln1="11-01";$bln2="11-30";$bln="NOPEMBER";}
else
{$bln1="12-01";$bln2="12-31";$bln="DESEMBER";}
}

elseif($pilih=='HARIAN')
{
$bln1=$tanggal."-".$bulan;$bln2=$tanggal."-".$bulan;$bln="HARIAN";
}
else
{
$bln1="01-01";$bln2="12-31";$bln="JANUARI - DESEMBER";
}

$judul="REPORT Maintenance $bln";

?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($judul); ?></title>
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
   <td colspan="10"><div align="center"><h2><strong><?php echo "Report Engine Maintenance $bln - $tahun"; ?></strong></h2></div></td>
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
inner join sparepart on d_jadwal_maintenance.idsparepart=sparepart.idsparepart
where d_jadwal_maintenance.tgl_mulai between '".$tahun."-".$bln1."' AND '".$tahun."-".$bln2."'
  ");
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
<form name="viewrs" method="post">
<div id="main"><div id="tomato">
<p align="center">
<input type="button" name="btnPrint" value="Print" class="btndisabled" onClick="goprint()">
</p>
</div></div>
</form>
</body>
</html>
<?php
}
?>