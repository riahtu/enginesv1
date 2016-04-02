<script type="text/javascript">
      $(document).ready(function() {
        // ketika input usia di isi, eksekusi bagian ini.
	      $("#txtint").keypress(function (data)
		 
	      { 
	         // kalau data bukan berupa angka, tampilkan pesan error
	         if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
	         {
		          $("#pesan").html("Isikan Angka").show().fadeOut("slow"); 
	            return false;
           }	
	      });
      });
    </script>
    
     <script type="text/javascript">
      $(document).ready(function() {
        // ketika input usia di isi, eksekusi bagian ini.
	      $("#txtvalue").keypress(function (data)
		 
	      { 
	         // kalau data bukan berupa angka, tampilkan pesan error
	         if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
	         {
		          $("#pesan").html("Isikan Angka").show().fadeOut("slow"); 
	            return false;
           }	
	      });
      });
    </script>
    
     <script type="text/javascript">
      $(document).ready(function() {
        // ketika input usia di isi, eksekusi bagian ini.
	      $("#txtunitp").keypress(function (data)
		 
	      { 
	         // kalau data bukan berupa angka, tampilkan pesan error
	         if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
	         {
		          $("#pesan").html("Isikan Angka").show().fadeOut("slow"); 
	            return false;
           }	
	      });
      });
    </script>
    
      <script src="js/jquery.js"></script>
      <!-- Bootstrap javascript -->

		<script type="text/javascript">
			$(document).ready(function () {
				$(".tip").tooltip();
			});
		</script>
        
       
     
    
