<style type="text/css">
<!--
body,td,th {
	color: white;
}
body {
	background-color: blue;
	background-image: url(../images/bg1.jpg);

}
-->
</style>
<?php


# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	// Baca form
	$txtPassBaru= $_POST['txtPassBaru'];
	$txtPassLama= $_POST['txtPassLama'];
	
	// Validasi form
	$pesanError = array();
	if (trim($txtPassBaru)=="") {
		$pesanError[] = "Data <b> Password baru </b> belum diisi !";		
	}
	
	// Validasi Password lama (harus benar)
	$sqlCek = "SELECT * FROM admin WHERE username='admin' AND password ='".md5($txtPassLama)."'";
	$qryCek = mysql_query($sqlCek, $koneksidb)  or die ("Query Periksa Password Salah : ".mysql_error());
	if(mysql_num_rows($qryCek) <1){
		$pesanError[] = "Maaf, <b> Password Anda Salah</b>....silahkan ulangi";
	}
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$mySql	= "UPDATE admin SET password='".md5($txtPassBaru)."'";
		$myQry	= mysql_query($mySql, $koneksidb);
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Logout&Info=Password Berhasil Diganti'>";
		}
	}	
}  

# Membaca Data Login untuk diedit
$mySql = "SELECT * FROM admin";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData= mysql_fetch_array($myQry);
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
<table class="table-list" width="100%">
	<tr>
	  <th colspan="3"><font color="blue">GANTI PASSWORD ADMIN </font></th>
	</tr>
	<tr>
	  <td width="15%" ><font color="#666666"><strong>Username</strong></font></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><strong><?php echo $myData['username']; ?></strong></td>
	</tr>
	<tr>
      <td><strong><font color="#666666"><strong>Password Lama </strong></font></td>
	  <td><b>:</b></td>
	  <td><input name="txtPassLama" type="password" value="" size="40" maxlength="30"/></td>
	</tr>
	<tr>
	  <td><strong><font color="#666666"><strong>Password Baru </strong></font></td>
	  <td><b>:</b></td>
	  <td><input name="txtPassBaru" type="password"  value="" size="40" maxlength="30"/></td>
	</tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
<font color="blue">Anda juga dapat merubah Password lewat tools <strong>phpMyAdmin</strong>, gunakan tipe enkripsi data <strong>MD5</strong> untuk Password.</font>
</form>