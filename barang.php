<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# Nomor Halaman (Paging)
$baris = 10;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql = "SELECT * FROM barang";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$maks	 = ceil($jml/$baris);
$mulai	= $baris * ($hal-1); 
?>
<html>
<head>
<link href="style/user.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="2" align="center" bgcolor="#696969" scope="col"><font color="black"><strong>KOLEKSI BARANG </strong></font></td>
  </tr>
<?php
// Menampilkan daftar barang
$barangSql = "SELECT barang.*,  kategori.nm_kategori FROM barang 
			LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
			ORDER BY barang.kd_barang ASC LIMIT $mulai, $baris";
$barangQry = mysql_query($barangSql, $koneksidb) or die ("Gagal Query".mysql_error()); 
$nomor = 0;
while ($barangData = mysql_fetch_array($barangQry)) {
	$nomor++;
	$KodeBarang = $barangData['kd_barang'];
	$KodeKategori = $barangData['kd_kategori'];
	
	// Membaca file gambar
	if ($barangData['file_gambar']=="") {
		$fileGambar = "noimage.jpg";
	}
	else {
		$fileGambar	= $barangData['file_gambar'];
	}
  
	// Warna baris data
	if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
?>
  <tr>
    <td width="19%" align="center">
	  <a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>"><img src="img-barang/<?php echo $fileGambar; ?>" width="100" border="0"> </a> <br>
      <div class='harga'>Rp. <?php echo format_angka($barangData['harga_jual']); ?> </div><br>
      <a href="?open=Barang-Beli&Kode=<?php echo $KodeBarang; ?>" class="button silver bigrounded"> <strong>Buy</strong></a> </td>
    <td width="81%" valign="top">
	  <a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>">
      <div class='judul'><?php echo $barangData['nm_barang']; ?> </div>
      </a>
      
	  <p><?php echo substr($barangData['keterangan'], 0, 200); ?> ....</p>
      <p><strong><font face="Comic Sans">Stok :</font></strong> <?php echo $barangData['stok']; ?></p>
    <strong><font face="Comic Sans">Kategori :</font></strong> <a href="?open=Kategori-Barang&Kode=<?php echo $KodeKategori; ?>"> <?php echo $barangData['nm_kategori']; ?> </a></td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="2" align="center" bgcolor="#F5F5F5">
	<b>Halaman:
    <?php
	for ($h = 1; $h <= $maks; $h++) {
			echo "[  <a href='?hal=$h'>$h</a> ]";
	}
	?>
    </b></td>
  </tr>
</table>
</body>
</html>
