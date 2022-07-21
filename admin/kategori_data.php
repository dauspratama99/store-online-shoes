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
// Validasi supaya yang mengakses hanya Admin (yang sudah login)
include_once "../library/inc.sesadmin.php";
?>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-common">
  <tr>
    <td colspan="2" align="right"><h1><font color="blue">DATA KATEGORI</font></h1></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="?open=Kategori-Add" target="_self"><img src="../images/btn_add_data.png" height="40" border="0" /></a></td>
  </tr>
  
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="35" align="center" bgcolor="#CCCCCC"><font color="blue">No</font></th>
        <th width="650" bgcolor="#CCCCCC"><font color="blue">Nama Kategori</font></th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><font color="blue"><strong>Tools</strong></font></td>
      </tr>
	<?php
	$mySql = "SELECT * FROM kategori ORDER BY nm_kategori ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_kategori'];
	?>
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['nm_kategori']; ?></td>
        <td width="44" align="center"><a href="?open=Kategori-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
        <td width="44" align="center"><a href="?open=Kategori-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS DATA KATEGORI INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
</table>
