<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

if ($module=='notif' AND $act=='input'){
$blokir = 'N';
  mysql_query("INSERT INTO tnotif(
  								 nilai_rentang,
                                 status) 
	                       VALUES('$_POST[txtname]',
                                '$blokir')");
								
    header('location:../../notif.html');
}

// Update user
elseif ($module=='notif' AND $act=='delete'){
    mysql_query("DELETE FROM tnotif WHERE idnotif = '$_REQUEST[sid]'");
    header('location:../../notif.html');
}
elseif ($module=='notif' AND $act=='aktif'){

$data = $_GET['data'];
if($data == 'Y'){
$blokir = 'N';
}else{
$blokir = 'Y';
}

 mysql_query("UPDATE tnotif SET status='N' WHERE status ='Y'");

 mysql_query("UPDATE tnotif SET status  = '$blokir'
                           WHERE idnotif  = '$_GET[sid]'");
						   
  header('location:../../notif.html');
}
?>
