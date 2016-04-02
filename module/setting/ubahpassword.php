<?php session_start(); ?>
<?php
$aksi="module/setting/aksi_ubahpassword.php";


if($_GET[module] == "editpass"){
	//$que = "select * from user where username='$_GET[id]'";
    //$result=mysql_query($que);  
    //$row = mysql_fetch_array($result);
?>
<h2 class='left'>Edit Password</h2>
  <div class="panel panel-default">
          <div class="panel-heading">
                Form
          </div>
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=setting&act=edit"?>" method="post" enctype="multipart/form-data">
                      <input hidden="" name="sid" id="sid" value="<?php echo $_SESSION['user'];?>" />
                      <label>Username</label>
                      **<input class="form-control" name="txtusername" id="txtusername" disabled="disabled" value="<?php echo $_SESSION['user'];?>" />
                      
                      <label>Name</label>
                     
                        <input class="form-control" name="txtnamalengkap" id="txtnamalengkap" disabled="disabled" value="<?php echo $_SESSION['namalengkap'];?>" />
                      <label>Old Password</label>
                      <input class="form-control" name="txtpasslama" id="txtpasslama" value="" />
                      <label>New Password</label>
                      <input class="form-control" name="txtpassbaru" id="txtpassbaru" value="" />
                      <label>
Repeat New Password</label>
                      <input class="form-control" name="txtulangipassbaru" id="txtulangipassbaru" value="" />
                      <p>&nbsp;</p>
                    
                      
                      <button type="submit" class="btn btn-default">Submit Button</button>
                    
                      <button type="reset" class="btn btn-primary">Reset Button</button>
                 </div>
  </div> 
<?php
}

  
?>
	
    