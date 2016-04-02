<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

if($module=='engine' AND $act=='input'){
	
	
  mysql_query("INSERT INTO master_mesin
  (ID_MESIN,NAMA_MESIN,ID_JENIS,TGL_PEMBUATAN,SPESIFIKASI_MESIN,DESKRIPSI) 
  VALUES 
 ('$_POST[txtid]','$_POST[txtname]','$_POST[txttype]','$_POST[txttgl]','$_POST[txtspec]','$_POST[txtdesc]')") or die ('SYSTEM FAILURE'); 
  
  header('location:../../engine.html');
  
}
elseif($module=='engine' AND $act=='edit'){
    
    mysql_query("UPDATE master_mesin SET 
                                 ID_MESIN     = '$_POST[txtid]',
                                 NAMA_MESIN    = '$_POST[txtname]',
								 ID_JENIS = '$_POST[txttype]',
								 TGL_PEMBUATAN  = '$_POST[txttgl]',
								 SPESIFIKASI_MESIN   = '$_POST[txtspec]',
								 DESKRIPSI   = '$_POST[txtdesc]'
                           WHERE ID_MESIN   = '$_POST[sid]'")or die ('SYSTEM FAILURE'); 
    header('location:../../engine.html');
}
elseif($module=='engine' AND $act=='delete'){
    mysql_query("DELETE FROM master_mesin WHERE ID_MESIN = '$_REQUEST[sid]'");
    header('location:../../engine.html');
}
?>