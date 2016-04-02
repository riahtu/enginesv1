<?php
class Database {
	// properti
	private $dbHost="localhost";
	private $dbUser="root";
	private $dbPass="";
	private $dbName="angsuran";
	
	// method koneksi mysql
	function connectMySQL() {
		mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
		mysql_select_db($this->dbName) or die ("Database Tidak Ditemukan di Server"); 
	}
}

class User {
// Proses Login
	function cek_login($user, $password) {
		$password = md5($password);
		$result = mysql_query("SELECT * FROM admin WHERE user='$user' AND password='$password'");
		$user_data = mysql_fetch_array($result);
		$no_rows = mysql_num_rows($result);
		if ($no_rows == 1) {
			$_SESSION['login'] = TRUE;
			$_SESSION['id'] = $user_data['id'];
			return TRUE;
		}
		else {
		  return FALSE;
		}
	}
	
	// Ambil Sesi 
	function get_sesi() {
		return $_SESSION['login'];
	}
	
	// Logout 
	function user_logout() {
		$_SESSION['login'] = FALSE;
		session_destroy();
	}
}	

class Nasabah {
	// method tampil data nasabah	
	function tampilNasabahSemua() {
		$query = mysql_query("SELECT * FROM nasabah ORDER BY id");
		while($row=mysql_fetch_array($query))
		  $data[]=$row;
	    return $data;
	}
	
	// method filter data nasabah
	function tampilNasabahFilter($keyword) {
		$query = mysql_query("SELECT * FROM nasabah WHERE nama LIKE '%$keyword%'");
		$no_rows = mysql_num_rows($query);
		if ($no_rows == 1) {
		  while($row=mysql_fetch_array($query)) {
		    $data[]=$row;
		    return $data;
	  	}
		}
	}
	
	// method mengambil data nasabah 
	function bacaDataNasabah($field, $id_nsb) {
		$query = mysql_query("SELECT * FROM nasabah WHERE id = '$id_nsb'");
		$data=mysql_fetch_array($query);
	  if ($field == 'id') return $data['id'];
		else if ($field == 'nama') return $data['nama'];
		else if ($field == 'ktp') return $data['ktp'];
		else if ($field == 'tmpt_lahir') return $data['tmpt_lahir'];
		else if ($field == 'tgl') return $data['tgl_lahir'];
		else if ($field == 'alamat') return $data['alamat'];
		else if ($field == 'telpon') return $data['telpon'];
		else if ($field == 'email') return $data['email'];
	}
	
	// method untuk proses update data nasabah
	function updateDataNasabah($id_nsb, $nama, $ktp, $tmpt_lahir, $tgl, $alamat, $telpon, $email) {
		$query = mysql_query("UPDATE nasabah SET
				  nama = '$nama', ktp = '$ktp', tmpt_lahir = '$tmpt_lahir', tgl_lahir = '$tgl', 
				  alamat = '$alamat', telpon = '$telpon', email = '$email'
				  WHERE id = '$id_nsb'");
		echo "Data Nasabah sudah di update";	
	}
	
	// method menghapus data nasabah
	function hapusNasabah($id_nsb) {
		$query = mysql_query("DELETE FROM nasabah WHERE id = '$id_nsb'");
		echo "Data Nasabah ID ".$id_nsb." sudah di hapus";
	}
	
	// method untuk proses tambah data nasabah
	function tambahDataNasabah($id_nsb, $nama, $ktp, $tmpt_lahir, $tgl, $alamat, $telpon, $email) {
		$query = "INSERT INTO nasabah (id, nama, ktp, tmpt_lahir, tgl_lahir, alamat, telpon, email)
		          VALUES ('$id_nsb', '$nama', '$ktp', '$tmpt_lahir', '$tgl', '$alamat', '$telpon', '$email')";
		$hasil = mysql_query($query);
	}
}

class pokokPinjaman 
{
	// method tampil data pokok pinjaman	
	function tampilPokok()
	{
		$query = mysql_query("SELECT * FROM pokok order by pokok asc");
		while($row=mysql_fetch_array($query))
		$data[]=$row;
	    return $data;
	}
	
	// method mengambil data pokok pinjaman
	function bacaDataPokok($field, $id_pokok)
	{
		$query = mysql_query("SELECT * FROM pokok where id = '$id_pokok'");
		$data=mysql_fetch_array($query);
	    if ($field == 'id') return $data['id'];
		else if ($field == 'pokok') return $data['pokok'];
	}

