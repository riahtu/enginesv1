  <script src="../js/jquery-latest.js"></script>
  <script type="text/javascript">
    setInterval("my_f();",5000);
	setInterval("my_g();",5000);
	setInterval("my_h();",5000); 
    function my_f(){
      $('#re').load(location.href + ' #ti');
    }
	function my_g(){
      $('#er').load(location.href + ' #it');
    }
	function my_h(){
      $('#ro').load(location.href + ' #ot');
    }
  </script>
<?php
$sruneng=mysql_query("select * from temphour where blokir='N'");
						$truneng=mysql_num_rows($sruneng);


 ?>
<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                       
                               <i class="icon-warning-sign"></i>
                                <div id="re">
								<span id="ti" class="badge red">
								<?php echo $truneng ?> </span></div>
							
                            </a>
							<ul class="dropdown-menu notifications">
								<li class="dropdown-menu-title">
                                <div id="er">
 									<span id="it">You have <?php echo $truneng ?> Engine Damage</span></div>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>	
                        <div id="ro">
								<li id="ot" class="warning">
                                 <?php
		if($_SESSION['leveluser']!='1' and $_SESSION['leveluser']!='3' and $_SESSION['leveluser']!='4'){
			//recor
     if($truneng==0){
	?>      
    <a href="#">
                                    <span class="icon red"><i class="icon-warning-sign"></i></span>
										<span class="message">Engine Damage</span>
                                    </a> 
                                    <?php 
                                   
                                    
     }else{
                                    ?>
                                    
                                    <a href="helpmain.html">
                                    <span class="icon red"><i class="icon-warning-sign"></i></span>
										<span class="message">Engine Damage</span>
                                    </a>
                                     <?Php
									 
	};
 };
	?> 
										
                                </li>
                            </div>
								
                                <li class="dropdown-menu-sub-footer">
                            		
								</li>	
							</ul>
						</li>