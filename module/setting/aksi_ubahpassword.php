<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

if ($module=='setting' AND $act=='edit'){
  $passdefault=md5($_POST['txtpasslama']);
  if($passdefault!=$_SESSION['passuser']){
	echo '{"status":"0"}';
  }
  elseif($passdefault==$_SESSION['passuser']){
  if($_POST['txtpassbaru']!=$_POST['txtulangipassbaru']){
	echo '{"status":"1"}';
	
  }else{
  $pass=md5($_POST['txtpassbaru']);
    mysql_query("UPDATE user SET PASSWORD   = '$pass'
                           WHERE  USERNAME = '$_SESSION[user]'")or die ('SYSTEM FAILURE'); 
    header('location:../../home.html');
	}
  }

}
?>