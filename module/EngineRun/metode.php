<?php
// panggil file koneksi.php
include "../../config/koneksi.php";


// tangkap variabel kd_
$kd_met = $_POST['id'];

// query untuk menampilkan  kd_
$data = mysql_fetch_array(mysql_query("
select jamputar_mesin.id_jamputar, jamputar_mesin.jam_interval, d_jadwal_maintenance.id_detail_jadwal, sparepart.idsparepart, sparepart.est_kerusakan, d_sparepart.iddetailsp, sum(d_sparepart.unit_price) from jamputar_mesin inner join d_jadwal_maintenance on jamputar_mesin.id_jamputar=d_jadwal_maintenance.id_jamputar inner join sparepart on d_jadwal_maintenance.idsparepart=sparepart.idsparepart inner join d_sparepart on sparepart.idsparepart=d_sparepart.idsparepart where jamputar_mesin.id_jamputar=".$kd_met
));

// jika kd_mhs > 0 / form ubah data
if($kd_met> 0) { 
	$tp = $data[1];
	$cp = $data[6];
	$cf = $data[4];
	$xb=$cf+$cp;
	$x=$xb/$tp;

//form tambah data
} else {
echo "bad connection";
}

?>

<form class="form-horizontal" id="form-detrun">
  <div class="control-group">
    <label class="control-label" for="nim">(Cp) = Biaya Pergantian Pencegahan</label>
        
		 <div class="input-prepend input-append">
									&nbsp;&nbsp;<span class="add-on">Rp</span>
           <input class="form-control" name="txtcp" id="txtcp" value="<?php echo $cp ?>" disabled="disabled" /><span class="add-on">.00</span>
    </div>
  </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="nam">(Cf.Htp) = Biaya Kerusakan</label>
		 <div class="input-prepend input-append">
									<span class="add-on">Rp</span>
                    <input class="form-control" name="txtcf" id="txtcf"  value="<?php echo $cf ?>" disabled="disabled"/><span class="add-on">.00</span>
                   </div> <span id="pesan"></span>
                   </div>
        
	</div>
    
     <div class="control-group">
		<label class="control-label" for="nam">(tp) = Interval</label>
		<div class="controls">
			<input type="text" id="nuum" class="form-control" name="nuum" value="<?php echo $tp ?>" disabled="disabled">
          
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="nam">C(tp) =  Total Rata-Rata Ongkos Persatuan Waktu</label>
		<div class="input-prepend input-append">
									<span class="add-on">Rp</span>
           <input class="form-control" name="txtx" id="txtx" value="<?php echo $x ?>" disabled="disabled" /><span class="add-on">.00</span>
    </div>
	</div>
  
    <br />
           
        
         
</form>

<?php
// tutup koneksi ke database mysql

?>
