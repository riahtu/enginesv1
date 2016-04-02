<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

if($module=='pabrik' AND $act=='input'){
  
  mysql_query("INSERT INTO pabrik
  (ID_PABRIK,NAMA_PABRIK,ID_MESIN,ALAMAT,DESKRIPSI) 
  VALUES 
 ('$_POST[txtid]','$_POST[txtname]','$_POST[txtengname]','$_POST[txtaddrs]','$_POST[txtdes]')") or die ('SYSTEM FAILURE'); 
  
  header('location:../../factory.html');
}
elseif($module=='pabrik' AND $act=='edit'){
    
    mysql_query("UPDATE pabrik SET ID_PABRIK    = '$_POST[txtid]',
                                 NAMA_PABRIK    = '$_POST[txtname]',
								 ID_MESIN   = '$_POST[txtengname]',
								 ALAMAT = '$_POST[txtaddrs]',
								 DESKRIPSI  = '$_POST[txtdes]'
                           WHERE ID_PABRIK   = '$_POST[sid]'")or die ('SYSTEM FAILURE'); 
    header('location:../../factory.html');
}
elseif($module=='pabrik' AND $act=='delete'){
    mysql_query("DELETE FROM pabrik WHERE ID_PABRIK = '$_REQUEST[sid]'");
    header('location:../../factory.html');
}
?>