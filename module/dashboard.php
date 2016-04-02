  <script src="../js/jquery-latest.js"></script>
  <script type="text/javascript">
    setInterval("my_function();",5000); 
	setInterval("my_data();",5000);
    function my_function(){
      $('#refresh').load(location.href + ' #time');
    }
	 function my_data(){
      $('#ref').load(location.href + ' #tm');
    }
  </script>
  <?php
						$srun=mysql_query("select * from jamputar_mesin");
						$trun=mysql_num_rows($srun);
						
						$sfac=mysql_query("select * from pabrik");
						$tfac=mysql_num_rows($sfac);
						
							$smes=mysql_query("select * from master_mesin where blokir='N'");
						$tmes=mysql_num_rows($smes);
						
						$smain=mysql_query("select * from d_jadwal_maintenance");
						$tmain=mysql_num_rows($smain);
						
						$selisihorder=$torder-$torder1;
						?>
                        <div id="refresh">
<div class="row-fluid" id="time">

				<div id="pupl" class="span3 statbox purple" onTablet="span6" onDesktop="span3">
                 
				
					<div class="number"><i class="icon-cogs"></i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<?php echo"$trun"; ?></div>
					<div class="title">Engine RunHour</div>
					<div class="footer">
						Total Data Records RunHour
					</div>	
				</div>
               
				<div  id="grn" class="span3 statbox green" onTablet="span6" onDesktop="span3">
					
					<div  class="number"><i class="icon-home"></i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<?php echo"$tfac"; ?></div>
					<div class="title">Factory</div>
					<div class="footer">
						Total Data Records Factory
					</div>
				</div>
               
				<div  id="blse" class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
					
					<div class="number"><i class="icon-wrench"></i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<?php echo"$tmes"; ?></div>
					<div class="title">Engine</div>
					<div class="footer">
						Total Records Engine
					</div>
				</div>
             
				<div  id="ylw" class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
					
					<div  class="number"><i class="icon-refresh"></i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<?php echo"$tmain"; ?></div>
					<div class="title">Maintenance</div>
					<div class="footer">
						Total Records Maintenance
					</div>
				</div>	
				
			</div>
            </div>
            
          <td> <?php
		if($_SESSION['leveluser']!='1' and $_SESSION['leveluser']!='3'){
			//runhor
	?> 
   <div class="row-fluid">
				         
            <?php
			 $que = "select jamputar_mesin.id_jamputar,
        jamputar_mesin.JAM_interval,
		
        t_komponen.id_komponen,
		
        pabrik.id_pabrik,
        pabrik.nama_pabrik,
		master_mesin.id_mesin,
		master_mesin.nama_mesin
         from jamputar_mesin inner join t_komponen on jamputar_mesin.id_komponen=t_komponen.id_komponen
         inner join pabrik on t_komponen.id_pabrik=pabrik.id_pabrik
		 inner join master_mesin on t_komponen.id_mesin=master_mesin.id_mesin
	";
	$result=mysql_query($que);
	$jumrows = mysql_num_rows($result);
			?>
              <div id="ref"> 
            <div  id="tm" class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Data</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
                    	<div class="box-content">
                    <table class="table table-condensed">
           
        <thead>
            <tr>
                <th hidden="true">ID Hour</th>
                <th>Interval</th>
                <th>Factory Name</th>
                <th>Engine Name</th>
                <th>Maintenance Status</th>
              
            </tr>
        </thead>
        <tbody>
		<?php
		$iCnt=0;
		if ($jumrows>0) { 
			while ($row = mysql_fetch_array($result)) {
        $iCnt++;
		?>
        
		  <tr <?php if ($iCnt%2==0) {?>class="odd gradeX" <?php } else {?>class="even gradeC"<?php }?> >
			<td hidden="true"><?php echo($row[0]); ?></td>
            <td>
			<?php echo($row[1]); ?></td>
            
          
            <td><?php echo($row[4]); ?></td>
              <td><?php echo($row[6]); ?></td>
              <?php 
			  $nt = "select nilai_rentang from tnotif where status = 'Y'";
	$ntr = mysql_query($nt);
	$ntt = mysql_fetch_array($ntr);
			  $ntt2 = $ntt[0] + $ntt[0];
			  $ntt3 = $ntt[0] + $ntt[0] + $ntt[0];
			  ?>
             <?php 
                $last = "
                        select SUM(NILAI_AWAL) from d_jamputar_mesin where ID_JAMPUTAR = '$row[0]'
                    ";
                    $lastr = mysql_query($last);
                    $rlast = mysql_fetch_array($lastr);
                $cekmain = $row[1] - $rlast[0];
                if($cekmain == 0 ){
              ?>
                <td align="center"><span class="label label-important">Need Maintenance</span></td>
             <?php }elseif($cekmain <= $ntt[0] and $cekmain >= 0){  ?>
              <td align="center"><span class="label label-important">1 days before maintenance</span></td>
              <?php }elseif($cekmain <= $ntt2 and $cekmain >= $ntt[0]){  ?>
              
               <td align="center"><span class="label label-important">2 days before maintenance</span></td>
              <?php }elseif($cekmain <= $ntt3 and $cekmain >= $ntt2){  ?>
                 <td align="center"><span class="label label-important">3 days before maintenance</span></td>
              <?php }else{?>
              <td align="center"><span class="label label-success">Available</span></td>
              <?php } ?>
              
       
    <td> 
    </td>  
		  </tr>
		<?php
			}
		}else{
		?>
		<tr>
			<td colspan="6">Data tidak di temukan</td>
		</tr>
		<?php
		}
		?>
        </tbody>
	</table>
   </div>
   </div>
        </div>   

            <div class="box span6">
            
					<div class="box-header">
                   
						<h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Chart</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
                    <div class="box-content">
            <div id="tampil_chart" style="width: 700px;"></div>
            </div>
            
            </div>
            
            </div>
             
           
      <?Php
	};
	?>
            
			 
          
             