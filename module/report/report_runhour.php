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

$judul="REPORT Run-HOUR $bln";

?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($judul); ?></title>
<link href="../../css/report.css" rel="stylesheet" type="text/css" />
</head>
<body>

<table width="100%" border="1" class="substdreport" />
  <tr>
   <td colspan="10"><div align="center"><h2><strong><?php echo "Report Engine RunHour $bln"; ?></strong></h2></div></td>
  </tr>
  <tr>
    <th>ID</th>
    <th>Factory Name</th>
    <th>Engine</th>
    <th>Date Entry</th>
    <th>Interval Value</th>
    <th>Estimate Maintenance</th>
    <th>Maintenance Status</th>
    
    
  </tr>
  <?php
  $que=mysql_query("
  select jamputar_mesin.id_jamputar,
        jamputar_mesin.JAM_interval,
		jamputar_mesin.help_jamputar,
        t_komponen.id_komponen,
		jamputar_mesin.TANGGAL_ENTRY,
        pabrik.id_pabrik,
        pabrik.nama_pabrik,
		master_mesin.nama_mesin
         from jamputar_mesin inner join t_komponen on jamputar_mesin.id_komponen=t_komponen.id_komponen
         inner join pabrik on t_komponen.id_pabrik=pabrik.id_pabrik 
		 inner join master_mesin on pabrik.id_mesin=master_mesin.id_mesin
  Where jamputar_mesin.TANGGAL_ENTRY BETWEEN  '".$tahun."-".$bln1."' AND '".$tahun."-".$bln2."'
  ");
  while ($r=mysql_fetch_array($que)){
  $subtotal = 0;
  
  ?>
  <tr>
  <td><?php echo($r[0]); ?></td>
  <td><?php echo($r[6]); ?></td>
  <td><?php echo($r[7]); ?></td>
  <td><?php echo($r[4]); ?></td>
  <td><?php echo($r[1]); ?></td>

 <?php
  $qd=mysql_query("select * from d_jamputar_mesin where ID_JAMPUTAR = '$r[0]' order by ID_DETAIL_JAMPUTAR ASC");
   while ($rd=mysql_fetch_array($qd)){
	$total = $rd[2]*$rd[3];
	$grand_total = $grand_total + $total;
	$subtotal = $subtotal + $total;
	$totalall = $totalall + $total;
	$subtotal_rp = format_rupiah($subtotal);
	$grand_total_rp = format_rupiah($grand_total);
	} 
   ?>
    <td><?php 
                $estim = ceil($rd[3] / $rd[2]); 
                echo date('Y-m-d', strtotime("+".$estim." days"));
                ?></td>
  
  <?php 
                 $last = "
                        select SUM(NILAI_AWAL) from d_jamputar_mesin where ID_JAMPUTAR = '$r[0]'
                    ";
                    $lastr = mysql_query($last);
                    $rlast = mysql_fetch_array($lastr);
                $cekmain = $row[1] - $rlast[0];
                if($cekmain == 0){
              ?>
              <td>Need Maintenance</td>
              <?php }else{?>
              <td>Available</td>
              <?php } ?>

 
  </tr>
  <?php
  }
  ?>
  
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