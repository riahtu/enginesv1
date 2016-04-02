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
$aksi="module/tengines/aksi_tengines.php";

  // Tampil Agenda
  if($_GET[module] == "tengine"){
    $que = "select * from jenis_mesin where BLOKIR ='N'";
	$result=mysql_query($que);
	$jumrows = mysql_num_rows($result);     
?>
	<h2 class='left'>Management Engine Type</h2>
    <a href="tengine-add.html" class="btn btn-primary btn-lg">ADD Engines Type</a>
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
               	<th hidden="true"></th>
                <th>Engine Type</th>
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
            <td><?php echo($row[1]); ?></td>
            <td><a href="<?php echo("tengine-edit-$row[0].html")?>">Edit</a> || <a href="#" onclick="hapusdata('<?php echo"$aksi?module=tengine&act=delete&sid=$row[0]" ?>')">Delete</a></td>  
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
elseif($_GET[module]=="tengineadd"){
?>
	<h2 class='left'>Add Engine Type</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form Engine Type
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=tengine&act=input"?>" method="post" enctype="multipart/form-data">
                      <label>Engine Type Name</label>
                      <input class="form-control" name="txtname" id="txtname" />
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                      
                      <button type="reset" class="btn btn-primary">Reset Button</button>

                  </form>
              </div>
    </div>  
<?php
}
elseif($_GET[module]=="tengineedit"){
  	$que = "select * from jenis_mesin where ID_JENIS='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
?>
	<h2 class='left'>Edit Engine Type</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form Engine Type
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=tengine&act=edit"?>" method="post" enctype="multipart/form-data">
                      <input hidden="" name="sid" id="sid" value="<?php echo($_GET[id]); ?>" />
                      <label>Engine Type Name</label>
                      <input class="form-control" name="txtname" id="txtname" value="<?php echo($row[1]); ?>" />
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                    
                      <button type="reset" class="btn btn-primary">Reset Button</button>
              </div>
  </div>    
<?php
}
?>