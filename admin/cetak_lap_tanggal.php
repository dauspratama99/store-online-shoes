<?php
error_reporting(E_ALL^ (E_NOTICE|E_WARNING));
session_start();
include("../library/inc.connection.php");
include_once "../library/inc.sesadmin.php";   // 
include_once "../library/inc.library.php";    // Membuka 

?>
<table  style='width:550px; font-size:12pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<h3 style="margin:10px auto; width:100%; text-align:center;">YOUTHLAND STORE</h3>
<h4 style="margin:10px auto; width:100%; text-align:center;">Jl.Gajah Mada no.8</h5>  
<h5 style="margin:10px auto; width:100%; text-align:center;">HP. 081266512389 Kode Pos 25121 </h5><hr width="37%" align='center'>
<h3 style="margin:10px auto; width:100%; text-align:center;">Laporan Per Tanggal</h3>

</table>
<table align="center" border="1" cellspacing='3' style='font-size:15pt; font-family:times new roman;  border-collapse: collapse;' >
  <tr align="center">
    <th> No </th>
    <th>Tanggal</th>
    <th>No. Pemesanan</th>
    <th>Kode Plg </th>
    <th>Nama Pelanggan </th>
    <th>Total Barang</th>
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

	// Menampilkan Semua Pemesanan yang sudah Lunas, dengan filter terpilih
	$mySql = "SELECT barang.id_brg, nm_brg, harga_brg, stock_brg,
		    member.id_member, nm, alamat,hp,
			transaksi.qty, tanggal
		    FROM barang, member, transaksi
		    WHERE transaksi.p_id = barang.id_brg
		    AND transaksi.c_id = member.id_member and transaksi.tanggal='$tanggal'";
				
				
	$myQry = mysql_query($mySql);  
	$nomor  = 0; $totItem =0; $totOmset=0;
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
    <td><?php echo $myData['tgl_pemesanan']; ?></td>
    <td><?php echo $myData['no_pemesanan']; ?></td>
    <td><?php echo $myData['kd_pelanggan']; ?></td>
    <td><?php echo $myData['nm_pelanggan']; ?></td>
    <td align="right"><?php echo $my2Data['total_barang']; ?></td>
    <td align="right"><?php echo format_angka($totalBayar); ?></td>
    
  </tr>
  <?php  $i++; } ?>
  <tr align="right">>
    <td colspan="5" >GRAND TOTAL     :</td>
    <td align="right" > <?php echo format_angka($totItemBarang); ?></td>
    <td align="right"><strong>Rp. <?php echo format_angka($totOmset); ?></strong></font></td>
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