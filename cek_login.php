
<?php
 //&& isset($_POST['txtpassword'])
if(isset($_POST['txtusername'])){ 

include "config/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST['txtusername']);
$pass     = anti_injection(md5($_POST['txtpassword']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  header('location:index.php?answer=wrong');
}
else{
$login=mysql_query("SELECT * FROM user WHERE USERNAME='$username' AND PASSWORD='$pass' AND BLOKIR='N'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  
  session_start();

  $_SESSION['user']     = $r['USERNAME'];
  $_SESSION['namalengkap']  = $r['NAMA_LENGKAP'];
  $_SESSION['passuser']     = $r['PASSWORD'];
  $_SESSION['leveluser']    = $r['ID_LEVEL'];
  $_SESSION['emailuser']    = $r['EMAIL'];
  
	$sid_lama = session_id();
	
	session_regenerate_id();

	$sid_baru = session_id();
	
  mysql_query("UPDATE user SET id_session='$sid_baru' WHERE username='$username'");

  $_SESSION['idsession']    = $r['ID_SESSION'];

  header('location:home.html');
	}
elseif($ketemu == 0){
  header('location:index.php?answer=wrong');
}
}
}else{
  header('location:index.php');
}
?>
