<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

$sid_lama = session_id();
	
session_regenerate_id();

$sid_baru = session_id();

if($module=='menu' AND $act=='input'){
  
  mysql_query("INSERT INTO menu(parent_id,
                                  judul, 
                                  url,
								  icon,
                                  menu_order,
                                  aktif,
                                  letak,
								  id_level) 
					                VALUES('$_POST[txtparent]',
                                 '$_POST[txtmenu]',
                                 '$_POST[txturl]',
								 '$_POST[txticon]',
                                 '$_POST[txturut]',
                                 '1',
                                 '$_POST[txtletak]',
								 '$_POST[txtlvl]')")or die ('SYSTEM FAILURE'); 
  header('location:../../menu.html');
}
elseif($module=='menu' AND $act=='edit'){
    
     mysql_query("UPDATE menu SET parent_id='$_POST[txtparent]',
                                  judul='$_POST[txtjudul]', 
                                  url='$_POST[txturl]',
								  icon='$_POST[txticon]',
                                  menu_order='$_POST[txturut]',
                                  aktif='$_POST[txtaktif]',
                                  letak='$_POST[txtletak]',
								  id_level='$_POST[txtlevel]'  
                           WHERE id   = '$_POST[id]'")or die ('SYSTEM FAILURE'); 
  header('location:../../menu.html');
}
elseif($module=='menu' AND $act=='delete'){
    mysql_query("DELETE FROM menu WHERE ID = '$_REQUEST[sid]'");
    header('location:../../menu.html');
}
?>