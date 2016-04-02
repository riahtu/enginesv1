(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {
		
		// deklarasikan variabel
		
		var kd_met = 0;
		
		// ketika tombol metode ditekan
		$('.ubahse').live("click", function(){
			
			var url = "module/EngineRun/metode.php";
			// ambil nilai id dari tombol ubah
			kd_met = this.id;
			
			if(kd_met != 0) {
				// ubah judul modal dialog
				$("#myModalLabel").html("Block Replacement Method");
			$.post(url, {id: kd_met} ,function(data) {
				// tampilkan detail.form.php ke dalam <div class="modal-body"></div>
				$(".modal-body").html(data).show();
			
			});
			
			}

			
		});
	
		
	
		// ketika tombol simpan ditekan
		$("#simpan-mahasiswa").bind("click", function(event) {
			var url = "mahasiswa.input.php";

			// mengambil nilai dari inputbox, textbox dan select
			var v_nim = $('input:text[name=nim]').val();
			var v_nama = $('input:text[name=nama]').val();
			var v_alamat = $('textarea[name=alamat]').val();
			var v_kelas = $('select[name=kelas]').val();
			var v_status = $('select[name=status]').val();

			// mengirimkan data ke berkas transaksi.input.php untuk di proses
			$.post(url, {nim: v_nim, nama: v_nama, alamat: v_alamat, kelas: v_kelas, status: v_status, id: kd_mhs} ,function() {
				// tampilkan data mahasiswa yang sudah di perbaharui
				// ke dalam <div id="data-mahasiswa"></div>
			

				// sembunyikan modal dialog
				$('#dialog-engine').modal('hide');
				
				// kembalikan judul modal dialog
				$("#myModalLabel").html("Tambah Data Mahasiswa");
			});
		});
	});
}) (jQuery);
