<?php
  session_start();
  error_reporting(0);
  ob_start();
  
if(isset($_SESSION['namalengkap'])){ 
  include "config/koneksi.php";
  
  function get_menu($data, $parent = 0) {
	static $i = 1;
	$tab = str_repeat("\t\t", $i);
	if (isset($data[$parent])) {
		$html = "\n$tab";
		$i++;
		foreach ($data[$parent] as $v) {
			$child = get_menu($data, $v->id);
			$html .= "$tab<li>";
			if($v->letak == 1){ $html .= "<a class='dropmenu' href='".$v->url."'><i class='".$v->icon."'></i>"."<span class='hidden-tablet'>  $v->judul  </span>"."<span class='halflings-icon white chevron-down'></a>";
			}
			else{
				$html .= "<a href='".$v->url."'><i class='".$v->icon."'></i>".($v->judul)."</a>";
			}
			if ($child) {
				$i--;
				$html .= "<ul>";
				$html .= $child;
				$html .= "\n\t$tab";
				$html .= "</ul>";
			}
			$html .= '</li>';
		}
		$html .= "$tab";
		return $html;
	} else {
		return false;
	}
}

$result = mysql_query("SELECT * FROM menu where aktif='1' AND id_level in('0','$_SESSION[leveluser]') ORDER BY menu_order");
while ($row = mysql_fetch_object($result)) {
	$data[$row->parent_id][] = $row;
}
$menu = get_menu($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once 'include/ClassMeta.php'; ?>
	
	
</head>

<body>
		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="home.html"><span><img src="img/eng.png" width="40"> Engine Maintenance</span></a>
								
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
												<!-- start: Notifications Dropdown -->
						
						<?php include_once 'include/ClassDrop.php'; ?>		
						<!-- end: Notifications Dropdown -->
						<!-- start: Message Dropdown -->
						
						
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> <?php echo($_SESSION['namalengkap']) ?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Account Settings</span>
								</li>
                                 <?php
		if($_SESSION['leveluser']!='1' and $_SESSION['leveluser']!='3' and $_SESSION['leveluser']!='4'){
	?>
                             <li><a href="notif.html"><i class="halflings-icon calendar"></i> Set Notif</a></li>
                             <?Php
	};
	?>					
								<li><a href="logout.php"><i class="halflings-icon off"></i> Logout</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
    
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		
        <div class="row-fluid">
				
			<!-- start: Main Menu -->
		<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<?php echo $menu; ?>
                        
				  </ul>
				</div>
			</div>
            <?php } ?>	
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
            
					<div id="content" class="span10">
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="home.html"></a> 
					<i class="icon-angle-right"> 
           </i>
				</li>
			</ul>
            
			<?php include_once 'include/content.php'; ?>	
            
             
            </div>
	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
	
    	<!--/#content.span10-->
        
		</div><!--/fluid-row-->
     
		
	<footer>
		<p>
         
			<span style="text-align:right;float:right">&copy; 2015 <a href="home.html" alt="Bootstrap_Dashboard">Responsive ENGINE MAINTENANCE CV. Aziz Perkasa Teknik</a></span>
			
		</p>
	</footer>
	
	<!-- start: JavaScript-->
<?php include_once 'include/JControl.php'; ?>
		
	<!-- end: JavaScript-->
	
</body>
</html>
