
<?php include "../../config/koneksi.php";?>

<script>
function hapusdata(urltujuan){
		el=$(this);
		if(confirm("Do you want to delete the data ?."))
		{
            alert("Data Deleted!");
            
            window.location = (urltujuan);
        }
        else{
            alert("Failure to Delete");
        }
}



function reback(){
    window.location = ("enginerun.html");
}
</script>
<?php include_once 'include/ClassModal.php'; ?>
                                                 
<?php
$aksi="module/EngineRun/Aksi_EngineRun.php";

  // Tampil data
  if($_GET[module] == "enginerun"){
    $que = "select jamputar_mesin.id_jamputar,
        jamputar_mesin.JAM_interval,
		jamputar_mesin.help_jamputar,
        t_komponen.id_komponen,
		jamputar_mesin.TANGGAL_ENTRY,
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
	<h2 class='left'>Engine Run Hour</h2>
    <p>&nbsp;</p>
    <div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
					
						<div class="box-icon">
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
                  
                <div class="box-content">
                 <?php
		if($_SESSION['leveluser']!='2'){
	?>
    <a href="enginerun-add.html" class="btn btn-warning btn-lg">ADD Engine Run</a>
      <?Php
	};
	?>
     <?php
		if($_SESSION['leveluser']!='3'){
	?>
     <a href="#" class="btn btn-success btn-lg" onclick='window.open("module/report/report_excel.php?cmd=cetak")'><i class="icon-file"></i> Export Excel</a>
     
     <a class="btn btn-danger btn-lg" onclick='window.open("module/report/ex_pdf.php")'><i class="icon-save"></i> Export PDF</a>
      <?Php
	};
	?>
             
  <p>&nbsp;</p> 
	<table class="table table-striped table-bordered bootstrap-datatable datatable" >
        <thead>
            <tr>
                <th hidden="true">ID Hour</th>
                <th>Interval</th>
                <th>Limit Help</th>
                <th>Date Entry</th>
                <th>Factory Name</th>
                <th>Engine Name</th>
                <th>Maintenance Status</th>
                <th>Action</th>
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
			<td hidden="true"><?php echo strip_tags($row[0]); ?></td>
            <td><a href="#dialog-metode" id="<?php 
	$data['kd_met']=$row[0];
	echo $data['kd_met'] ?>" data-toggle="modal" class="ubahse">
			<?php echo strip_tags($row[1]); ?></a></td>
            
            <td><?php echo strip_tags($row[2]); ?></td>
            <td><?php
			$tanggals = $row[4];
			$tanggalbarus = date('D, j-M-Y', strtotime($tanggals ));
			echo strip_tags($tanggalbarus);  ?></td>
            <td><?php echo strip_tags($row[6]); ?></td>
              <td><?php echo strip_tags($row[8]); ?></td>
             <?php 
                $last = "
                        select SUM(NILAI_AWAL) from d_jamputar_mesin where ID_JAMPUTAR = '$row[0]'
                    ";
                    $lastr = mysql_query($last);
                    $rlast = mysql_fetch_array($lastr);
                $cekmain = $row[1] - $rlast[0];
                if($cekmain == 0){
              ?>
              
              <td align="center"><span class="label label-important">Need Maintenance</span></td>
              <?php }else{?>
              <td align="center"><span class="label label-success">Available</span></td>
              <?php } ?>
              
       
    <td> <?php
		if($_SESSION['leveluser']!='2'){
			//runhor
	?>    
   
     <a class="tip" data-toggle="tooltip" data-placement="top" title="input hour" href="<?php echo("enginerun-hour-$row[0].html")?>"><button class="btn btn-info"><i class="halflings-icon white check"></i></button></a>
	 <?Php
	};
	?>  
    <?php
		if($_SESSION['leveluser']!='1'){
			//detail
	?>       
    <a href="#dialog-engine" id="<?php 
	$data['kd_mhs']=$row[0];
	echo $data['kd_mhs'] ?>" data-toggle="modal" class="ubah"><button class="btn btn-primary"><i class="icon-zoom-in"></i></button></a>  <?Php
	};
	?>   
    
     <?php
		if($_SESSION['leveluser']!='3'){
			//maintenance
		 if($cekmain <= 50 and $cekmain >= 0){
	?>     
        <a class="tip" data-toggle="tooltip" data-placement="top" title="input maintenance" href="<?php echo("maintenance-add-$row[0].html")?>"><button class="btn btn-warning"><i class="icon-cogs"></i></button></a>  
         <?php }else{?>
          <a class="tip" data-toggle="tooltip" data-placement="top" title="maintenance disabled" href="#"><button disabled="disabled" class="btn btn-warning"><i class="icon-cogs"></i></button></a> 
         
         <?php } ?> 
        <?php }; ?>   
        
   <?php
		if($_SESSION['leveluser']!='3'){
			//hapus
	?>           <a class="tip" data-toggle="tooltip" data-placement="top" title="hapus data" href="#" onclick="hapusdata('<?php echo"$aksi?module=enginerun&act=delete&sid=$row[0]" ?>')"><button class="btn btn-danger"><i class="halflings-icon white trash"></i> </button>  
 </a>
    <?Php
	};
	?>   
     <?php
		if($_SESSION['leveluser']!='2'){
			//edit
	?>     
    <a class="tip" data-toggle="tooltip" data-placement="top" title="edit" href="<?php echo("enginerun-edit-$row[0].html")?>"><button class="btn btn-warning"><i class="halflings-icon white edit"></i></button></a>
      <?Php
	};
	?> 
     <?php
		if($_SESSION['leveluser']!='2'){
			//recor
	?>     
     <a class="tip" data-toggle="tooltip" data-placement="top" title="warning" href="<?php echo("helpmain-add-$row[0].html")?>"><button class="btn btn-danger"><i class="halflings-icon white refresh"></i></button></a>
      <?Php
	};
	?> 
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
        
<?php

}elseif($_GET[module]=="enginerunadd"){
	?>
<h2 class='left'>Add Engine Run</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                engine run hour
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=enginerun&act=input"?>" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Factory Entry & Engine</label>
                            <select class="form-control" name="txtfac" id="txtfac">
                            <?php $tampil=mysql_query("
                            SELECT
                              t_komponen.ID_KOMPONEN,
                              t_komponen.ID_PABRIK,
                              pabrik.NAMA_PABRIK,
							  master_mesin.NAMA_MESIN
                            FROM
                              t_komponen
                              INNER JOIN pabrik ON t_komponen.ID_PABRIK = pabrik.ID_PABRIK
							  INNER JOIN master_mesin ON
							  t_komponen.ID_MESIN = master_mesin.ID_MESIN;
                            ");
                            while($r=mysql_fetch_array($tampil)){
                              echo "<option value=$r[0]>$r[2]-$r[3]</option>";
                            } ?>
                            </select>
                      </div>
                      <div class="form-group">
                    <label>Interval</label>
                      <input class="form-control" name="txtint" id="txtint" />
                      <span id="pesan"></span>
                      </div>
                      <div class="form-group">
                      <label>Limit Help</label>
                            <textarea class="form-control" name="txthelp" id="txthelp" rows="3"></textarea>
                      </div>
                      <p>&nbsp;</p>
                      
                      <button type="submit" class="btn btn-default">Submit Button</button>
                      
                      <button type="button" onclick="reback()" class="btn btn-primary">Return</button>

                  </form>
              </div>
    </div>
<?php
}elseif($_GET[module]=="enginerunedit"){
	$que = "select * from jamputar_mesin where ID_JAMPUTAR='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);	
?>    
 <h2 class='left'>Edit Run Hour</h2>
  <div class="panel panel-default">
              <div class="panel-body">
               <form name="mainform" id="mainform" action="<?php echo"$aksi?module=enginerun&act=edit"?>" method="post" enctype="multipart/form-data">
                      <input hidden="" name="sid" id="sid" value="<?php echo($_GET[id]); ?>" />
                     <div class="form-group">
                        <label>Factory Name & Engine</label>
                            <select class="form-control" name="txtfac" id="txtfac">
                            <?php $tampil=mysql_query("SELECT
                              t_komponen.ID_KOMPONEN,
                              t_komponen.ID_PABRIK,
                              pabrik.NAMA_PABRIK,
							  master_mesin.NAMA_MESIN
                            FROM
                              t_komponen
                              INNER JOIN pabrik ON t_komponen.ID_PABRIK = pabrik.ID_PABRIK
							  INNER JOIN master_mesin ON
							  t_komponen.ID_MESIN = master_mesin.ID_MESIN;");
					while($r=mysql_fetch_array($tampil)){?>
					<option value=<?php echo $r[0];?> <?php if (!(strcmp($r[0], $row[1]))) {echo "selected=\"selected\"";} ?>><?php echo $r[2]?>-<?php echo $r[3] ?></option>
                                <?php } ?>
                            </select>
                      </div>
                       <label>Interval</label>
                      <input class="form-control" name="txtintv" id="txtintv" value="<?php echo $row[2]; ?>" />
                       <div class="form-group">
                      <label>Limit Help</label>
                            <textarea class="form-control" name="txthelp" id="txthelp" rows="3"><?php echo $row[4]; ?></textarea>
                      </div>
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                    
                      <button type="reset" class="btn btn-primary">Reset Button</button>
                      </form>
              
              
              </div>
              </div>
      
<?php
}elseif($_GET[module]=="enginerunhour"){
    $que = "select * from jamputar_mesin where ID_JAMPUTAR='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
	?>
              
    
<?php 
    //        menampilkan pesan jika ada pesan
            if (($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>'.$_SESSION['pesan'].'</div>';
            }

    //        mengatur session pesan menjadi kosong
            $_SESSION['pesan'] = '';
            ?>     
<h2 class='left'>Add Hour</h2>
<div class="panel panel-default">
            <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=enginerun&act=inputdetail"?>" method="post" enctype="multipart/form-data">
                      <input name="id" id="id" value="<?php echo($row[0]); ?>" hidden="" />
                      <label>Entry</label> <label>Interval</label>
                      <input class="form-control" name="txtfac" id="txtfac" value="<?php echo($row[0]); ?>" hidden="" />
                      <input class="form-control" name="txtint" id="txtint" value="<?php echo($row[2]); ?>" readonly/>
                      <div class="form-group">
                      <label>Limit Help</label>
                            <textarea class="form-control" name="txthelp" id="txthelp" rows="3" disabled><?php echo($row[4]); ?></textarea>
                      </div>
                      <p>&nbsp;</p>
        <table class="table table-striped table-bordered bootstrap-datatable datatable" >
        <thead>
            <tr>
                <th hidden="true">Detail ID</th>
                <th>Value</th>
                <th>Date Entry</th>
                <th>Estimated Maintenance Date</th>
                <th>User</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
		<?php      
        $dque = "
        select * from d_jamputar_mesin where ID_JAMPUTAR = '$row[0]' order by ID_DETAIL_JAMPUTAR ASC
	";
	$dresult=mysql_query($dque);
	$djumrows = mysql_num_rows($dresult);
		$iCnt=0;
		if ($djumrows>0) { 
			while ($drow = mysql_fetch_array($dresult)) {
        $iCnt++;
                $fint = ceil($fint + $drow[2]);
                $lint = ceil($row[2] - $fint);
		?>
        
		  <tr <?php if ($iCnt%2==0) {?>class="odd gradeX" <?php } else {?>class="even gradeC"<?php }?> >
			<td hidden="true"><?php echo strip_tags($drow[0]); ?></td>
            <td><?php echo strip_tags($drow[2]); ?></td>
            <td><?php 
			$tanggals = $drow[3];
			$tanggalbarus = date('D, j-M-Y', strtotime($tanggals ));
			echo strip_tags($tanggalbarus); 
			?></td>
            <td><?php
                $estim = ceil($lint / $drow[2] ); 
                
                echo date('D, j-M-Y', strtotime("+".$estim." days"));
                ?></td>
                <td><?php echo strip_tags($drow[5]); ?></td>
            <th><a href="#" onclick="hapusdata('<?php echo"$aksi?module=enginerun&act=deletedet&sid=$drow[0]&ids=$row[0]" ?>')"><button class="btn btn-small btn-danger"><i class="halflings-icon white trash"></i> </button></a></th>  
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
        
         <?php 
                 $last = "
                        select SUM(NILAI_AWAL) from d_jamputar_mesin where ID_JAMPUTAR = '$row[0]'
                    ";
                    $lastr = mysql_query($last);
                    $rlast = mysql_fetch_array($lastr);
              ?>
             
	</table>
    <td colspan="6">Total Run Hour = <?php echo $rlast[0]; ?> </td> 
    
                  <p>
                  <br />                   <label>Value Engine</label>
                    <input hidden="hidden"  name="txtsisa" id="txtsisa" value="<?php 
                    if ($djumrows == 0){
                        echo($row[2]);
						
                        }else{
                        echo($lint);
                        } ?>" />
                        <a class="tip" href="#" data-toggle="tooltip" data-placement="left" title="Nilai Run Hour 1 - 24 jam sehari">
                    <input class="form-control" name="txtvalue" id="txtvalue" type="number" min="1" max="24" required="required" placeholder="1-24" /></a>
                    <span id="pesan"></span>
                    
                  </p>
                  
                  <p>&nbsp; </p>
                      <button type="submit" class="btn btn-default">Submit Detail</button>
                      
                      <button type="button" onclick="reback()" class="btn btn-primary">Return</button>

                  </form>
  </div>
</div>  

 
	
              </div>
  </div>
<?php
}
?>
