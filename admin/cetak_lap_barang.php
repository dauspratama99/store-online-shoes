<?php
session_start();
 //$fil=$_SESSION['filterSql'];
include("../library/inc.connection.php");
include_once "../library/inc.sesadmin.php";   // Validasi halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka 
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
<table  style='width:550px; font-size:12pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<h3 style="margin:10px auto; width:100%; text-align:center;">YOUTHLAND STORE </h3>
<h3 style="margin:10px auto; width:100%; text-align:center;">Laporan Data Stok Barang</h3>

</table>
<table align="center" border="1" cellspacing='3' style='font-size:15pt; font-family:times new roman;  border-collapse: collapse;' >
  <tr align="center">
    <th> No </th>
    <th>Kode</th>
    <th>Nama Barang</th>
    <th>Stok </th>
    <th>Modal </th>
    <th>Harga Jual (Rp)</th> 
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
    <td><?php echo $myData['kd_barang']; ?></td>
    <td><?php echo $myData['nm_barang']; ?></td>
    <td><?php echo $myData['stok']; ?></td>
    <td><?php echo $myData['harga_modal']; ?></td>
    <td align="right"><?php echo $myData['harga_jual']; ?></td>
    
  </tr>
  <?php  $nomor++; } ?>
  
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