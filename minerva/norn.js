function setVisible(obj, bool){
		if(typeof obj == "string") obj = document.getElementById(obj);
		
		if(bool == false){
			if(obj.style.visibility != 'hidden');
				obj.style.visibility = 'hidden';
			} else {
			if(obj.style.visibility != 'visible');
			obj.style.visibility = 'visible';
		}
	}	
	function gohide(idhide){
		setVisible(idhide,false);
		setTimeout(function(){ setVisible(idhide, true) }, 3000);
	}
//fungsi untuk kirim data
function transferdata(urlasal,proses,urltujuan,list){
gohide('hiddendiv');	
var prosesdata = urlasal+"?cmd="+proses;
var hasildata = urltujuan+"?cmd="+list;
//alert (prosesdata);
//alert (hasildata);
		$.ajax({
			type: 'POST',
			url: prosesdata,
			data: $('#my_form').serialize(),
			dataType: 'json',
			success: function(response) {
			if(response.status == 1) {
	                  alert("Data Berhasil Tersimpan !");
	                  $("#content").load(hasildata);
	             }
				 else{
						alert("Terdapat Error data gagal disimpan !");
					}
			}
		})
		return false;
};

//fungsi untuk kirim data detail atau unik
function transferdatadetail(urlasal,proses,urltujuan,list){
gohide('hiddendiv');	
var prosesdata = urlasal+"?cmd="+proses;
var hasildata = urltujuan+"?cmd="+list;
		$.ajax({
			type: 'POST',
			url: prosesdata,
			data: $('#new_form').serialize(),
			dataType: 'json',
			success: function(response) {
			if(response.status == 1) {
	                  alert("Data Berhasil Tersimpan !");
	                  $("#detail_content").load(hasildata);
	             }	
				 else{
						alert("Terdapat Error data gagal disimpan !");
					}
			}
		})
		return false;
};
// thickbok
function transferdatabrowse(urlasal,proses,urltujuan,list){
var prosesdata = urlasal+"?cmd="+proses;
var hasildata = urltujuan+"?cmd="+list;
		$.ajax({
			type: 'POST',
			url: prosesdata,
			data: $('#thickbox_form').serialize(),
			dataType: 'json',
			success: function(response) {
			if(response.status == 1) {
			showthickbox(urltujuan,list)
	             }	
				 	else{
						alert("Terdapat Error data gagal disimpan !");
					}
			}
		})
		return false;
};

function hapusdata(urlasal,proses,urltujuan,id){
var prosesdata = urlasal+"?cmd="+proses+"&id="+id;
var hasildata = urltujuan;
		el=$(this);
		if(confirm("Apakah benar akan menghapus data ini ?."))
		{
			$.ajax({
				url: prosesdata, 			
				type:"GET",
				dataType: 'json', //respon yang diminta dalam format JSON
				success:function(response){
			if(response.status == 1){
            alert("Data berhasil di hapus!");
			$("#content").load(hasildata);
					}
					else{
						alert("data gagal di hapus!");
					}
				}
			});
		}
		return false;
	};
//blokir data	
function blokirdata(urlasal,proses,urltujuan,id){
var prosesdata = urlasal+"?cmd="+proses+"&id="+id;
var hasildata = urltujuan;
		el=$(this);
		if(confirm("Apakah benar akan memblokir data ini ?."))
		{
			$.ajax({
				url: prosesdata, 			
				type:"GET",
				dataType: 'json',
				success:function(response){
			if(response.status == 1){
            alert("Data berhasil di blokir!");
			$("#content").load(hasildata);
					}
					else{
						alert("data gagal di blokir!");
					}
				}
			});
		}
		return false;
	};
	
function hapusdatadetail(urlasal,proses,urltujuan){
var prosesdata = urlasal+"?cmd="+proses;
var hasildata = urltujuan;
		el=$(this);
		if(confirm("Apakah benar akan menghapus data ini ?."))
		{
			$.ajax({
				url: prosesdata, 			
				type:"GET",
				dataType: 'json', //respon yang diminta dalam format JSON
				success:function(response){
			if(response.status == 1){
            alert("Data berhasil di hapus!");
			$("#detail_content").load(hasildata);
					}
					else{
						alert("data gagal di hapus!");
					}
				}
			});
		}
		return false;
	};

//buat thickbox
function setValue(theData,pID,pName) {
		 document.getElementById(pName).value = pID;
$().colorbox.close();
}

//buat laporan
var nilai 
function laporan(lap) {
	nilai=lap
	//alert(nilai);
	
	if (nilai=='BULANAN')
	{
	document.getElementById('harian2').style.visibility="hidden"
	document.getElementById('harian').style.visibility="hidden"
	document.getElementById('bulanan').style.visibility="visible"
	document.getElementById('triwulan').style.visibility="hidden"
	document.getElementById('tahunan').style.visibility="visible"
	document.getElementById('btn_laporan').style.visibility="visible"
	}
	else if(nilai=='HARIAN')
	{
	document.getElementById('harian2').style.visibility="hidden"
	document.getElementById('harian').style.visibility="visible"
	document.getElementById('bulanan').style.visibility="visible"
	document.getElementById('triwulan').style.visibility="hidden"
	document.getElementById('tahunan').style.visibility="visible"
	document.getElementById('btn_laporan').style.visibility="visible"
	}
	else if(nilai=='MINGGUAN')
	{
	document.getElementById('harian').style.visibility="visible"
	document.getElementById('harian2').style.visibility="visible"
	document.getElementById('bulanan').style.visibility="visible"
	document.getElementById('triwulan').style.visibility="hidden"
	document.getElementById('tahunan').style.visibility="visible"
	document.getElementById('btn_laporan').style.visibility="visible"
	}
	else if(nilai=='TRIWULAN')
	{ 
	document.getElementById('harian2').style.visibility="hidden"
	document.getElementById('harian').style.visibility="hidden"
	document.getElementById('bulanan').style.visibility="hidden"
	document.getElementById('triwulan').style.visibility="visible"
	//alert(nilai);
	document.getElementById('tahunan').style.visibility="visible"
	document.getElementById('btn_laporan').style.visibility="visible"
	}
	else
	{ 
	document.getElementById('harian2').style.visibility="hidden"
	document.getElementById('harian').style.visibility="hidden"
	document.getElementById('bulanan').style.visibility="hidden"
	document.getElementById('triwulan').style.visibility="hidden"
	document.getElementById('tahunan').style.visibility="visible"
	//alert(nilai);
	document.getElementById('btn_laporan').style.visibility="visible"
	}
	
}