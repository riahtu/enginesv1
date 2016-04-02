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
$aksi="module/users/aksi_users.php";

  // Tampil Agenda
  if($_GET[module] == "users"){
    $que = "select * from user where BLOKIR ='N'";
	$result=mysql_query($que);
	$jumrows = mysql_num_rows($result);
?>
	<h2 class='left'>Management User</h2>
    <a href="users-add.html" class="btn btn-primary btn-lg">ADD USER</a>
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
                <th>Username</th>
                <th>Full Name</th>
                <th>E-mail</th>
                <th>Phone Number</th>
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
            <td><?php echo strip_tags($row[3]); ?></td>
            <td><?php echo strip_tags($row[4]); ?></td>
            <td><?php echo strip_tags($row[5]); ?></td>
            <td><a href="<?php echo("users-edit-$row[6].html")?>">Edit</a> || <a href="#" onclick="hapusdata('<?php echo"$aksi?module=users&act=delete&sid=$row[6]" ?>')">Delete</a></td>  
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
elseif($_GET[module]=="usersadd"){
?>
	<h2 class='left'>Add User</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form User
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=users&act=input"?>" method="post" enctype="multipart/form-data">
                      <label>Username</label>
                      <input class="form-control" name="txtusername" id="txtusername" />
                      <div class="form-group">
                        <label>User's Level</label>
                            <select class="form-control" name="txtlevel" id="txtlevel">
                            <?php $tampil=mysql_query("SELECT * FROM level where BLOKIR ='N'");
                            while($r=mysql_fetch_array($tampil)){
                              echo "<option value=$r[0]>$r[1]</option>";
                            } ?>
                            </select>
                      </div>
                      <label>Password</label>
                      <input class="form-control" name="txtpassword" id="txtpassword" />
                      <label>Full Name</label>
                      <input class="form-control" name="txtname" id="txtname" />
                      <label>E-mail</label>
                      <input class="form-control" name="txtemail" id="txtemail" />
                      <label>Phone Number</label>
                      <input class="form-control" name="txtphone" id="txtphone" />
                      <label>Address</label>
                      <input class="form-control" name="txtaddress" id="txtaddress" />
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                      
                      <button type="reset" class="btn btn-primary">Reset Button</button>

                  </form>
              </div>
    </div>  
<?php
}
elseif($_GET[module]=="usersedit"){
  	$que = "select * from user where ID_SESSION='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
?>
	<h2 class='left'>Edit User</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form User
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=users&act=edit"?>" method="post" enctype="multipart/form-data">
                      <label>Username</label>
                      <input hidden="" name="sid" id="sid" value="<?php echo($_GET[id]); ?>" />
                      <input class="form-control" name="txtusername" id="txtusername" value="<?php echo($row[0]); ?>" />
                      <div class="form-group">
                        <label>User's Level</label>
                            <select class="form-control" name="txtlevel" id="txtlevel">
				   <?php $tampil=mysql_query("SELECT * FROM level where BLOKIR='N'");
					while($r=mysql_fetch_array($tampil)){?>
					<option value=<?php echo $r[0];?> <?php if (!(strcmp($r[0], $row[1]))) {echo "selected=\"selected\"";} ?>><?php echo $r[1] ?></option>
                                <?php } ?>
                            </select>
                      </div>
                      <label>Password</label>
                      <input class="form-control" name="txtpassword" id="txtpassword" type="password"/>
                      <label>Full Name</label>
                      <input class="form-control" name="txtname" id="txtname" value="<?php echo($row[3]); ?>" />
                      <label>E-mail</label>
                      <input class="form-control" name="txtemail" id="txtemail" value="<?php echo($row[4]); ?>" />
                      <label>Phone Number</label>
                      <input class="form-control" name="txtphone" id="txtphone" value="<?php echo($row[5]); ?>" />
                      <label>Address</label>
                      <input class="form-control" name="txtaddress" id="txtaddress" value="<?php echo($row[7]); ?>" />
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                    
                      <button type="reset" class="btn btn-primary">Reset Button</button>
                      </form>
              </div>
  </div>    
<?php
}
?>