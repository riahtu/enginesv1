<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

if($module=='users' AND $act=='input'){
  $ps=md5($_POST['txtpassword']);
  mysql_query("INSERT INTO user
  (USERNAME,ID_LEVEL,PASSWORD,NAMA_LENGKAP,EMAIL,NO_TLP,
  ID_SESSION,ALAMAT) 
  VALUES 
 ('$_POST[txtusername]','$_POST[txtlevel]','$ps','$_POST[txtname]','$_POST[txtemail]','$_POST[txtphone]','$sid_baru',
  '$_POST[txtaddress]')") or die ('SYSTEM FAILURE'); 
  
  header('location:../../users.html');
}
elseif($module=='users' AND $act=='edit'){
    $ps=md5($_POST['txtpassword']);
    mysql_query("UPDATE user SET USERNAME     = '$_POST[txtusername]',
                                 ID_LEVEL    = '$_POST[txtlevel]',
								 PASSWORD = '$ps',
								 NAMA_LENGKAP  = '$_POST[txtname]',
								 EMAIL   = '$_POST[txtemail]',
								 NO_TLP   = '$_POST[txtphone]',
								 ALAMAT       = '$_POST[txtaddress]',
                                 ID_SESSION   = '$sid'
                           WHERE ID_SESSION   = '$_POST[sid]'")or die ('SYSTEM FAILURE'); 
    header('location:../../users.html');
}
elseif($module=='users' AND $act=='delete'){
    mysql_query("DELETE FROM user WHERE ID_SESSION = '$_REQUEST[sid]'");
    header('location:../../users.html');
}
?>