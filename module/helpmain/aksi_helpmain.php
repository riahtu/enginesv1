<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

$tanggal = date("Y-m-d");

if($module=='helpmain' AND $act=='input'){
    
  mysql_query("INSERT INTO temphour
  (ID_JAMPUTAR,ID_KOMPONEN,JAM_INTERVAL,INTERVAL_DA,TANGGAL_ENTRY,PART_REQ) 
  VALUES 
 ('$_POST[sid]','$_POST[txtfac]','$_POST[txtintv]','$_POST[txtintd]','$tanggal','$_POST[txthelp]')") or die ('SYSTEM FAILURE');
  
  header('location:../../enginerun.html');
}
elseif($module=='enginerun' AND $act=='edit'){
mysql_query("UPDATE jamputar_mesin SET 
								 BLOKIR = 'Y'
								
                           WHERE ID_JAMPUTAR   = '$_POST[sid]'")or die ('SYSTEM FAILURE'); 	
	header('location:../../helpmain.html');
	
	
}
elseif($module=='enginerun' AND $act=='inputdetail'){

    $inter = $_POST[txtsisa] - $_POST[txtvalue];
if ($inter < 0){
	 $_SESSION['pesan'] = 'Error... exceeding the interval limit';
    echo '<script>window.location="../../enginerun-hour-'.$_POST[id].'.html?answer=wrong"</script>';

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
elseif($module=='helpmain' AND $act=='delete'){

	
  $data = $_GET['data'];
if($data == 'Y'){
$blokir = 'N';
}else{
$blokir = 'Y';
}

 mysql_query("UPDATE temphour SET blokir='N' WHERE blokir ='Y'");

 mysql_query("UPDATE temphour SET blokir  = '$blokir'
                           WHERE id_jamputar  = '$_GET[sid]'");
						   
  header('location:../../helpmain.html');
}
?>