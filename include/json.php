<?php include "../config/koneksi.php";?>
<?php
// write your SQL query here (you may use parameters from $_GET or $_POST if you need them)
$query = mysql_query('select jamputar_mesin.id_jamputar,
        t_komponen.id_komponen,
        pabrik.id_pabrik,
        pabrik.nama_pabrik,
		master_mesin.id_mesin,
		master_mesin.nama_mesin
         from jamputar_mesin inner join t_komponen on jamputar_mesin.id_komponen=t_komponen.id_komponen
         inner join pabrik on t_komponen.id_pabrik=pabrik.id_pabrik
		 inner join master_mesin on t_komponen.id_mesin=master_mesin.id_mesin');


$table = array();
$table['cols'] = array(
/* Disini kita mendefinisikan data pada tabel database
* masing-masing kolom akan kita ubah menjadi array
* Kolom tersebut adalah parameter (string) dan nilai (integer/number)
* Pada bagian ini kita juga memberi penamaan pada hasil chart nanti
*/
array('label' => 'parameter', 'type' => 'string'),
array('label' => 'nilai', 'type' => 'number')
);
// melakukan query yang akan menampilkan array data
$rows = array();
while($r = mysql_fetch_array($query)) {
$temp = array();
// masing-masing kolom kita masukkan sebagai array sementara
$temp[] = array('v' =>$r[5]);
$query2 = mysql_query("select sum(nilai_awal) from d_jamputar_mesin where id_jamputar = '$r[0]'");
while($rd = mysql_fetch_array($query2)){
$temp[] = array('v' => (int) $rd[0]);
$rows[] = array('c' => $temp);
	}

}
 
// mempopulasi row tabel
$table['rows'] = $rows;
// encode tabel ke bentuk json
$jsonTable = json_encode($table);
 
// set up header untuk JSON, wajib.
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
 
// menampilkan data hasil query ke bentuk json
echo $jsonTable;
?>
