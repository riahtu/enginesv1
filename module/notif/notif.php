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
$aksi="module/notif/aksi_notif.php";

  // Tampil Agenda
  if($_GET[module] == "notif"){
    $que = "select * from tnotif";
	$result=mysql_query($que);
	$jumrows = mysql_num_rows($result);     
?>
	<h2 class='left'>Setting Notifikasi</h2>
    <a href="notif-add.html" class="btn btn-primary btn-lg">ADD NOTIF</a>
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
            	<th>ID </th>
                <th>Span Value</th>
                <th>Status</th>
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
			<td><?php echo($row[0]); ?></td>
            <td><?php echo($row[1]); ?></td>
            <td><?php echo($row[2]); ?></td>
            <td><a href="<?php echo("$aksi?module=notif&act=aktif&sid=$row[0]&data=$row[2]")?>">Active</a> || <a href="#" onclick="hapusdata('<?php echo"$aksi?module=notif&act=delete&sid=$row[0]"?>')">Delete</a></td>  
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
elseif($_GET[module]=="notifadd"){
?>
	<h2 class='left'>Add Value</h2>
  <div class="panel panel-default">
          <div class="panel-heading">Set Notif</div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=notif&act=input"?>" method="post" enctype="multipart/form-data">
                      <label>Span Value</label>
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
	   
<?php
}
?>