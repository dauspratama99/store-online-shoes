

<?php
include_once "../library/inc.sesadmin.php";   // Validasi, mengakses halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka librari peringah fungsi

# Deklarasi variabel
$filterSql	= ""; 
$startTgl	= ""; 

# Filter data berdasarkan Tanggal
$tanggal 	= isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('d-m-Y');
$filterSql	= "AND tgl_pemesanan = '".InggrisTgl($tanggal)."'";
?>

<div align="center">
<h2><font  color="black"> YOUTHLAND STORE </font></h2>
<h2> <font color="black">LAPORAN PENJUALAN PER TANGGAL </font></h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="500" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><font color="black"><strong>FILTER DATA </strong></font></td>
    </tr>
    <tr>
      <td width="135"><font color="black"><strong>Tanggal Transaksi</strong></font></td>
      <td width="5"><font color="black"><strong>:</strong></font></td>
      <td width="346"><input name="txtTanggal" type="text" class="tcal"  value="<?php echo $tanggal; ?>" />
      <input name="btnTampil" type="submit" value=" Tampilkan " />
    </tr>
  </table>
</form>

<table class="table-list" width="850" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="23" align="center" bgcolor="#CCCCCC"><font color="black"><b>No</b></font></td>
    <td width="72" bgcolor="#CCCCCC"><font color="black"><b>Tanggal</b></font></td>
    <td width="110" bgcolor="#CCCCCC"><font color="black"><b>No. Pemesanan </b></font> </td>
    <td width="100" bgcolor="#CCCCCC"><font color="black"><strong>Kode Plg </strong></font></td>
    <td width="218" bgcolor="#CCCCCC"><font color="black"><strong>Nama Pelanggan </strong></font></td>
    <td width="117" align="right" bgcolor="#CCCCCC"><font color="black"><strong>Total Barang  </strong></font></td>
    <td width="126" align="right" bgcolor="#CCCCCC"><font color="black"><strong>Total Belanja (Rp) </strong></font></td></td>
    <td width="43" align="center" bgcolor="#CCCCCC"><font color="black"><b>Tools</b></font></td>
  </tr>
  <?php
	// Deklrasi variabel angka
	$totalBayar 	= 0;
	$totalBiayaKirim	= 0;
	$totItemBarang	= 0;
	$totOmset		= 0;

	// Menampilkan Semua Pemesanan yang sudah Lunas, dengan filter terpilih
	$mySql = "SELECT pemesanan.*, pelanggan.nm_pelanggan, provinsi.biaya_kirim FROM pemesanan 
				LEFT JOIN pelanggan ON pemesanan.kd_pelanggan = pelanggan.kd_pelanggan
				LEFT JOIN provinsi ON pemesanan.kd_provinsi = provinsi.kd_provinsi
				WHERE pemesanan.status_bayar='Lunas' 
				$filterSql 
				ORDER BY pemesanan.no_pemesanan";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = 0;
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		
		// Membaca Kode pemesanan/ Nomor transaksi
		$Kode = $myData['no_pemesanan'];
		
		// MENGHITUNG TOTAL BAYAR, TOTAL JUMLAH BARANG dengan perintah SQL
		$my2Sql	= "SELECT SUM(harga * jumlah) As total_bayar,
					SUM(jumlah) As total_barang 
					FROM pemesanan_item WHERE no_pemesanan='$Kode'";
		$my2Qry = @mysql_query($my2Sql, $koneksidb) or die ("Gagal query".mysql_error());
		$my2Data =mysql_fetch_array($my2Qry);
		
		// Menghitung Total Bayar
		$totalBiayaKirim= $myData['biaya_kirim'] * $my2Data['total_barang'];
		$totalBayar 	= $my2Data['total_bayar'] + $totalBiayaKirim;

		// MENJUMLAH TOTAL SEMUA DATA YANG TAMPIL (Dari baris pertama sampai terakhir)
		$totItemBarang	= $totItemBarang + $my2Data['total_barang'];
		$totOmset		= $totOmset + $totalBayar;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_pemesanan']); ?></td>
    <td><?php echo $myData['no_pemesanan']; ?></td>
    <td><?php echo $myData['kd_pelanggan']; ?></td>
    <td><?php echo $myData['nm_pelanggan']; ?></td>
    <td align="right"><?php echo $my2Data['total_barang']; ?></td>
    <td align="right"><?php echo format_angka($totalBayar); ?></td>
    <td align="center"><a href="pemesanan_lihat.php?Kode=<?php echo $Kode; ?>" target="_blank" class='button white small'>Lihat</a></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="5" align="right"><font color="black"><strong>GRAND TOTAL     : </strong></font></td>
    <td align="right" bgcolor="#CCCCCC"><strong><?php echo format_angka($totItemBarang); ?></strong></td>
    <td align="right" bgcolor="#CCCCCC"><font color="black"><strong>Rp. <?php echo format_angka($totOmset); ?></strong></font></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
