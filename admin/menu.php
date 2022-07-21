<?php
# JIKA DIKENALI YANG LOGIN ADMIN
if(isset($_SESSION['SES_ADMIN'])){
?>
<style type="text/css">
<!--
.style1 {color: black}
-->
<link rel="shortcut icon" href="./images/ic.png">

</style>

	<ul>
	<font face="Comic Sans"><li><a href='?open' title='Halaman Utama' class="style1" ><font color="black"><div style="cursor: pointer;"> Home </div></font></a></li></font>
	<font face="Comic Sans"><li><a href='?open=Password-Admin' title='Password Admin' ><font color="black"> Password Admin </font></a></li></font>
	<font face="Comic Sans"><li><a href='?open=Provinsi-Data' title='Provinsi' target="_self"><font color="black">Data Provinsi</font></a></li></font>
	<font face="Comic Sans"><li><a href='?open=Kategori-Data' title='Kategori' target="_self"><font color="black">Data Kategori</font></a></li></font>
	<font face="Comic Sans"><li><a href='?open=Barang-Data' title='Barang' target="_self"><font color="black">Data Barang</font></a></li></font>
	<font face="Comic Sans"><li><a href='?open=Pelanggan-Data' title='Pelanggan' target="_self"><font color="black">Data Pelanggan</font></a></li></font>
	<font face="Comic Sans"><li><a href='?open=Pemesanan-Barang' title='Pemesanan Barang' target="_self"><font color="black">Pemesanan Barang</font></a></li></font>
	<font face="Comic Sans"><li><a href='?open=Konfirmasi-Transfer' title='Konfirmasi Transfer' target="_self"><font color="black">Konfirmasi Transfer</font></a></li></font>
	<font face="Comic Sans"><li><a href='?open=Laporan' title='Laporan' target="_self"><font color="black">Laporan</font></a></li>
	<font face="Comic Sans"><li><a href='?open=Logout' title='Logout (Exit)'><font color="black">Logout</font></a></li>
	</ul>
<?php
} 
else {
// JIKA BELUM ADA YANG LOGIN
?>
	<ul>
	<li><a href='?open=Login' title='Login' target="_self"><font color="black"><font face="Comic Sans">LOGIN</font></a></li></font>
	<li><a href='../index.php' title='Home' target="_self"><font color="black"><font face="Comic Sans">HOME</font></a></li></font>

<?php } ?>
