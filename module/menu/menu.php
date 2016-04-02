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
$aksi="module/menu/aksi_menu.php";

  // Tampil Agenda
  if($_GET[module] == "menu"){
    $que = "select * from menu where aktif ='1'";
	$result=mysql_query($que);
	$jumrows = mysql_num_rows($result);
?>
	<h2 class='left'>Management Menu</h2>
    <a href="menu-add.html" class="btn btn-primary btn-lg">ADD MENU</a>
    <p>&nbsp;</p>
	<div class="row-fluid sortable">
    <div class="table-responsive">		
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
                <th>id</th>
                <th>Parent ID</th>
                <th>Judul</th>
                <th>Url</th>
                <th>icon</th>
                <th>Menu Order</th>
                <th>Aktif</th>
                <th>letak</th>
                <th>Id level</th>
                <th>Aksi</th>
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
            <td><?php echo($row[3]); ?></td>
            <td><?php echo($row[4]); ?></td>
            <td><?php echo($row[5]); ?></td>
            <td><?php echo($row[6]); ?></td>
            <td><?php echo($row[7]); ?></td>
            <td><?php echo($row[8]); ?></td>
            <td><a href="<?php echo("menu-edit-$row[0].html")?>">Edit</a> || <a href="#" onclick="hapusdata('<?php echo"$aksi?module=menu&act=delete&sid=$row[0]" ?>')">Delete</a></td>  
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
 </div>
	<?php
  }
elseif($_GET[module]=="menuadd"){
?>
	<h2 class='left'>Add Menu</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form Menu
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=menu&act=input"?>" method="post" enctype="multipart/form-data">
                      <label>Judul Menu</label>
                      <input class="form-control" name="txtmenu" id="txtmenu" />
                      <div class="form-group">
                        <label>Parent</label>
                            <select class="form-control" name="txtparent" id="txtparent">
                            <?php $tampil=mysql_query("SELECT * FROM menu where aktif ='1' order by parent_id");
                            while($r=mysql_fetch_array($tampil)){
                              echo "<option value=$r[parent_id]>$r[judul]</option>";
                            } ?>
                            </select>
                      </div>
                      <label>Url</label>
                      <input class="form-control" name="txturl" id="txturl" />
                      <label>Icon</label>
                      <input class="form-control" name="txticon" id="txticon" />
                      <label>Urut</label>
                      <select class="form-control" name="txturut" id="txturut">
             <?php           for($i=1;$i<=15;$i++){
    echo " <option value=$i selected>$i</option>";
			}
			?>
                       </select>
                      <label>Dropdown Menu?</label>
                      <select class="form-control" name="txtletak" id="txtletak" >
                      <option value=1 selected>Yes</option>
			<option value=0 selected>No</option>
                      </select>
                      
                      <label>ID Level</label>
                      <select class="form-control" name="txtlvl" id="txtlvl" >						<option value=4 selected>Manager</option>
                      <option value=3 selected>Pegawai</option>
                      <option value=2 selected>Office</option>
			<option value=1 selected>Admin</option>
                      </select>
                      
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                      
                      <button type="reset" class="btn btn-primary">Reset Button</button>

                  </form>
              </div>
    </div>  
<?php
}
elseif($_GET[module]=="menuedit"){
  	$que = "select * from menu where id='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
?>
	<h2 class='left'>Edit Menu</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form Menu
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=menu&act=edit"?>" method="post" enctype="multipart/form-data">
                      <label>Judul</label>
                      <input type="hidden" name="id" value=<?php echo($_GET[id]); ?> />
                      <input class="form-control" name="txtjudul" id="txtjudul" value="<?php echo($row[2]); ?>" />
                      <div class="form-group">
                        <label>Parent</label>
                            <select class="form-control" name="txtparent" id="txtparent">
				   <?php $tampil=mysql_query("SELECT * FROM menu where aktif='1'");
					while($r=mysql_fetch_array($tampil)){?>
					<option value=<?php echo $r[0];?> <?php if (!(strcmp($r[0], $row[1]))) {echo "selected=\"selected\"";} ?>><?php echo $r[2] ?></option>
                                <?php } ?>
                            </select>
                      </div>
                      <label>Url</label>
                      <input class="form-control" name="txturl" id="txturl"  value="<?php echo($row[3]); ?>" />
                      <label>Icon</label>
                      <input class="form-control" name="txticon" id="txticon" value="<?php echo($row[4]); ?>" />
                      <label>Urut</label>
                      <select class="form-control" name="txturut" id="txturut" ><?php  for($i=1;$i<=15;$i++){
    echo " <option value=$i selected>$i</option>";
			} ?>
                      </select>
                       <label>Aktif</label>
                      <select class="form-control" name="txtaktif" id="txtaktif"  >
                      <option value=0 selected>No</option>
			<option value=1 selected>Yes</option>
                      </select>
                      <label>DropDown Menu</label>
                      <select class="form-control" name="txtletak" id="txtletak"  >
                      <option value=1 selected>Yes</option>
			<option value=0 selected>No</option>
                      </select>
                      <div class="form-group">
                        <label>User's Level</label>
                            <select class="form-control" name="txtlevel" id="txtlevel">
				   <?php $tampil=mysql_query("SELECT * FROM level where BLOKIR='N'");
					while($r=mysql_fetch_array($tampil)){?>
					<option value=<?php echo $r[0];?> <?php if (!(strcmp($r[0], $row[1]))) {echo "selected=\"selected\"";} ?>><?php echo $r[1] ?></option>
                                <?php } ?>
                            </select>
                      </div>
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                    
                      <button type="reset" class="btn btn-primary">Reset Button</button>
              </div>
  </div>    
<?php
}
?>