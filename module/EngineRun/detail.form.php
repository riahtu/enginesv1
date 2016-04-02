<?php
// panggil file koneksi.php
include "../../config/koneksi.php";


// tangkap variabel kd_mhs
$kd_mhs = $_POST['id'];

// query untuk menampilkan  kd_mhs
$data = mysql_fetch_array(mysql_query("
select jamputar_mesin.id_jamputar, t_komponen.id_komponen, pabrik.nama_pabrik, jamputar_mesin.jam_interval 
from jamputar_mesin inner join t_komponen on jamputar_mesin.id_komponen=t_komponen.id_komponen
 inner join pabrik on t_komponen.id_pabrik=pabrik.id_pabrik  where ID_JAMPUTAR=".$kd_mhs
));

// jika kd_mhs > 0 / form ubah data
if($kd_mhs> 0) { 
	$nim = $data[0];
	$nam = $data[2];
	$wew = $data[3];

//form tambah data
} else {

}

?>
<form class="form-horizontal" id="form-detrun">
	<div class="control-group">
		<label class="control-label" for="nim">ID</label>
        
		<div class="controls">
			<input type="text" id="nim" class="form-control" name="nim" value="<?php echo $nim ?>" readonly="readonly">
          
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="nam">FACTORY NAME</label>
		<div class="controls">
			<input type="text" id="nam" class="form-control" name="nam" value="<?php echo $nam ?>" readonly="readonly">
          
		</div>
        
	</div>
    
    <div class="control-group">
		<label class="control-label" for="nam"> INTERVAL</label>
		<div class="controls">
			<input type="text" id="wew" class="form-control" name="wew" value="<?php echo $wew ?>" readonly="readonly">
          
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
                <th hidden="true">Detail ID</th>
                <th>Value</th>
                <th>Date Entry</th>
                <th>Estimated Maintenance Date</th>
                
            </tr>
        </thead>
        <tbody>
		<?php
        $dque = "
        select * from d_jamputar_mesin where ID_JAMPUTAR = '$kd_mhs' order by ID_DETAIL_JAMPUTAR ASC
	";
	$dresult=mysql_query($dque);
	$djumrows = mysql_num_rows($dresult);
		$iCnt=0;
		if ($djumrows>0) { 
			while ($drow = mysql_fetch_array($dresult)) {
        $iCnt++;
		 $fint = ceil($fint + $drow[2]);
                $lint = ceil($data[3] - $fint);
		?>
        
		  <tr <?php if ($iCnt%2==0) {?>class="odd gradeX" <?php } else {?>class="even gradeC"<?php }?> >
			<td hidden="true"><?php echo($drow[0]); ?></td>
            <td><?php echo($drow[2]); ?></td>
            <td><?php echo($drow[3]); ?></td>
            <td><?php 
               $estim = ceil($lint / $drow[2] ); 
                
                echo date('Y-m-d', strtotime("+".$estim." days"));
                ?></td>
           
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
                        select SUM(NILAI_AWAL) from d_jamputar_mesin where ID_JAMPUTAR = '$nim'
                    ";
                    $lastr = mysql_query($last);
                    $rlast = mysql_fetch_array($lastr);
              ?>
          <td colspan="6">Total Run Hour = <?php echo $rlast[0]; ?> </td>    
	</table>    
    </div>
    </div>
    </div>
</form>

<?php
// tutup koneksi ke database mysql

?>
