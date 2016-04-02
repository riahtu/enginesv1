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
$aksi="module/levels/aksi_levels.php";

  // Tampil Agenda
  if($_GET[module] == "level"){
    $que = "select * from level where BLOKIR ='N'";
	$result=mysql_query($que);
	$jumrows = mysql_num_rows($result);     
?>
	<h2 class='left'>Management Level</h2>
    <a href="level-add.html" class="btn btn-primary btn-lg">ADD LEVEL</a>
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
                <th hidden="true">ID</th>
                <th>Level Name</th>
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
            <td><a href="<?php echo("level-edit-$row[0].html")?>">Edit</a> || <a href="#" onclick="hapusdata('<?php echo"$aksi?module=level&act=delete&sid=$row[0]" ?>')">Delete</a></td>  
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
elseif($_GET[module]=="leveladd"){
?>
	<h2 class='left'>Add Level</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form Level
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=level&act=input"?>" method="post" enctype="multipart/form-data">
                      <label>Level Name</label>
                      <input class="form-control" name="txtname" id="txtname" />
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