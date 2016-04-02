<?php
function seo_title($s) {
    $c = array (' ');
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
$s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
$s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
return $s;
}

function pic_change($r) {
    $a = array (' ');
    $b = array ('-','/','\\',',','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
$r = str_replace($b, '', $r); // Hilangkan karakter yang telah disebutkan di array $b
$r = strtolower(str_replace($a, '-', $r)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
return $r;
}
?>
