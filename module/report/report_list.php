<?php session_start(); 
include "../../config/koneksi.php";
//$cmd=$_REQUEST['cmd'];
?>
<script language="javascript">
function laporan(lap) {
	nilai=lap;
	//alert(nilai);
	
	if (nilai=='BULANAN')
	{
	document.getElementById('harian').style.visibility="hidden"
	document.getElementById('bulanan').style.visibility="visible"
	document.getElementById('tahunan').style.visibility="visible"
	document.getElementById('btn_laporan').style.visibility="visible"
	}
	else if(nilai=='HARIAN')
	{
	document.getElementById('harian').style.visibility="visible"
	document.getElementById('bulanan').style.visibility="visible"
	document.getElementById('tahunan').style.visibility="visible"
	document.getElementById('btn_laporan').style.visibility="visible"
	}
	else
	{ 
	document.getElementById('harian').style.visibility="hidden"
	document.getElementById('bulanan').style.visibility="hidden"
	document.getElementById('tahunan').style.visibility="visible"
	document.getElementById('btn_laporan').style.visibility="visible"
	}
	
}

function openwindow(url,list,pilih,hari,bulan,tahun) {
urlgo=url+"?cmd="+list+"&pilih="+pilih+"&hari="+hari+"&bulan="+bulan+"&tahun="+tahun;
window.open(urlgo)
}
function openbarang(url,list,pilih,hari,bulan,tahun,barang) {
urlgo=url+"?cmd="+list+"&pilih="+pilih+"&hari="+hari+"&bulan="+bulan+"&tahun="+tahun+"&barang="+barang;
window.open(urlgo)
}

</script>


<?php
if($_GET[module] == "reportrunhour") {
?>
<form name="frm_data" method="post" action="#">

          <label style="width:80px">Select Report :</label>
          <select name="cbo_laporan" id="cbo_laporan" onChange="laporan(this.value)" class="styledate">
            <option value="PILIH LAPORAN" selected>Select Report</option>
			<option value="HARIAN">Daily</option>
            <option value="BULANAN">Monthly</option>
            <option value="TAHUNAN">Yearly</option>
          </select>
         		
		  <label style="visibility:hidden" id="harian">
		  Date
		  <select name="cbharian" id="cbharian" class="styledate">
		  <?php for($i=1;$i<=31;$i++) {?>
		  <option value="<?php echo($i); ?>"><?php echo($i); ?></option>
		  <?php }?>
	      </select>
		  </label>

          <label style="visibility:hidden" id="bulanan">
		  Month
          <select name="cbbulan" id="cbbulan" class="styledate">
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">Nopember</option>
            <option value="12">Desember</option>
          </select>
          </label>
          <label style="visibility:hidden" id="tahunan">
		  Years
          <select name="cbtahun" id="cbtahun" class="styledate">
            <?php $thn=date('Y'); for($i=2000;$i<=$thn;$i++) {?>
            <option value="<?php echo $i; ?>" <?php if(!(strcmp(trim($i), "$thn")))echo "selected";?>><?php echo $i; ?></option>
            <?php } ?>
          </select>
        </label>
        <label style="visibility:hidden" id="btn_laporan">
  <input type="button" name="button" value="Show" class="btn btn-primary" onclick="openwindow('module/report/report_runhour.php','cetak',cbo_laporan.value,cbharian.value,cbbulan.value,cbtahun.value);">
        </label>
<?php
}else if ($_GET[module]=="reportm"){
?>       
<form name="frm_data" method="post" action="#">

          <label style="width:80px">Select Report :</label>
          <select name="cbo_laporan" id="cbo_laporan" onChange="laporan(this.value)" class="styledate">
            <option value="PILIH LAPORAN" selected>Select Report</option>
			<option value="HARIAN">Daily</option>
            <option value="BULANAN">Monthly</option>
            <option value="TAHUNAN">Yearly</option>
          </select>
         		
		  <label style="visibility:hidden" id="harian">
		  Date
		  <select name="cbharian" id="cbharian" class="styledate">
		  <?php for($i=1;$i<=31;$i++) {?>
		  <option value="<?php echo($i); ?>"><?php echo($i); ?></option>
		  <?php }?>
	      </select>
		  </label>

          <label style="visibility:hidden" id="bulanan">
		  Month
          <select name="cbbulan" id="cbbulan" class="styledate">
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">Nopember</option>
            <option value="12">Desember</option>
          </select>
          </label>
          <label style="visibility:hidden" id="tahunan">
		  Years
          <select name="cbtahun" id="cbtahun" class="styledate">
            <?php $thn=date('Y'); for($i=2000;$i<=$thn;$i++) {?>
            <option value="<?php echo $i; ?>" <?php if(!(strcmp(trim($i), "$thn")))echo "selected";?>><?php echo $i; ?></option>
            <?php } ?>
          </select>
        </label>
        <label style="visibility:hidden" id="btn_laporan">
  <input type="button" name="button" value="Show" class="btn btn-primary" onclick="openwindow('module/report/report_maintenance.php','cetak',cbo_laporan.value,cbharian.value,cbbulan.value,cbtahun.value);">
        </label>

<?php
};
?>