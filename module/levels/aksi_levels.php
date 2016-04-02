<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

if($module=='level' AND $act=='input'){
  
  mysql_query("INSERT INTO level
  (NAMA_LEVEL) 
  VALUES 
 ('$_POST[txtname]')") or die ('SYSTEM FAILURE'); 
  
  header('location:../../level.html');
}
elseif($module=='level' AND $act=='edit'){
    
    mysql_query("UPDATE level SET NAMA_LEVEL     = '$_POST[txtname]'
                           WHERE ID_LEVEL   = '$_POST[sid]'")or die ('SYSTEM FAILURE'); 
    header('location:../../level.html');
}
elseif($module=='level' AND $act=='delete'){
    mysql_query("DELETE FROM level WHERE ID_LEVEL = '$_REQUEST[sid]'");
    header('location:../../level.html');
}
?>