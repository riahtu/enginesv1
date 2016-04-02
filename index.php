<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Engine Maintenance</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css_login/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css_login/styles.css" rel="stylesheet">
<script language="javascript">
function validasi(form){
  if (form.txtusername.value == ""){
    alert("Anda belum mengisikan Username.");
    form.username.focus();
    return (false);
  }
     
  if (form.txtpassword.value == ""){
    alert("Anda belum mengisikan Password.");
    form.password.focus();
    return (false);
  }
  return (true);
}
function cekdata(nama,proses,urltujuan){
var prosesdata = urltujuan+"?cmd="+proses;
		$.ajax({
			type: 'POST',
			url: prosesdata,
			data: "id=" + nama,
			success: function(data) {
			$("#txtbagian").html(data);			
			}
		})
		return false;
};
</script>
	</head>
	<body>
    
    <?php
	$answer=$_GET['answer'];
	
	if($answer == 'wrong'){
	echo "	
	<div class='alert-error'>
							<center style='color:red'>Username or Password Incorrect</center>
						</div>
	
	";
	}
	?>
   <nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  
</nav>
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h1 class="text-center">Engine Maintenance</h1>
      </div>
      <div class="modal-body">
        <?php include_once 'include/AuthLogin.php'; ?>
          <table class="table table-bordered">
              <tr><td>Username</td><td>  
            <div class="input-group">
              <input type="text" id="txtusername" name="txtusername" class="form-control input-lg" placeholder="Username" required>
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  
            </div></td></tr>
             <tr><td>Password</td><td><div class="input-group">
              <input type="password" id="txtpassword" name="txtpassword" class="form-control input-lg" placeholder="Password" required> <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
            </div>
              </td></tr>
              <tr><td></td><td> </td></tr>
              <tr><td></td><td><div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Login</button>
             
            </div>
            </td>
            </tr>
            </table>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
         CV. Aziz  Perkasa Teknik
		  </div>	
      </div>
  </div>
  </div>
</div>
	<!-- script references -->
		<script src="js_login/jquery.min.js"></script>
		<script src="js_login/bootstrap.min.js"></script>
	</body>
</html>