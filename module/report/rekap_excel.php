<?php
 
// nama file
$namaFile = "report.xls";
 
// Fungsi penanda awal file (Begin Of File) Excel
function xlsBOF() {
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}
 
// Fungsi penanda akhir file (End Of File) Excel
function xlsEOF() {
echo pack("ss", 0x0A, 0x00);
return;
}
 
// Fungsi untuk menulis data (angka) ke cell excel
function xlsWriteNumber($Row, $Col, $Value) {
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
echo pack("d", $Value);
return;
}
 
// Fungsi untuk menulis data (text) ke cell excel
function xlsWriteLabel($Row, $Col, $Value ) {
$L = strlen($Value);
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
echo $Value;
return;
}
 
// header file excel 
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,
        pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
 
// header untuk nama file
header("Content-Disposition: attachment;
        filename=".$namaFile."");
 
header("Content-Transfer-Encoding: binary ");
 
// memanggil fungsi penanda awal file excel
xlsBOF();
 
// ------ membuat kolom pada excel --- //
 
// mengisi pada cell A1 (baris ke-0, kolom ke-0)
xlsWriteLabel(0,0,"ID");               
 
// mengisi pada cell A2 (baris ke-0, kolom ke-1)
xlsWriteLabel(0,1,"FACTORY NAMER");              
 
// mengisi pada cell A3 (baris ke-0, kolom ke-2)
xlsWriteLabel(0,2,"ENGINE");
 
// mengisi pada cell A4 (baris ke-0, kolom ke-3)
xlsWriteLabel(0,3,"DATE ENTRY");   
 
// mengisi pada cell A5 (baris ke-0, kolom ke-4)
xlsWriteLabel(0,4,"Estimates Completes Maintenance"); 

// mengisi pada cell A6 (baris ke-0, kolom ke-4)
xlsWriteLabel(0,5,"Description"); 

// mengisi pada cell A7 (baris ke-0, kolom ke-4)
xlsWriteLabel(0,6,"Part Package"); 

// mengisi pada cell A8 (baris ke-0, kolom ke-4)
xlsWriteLabel(0,7,"Total"); 
 
// -------- menampilkan data --------- //
 
// koneksi ke mysql 
session_start();
include "../../config/koneksi.php";
include "../../config/rp.php";
error_reporting(0);
// query menampilkan semua data 
$query = " select 
d_jadwal_maintenance.id_detail_jadwal,
d_jadwal_maintenance.tgl_mulai,
d_jadwal_maintenance.tgl_selesai,
d_jadwal_maintenance.deskripsi,
jamputar_mesin.id_jamputar,
t_komponen.id_komponen,
pabrik.id_pabrik,
pabrik.nama_pabrik,
master_mesin.id_mesin,
master_mesin.nama_mesin,
sparepart.idsparepart,
sparepart.part_package
from d_jadwal_maintenance inner join jamputar_mesin on jamputar_mesin.id_jamputar=d_jadwal_maintenance.id_jamputar
inner join t_komponen on jamputar_mesin.id_komponen=t_komponen.id_komponen
inner join pabrik on t_komponen.id_pabrik=pabrik.id_pabrik
inner join master_mesin on t_komponen.id_mesin=master_mesin.id_mesin
inner join sparepart on d_jadwal_maintenance.idsparepart=sparepart.idsparepart";
$hasil = mysql_query($query);
 
// nilai awal untuk baris cell
$noBarisCell = 1;
 
// nilai awal untuk nomor urut data
$noData = 1;
 
while ($data = mysql_fetch_array($hasil))
{
	 $subtotal = 0;
   // menampilkan no. urut data
   xlsWriteNumber($noBarisCell,0,$noData);
 
   // menampilkan data nim
   xlsWriteLabel($noBarisCell,1,$data['0']);
 
   // menampilkan data nama mahasiswa
   xlsWriteLabel($noBarisCell,2,$data['7']);
 
   // menampilkan data nilai
   xlsWriteNumber($noBarisCell,3,$data['9']);
   
   // menampilkan data nilai
   $tanggals = $data[1];
			$tanggalbarus = date('D, j-M-Y', strtotime($tanggals ));
   xlsWriteNumber($noBarisCell,4,$tanggalbarus);
   
   // menampilkan data nilai
   $tanggals1 = $data[2];
			$tanggalbarus1 = date('D, j-M-Y', strtotime($tanggals1 ));
   xlsWriteNumber($noBarisCell,5,$tanggalbarus1);
   
    // menampilkan data nilai
   xlsWriteNumber($noBarisCell,6,$data['3']);
   
    // menampilkan data nilai
   xlsWriteNumber($noBarisCell,7,$data['11']);
 
   // menentukan status total
   
    $qd=mysql_query("select sum(unit_price) from d_sparepart where idsparepart = '$data[10]' order by iddetailsp ASC");
   while ($rd=mysql_fetch_array($qd)){
	$total = ($rd[0]);
	$grand_total = $grand_total + $total;
	$subtotal = $subtotal + $total;
	$totalall = $totalall + $total;
	$total_rp = format_rupiah($total);
	$grand_total_rp = format_rupiah($grand_total);
	} 
 
   // menampilkan status kelulusan
   xlsWriteLabel($noBarisCell,8,$total_rp);
 
   // increment untuk no. baris cell dan no. urut data
   $noBarisCell++;
   $noData++;
}
 
// memanggil fungsi penanda akhir file excel
xlsEOF();
exit(); 
?>
