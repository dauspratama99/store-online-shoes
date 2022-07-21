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
include_once "../library/inc.sesadmin.php";   // Validasi, mengakses halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka librari peringah fungsi

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris = 30;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM barang";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	 = mysql_num_rows($pageQry);
$maksData= ceil($jumlah/$baris);
?>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-common">
  <tr>
    <td colspan="2" align="right"><h1><b><font color="blue">DATA BARANG </font></b></h1></td>
  </tr>
  
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="?open=Barang-Add" target="_self"><img src="../images/btn_add_data.png" height="40" border="0" /></a></td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="26" align="center" bgcolor="#CCCCCC"><font color="blue"><strong>No</strong></font></th>
        <th width="88" align="left" bgcolor="#CCCCCC"><font color="blue"><strong>Kode</strong></font></th>
        <th width="388" bgcolor="#CCCCCC"><font color="blue"><strong>Nama Barang </strong></font></th>
        <th width="54" bgcolor="#CCCCCC"><font color="blue"><strong> Stok</strong></font></th>
        <th width="116" align="right" bgcolor="#CCCCCC"><font color="blue"><strong> Harga (Rp) </strong></font></th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><font color="blue"><strong>Tools</strong></font></td>
        </tr>
      <?php	
	$mySql = "SELECT * FROM barang ORDER BY kd_barang ASC LIMIT $hal, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_barang'];
	?>
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['kd_barang']; ?></td>
        <td><?php echo $myData['nm_barang']; ?></td>
        <td align="center"><?php echo $myData['stok']; ?></td>
        <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
        <td width="44" align="center"><a href="?open=Barang-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
        <td width="42" align="center"><a href="?open=Barang-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA BARANG INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td width="407"><font color="blue"><b>Jumlah Data :</b></font> <?php echo $jumlah; ?> </td>
    <td width="384" align="right"><font color="blue"><b>Halaman ke :</b></font>
      <?php
	for ($h = 1; $h <= $maksData; $h++) {
		$list[$h] = $baris * $h - $baris;
		echo " <a href='?open=Barang-Data&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
