<?php
// panggil file koneksi.php
include "../../config/koneksi.php";


// tangkap variabel kd_mhs
$kd_sp = $_POST['id'];

// query untuk menampilkan  kd_mhs
$data = mysql_fetch_array(mysql_query("
select sparepart.idsparepart, sparepart.part_package from sparepart where idsparepart=".$kd_sp
));

// jika kd_mhs > 0 / form ubah data
if($kd_sp> 0) { 
	$idim = $data[0];
	$prt = $data[1];
	

//form tambah data
} else {

}

?>
<form class="form-horizontal" id="form-detrun">
	<div class="control-group">
		<label class="control-label" for="nim">ID</label>
        
		<div class="controls">
			<input type="text" id="nim" class="form-control" name="nim" value="<?php echo $idim ?>" readonly="readonly">
          
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="nam">PART PACKAGE</label>
		<div class="controls">
			<input type="text" id="nam" class="form-control" name="nam" value="<?php echo $prt ?>" readonly="readonly">
          
		</div>
        
	</div>
    
  
    <br />
    <div class="panel panel-default">
      <div class="panel-heading">
                        </div>
     <div class="panel-body">  
    <div class="table-responsive">
	 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>Detail ID</th>
                <th>Part No</th>
                <th>Part Decription</th>
                <th>Unit Price</th>
                
            </tr>
        </thead>
        <tbody>
		<?php
        $dque = "
        select * from d_sparepart n where idsparepart = '$kd_sp' order by iddetailsp ASC
	";
	$dresult=mysql_query($dque);
	$djumrows = mysql_num_rows($dresult);
		$iCnt=0;
		if ($djumrows>0) { 
			while ($drow = mysql_fetch_array($dresult)) {
        $iCnt++;
               
		?>
        
		  <tr <?php if ($iCnt%2==0) {?>class="odd gradeX" <?php } else {?>class="even gradeC"<?php }?> >
			<td><?php echo($drow[0]); ?></td>
            <td><?php echo($drow[2]); ?></td>
            <td><?php echo($drow[3]); ?></td>
            <td>Rp. <?php echo($drow[4]);
                ?>.-</td>
           
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
                        select SUM(unit_price) from d_sparepart where idsparepart = '$kd_sp'
                    ";
                    $lastr = mysql_query($last);
                    $rlast = mysql_fetch_array($lastr);
              ?>
            <td colspan="6">Budget = Rp. <?php echo $rlast[0]; ?>,- </td>    
	</table>
                  <p>    
	</table>    
    </div>
    </div>
    </div>
</form>

<?php
// tutup koneksi ke database mysql

?>
