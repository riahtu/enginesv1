<script type="text/javascript" src="js/jquery.validate.js"></script>
  <script type="text/javascript">
		$(document).ready(function() {
			$("#form1").validate({
				rules: {
					username: "required",
				  password: {
          	 required: true,
					   minlength: 5
          },		
			     cpassword:
			     {
				      required: true,
				      equalTo: "#password"
			     },
					
				},
			
      	messages: { 
			    nama: {
				    required: '. Nama harus di isi'
			    },
		      umur: {
				    required: '. Umur harus di isi',
				    number  : '. Hanya boleh di isi Angka'
			    },
				  username: {
				    required: '. Username harus di isi'
			    },
			    password: {
				    required : '. Password harus di isi',
				    minlength: '. Password minimal 5 karakter'
			    },
			    cpassword: {
				    required: '. Ulangi Password harus di isi',
				    equalTo : '. Isinya harus sama dengan Password'
			    },
			    email: {
				    required: '. Email harus di isi',
				    email   : '. Email harus valid'
			    },
			    website: {
				    required: '. Website harus di isi',
				    url     : '. Alamat website harus valid'
			    }
			   },
         
         success: function(label) {
            label.text('OK!').addClass('valid');
         }
			});
		});
	</script>