	// method untuk proses update data pokok pinjaman
	function updateDataPokok($id_pokok, $pokok)
	{
		$query = mysql_query("UPDATE pokok SET
				  pokok = '$pokok' WHERE id = '$id_pokok'");
		echo "Data pokok pinjaman sudah diupdate";	
	}
	
	// method menghapus data pokok pinjaman
	function hapusPokok($id_pokok)
	{
		$query = "DELETE FROM pokok WHERE id = '$id_pokok'";
		mysql_query($query);
		echo "Data Pokok Pinjaman ID ".$id_pokok." sudah dihapus";
	}
	
	// method untuk proses tambah data pokok pinjaman
	function tambahDataPokok($pokok)
	{
		$query = "INSERT INTO pokok (pokok) VALUES ('$pokok')";
		$hasil = mysql_query($query);
	}
}

class lamaPinjaman
{
	// method tampil data lama pinjaman	
	function tampilLama()
	{
		$query = mysql_query("SELECT * FROM lama order by lama asc");
		while($row=mysql_fetch_array($query))
		$data[]=$row;
	    return $data;
	}
	
	// method mengambil data lama pinjaman
	function bacaDataLama($field, $id_lama)
	{
		$query = mysql_query("SELECT * FROM lama where id = '$id_lama'");
		$data=mysql_fetch_array($query);
	    if ($field == 'id') return $data['id'];
		else if ($field == 'lama') return $data['lama'];
	}

	// method untuk proses update data lama pinjaman
	function updateDataLama($id_lama, $lama)
	{
		$query = mysql_query("UPDATE lama SET
				  lama = '$lama' WHERE id = '$id_lama'");
		echo "Data lama pinjaman sudah diupdate";	
	}
	
	// method menghapus data lama pinjaman
	function hapusLama($id_lama)
	{
		$query = "DELETE FROM lama WHERE id = '$id_lama'";
		mysql_query($query);
		echo "Data Lama Pinjaman ID ".$id_lama." sudah dihapus";
	}
	
	// method untuk proses tambah data pokok pinjaman
	function tambahDataLama($lama)
	{
		$query = "INSERT INTO lama (lama) VALUES ('$lama')";
		$hasil = mysql_query($query);
	}
}

class Pinjaman
{
	//method tampil data peminjaman
	function tampilPinjaman()
	{
		$query = mysql_query("select * from pinjaman where status='belum' order by no desc");
		while($row=mysql_fetch_array($query))
		$data[]=$row;
	    return $data;
	}
	
	//method ambil nama nasabah
	function ambilNama($id_nsb)
	{
		$query = mysql_query("SELECT * FROM nasabah WHERE id='$id_nsb'");
		$row = mysql_fetch_array($query);
		echo $row['nama'];
	}
	
	//method seting jatuh tempo
	function jatuhTempo($id_nsb)
	{
		$query = mysql_query("SELECT tgl FROM pinjaman WHERE id='$id_nsb'");
		$row=mysql_fetch_array($query);
		$tempo=substr($row['tgl'],8,2);
		echo $tempo;
	}
	
	//method tampil combo nama nasabah
	function comboNama()
	{
		$query = mysql_query("SELECT id, nama FROM nasabah");
		while($row=mysql_fetch_array($query))
		$data[]=$row;
	    return $data;
	}
	
	//method tampil combo nama nasabah
	function comboPokok()
	{
		$query = mysql_query("SELECT * FROM pokok order by pokok asc");
		while($row=mysql_fetch_array($query))
		$data[]=$row;
	    return $data;
	}
	
	//method tampil combo lama pinjaman
	function comboLama()
	{
		$query = mysql_query("SELECT * FROM lama order by lama asc");
		while($row=mysql_fetch_array($query))
		$data[]=$row;
	    return $data;
	}
	
	//method menghitung angsuran
	function hitungAngsuran($lama,$pokok,$bunga)
	{
		$tahun=$lama/12;
		$angsur=ceil(($pokok+($pokok*($bunga/100)*$tahun))/$lama);
		return $angsur;
	}
	
	//method simpan data pinjaman
	function simpanPinjaman($no, $tgl, $pokok, $lama, $bunga, $angsur, $id)
	{
		$query=mysql_query("SELECT * FROM pinjaman WHERE id='$id' AND status='belum'");
		if(mysql_num_rows($query)<=0)
			{
				$qry_simpan="insert into pinjaman(no, tgl, pokok, lama, bunga, angsuran, id) 
        values('$no','$tgl','$pokok','$lama','$bunga','$angsur','$id')";
				$hasil = mysql_query($qry_simpan);
			}
		else 
			{
				?><script language="javascript">
			alert("Nasabah Ini belum melunasi pinjaman !!");
    		location = "?page=pinjaman_mgr";
   			 </script><?php
			}
	}
	
	//method mencari nomor pinjam
	function tampilPinjamanFilter($nomor)
	{
		$query = mysql_query("SELECT * FROM pinjaman where no='$nomor'");
		$no_rows = mysql_num_rows($query);
		if ($no_rows == 1)
		{
		while($row=mysql_fetch_array($query))
		{
		$data[]=$row;
		return $data;
	  	}
		}
	}
	
