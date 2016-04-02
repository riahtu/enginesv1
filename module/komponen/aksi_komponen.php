<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

if($module=='komponen' AND $act=='input'){
  
  mysql_query("INSERT INTO t_komponen (ID_KOMPONEN, ID_MESIN, ID_PABRIK, TGL_ENTRY_MESIN) VALUES  ('$_POST[txtid]','$_POST[txtengname]','$_POST[txtfacname]','$_POST[txtdate]')") or die ('SYSTEM FAILURE'); 
  
  header('location:../../componen.html');
}
elseif($module=='komponen' AND $act=='edit'){
    
    mysql_query("UPDATE t_komponen SET ID_KOMPONEN    = '$_POST[txtid]',
								 ID_MESIN   = '$_POST[txtengname]',
								 ID_PABRIK    = '$_POST[txtfacname]',
								 TGL_ENTRY_MESIN = '$_POST[txtdate]'
                           WHERE ID_KOMPONEN   = '$_POST[sid]'")or die ('SYSTEM FAILURE'); 
    header('location:../../componen.html');
}
elseif($module=='komponen' AND $act=='delete'){
    mysql_query("DELETE FROM t_komponen WHERE ID_komponen = '$_REQUEST[sid]'");
    header('location:../../componen.html');
}
?>