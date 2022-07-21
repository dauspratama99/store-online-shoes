<?php
session_start();
include("../library/inc.connection.php");
include_once "../library/inc.sesadmin.php";   // Validasi halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka 
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];

echo"<body onLoad='javascript:window:print()'>";

?>
<table  style='width:550px; font-size:12pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<h3 style="margin:10px auto; width:100%; text-align:center;">YOUTHLAND STORE</h3>
<h3 style="margin:10px auto; width:100%; text-align:center;">Laporan Perbulan</h3>
<h3 style="margin:10px auto; width:100%; text-align:center;"> Bulan : <?php echo $bulan ;?>-<?php echo $tahun; ?> </h3>

</table>
<table align="center" border="1" cellspacing='3' style='font-size:15pt; font-family:times new roman;  border-collapse: collapse;' >
  <tr align="center">
    <th> No </th>
    <th>Tanggal</th>
    <th>Kode Plg </th>
    <th>Nama Pelanggan </th>
    <th>Harga </th>
    <th>Jumlah</th>
    <th>Total Belanja (Rp) </th> 
  </tr>
  
<?php
$no=1;

$total=0;



	// Deklrasi variabel angka
	$totalBayar 	= 0;
 	$totalBiayaKirim	= 0;
	$totItemBarang	= 0;
	$totOmset		= 0;
	$jml_tot = 0;
	$total1 = 0;
	
	
	// Menampilkan Semua Pemesanan yang sudah Lunas, dengan filter terpilih
	$q = "SELECT DISTINCT pemesanan.tgl_pemesanan, pelanggan.kd_pelanggan, nm_pelanggan, pemesanan_item.harga, jumlah 
	from pemesanan, pelanggan, pemesanan_item
	where pemesanan.kd_pelanggan = pelanggan.kd_pelanggan and month(pemesanan.tgl_pemesanan)='$bulan' and year(pemesanan.tgl_pemesanan)='$tahun' and pemesanan_item.no_pemesanan = pemesanan.no_pemesanan";
	$qq = mysql_query($q);
	while ($data = mysql_fetch_array($qq)){
	$harga = $data['harga'];
	$jml = $data['jumlah'];
	
	$belanja = $harga * $jml ;
	$harga1 = array($data['jumlah']);
	$value = array_sum($harga1);
	$jml_tot +=$value;
	

	$total = array($data['harga']);
	$value1 = array_sum($total);
	$total1 +=$value1;
	?>
  <tr>
   <td><?php echo $no++ ?></td>
	
	<td><?php echo $data['tgl_pemesanan'];?></td>

	<td><?php echo $data['kd_pelanggan'];?></td>
	<td><?php echo $data['nm_pelanggan'];?></td>
	<td><?php echo $data['harga'];?></td>
	<td><?php echo $data['jumlah'];?></td>
	<td><?php echo $belanja;?></td>


    
  </tr>
  <?php } ?>
  <tr align="right">
    <td colspan="5" >GRAND TOTAL     :</td>
    <td align="right" > <?php echo format_angka($jml_tot); ?></td>
    <td align="right"><strong>Rp. <?php echo format_angka($total1); ?></strong></font></td>
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