<?php
session_start();
 //$fil=$_SESSION['filt'];
include("../library/inc.connection.php");
include_once "../library/inc.sesadmin.php";   // Validasi halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka 
$tahun = $_POST['tahun'];
?>
<table  style='width:550px; font-size:12pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<h3 style="margin:10px auto; width:100%; text-align:center;">YOUTHLAND STORE</h3>
<h3 style="margin:10px auto; width:100%; text-align:center;">Laporan Pertahun</h3>
<h3 style="margin:10px auto; width:100%; text-align:center;"> Tahun : <?php echo $tahun;?></h3>

</table>
<table align="center" border="1" cellspacing='3' style='font-size:15pt; font-family:times new roman;  border-collapse: collapse;' width="80%">
  <tr align="center">
    <th> No </th>
    <th>Bulan</th>
    <th>Jumlah</th>
    <th>Total</th>
  </tr>
  
<?php
	// Deklrasi variabel angka
	$totalBayar 	= 0;
 	$totalBiayaKirim	= 0;
	$totItemBarang	= 0;
	$totOmset		= 0;
	
	//Cari Bulan
	$NamaBulan = array("01"=>"Januari","1"=>"Januari", 
						"02"=>"Februari", "2"=>"Februari",
						"03"=>"Maret","3"=>"Maret", 
						"04"=>"April","4"=>"April", 
						"05"=>"Mei", "5"=>"Mei", 
						"06"=>"Juni","6"=>"Juni", 
						"07"=>"Juli", "7"=>"Juli", 
						"08"=>"Agustus","8"=>"Agustus", 
						"09"=>"September","9"=>"September", 
						"10"=>"Oktober", 
						"11"=>"November", 
						"12"=>"Desember");
	

	// Menampilkan Semua Pemesanan yang sudah Lunas, dengan filter terpilih
	$mySql = "SELECT pemesanan.*, pelanggan.nm_pelanggan, SUM(pemesanan_item.jumlah) AS jumlah,SUM(pemesanan_item.harga) as harga, MONTH(pemesanan.tgl_pemesanan) AS bulan  
				FROM pemesanan 
				LEFT JOIN pelanggan ON pemesanan.kd_pelanggan = pelanggan.kd_pelanggan
				LEFT JOIN provinsi ON pemesanan.kd_provinsi = provinsi.kd_provinsi
				LEFT JOIN pemesanan_item ON pemesanan.no_pemesanan =  pemesanan_item.no_pemesanan
				WHERE pemesanan.status_bayar='Lunas' 
				AND year(pemesanan.tgl_pemesanan)='$tahun'
			GROUP BY LEFT(pemesanan.tgl_pemesanan,7)";
				
	$myQry = mysql_query($mySql);  
	$nomor  = 0; $totItem =0; $totOmset=0;
	
	$jumlah_total= 0;
	$harga_total= 0;
	
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$jumlah_total += $myData['jumlah'];
		$harga_total += $myData['harga'];
		// Membaca Kode pemesanan/ Nomor transaksi
		//$Kode = $myData['no_pemesanan'];
		
		// MENGHITUNG TOTAL BAYAR, TOTAL JUMLAH BARANG dengan perintah SQL
		//$my2Sql	= "SELECT SUM(harga * jumlah) As total_bayar,
					//SUM(jumlah) As total_barang 
					//FROM pemesanan_item WHERE no_pemesanan='$Kode'";
		//$my2Qry = @mysql_query($my2Sql, $koneksidb) or die ("Gagal query".mysql_error());
		//$my2Data =mysql_fetch_array($my2Qry);
		
		// Menghitung Total Bayar
		//$totalBiayaKirim= $myData['biaya_kirim'] * $my2Data['total_barang'];
		//$totalBayar 	= $my2Data['total_bayar'] + $totalBiayaKirim;
		
		// MENJUMLAH TOTAL SEMUA DATA YANG TAMPIL (Dari baris pertama sampai terakhir)
		//$totItemBarang	= $totItemBarang + $my2Data['total_barang'];
		//$totOmset		= $totOmset + $totalBayar;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $NamaBulan[$myData['bulan']]; ?></td>
    <td><?php echo $myData['jumlah']; ?></td>
    <td><?php echo $myData['harga']; ?></td>
  </tr>
  <?php  } ?>
  <tr align="right">>
    <td colspan="2" >TOTAL SELURUHNYA     :</td>
    <td align="right" > <?php echo format_angka($jumlah_total); ?></td>
    <td align="right"><strong>Rp. <?php echo format_angka($harga_total); ?></strong></font></td>
  </tr>
  </table>
  
  
  <table align="right"  style='550px; font-size:10pt;' cellspacing='0'>
  <tr><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td></tr>
<tr><td colspan="5" align="center">Padang, <?php echo date("Y/m/d");?></td>
</tr>
  <tr>
  <td>&nbsp;</td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  </tr>
  <tr>
  <td colspan="5" align="center">YOUTHLAND STORE</td>
  </tr>
<td style='border:0px solid black; padding:120px; text-align:left; width:30%'></td>
<td align='center'></br></br><u></u></td></tr></table></center>




<h3 style="margin:10px auto; width:100%; text-align:center; color:#09c;">
<tr>
<td></td>
<td></td>
<td>
<br><br>

</td>
</tr>
</h3>
<script>
window.print();
</script>