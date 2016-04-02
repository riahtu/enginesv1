<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

if($module=='sparepart' AND $act=='input'){
  
  mysql_query("INSERT INTO sparepart
  (part_package,description,est_kerusakan) 
  VALUES 
 ('$_POST[txtpack]','$_POST[txtdes]','$_POST[txtker]')") or die ('SYSTEM FAILURE'); 
  
  header('location:../../sparepart.html');
}

elseif($module=='sparepart' AND $act=='inputdetail'){

  mysql_query("INSERT INTO d_sparepart
  (idsparepart,part_no,part_desc,unit_price) 
  VALUES 
 ('$_POST[id]','$_POST[txtpart]','$_POST[txtpartdes]','$_POST[txtunitp]')") or die ('SYSTEM FAILURE');

  header('location:../../spare-det-'.$_POST[id].'.html');
    
	
}

elseif($module=='sparepart' AND $act=='deletedet'){
$ambl=$_REQUEST[ids];
	
    mysql_query("DELETE FROM d_sparepart WHERE iddetailsp = '$_REQUEST[sid]'");
	
	
 header('location:../../spare-det-'.$ambl.'.html');	
	
}
elseif($module=='sparepart' AND $act=='edit'){
    
    mysql_query("UPDATE sparepart SET
								 part_package  = '$_POST[txtpack]',
								 description  = '$_POST[txtdes]',
								 est_kerusakan = '$_POST[txtker]'
                           WHERE idsparepart   = '$_POST[sid]'")or die ('SYSTEM FAILURE'); 
    header('location:../../sparepart.html');
}
elseif($module=='sparepart' AND $act=='delete'){
    mysql_query("DELETE FROM sparepart WHERE idsparepart = '$_REQUEST[sid]'");
    header('location:../../sparepart.html');
}
?>