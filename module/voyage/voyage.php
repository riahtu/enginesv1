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
$aksi="module/voyage/aksi_voyage.php";


  if($_GET[module] == "voyage"){
    $que = "select * from voyage";
	$result=mysql_query($que);
	$jumrows = mysql_num_rows($result);
?>
	<h2 class='left'>Voyage Management</h2>
    <?php
	
?>
    <a href="voyage-add.html" class="btn btn-primary btn-lg">ADD VOYAGE</a>

    <p>&nbsp;</p>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>Ship Name</th>
                <th>Date of Departure</th>
                <th>Date of Arrived</th>
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
        
		  <tr <?php if ($iCnt%2==0) {?>class="odd gradeX" <?php } else {?>class="even gradeC"<?php }?> >
			<td><?php echo($row[1]); ?></td>
            <td><?php echo($row[2]); ?></td>
            <td><?php echo($row[3]); ?></td>
            <td><?php echo($row[4]); ?></td>
            <td><a href="<?php echo("voyage-edit-$row[0].html")?>">Edit</a> || <a href="#" onclick="hapusdata('<?php echo"$aksi?module=voyage&act=delete&sid=$row[0]" ?>')">Delete</a></td>  
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
	<?php
  }
 
elseif($_GET[module]=="voyageadd"){
?>
	<h2 class='left'>Add Voyage</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form Input
          </div>
              <div class="panel-body">
                <form name="mainform" id="mainform" action="<?php echo"$aksi?module=voyage&act=input"?>" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label>Ship Name</label>
                            <select class="form-control" name="txtsname" id="txtsname">
                            <?php $tampil=mysql_query("SELECT * FROM kapal");
                            while($r=mysql_fetch_array($tampil)){
                              echo "<option value=$r[ID_KAPAL]>$r[NAMA_KAPAL]</option>";
                            } ?>
                            </select>
                  </div>
                      
                       
                      <label>Date of Departure</label>
                      <input class="form-control" type="date" name="txtdatedep" id="txtdatedep" />
                      <label>Date Of Arrived</label>
                    <input class="form-control" type="date" name="txtdatedes" id="txtdatedes" />
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
elseif($_GET[module]=="voyageedit"){
  	$que = "select * from voyage where ID_VOYAGE='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
?>
	<h2 class='left'>Edit Data</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=voyage&act=edit"?>" method="post" enctype="multipart/form-data">
                      <input hidden="" name="sid" id="sid" value="<?php echo($_GET[id]); ?>" />
                      <div class="form-group">
                        <label>Ship Name</label>
                            <select class="form-control" name="txtsname" id="txtsname">
				   <?php $tampil=mysql_query("SELECT * FROM kapal");
					while($r=mysql_fetch_array($tampil)){?>
					<option value=<?php echo $r[0];?> <?php if (!(strcmp($r[0], $row[1]))) {echo "selected=\"selected\"";} ?>><?php echo $r[1] ?></option>
                                <?php } ?>
                            </select>
                      </div>
                      <label>Date of Departure</label>
                      <input class="form-control" type="date" name="txtname" id="txtname" value="<?php echo($row[2]); ?>" />
                      
                      <label>Date Of Arrived</label>
                      <input class="form-control" type="date" name="txtdate" id="txtdate" value="<?php echo($row[3]); ?>" />
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