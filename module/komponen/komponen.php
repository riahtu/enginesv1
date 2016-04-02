<script>
function hapusdata(urltujuan){
		el=$(this);
		if(confirm("Do you want to delete this data ?."))
		{
            alert("Data Deleted!");
            
            window.location = (urltujuan);
        }
        else{
            alert("Failure to Delete");
        }
}
</script>
 <script type="text/javascript">
      $(document).ready(function() {
        // ketika input usia di isi, eksekusi bagian ini.
	      $("#txtid").keypress(function (data)
		 
	      { 
	         // kalau data bukan berupa angka, tampilkan pesan error
	         if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
	         {
		          $("#pesan").html("Isikan Angka").show().fadeOut("slow"); 
	            return false;
           }	
	      });
      });
    </script>            
<?php
$aksi="module/komponen/aksi_komponen.php";

  // Tampil komponen
  if($_GET[module] == "komponen"){
    $que = "select t_komponen.id_komponen, master_mesin.nama_mesin, pabrik.nama_pabrik, t_komponen.tgl_entry_mesin from t_komponen inner join pabrik on t_komponen.id_pabrik=pabrik.id_pabrik inner join master_mesin on t_komponen.id_mesin=master_mesin.id_mesin  where master_mesin.blokir='N'";
	$result=mysql_query($que);
	$jumrows = mysql_num_rows($result);
?>
	<h2 class='left'>Engine Run Component</h2>
    <a href="componen-add.html" class="btn btn-primary btn-lg">ADD Component</a>
    <p>&nbsp;</p>
<table class="table table-striped table-bordered bootstrap-datatable datatable" >
        <thead>
            <tr>
                <th>Component ID</th>
                <th>Engine Name</th>
                <th>Factory Name</th>
                <th>Date Entry</th>
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
            
            <td><a href="<?php echo("componen-edit-$row[0].html")?>">Edit</a> || <a href="#" onclick="hapusdata('<?php echo"$aksi?module=komponen&act=delete&sid=$row[0]" ?>')">Delete</a></td>  
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
elseif($_GET[module]=="komponenadd"){

 $query = "SELECT max(id_komponen) as maxKode FROM t_komponen";
   $hasil = mysql_query($query); 
  $data = mysql_fetch_array($hasil); 
  $kodeBarang = $data['maxKode']; 
   $noUrut = (int) substr($kodeBarang, 1, 4); 
   $noUrut++; 
   $char="C";
    $newID = $char . sprintf("%04s", $noUrut);


?>
	<h2 class='left'>Add Component</h2>
  <div class="panel panel-default">
        
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=komponen&act=input"?>" method="post" enctype="multipart/form-data">
                      <label>Component ID</label>
                      <input class="form-control" name="txtid" id="txtid" value="<?php echo($newID); ?>" readonly="readonly" />
                      <span id="pesan"></span>
                       
                      <div class="form-group">
                        <label>Engine's Name</label>
                            <select class="form-control" name="txtengname" id="txttype">
                            <?php $tampil=mysql_query("SELECT * FROM master_mesin where blokir='N'");
                            while($r=mysql_fetch_array($tampil)){
                              echo "<option value=$r[0]>$r[1]</option>";
                            } ?>
                            </select>
                      </div>
                      
                                   <div class="form-group">
                        <label>Factory Name</label>
                            <select class="form-control" name="txtfacname" id="txttype">
                            <?php $tampil=mysql_query("SELECT * FROM pabrik");
                            while($r=mysql_fetch_array($tampil)){
                              echo "<option value=$r[0]>$r[1]</option>";
                            } ?>
                            </select>
                      </div>
                      
                      <p>
                                     <label>Date Entry</label>
                          <input class="form-control" type="date" name="txtdate" id="txtdate" />
                    </p>
                      <p>&nbsp; </p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                      
                      <button type="reset" class="btn btn-primary">Reset Button</button>

                  </form>
              </div>
    </div>  
<?php
}
elseif($_GET[module]=="komponenedit"){
  	$que = "select * from t_komponen where ID_KOMPONEN='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
?>
	<h2 class='left'>Edit Data</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=komponen&act=edit"?>" method="post" enctype="multipart/form-data">
                      <label>Ship ID</label>
                      <input hidden="" name="sid" id="sid" value="<?php echo($_GET[id]); ?>" />
                      <input class="form-control" name="txtid" id="txtid" value="<?php echo($_GET[id]); ?>" />
                      
                      <div class="form-group">
                        <label>Engine's Name</label>
                            <select class="form-control" name="txtengname" id="txtengname">
                            <?php $tampil=mysql_query("SELECT * FROM master_mesin where BLOKIR='N'");
					while($r=mysql_fetch_array($tampil)){?>
					<option value=<?php echo $r[0];?> <?php if (!(strcmp($r[0], $row[2]))) {echo "selected=\"selected\"";} ?>><?php echo $r['NAMA_MESIN'] ?></option>
                                <?php } ?>
                            </select>
                      </div>
                      
                     <div class="form-group">
                        <label>Ship Name</label>
                            <select class="form-control" name="txtfacname" id="txtfacname">
                            <?php $tampil=mysql_query("SELECT * FROM pabrik");
					while($r=mysql_fetch_array($tampil)){?>
					<option value=<?php echo $r[0];?> <?php if (!(strcmp($r[0], $row[2]))) {echo "selected=\"selected\"";} ?>><?php echo $r['NAMA_PABRIK'] ?></option>
                                <?php } ?>
                            </select>
                      </div>
                      
                      <label>Date Entry</label>
                      <input class="form-control" type="date" name="txtdate" id="txtdate" value="<?php echo($row[3]); ?>" />
                      
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-default">Submit Button</button>
                    
                      <button type="reset" class="btn btn-primary">Reset Button</button>
              </div>
  </div>    
<?php
}
?>