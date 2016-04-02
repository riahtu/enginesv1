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
    window.location = ("engine.html");
}
</script>            
<?php
$aksi="module/engines/aksi_engines.php";

  // Tampil Agenda
  if($_GET[module] == "engine"){
    $que = "
SELECT
  master_mesin.ID_MESIN,
  master_mesin.NAMA_MESIN,
  jenis_mesin.NAMA_JENIS,
  master_mesin.TGL_PEMBUATAN
FROM
  master_mesin
  INNER JOIN jenis_mesin ON master_mesin.ID_JENIS =
    jenis_mesin.ID_JENIS
    where master_mesin.BLOKIR ='N'";
	$result=mysql_query($que);
	$jumrows = mysql_num_rows($result);
?>
	<h2 class='left'>Management Engine</h2>
    <a href="engine-add.html" class="btn btn-primary btn-lg">ADD Engine</a>
    <p>&nbsp;</p>
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
					
						<div class="box-icon">
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
                <p><?php 
    //        menampilkan pesan jika ada pesan
            if (($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>'.$_SESSION['pesan'].'</div>';
            }

    //        mengatur session pesan menjadi kosong
            $_SESSION['pesan'] = '';
            ?>     </p>   
                <div class="box-content"> 
	<table class="table table-striped table-bordered bootstrap-datatable datatable" >
        <thead>
            <tr>
                <th>Serial Number</th>
                <th>Engine Name</th>
                <th>Engine Model</th>
                <th>Register Date</th>
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
			<td><?php echo strip_tags($row[0]); ?></td>
            <td><?php echo strip_tags($row[1]); ?></td>
            <td><?php echo strip_tags($row[2]); ?></td>
            <td><?php
			$tanggals = $row[3];
			$tanggalbarus = date('D, j-M-Y', strtotime($tanggals ));
			echo strip_tags($tanggalbarus);  ?></td>
            <td><a href="<?php echo("engine-edit-$row[0].html")?>">Edit</a> || <a href="<?php echo"engine-detail-$row[0].html" ?>">Detail</a> || <a href="#" onclick="hapusdata('<?php echo"$aksi?module=engine&act=delete&sid=$row[0]" ?>')">Delete</a></td>  
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
elseif($_GET[module]=="engineadd"){

  $query = "SELECT max(id_mesin) as maxKode FROM master_mesin";
   $hasil = mysql_query($query); 
  $data = mysql_fetch_array($hasil); 
  $kodeBarang = $data['maxKode']; 
   $noUrut = (int) substr($kodeBarang, 1, 4); 
   $noUrut++; 
   $char="E";
    $newID = $char . sprintf("%04s", $noUrut);

		
	
?>
	<h2 class='left'>Add Engine</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form Engine
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=engine&act=input"?>" method="post" enctype="multipart/form-data">
                      <label>ID Engine</label>
                      <input class="form-control" name="txtid" id="txtid" value="<?php echo($newID); ?>" readonly="readonly" />
                      <label>Engine Name</label>
                      <input class="form-control" name="txtname" id="txtname" />
                      <div class="form-group">
                        <label>Engine's Type</label>
                            <select class="form-control" name="txttype" id="txttype">
                            <?php $tampil=mysql_query("SELECT * FROM jenis_mesin");
                            while($r=mysql_fetch_array($tampil)){
                              echo "<option value=$r[0]>$r[1]</option>";
                            } ?>
                            </select>
                      </div>
                      <label>Engine's Date</label>
                      <input class="form-control" type="date" name="txttgl" id="txttgl" />
                      <div class="form-group">
                      <label>Engine's Specification</label>
                            <textarea class="form-control" name="txtspec" id="txtspec" rows="3"></textarea>
                      </div>
                      <div class="form-group">
                      <label>Engine's Description</label>
                            <textarea class="form-control" name="txtdesc" id="txtdesc" rows="3"></textarea>
                      </div>
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                      
                      <button type="reset" class="btn btn-primary">Reset Button</button>

                  </form>
              </div>
    </div>  
<?php
}
elseif($_GET[module]=="engineedit"){
  	$que = "select * from master_mesin where ID_MESIN='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
?>
	<h2 class='left'>Edit Engine</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form Engine
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=engine&act=edit"?>" method="post" enctype="multipart/form-data">
                      <label>ID Engine</label>
                      <input hidden="" name="sid" id="sid" value="<?php echo($_GET[id]); ?>" />
                      <input class="form-control" name="txtid" id="txtid" value="<?php echo($_GET[id]); ?>" readonly="readonly" />
                      <label>Engine Name</label>
                      <input class="form-control" name="txtname" id="txtname" value="<?php echo($row['NAMA_MESIN']); ?>" />
                      <div class="form-group">
                        <label>Engine's Type</label>
                            <select class="form-control" name="txttype" id="txttype">
                            <?php $tampil=mysql_query("SELECT * FROM jenis_mesin where BLOKIR='N'");
					while($r=mysql_fetch_array($tampil)){?>
					<option value=<?php echo $r[0];?> <?php if (!(strcmp($r[0], $row[2]))) {echo "selected=\"selected\"";} ?>><?php echo $r[1] ?></option>
                                <?php } ?>
                            </select>
                      </div>
                      <label>Engine's Date</label>
                      <input class="form-control" type="date" name="txttgl" id="txttgl" value="<?php echo($row['TGL_PEMBUATAN']); ?>" />
                      <div class="form-group">
                      <label>Engine's Specification</label>
                            <textarea class="form-control" name="txtspec" id="txtspec" rows="3"><?php echo($row['SPESIFIKASI_MESIN']); ?></textarea>
                      </div>
                      <div class="form-group">
                      <label>Engine's Description</label>
                            <textarea class="form-control" name="txtdesc" id="txtdesc" rows="3"><?php echo($row['DESKRIPSI']); ?></textarea>
                      </div>
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                    
                      <button type="reset" class="btn btn-primary">Reset Button</button>
              </div>
  </div>    
<?php
}
elseif($_GET[module]=="enginedetail"){
  	$que = "select * from master_mesin where ID_MESIN='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
?>
	<h2 class='left'>Detail Engine</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form Detail Engine
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=engine&act=edit"?>" method="post" enctype="multipart/form-data">
                      <label>ID Engine</label>
                      <input class="form-control" disabled name="txtid" id="txtid" value="<?php echo($_GET[id]); ?>" />
                      <label>Engine Name</label>
                      <input class="form-control" disabled name="txtname" id="txtname" value="<?php echo($row['NAMA_MESIN']); ?>" />
                      <div class="form-group">
                        <label>Engine's Type</label>
                            <select class="form-control" disabled name="txttype" id="txttype">
                            <?php $tampil=mysql_query("SELECT * FROM jenis_mesin where BLOKIR='N'");
					while($r=mysql_fetch_array($tampil)){?>
					<option value=<?php echo $r[0];?> <?php if (!(strcmp($r[0], $row[2]))) {echo "selected=\"selected\"";} ?>><?php echo $r[1] ?></option>
                                <?php } ?>
                            </select>
                      </div>
                      <label>Engine's Date</label>
                      <input class="form-control" type="date" disabled name="txttgl" id="txttgl" value="<?php echo($row['TGL_PEMBUATAN']); ?>" />
                      <div class="form-group">
                      <label>Engine's Specification</label>
                            <textarea class="form-control" name="txtspec" disabled id="txtspec" rows="3"><?php echo($row['SPESIFIKASI_MESIN']); ?></textarea>
                      </div>
                      <div class="form-group">
                      <label>Engine's Description</label>
                            <textarea class="form-control" disabled name="txtdesc" id="txtdesc" rows="3"><?php echo($row['DESKRIPSI']); ?></textarea>
                      </div>
                      <p>&nbsp;</p>
                      <button type="button" class="btn btn-warning" onclick="reback();" onkeypress="reback();" >Return Button</button>
              </div>
  </div>          
<?php
}
?>