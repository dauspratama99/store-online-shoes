<?php
include_once "../library/inc.sesadmin.php";   // Validasi halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka librari peringah fungsi

// Membaca Kategori yang dipilih
$kodeKategori= isset($_GET['kodeKat']) ? $_GET['kodeKat'] : 'SEMUA';
$dataKategori= isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : $kodeKategori;

// Membuat SQL Filter data
if(trim($dataKategori)=="SEMUA") {
	$filterSql = ""; 
}
else {
	$filterSql = "WHERE kd_kategori='$dataKategori'";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM barang $filterSql";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	 = mysql_num_rows($pageQry);
$maksData = ceil($jumlah/$baris);
?>
<div align="center">
<h2><font  color="black"> YOUTHLAND STORE </font></h2>
<h2><font color="black"> LAPORAN DATA BARANG </font></h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table  class="table-list"  width="400" border="0" cellpadding="2" cellspacing="1">
    <tr>
      <th colspan="2" bgcolor="#CCCCCC"><font color="blue"><strong>KATEGORI  BARANG </strong></font></th>
    </tr>
    <tr>
      <td width="100"><font color="blue"><strong>Pilih Kategori </strong></font></td>
      <td width="289"><strong>
        <select name="cmbKategori">
          <option value="SEMUA">....</option>
          <?php
			  $bacaSql = "SELECT * FROM kategori ORDER BY kd_kategori";
			  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
			  while ($bacaData = mysql_fetch_array($bacaQry)) {
				if ($bacaData['kd_kategori']== $dataKategori) {
					$cek = " selected";
				} else { $cek=""; }
				echo "<option value='$bacaData[kd_kategori]' $cek> $bacaData[nm_kategori] </option>";
			  }
			  ?>
        </select>
        <input name="btnTampil" type="submit" value="Tampilkan" />
      </strong>
	  <a href="cetak_lap_barang.php"><input name="cetak" type="button" value=" Cetak " /></a></td>
	  
    </tr>
  </table>
</form>

<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="24" align="center" bgcolor="#CCCCCC"><font color="blue"><strong>No</strong></font></td>
    <td width="69" align="center" bgcolor="#CCCCCC"><font color="blue"><strong>Kode</strong></font></td>
    <td width="470" bgcolor="#CCCCCC"><font color="blue"><strong>Nama Barang </strong></font></td>
    <td width="34" align="center" bgcolor="#CCCCCC"><font color="blue"><strong> Stok</strong></font></td>
    <td width="90" align="right" bgcolor="#CCCCCC"><font color="blue"><strong>H Modal(Rp)</strong></font></td>
    <td width="82" align="right" bgcolor="#CCCCCC"><font color="blue"><strong>H Jual(Rp)</strong></font></td>
  </tr>
  <?php	
	$mySql = "SELECT * FROM barang $filterSql ORDER BY kd_barang ASC LIMIT $hal, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td align="center"><?php echo $myData['kd_barang']; ?></td>
    <td><?php echo $myData['nm_barang']; ?></td>
    <td align="center"><?php echo $myData['stok']; ?></td>
    <td align="right"><?php echo format_angka($myData['harga_modal']); ?></td>
    <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
  </tr>
  <?php } ?>
  <tr class="selKecil">
    <td colspan="3" bgcolor="#CCCCCC"><font color="#FF0066"><b>Jumlah Data :</b></font> <?php echo $jumlah; ?> </td>
    <td colspan="3" align="right" bgcolor="#CCCCCC"><font color="#FF0066"><b>Halaman ke :</b></font>
      <?php
	for ($h = 1; $h <= $maksData; $h++) {
		$list[$h] = $baris * $h - $baris;
		echo " <a href='?open=Laporan-Barang&hal=$list[$h]&kodeKat=$dataKategori'>$h</a> ";
	}
	?></td>
  </tr>
</table>
