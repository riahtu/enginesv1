<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

$tanggal = date("Y-m-d");

if($module=='maintenance' AND $act=='input'){
    
    mysql_query("UPDATE jamputar_mesin SET JAM_INTERVAL = '$_GET[intb]'
                           WHERE ID_JAMPUTAR   = '$_GET[id]'")or die ('SYSTEM FAILURE'); 

  header('location:../../enginerun.html');
}
elseif($module=='maintenance' AND $act=='inputdetail'){

  mysql_query("INSERT INTO d_jadwal_maintenance
  (ID_JAMPUTAR,TGL_MULAI,TGL_SELESAI,DESKRIPSI,ID_USER,idsparepart) 
  VALUES 
 ('$_POST[id]','$_POST[txtdateF]','$_POST[txtdateL]','$_POST[txtdesc]','$_SESSION[user]','$_POST[txtprt]')") or die ('SYSTEM FAILURE');

  header('location:../../maintenance-add-'.$_POST[id].'.html');
}
elseif($module=='maintenance' AND $act=='deletedet'){
$ambl=$_REQUEST[ids];
	
    mysql_query("DELETE FROM d_jadwal_maintenance WHERE ID_DETAIL_JADWAL = '$_REQUEST[sid]'");
	
	
 header('location:../../maintenance-add-'.$ambl.'.html');
	
}
elseif($module=='enginerun' AND $act=='delete'){

	
    mysql_query("DELETE FROM jamputar_mesin WHERE ID_JAMPUTAR = '$_REQUEST[sid]'");
	
	
    header('location:../../enginerun.html');
}
?>