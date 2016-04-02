 <script language="javascript" src="minerva/ez.js"></script>
 <script src="js/jquery.js"></script>
      <!-- Bootstrap javascript -->
      <script src="js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$(".tip").tooltip();
			});
		</script>
<script>
function hapusdata(urltujuan){
		el=$(this);
		if(confirm("Do you want to delete the data ?."))
		{
            alert("Data Deleted!");
            
            window.location = (urltujuan);
        }
        else{
            alert("Failure to Delete");
        }
}

function submitform(val,intb){
    if(intb == ''){
        alert("please insert new interval data");
		
    }else{
    window.location = ("module/maintenance/aksi_maintenance.php?module=maintenance&act=input&id="+val+"&intb="+intb);
    }
}
function reback(){
    window.location = ("enginerun.html");
}

$(document).ready(function() {
        // ketika input usia di isi, eksekusi bagian ini.
	      $("#txtintb").keypress(function (data)
		 
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
 <div class="modal hide fade" id="dialog-engine">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Replacement Part</h3>
		</div>
		<div class="modal-body">
			
		</div>
		<div class="modal-footer">
			<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">cancel</button>
		</div>
	</div>
 
 
 
 
 
     
<?php
$aksi="module/maintenance/aksi_maintenance.php";

  if($_GET[module]=="maintenanceadd"){
$que = "select * from jamputar_mesin where ID_JAMPUTAR='$_GET[id]'";
    $result=mysql_query($que);  
    $row = mysql_fetch_array($result);
	
	
$quejb = mysql_query("select * from sparepart");	
	?>
<h2 class='left'>Add Maintenance</h2>
  <div class="panel panel-default">
         
              <div class="panel-body">
                  <form name="mainform" id="mainform" action="<?php echo"$aksi?module=maintenance&act=inputdetail"?>" method="post" enctype="multipart/form-data">
                      <input name="id" id="id" value="<?php echo($row[0]); ?>" hidden="" />
                      
                      <input class="form-control" name="txtfac" id="txtfac" value="<?php echo($row[1]); ?>" hidden="" />
                      <label>OLD Interval - New Interval</label>
                      <input class="form-control" name="txtintl" id="txtintl" value="<?php echo($row[2]); ?>" readonly/> -
                      
                       <a class="tip" href="#" data-toggle="tooltip" data-placement="top" title="Inputkan nilai interval baru">
                      <input class="form-control" name="txtintb" id="txtintb" /></a>
                      <span id="pesan"></span>
                      <div class="form-group">
                      <label>Limit Help</label>
                            <textarea class="form-control" name="txthelp" id="txthelp" rows="3" disabled><?php echo($row[4]); ?></textarea>
                      </div>
                      <p>&nbsp;</p>
                      <p>Maintenance Status</p>
        <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th hidden="true">Detail ID</th>
                <th>Date Entry Maintenance</th>
                <th>Estimated Maintenance Time</th>
                <th>Description</th>
                <th>Part Package</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
		<?php
        $dque = "
        select d_jadwal_maintenance.id_detail_jadwal, d_jadwal_maintenance.tgl_mulai, d_jadwal_maintenance.tgl_selesai, d_jadwal_maintenance.deskripsi, sparepart.part_package, sparepart.idsparepart from d_jadwal_maintenance inner join sparepart on sparepart.idsparepart=d_jadwal_maintenance.idsparepart where ID_JAMPUTAR = '$row[0]' order by ID_DETAIL_JADWAL ASC
	";
	$dresult=mysql_query($dque);
	$djumrows = mysql_num_rows($dresult);
		$iCnt=0;
		if ($djumrows>0) { 
			while ($drow = mysql_fetch_array($dresult)) {
        $iCnt++;
		?>
        
		  <tr <?php if ($iCnt%2==0) {?>class="odd gradeX" <?php } else {?>class="even gradeC"<?php }?> >
			<td hidden="true"><?php echo strip_tags($drow[0]); ?></td>
            <td><?php 
			$tanggals = $drow[1];
			$tanggalbarus = date('D, j-M-Y', strtotime($tanggals ));
			echo strip_tags($tanggalbarus);
			 ?></td>
            <td><?php
			$tanggals1 = $drow[2];
			$tanggalbarus1 = date('D, j-M-Y', strtotime($tanggals1 ));
			echo strip_tags($tanggalbarus1);
			 ?></td>
            <td><?php echo strip_tags($drow[3]); ?></td>
            <td><a href="#dialog-engine" id="<?php 
	$data['kd_sp']=$drow[5];
	echo $data['kd_sp'] ?>" data-toggle="modal" class="ubah2"><?php echo($drow[4]); ?></a></td>
            <td><a href="#" onclick="hapusdata('<?php echo"$aksi?module=maintenance&act=deletedet&sid=$drow[0]&ids=$row[0]" ?>')"><button class="btn btn-small btn-danger"><i class="halflings-icon white trash"></i> </button></a></td>  
		  </tr>
		<?php
			}
		}else{
		?>
		<tr>
			<td colspan="6">Data tidak di temukan</td>
		</tr>
		<?php
		}
		?>
        </tbody>    
	</table>
                      <p>Form </p>
        <label>Date Entry Maintenance</label>    
                      <input class="form-control" type="date" name="txtdateF" id="txtdateF" />
        <label>Estimated Maintenance Time</label>    
                      <input class="form-control" type="date" name="txtdateL" id="txtdateL" />
       <div class="control-group">
               <label>
Replacement Parts </label>

<div class="controls">
<select name="txtprt" data-placeholder="Select Package" id="selectError2" data-rel="chosen">
 
 <optgroup label="Part Package">
 <?php while($rm=mysql_fetch_array($quejb)){?>
										<option value="<?php echo $rm[0]; ?>"><?php echo $rm[1]; ?></option>
										
						  
										</optgroup>
                                        <?php }; ?>


</select>  
</div>
             
         </div>                   
                      
                      
        <div class="form-group">
               <label>Description</label>
               <textarea class="form-control" name="txtdesc" id="txtdesc" rows="3"></textarea>
         </div>              
                  <p>&nbsp; </p>
                   
                    <button type="submit" class="btn btn-default">Submit Detail</button>
                    <button type="button" onclick="reback()" class="btn btn-primary">Return</button>
                  <p>&nbsp; </p>
                  <a class="tip" href="#" data-toggle="tooltip" data-placement="left" title="Untuk Simpan Interval Baru">
                  <button type="button" onclick="submitform(<?php echo($row[0]); ?>,txtintb.value)" class="btn btn-success">Submit Form</button></a>
                </form>      
              </div>
    </div>  
<?php
}
?>
