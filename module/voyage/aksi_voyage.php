<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

if($module=='voyage' AND $act=='input'){
  
  mysql_query("INSERT INTO voyage
  (ID_KAPAL,TGL_KEBERANGKATAN,TGL_SAMPAI,DESKRIPSI) 
  VALUES 
 ('$_POST[txtsname]','$_POST[txtdatedep]','$_POST[txtdatedes]','$_POST[txtdes]')") or die ('SYSTEM FAILURE'); 
  
  header('location:../../voyage.html');
}
elseif($module=='voyage' AND $act=='edit'){
    
    mysql_query("UPDATE voyage SET ID_KAPAL    = '$_POST[txtsname]',
                              TGL_KEBERANGKATAN    = '$_POST[txtdatedep]',
								 TGL_SAMPAI = '$_POST[txtdatedes]',
								 DESKRIPSI  = '$_POST[txtdes]'
                           WHERE ID_VOYAGE   = '$_POST[id]'")or die ('SYSTEM FAILURE'); 
    header('location:../../voyage.html');
}
elseif($module=='voyage' AND $act=='delete'){
    mysql_query("DELETE FROM voyage WHERE ID_VOYAGE = '$_REQUEST[sid]'");
    header('location:../../voyage.html');
}
?>