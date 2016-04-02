<?php
// class paging untuk halaman administrator
class Paging{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET[halaman])){
	$posisi=0;
	$_GET[halaman]=1;
}
else{
	$posisi = ($_GET[halaman]-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link halaman 1,2,3, ...
for ($i=1; $i<=$jmlhalaman; $i++){
  if ($i == $halaman_aktif){
    $link_halaman .= "<b><a href='#'>$i</a></b>";
  }
else{
  $link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a> ";
}
$link_halaman .= " ";
}
return $link_halaman;
}
}


// class paging untuk halaman berita (menampilkan semua berita) 
class Paging2{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET[halaman])){
	$posisi=0;
	$_GET[halaman]=1;
}
else{
	$posisi = ($_GET[halaman]-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman, $link){
	$link_halaman = "";
	
	// Link halaman 1,2,3, ...
	for ($i=1; $i<=$jmlhalaman; $i++){
		if ($i == $halaman_aktif){
			$link_halaman .= "<b><a href='#' style='color:#fff;background:#8c3521'>$i</a></b>";
		}else{
			$link_halaman .= "<a href=$link-$i.html>$i</a>  ";
		}
	$link_halaman .= " ";
	}
	return $link_halaman;
}
}


// class paging untuk halaman kategori (menampilkan semua kategori)
class Paging3{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET[halkategori])){
	$posisi=0;
	$_GET[halkategori]=1;
}
else{
	$posisi = ($_GET[halkategori]-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";
// Link halaman 1,2,3, ...
for ($i=1; $i<=$jmlhalaman; $i++){
  if ($i == $halaman_aktif){
    $link_halaman .= "<b>$i</b> | ";
  }
else{
  $link_halaman .= "<a href=halkategori-$_GET[id]-$i.html>$i</a> | ";
}
$link_halaman .= " ";
}
return $link_halaman;
}
}


// class paging untuk halaman hasil pencarian
class Paging7{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET[halpencarian])){
	$posisi=0;
	$_GET[halpencarian]=1;
}
else{
	$posisi = ($_GET[halpencarian]-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($ketemu2, $batas){
$jmlhalaman = ceil($ketemu2/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";
// Link halaman 1,2,3, ...
for ($i=1; $i<=$jmlhalaman; $i++){
  if ($i == $halaman_aktif){
    $link_halaman .= "<b>$i</b> | ";
  }
else{
  $link_halaman .= "<a href=halpencarian-$_POST[kata]-$i.html>$i</a> | ";
}
$link_halaman .= " ";
}
return $link_halaman;
}
}
?>
