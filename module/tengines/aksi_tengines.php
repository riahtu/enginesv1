<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

if($module=='tengine' AND $act=='input'){
  
  mysql_query("INSERT INTO jenis_mesin
  (NAMA_JENIS) 
  VALUES 
 ('$_POST[txtname]')") or die ('SYSTEM FAILURE'); 
  
  header('location:../../tengine.html');
}
elseif($module=='tengine' AND $act=='edit'){
    
    mysql_query("UPDATE jenis_mesin SET NAMA_JENIS     = '$_POST[txtname]'
                           WHERE ID_JENIS   = '$_POST[sid]'")or die ('SYSTEM FAILURE'); 
    header('location:../../tengine.html');
}
elseif($module=='tengine' AND $act=='delete'){
    mysql_query("DELETE FROM jenis_mesin WHERE ID_JENIS = '$_REQUEST[sid]'");
    header('location:../../tengine.html');
}
?>