<table width="100%" border="0" cellpadding="4" cellspacing="0">
<?php
if (! isset($_SESSION['SES_PELANGGAN'])) {
// Jika belum Login, maka form Login ditampilkan
?>
  <form name="frmLogin" method="post" action="?open=Login-Validasi">
    <tr>
      <td height="22" align="center" bgcolor="#ff9500" class="head"><b><font color="black"><font face="Comic Sans">LOGIN </font></b></td></font>
    </tr>
    <tr> 
      <td width="919" height="18"><b><font color="black"><font face="Comic Sans">Username : </font></b><br /></font>
        <input name="txtUsername" type="text"  size="20" maxlength="30"> </td>
    </tr>
    <tr> 
      <td height="18"> <b><font color="black"><font face="Comic Sans">Password :</font></b> <br /></font>
      <input name="txtPassword" type="password" size="20" maxlength="30"></td>
    </tr>
    
    <tr> 
      <td><input type="submit" name="btnLogin" value="Login" /></td>
    </tr>
    <tr> 
      <td><b><img src="images/ikon.jpg" width="9" height="9">
		<a href="?open=Pelanggan-Baru" target="_self"><font color="black"><font face="Comic Sans">Register </font></a></b></td></font>
    </tr>
    <tr> 
      <td ></td>
    </tr>
  </form>
<?php 
}
else { 
// Jika sudah Login, maka menu Pelanggan ditampilkan
?>
    <tr>
      <td height="22" align="center" bgcolor="#f98600"  class="head"><b><font face="Comic Sans">TRANSAKSI</b></td></font>
    </tr>  
  <tr> 
    <td><b> <img src="images/ikon.jpg" width="9" height="9"> <a href="?open=Keranjang-Belanja" target="_self">Keranjang Belanja</a> </b></td>
  </tr>
  
  <tr> 
    <td><b> <img src="images/ikon.jpg" width="9" height="9"> <a href="?open=Transaksi-Tampil" target="_self">Tampil Transaksi </a> </b></td>
  </tr>
  <tr>
    <td><b> <img src="images/ikon.jpg" width="9" height="9" /> <a href="login_out.php" target="_self">Logout</a></b></td>
  </tr>
<?php } ?>
</table>
