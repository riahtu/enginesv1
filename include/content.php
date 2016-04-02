<script src="minerva/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jsapi.js"></script>
<script language="javascript" src="minerva/ez.js"></script>
<script language="javascript" src="minerva/ez2.js"></script>
<?php include_once 'include/ehand.php'; ?>
 
<!-- Mengembed Jquery -->
<script type="text/javascript">

  /* Disable Right Click dengan fungsi tambahan. */
  document.oncontextmenu = new Function("Fungsi1();return(false)");
  function Fungsi1()
  {
   alert("disabled");
  }
 </script>
<?php      
if ($_GET['module']=='home'){
?>    
<h2>Dashboard</h2>   
<h5>Welcome  <?php echo($_SESSION['namalengkap']); ?> , Ready to Work</h5>
<?php include_once 'module/dashboard.php'; ?>	
<?php
}elseif ($_GET['module']=='users'){    
    include "module/users/users.php";
}elseif ($_GET['module']=='usersadd'){    
    include "module/users/users.php";    
}elseif ($_GET['module']=='usersedit'){    
    include "module/users/users.php";
	//menu
}elseif ($_GET['module']=='menu'){
	include "module/menu/menu.php";
}elseif ($_GET['module']=='menuadd'){
	include "module/menu/menu.php";
}elseif ($_GET['module']=='menuedit'){
	include "module/menu/menu.php";
	
	//pabrik
}elseif ($_GET['module']=='pabrik'){
	include "module/pabrik/pabrik.php";
}elseif ($_GET['module']=='pabrikadd'){
	include "module/pabrik/pabrik.php";
}elseif ($_GET['module']=='pabrikedit'){
	include "module/pabrik/pabrik.php";
//Module Level    
}elseif ($_GET['module']=='level'){
	include "module/levels/levels.php";
}elseif ($_GET['module']=='leveladd'){
	include "module/levels/levels.php";
}elseif ($_GET['module']=='leveledit'){
	include "module/levels/levels.php";
	
	//Module Notif    
}elseif ($_GET['module']=='notif'){
	include "module/notif/notif.php";
}elseif ($_GET['module']=='notifadd'){
	include "module/notif/notif.php";
//Module Jenis Engine    
}elseif ($_GET['module']=='tengine'){
	include "module/tengines/tengines.php";
}elseif ($_GET['module']=='tengineadd'){
	include "module/tengines/tengines.php";
}elseif ($_GET['module']=='tengineedit'){
	include "module/tengines/tengines.php";
//Module Engine    
}elseif ($_GET['module']=='engine'){
	include "module/engines/engines.php";
}elseif ($_GET['module']=='engineadd'){
	include "module/engines/engines.php";
}elseif ($_GET['module']=='engineedit'){
	include "module/engines/engines.php";    
}elseif ($_GET['module']=='enginedetail'){
	include "module/engines/engines.php";
//Ubah Password
}elseif ($_GET['module']=='editpass'){
	include "module/setting/ubahpassword.php";
    
//Jam Putar Mesin
}elseif ($_GET['module']=='enginerun'){
	include "module/EngineRun/EngineRun.php";
}elseif ($_GET['module']=='enginerunadd'){
	include "module/EngineRun/EngineRun.php";
}elseif ($_GET['module']=='enginerunedit'){
	include "module/EngineRun/EngineRun.php";	
}elseif ($_GET['module']=='enginerunhour'){
	include "module/EngineRun/EngineRun.php";
}elseif ($_GET['module']=='maintenanceadd'){
	include "module/maintenance/maintenance.php";
	
//komponen
}elseif ($_GET['module']=='komponen'){
	include "module/komponen/komponen.php";
}elseif ($_GET['module']=='komponenadd'){
	include "module/komponen/komponen.php";
}elseif ($_GET['module']=='komponenedit'){
	include "module/komponen/komponen.php";	
//budgetlist
}elseif ($_GET['module']=='bl'){
	include "module/bl/bl.php";
	//Helpmain
}elseif ($_GET['module']=='helpmain'){
	include "module/helpmain/helpmain.php";
}elseif ($_GET['module']=='helpmainadd'){
	include "module/helpmain/helpmain.php";
//sparepart	
}elseif ($_GET['module']=='sparepart'){
	include "module/sparepart/sparepart.php";
}elseif ($_GET['module']=='sparepartadd'){
	include "module/sparepart/sparepart.php";
}elseif ($_GET['module']=='sparepartedit'){
	include "module/sparepart/sparepart.php";
}elseif ($_GET['module']=='sparedetail'){
	include "module/sparepart/sparepart.php";
	
//report jamputar		
	}elseif ($_GET['module']=='reportrunhour'){
	include "module/report/report_list.php";
//report maintenance
	}elseif ($_GET['module']=='reportm'){
	include "module/report/report_list.php";
		
  }else{
    echo "Content Not Found";
}
?>
            
  <!-- /. ROW  -->
  <hr />
