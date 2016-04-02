<script>
function hapusdata(urltujuan){
		el=$(this);
		if(confirm("Do you want to deactivate interval damage ?."))
		{
            alert("Data deactivated!");
            
            window.location = (urltujuan);
        }
        else{
            alert("Failure to Delete");
        }
}
</script>            
<?php
$aksi="module/helpmain/aksi_helpmain.php";

  // Tampil Agenda
  if($_GET[module] == "helpmain"){
    $que = "select temphour.id_jamputar,
        temphour.JAM_interval,
        temphour.INTERVAL_DA,
		temphour.part_req,
        t_komponen.id_komponen,
		temphour.TANGGAL_ENTRY,
        pabrik.id_pabrik,
        pabrik.nama_pabrik,
		master_mesin.id_mesin,
		master_mesin.nama_mesin
         from temphour inner join t_komponen on temphour.id_komponen=t_komponen.id_komponen
         inner join pabrik on t_komponen.id_pabrik=pabrik.id_pabrik
		 inner join master_mesin on t_komponen.id_mesin=master_mesin.id_mesin";
	$result=mysql_query($que);
	$jumrows = mysql_num_rows($result);     
?>
	<h2 class='left'>HELP INTERVAL DAMAGE</h2>
    
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
					
						<div class="box-icon">
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
                <p>&nbsp;</p>    
                <div class="box-content">
                <div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong><?php echo $jumrows ?></strong> Problem Interval Damage
						</div>
	<table class="table table-striped table-bordered bootstrap-datatable datatable" >
        <thead>
            <tr>
                <th hidden="true">ID</th>
                <th>Interval</th>
                <th>Interval Damage</th>
                <th>Date Entry</th>
                <th>Factory Name</th>
                <th>Engine Name</th>
                <th>Part Request</th>
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
			<td hidden="true"><?php echo($row[0]); ?></td>
            <td><?php echo strip_tags($row[1]); ?></td>
            <td><?php echo strip_tags($row[2]); ?></td>
            <td><?php echo strip_tags($row[5]); ?></td>
            <td><?php echo strip_tags($row[7]); ?></td>
            <td><?php echo strip_tags($row[9]); ?></td>
            <td><?php echo strip_tags($row[3]); ?></td>
            <td><a class="tip" data-toggle="tooltip" data-placement="top" title="input maintenance" href="<?php echo("maintenance-add-$row[0].html")?>"><button class="btn btn-warning"><i class="icon-cogs"></i></button></a>  
          <a class="tip" data-toggle="tooltip" data-placement="top" title="hapus data" href="#" onclick="hapusdata('<?php echo"$aksi?module=helpmain&act=delete&sid=$row[0]" ?>')"><button class="btn btn-danger"><i class="halflings-icon white trash"></i> </button>  
 </a></td>  
		  </tr>
		<?php
			}
		}else{
		?>
		<tr>
			<td colspan="3">Data tidak di temukan</td>
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
  }
elseif($_GET[module]=="helpmainadd"){
	
$que = "select * from jamputar_mesin where ID_JAMPUTAR='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);	
?>    
 <h2 class='left'>Help Interval Damage</h2>
  <div class="panel panel-default">
              <div class="panel-body">
               <form name="mainform" id="mainform" action="<?php echo"$aksi?module=helpmain&act=input"?>" method="post" enctype="multipart/form-data">
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
                       <div class="form-group">
                       <label>Interval</label>
                      <input class="form-control" name="txtintv" id="txtintv" value="<?php echo $row[2]; ?>" />
                      </div>
                       <div class="form-group">
                        <label>Interval Damage</label>
                      <input class="form-control" name="txtintd" id="txtintv" value=""/>
                       </div>
                       <div class="form-group">
                      <label>part replacement request</label>
                            <textarea class="form-control" name="txthelp" id="txthelp" rows="3"></textarea>
                      </div>
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                    
                      <button type="reset" class="btn btn-primary">Reset Button</button>
                      </form>
              
              
              </div>
              </div>
    <?php
}
elseif($_GET[module]=="leveledit"){
  	$que = "select * from level where ID_LEVEL='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
?>
	<h2 class='left'>Edit Level</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form User
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=level&act=edit"?>" method="post" enctype="multipart/form-data">
                      <input hidden="" name="sid" id="sid" value="<?php echo($_GET[id]); ?>" />
                      <label>Full Name</label>
                      <input class="form-control" name="txtname" id="txtname" value="<?php echo($row[1]); ?>" />
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                    
                      <button type="reset" class="btn btn-primary">Reset Button</button>
                      </form>
              </div>
  </div>    
<?php
}
?>