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
</script>            
<?php
$aksi="module/pabrik/aksi_pabrik.php";

  // Tampil Agenda
  if($_GET[module] == "pabrik"){
    $que = "select
			pabrik.ID_PABRIK,
			pabrik.NAMA_PABRIK,
			master_mesin.ID_MESIN,
			jenis_mesin.id_jenis,
			jenis_mesin.nama_jenis,
			pabrik.ALAMAT,
			pabrik.DESKRIPSI
			FROM pabrik inner join
			master_mesin ON pabrik.ID_MESIN = master_mesin.ID_MESIN inner join jenis_mesin on master_mesin.id_jenis=jenis_mesin.id_jenis where master_mesin.BLOKIR='N'";
	$result=mysql_query($que);
	$jumrows = mysql_num_rows($result);
?>
	<h2 class='left'>Manufacturing</h2>
    <a href="factory-add.html" class="btn btn-primary btn-lg">ADD FACTORY</a>
    <p>&nbsp;</p>
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
					
						<div class="box-icon">
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
                <p>&nbsp;</p>    
                <div class="box-content">
	<table class="table table-striped table-bordered bootstrap-datatable datatable" >
        <thead>
            <tr>
                <th>Factory ID</th>
                <th>Factory Name</th>
                <th hidden="true">Engine Model</th>
                <th>Address</th>
                <th>Description</th>
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
        
		  <tr <?php if ($iCnts%2==0) {?>class="odd gradeX" <?php } else {?>class="even gradeC"<?php }?> >
			<td><?php echo strip_tags($row[0]); ?></td>
            <td><?php echo strip_tags($row[1]); ?></td>
            <td hidden="true"><?php echo strip_tags($row[4]); ?></td>
            <td><?php echo strip_tags($row[5]); ?></td>
            <td><?php echo strip_tags($row[6]); ?></td>
            <td><a href="<?php echo("factory-edit-$row[0].html")?>">Edit</a> || <a href="#" onclick="hapusdata('<?php echo"$aksi?module=pabrik&act=delete&sid=$row[0]" ?>')">Delete</a></td>  
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
  }
elseif($_GET[module]=="pabrikadd"){

       
 
  $query = "SELECT max(id_pabrik) as maxKode FROM pabrik";
   $hasil = mysql_query($query); 
  $data = mysql_fetch_array($hasil); 
  $kodeBarang = $data['maxKode']; 
   $noUrut = (int) substr($kodeBarang, 1, 4); 
   $noUrut++; 
   $char="F";
    $newID = $char . sprintf("%04s", $noUrut);
?>
	<h2 class='left'>Add Data</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form Add Factory
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=pabrik&act=input"?>" method="post" enctype="multipart/form-data">
                      <label>Factory ID</label>
                      <input class="form-control" name="txtid" id="txtid" value="<?php echo($newID); ?>" readonly="readonly" />
                      
                       
                      <label>Factory Name</label>
                      <input class="form-control" name="txtname" id="txtname" />
                      <div class="form-group">
                        <label>Engine's Name</label>
                            <select class="form-control" name="txtengname" id="txttype">
                            <?php $tampil=mysql_query("SELECT * FROM master_mesin where blokir='N'");
                            while($r=mysql_fetch_array($tampil)){
                              echo "<option value=$r[0]>$r[1]</option>";
                            } ?>
                            </select>
                      </div>
                      
                      <label>Address</label>
                      <textarea class="form-control"  name="txtaddrs" id="txtaddrs"> </textarea>
                      
                      <label>Description</label>
                      <textarea class="form-control" name="txtdes" id="txtdes"></textarea>
                     
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                      
                      <button type="reset" class="btn btn-primary">Reset Button</button>

                  </form>
              </div>
    </div>  
<?php
}
elseif($_GET[module]=="pabrikedit"){
  	$que = "select * from pabrik where ID_PABRIK='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
?>
	<h2 class='left'>Edit Data</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=pabrik&act=edit"?>" method="post" enctype="multipart/form-data">
                      <label>Factory ID</label>
                      <input hidden="" name="sid" id="sid" value="<?php echo($_GET[id]); ?>" />
                      <input class="form-control" name="txtid" id="txtid" value="<?php echo($_GET[id]); ?>" />
         
                      <label>Factory Name</label>
                      <input class="form-control" name="txtname" id="txtname" value="<?php echo($row['NAMA_PABRIK']); ?>" />
                      
                      <div class="form-group">
                        <label>Engine's Name</label>
                            <select class="form-control" name="txtengname" id="txtengname">
                            <?php $tampil=mysql_query("SELECT * FROM master_mesin where BLOKIR='N'");
					while($r=mysql_fetch_array($tampil)){?>
					<option value=<?php echo $r[0];?> <?php if (!(strcmp($r[0], $row[2]))) {echo "selected=\"selected\"";} ?>><?php echo $r['NAMA_MESIN'] ?></option>
                                <?php } ?>
                            </select>
                      </div>
                      
                      <label>Address</label>
                      <input class="form-control"  name="txtaddrs" id="txtaddrs" value="<?php echo($row[3]); ?>" />
                      <label>Description</label>
                      <input class="form-control" name="txtdes" id="txtdes" value="<?php echo($row[4]); ?>" />
                      
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                    
                      <button type="reset" class="btn btn-primary">Reset Button</button>
              </div>
  </div>    
<?php
}
?>