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
<?php include_once 'include/ehand.php'; ?>            
<?php
$aksi="module/sparepart/aksi_sparepart.php";

  // Tampil Agenda
  if($_GET[module] == "sparepart"){
    $que = "select
			idsparepart,part_package,description from sparepart";
	$result=mysql_query($que);
	$jumrows = mysql_num_rows($result);
?>
 
	<h2 class='left'>Data SparePart</h2>
    <?php
		if($_SESSION['leveluser']!='2'){
	?>
    <a href="spare-add.html" class="btn btn-primary btn-lg">ADD SPAREPART</a>
       <?Php
	};
	?>
    <p>&nbsp;</p>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th hidden="true">ID</th>
                <th>Part Package</th>
                <th>Package Description</th>
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
            <td><?php echo($row[2]); ?></td>
            <td><a href="<?php echo("spare-det-$row[0].html")?>">Detail</a> - 
            <?php
		if($_SESSION['leveluser']!='2' and $_SESSION['leveluser']!='4' ){
			//runhor
	?>       
            <a href="<?php echo("spare-edit-$row[0].html")?>">Edit</a> - <a href="#" onclick="hapusdata('<?php echo"$aksi?module=sparepart&act=delete&sid=$row[0]" ?>')">Delete</a>
             <?Php
	};
	?> </td>  
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
elseif($_GET[module]=="sparepartadd"){
	$query = mysql_query("select max(idsparepart) from sparepart");
 $hasil=mysql_fetch_row($query);
  if($hasil!=""){
    $id_barang=$hasil[0];
	}else {
	$id_barang=0;
	}
  $nilai =($id_barang);
  $nilai=$nilai+1;
?>
	<h2 class='left'>Add Sparepart</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form Sparepart
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=sparepart&act=input"?>" method="post" enctype="multipart/form-data">
                      <label>Part Package</label>
                      <input class="form-control" name="txtpack" id="txtpack" />
                      
                      <label>Description Pack</label>
                      <textarea class="form-control" name="txtdes" id="txtdes"></textarea>
                       <label>Total Estimasi Kerusakan</label>
                      <input class="form-control" name="txtker" id="txtker" />
                     
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                      
                      <button type="reset" class="btn btn-primary">Reset Button</button>

                  </form>
              </div>
    </div> 
<?php
}
elseif($_GET[module]=="sparedetail"){    
 $que = "select * from sparepart where idsparepart='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
?>     
<h2 class='left'>Part Detail</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=sparepart&act=inputdetail"?>" method="post" enctype="multipart/form-data">
                      <input name="id" id="id" value="<?php echo($row[0]); ?>" hidden="" />
                      <label> Part Package</label>
                      <input class="form-control" name="txtship" id="txtship" value="<?php echo($row[1]); ?>" disabled />
                     
                      <div class="form-group">
                      <label>Descriotion Package</label>
                            <textarea class="form-control" name="txthelp" id="txthelp" rows="3" disabled><?php echo($row[2]); ?></textarea>
                      </div>
                      <p>&nbsp;</p>
        <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th hidden="true">Detail ID</th>
                <th>Part No</th>
                <th>Part Decription</th>
                <th>Unit Price</th>
                <th>Action</th>
            </tr>
        </thead>
<tbody>
		<?php      
        $dque = "
        select * from d_sparepart where idsparepart = '$row[0]' order by iddetailsp ASC
	";
	$dresult=mysql_query($dque);
	$djumrows = mysql_num_rows($dresult);
		$iCnt=0;
		if ($djumrows>0) { 
			while ($drow = mysql_fetch_array($dresult)) {
        $iCnt++;
               
		?>
        
		  <tr <?php if ($iCnt%2==0) {?>class="odd gradeX" <?php } else {?>class="even gradeC"<?php }?> >
			<td hidden="true"><?php echo($drow[0]); ?></td>
            <td><?php echo($drow[2]); ?></td>
            <td><?php echo($drow[3]); ?></td>
            <td>Rp. <?php echo($drow[4]);
                ?>.-</td>
                      <?php
		if($_SESSION['leveluser']!='4' ){
			//runhor
	?>  
            <td><a href="#" onclick="hapusdata('<?php echo"$aksi?module=sparepart&act=deletedet&sid=$drow[0]&ids=$row[0]" ?>')">Delete</a></td>
            <?php }; ?>  
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
                        select SUM(unit_price) from d_sparepart where idsparepart = '$row[0]'
                    ";
                    $lastr = mysql_query($last);
                    $rlast = mysql_fetch_array($lastr);
              ?>
            <td colspan="6">Budget = Rp. <?php echo $rlast[0]; ?>,- </td>    
	</table>
          <?php
		if($_SESSION['leveluser']!='4' ){
			//runhor
	?>  
                  <p>
                    <label>Part No</label>
                    
                    <input class="form-control" name="txtpart" id="txtpart" />
                   
                  </p>
                   <p>
                    <label>Part Description </label>
                    
                    <textarea class="form-control" name="txtpartdes" id="txtpartdes" rows="3"></textarea>
                  </p>
                  <p>
                   <div class="control-group">
								<label class="control-label" for="appendedPrependedInput">Unit Price</label>
                    
                     <div class="input-prepend input-append">
									<span class="add-on">Rp</span>
                    <input class="form-control" name="txtunitp" id="txtunitp" /><span class="add-on">.00</span>
                   </div> <span id="pesan"></span>
                   </div>
                  </p>
                  
                  <p>&nbsp; </p>
                      <button type="submit" class="btn btn-default">Submit Detail</button>
                      
                      <button type="button" onclick="reback()" class="btn btn-primary">Return</button>
                      <?php };?>

                  </form>
              </div>
    </div>  





<?php
}
elseif($_GET[module]=="sparepartedit"){
  	$que = "select * from sparepart where idsparepart='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
?>
	<h2 class='left'>Edit Data</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=sparepart&act=edit"?>" method="post" enctype="multipart/form-data">
                      <label>Part Package</label>
                      <input hidden="" name="sid" id="sid" value="<?php echo($_GET[id]); ?>" />
                      <input class="form-control" name="txtpack" id="txtpack" value="<?php echo($row[1]); ?>" />
         
                      <label>Package Description</label>
                      <input class="form-control" name="txtdes" id="txtdes" value="<?php echo($row[2]); ?>" />
                      
                       <label>Estimasi Kerusakan</label>
                      <input class="form-control" name="txtker" id="txtker" value="<?php echo($row[3]); ?>" />
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                    
                      <button type="reset" class="btn btn-primary">Reset Button</button>
              </div>
  </div>
  </form>    
<?php
}
?>