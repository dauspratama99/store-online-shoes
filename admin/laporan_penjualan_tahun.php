<?php
include_once "../library/inc.sesadmin.php";   // Validasi halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka librari peringah fungsi

?>
<div align="center">
<h2><font  color="black"> YOUTHLAND STORE </font></h2>
<h2> <font color="black">LAPORAN PENJUALAN PER TAHUN</font></h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self"></form>

<label for="#">Tahun</label>

<select name="tahun">
  <?php 
  $mulai=date ('Y') -50;
  for($i = $mulai;$i<$mulai + 100;$i++) {
  $sel = $i == date ('Y') ?' selected="selected"' : '';
  echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
  }
  ?>
  </select>
  <br>
  <input type="submit" name="cetak" value="cetak"> <br>
  