	// method menghapus data pinjaman
	function hapusPinjaman($nopim)
	{
		$qry_pinjam = "DELETE FROM pinjaman WHERE no = '$nopim'";
		mysql_query($qry_pinjam);
		
		$qry_angsur = "DELETE FROM angsuran WHERE no = '$nopim'";
		mysql_query($qry_angsur);
		
		echo "Data Pinjaman ID ".$nopim." sudah dihapus";
	}
}

class Angsuran
{
	//method tampil data peminjaman Angsuran
	function tampilPinjamAngsur($field, $nopim)
	{
		$query = mysql_query("SELECT * FROM pinjaman WHERE no='$nopim'");
		$data=mysql_fetch_array($query);
	    if ($field == 'nopim') return $data['no'];
		else if ($field == 'tgl') return $data['tgl'];
		else if ($field == 'pokok') return $data['pokok'];
		else if ($field == 'lama') return $data['lama'];
		else if ($field == 'bunga') return $data['bunga'];
		else if ($field == 'angsuran') return $data['angsuran'];
		else if ($field == 'id') return $data['id'];
	}
	
	//method tampil data nasabah peminjam
	function tampilPinjamNasabah($field, $id_nsb)
	{
		$query = mysql_query("SELECT id, nama, alamat from nasabah where id='$id_nsb'");
		$data=mysql_fetch_array($query);
	  if ($field == 'id') return $data['id'];
		else if ($field == 'nama') return $data['nama'];
		else if ($field == 'alamat') return $data['alamat'];
	}
	
	//method mencari angsuran keberapa
	function cariAngsuran($nopim)
	{
		$query=mysql_query("SELECT * FROM angsuran WHERE no ='$nopim' AND ags_ke=(SELECT MAX(ags_ke) from angsuran WHERE no ='$nopim')");
		if(mysql_num_rows($query)>0)
		{
			//jika sudah pernah mebayar angsuran, maka angsuran ditambah 1
			$data=mysql_fetch_array($query);
			$ags_ke = $data['ags_ke']+1;
			return $ags_ke;
		}else {
			//jika belum pernah membayar angsuran, maka seting menjadi angsuran pertama
			$ags_ke = 1;
			return $ags_ke;
		}
	}
	
	//method cari sisa angsuran
	function cariSisaAngsur($lama,$angsur_ke)
	{
		$sisa_ags = $lama - $angsur_ke;
		return $sisa_ags;
	}
	
	//method cek apakah nasabah terkena denda dan set tgl jatuh tempo
	function cekDenda($angsur_ke,$tempo_bln,$tempo_tgl,$tempo_thn,$angsuran)
	{
		if ($angsur_ke>1)
		{
			$tanggal_tempo = mktime(0,0,0, $tempo_bln+$angsur_ke, $tempo_tgl, $tempo_thn);
			$tanggal_bayar = mktime(0,0,0, date("m"), date("d"), date("Y"));
		}else{
			$tanggal_tempo = mktime(0,0,0, $tempo_bln+1, $tempo_tgl, $tempo_thn);
			$tanggal_bayar = mktime(0,0,0, date("m"), date("d"), date("Y"));
		}
			$tglp_tempo=date("d-m-Y", $tanggal_tempo);
			$denda = round(($tanggal_bayar-$tanggal_tempo)/(60*60*24));
			
			if ($denda>0)
			{	
				$haridenda = $denda ;
				$jml_denda = ceil(1/100 *$angsuran*$denda);
				} else {
				$haridenda = 0 ;
				$jml_denda = 0;
			}
			
			//buat array untuk menghasilkan return value lebih dari satu
			$hasil = array($tglp_tempo,$haridenda,$jml_denda);
 			return $hasil;
	}	
	
	//method hitung denda dan total pembayaran 
	function hitungTotal($angsuran,$jml_denda)
	{
		//hitung total pembayaran
		$tobay = $angsuran + $jml_denda ; 
 		return $tobay;
	}
	
	//method simpan data angsuran 
	function simpanAngsuran($tgl,$tgl_tempo, $ags_ke, $telat, $denda, $no, $id_nsb)
	{
		$query="insert into angsuran(tgl,tgl_tempo,ags_ke, telat, denda, no, id_nasabah) 
		values('$tgl','$tgl_tempo', '$ags_ke', '$telat', '$denda', '$no', '$id_nsb')";
		$hasil=mysql_query($query);
	}
	
	//method update status data angsuran menjadi lunas jika angsuran sudah selesai
	function updateAngsuran($nopim)
	{
		$qry_update=mysql_query("UPDATE pinjaman set status='lunas' WHERE no='$nopim'");
		?>
		<script language="javascript">
			alert("Angsuran Sudah dilunasi !!");
    		location = "?page=pinjaman_mgr";
   			 </script>
		<?php 
	} 
	
	//tampil data per nasabah lewat method tampilPerNasabah()
	function tampilPerNasabah($nopim)
	{
		$query = mysql_query("select * from angsuran where no='$nopim' order by no_ang asc");
		while($row=mysql_fetch_array($query))
		$data[]=$row;
	    return $data;
	}

}
