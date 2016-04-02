<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

$tanggal = date("Y-m-d");

if($module=='enginerun' AND $act=='input'){
    
  mysql_query("INSERT INTO jamputar_mesin
  (ID_KOMPONEN,JAM_INTERVAL,TANGGAL_ENTRY,HELP_JAMPUTAR) 
  VALUES 
 ('$_POST[txtfac]','$_POST[txtint]','$tanggal','$_POST[txthelp]')") or die ('SYSTEM FAILURE');
  
  header('location:../../enginerun.html');
}
elseif($module=='enginerun' AND $act=='edit'){
mysql_query("UPDATE jamputar_mesin SET 
								 ID_KOMPONEN = '$_POST[txtfac]',
								 JAM_INTERVAL   = '$_POST[txtintv]',
								 HELP_JAMPUTAR   = '$_POST[txthelp]'
                           WHERE ID_JAMPUTAR   = '$_POST[sid]'")or die ('SYSTEM FAILURE'); 	
	header('location:../../enginerun.html');
	
	
}
elseif($module=='enginerun' AND $act=='inputdetail'){

    $inter = $_POST[txtsisa] - $_POST[txtvalue];
if ($inter < 0){
	 $_SESSION['pesan'] = 'Error... exceeding the interval limit';
  header('location:../../enginerun-hour-'.$_POST[id].'.html');

}else{
  mysql_query("INSERT INTO d_jamputar_mesin
  (ID_JAMPUTAR,NILAI_AWAL,TANGGAL_INPUT,ID_USER) 
  VALUES 
 ('$_POST[id]','$_POST[txtvalue]','$tanggal','$_SESSION[user]')") or die ('SYSTEM FAILURE');

  header('location:../../enginerun-hour-'.$_POST[id].'.html');
    }
}
elseif($module=='enginerun' AND $act=='deletedet'){
$ambl=$_REQUEST[ids];
	
    mysql_query("DELETE FROM d_jamputar_mesin WHERE ID_DETAIL_JAMPUTAR = '$_REQUEST[sid]'");
	
	
 header('location:../../enginerun-hour-'.$ambl.'.html');
	
}
elseif($module=='enginerun' AND $act=='delete'){

	
    mysql_query("DELETE FROM jamputar_mesin WHERE ID_JAMPUTAR = '$_REQUEST[sid]'");
	
	
    header('location:../../enginerun.html');
}
?>