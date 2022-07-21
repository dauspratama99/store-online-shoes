<?php
include_once "library/inc.connection.php";
//include_once "../library/inc.sesadmin.php";
include_once "library/inc.library.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	// Baca variabel form
	$txtNoPemesanan	= $_POST['txtNoPemesanan'];
	$txtNoPemesanan 		= str_replace("'","&acute;",$txtNoPemesanan);
	
	$txtNama		= $_POST['txtNama'];
	$txtNama 		= str_replace("'","&acute;",$txtNama);
	
	$txtJumlahTransfer		= $_POST['txtJumlahTransfer'];
	$txtJumlahTransfer 		= str_replace(".","",$txtJumlahTransfer); // Menghilangkan karakter titik (10.000 jadi 10000)
	$txtJumlahTransfer 		= str_replace(",","",$txtJumlahTransfer); // Menghilangkan karakter koma (10,000 jadi 10000)
	$txtJumlahTransfer 		= str_replace(" ","",$txtJumlahTransfer); // Menghilangkan karakter kosong (10 000 jadi 10000)
	
	$txtKeterangan	= $_POST['txtKeterangan'];
	$txtKeterangan 	= str_replace("'","&acute;",$txtKeterangan);
	
	// Validasi form
	$pesanError = array();
	if (trim($txtNoPemesanan)=="") {
		$pesanError[] = "Data <b>No. Pemesanan</b>  masih kosong, isi sesuai dengan <b>No Pemesanan</b> Anda";
	}
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Penerima</b>  masih kosong, isi sesuai nama akun Anda";
	}
	if (trim($txtJumlahTransfer)=="" or ! is_numeric(trim($txtJumlahTransfer))) {
		$pesanError[] = "Data <b> Jumlah Ditransfer (Rp)</b> masih kosong, dan <b> harus ditulis angka </b>";
	}
	if (trim($txtKeterangan)=="") {
		$pesanError[] = "Data <b> Keterangan </b> masih kosong";
	}
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		// Membuat kode baru
		$tanggal	= date('Y-m-d');
		$kodeBaru	= buatKode("konfirmasi", "");

		// Mengkopi file gambar
		if (! empty($_FILES['namaFile']['tmp_name'])) {
			$nama_file = $_FILES['namaFile']['name'];
			$nama_file = stripslashes($nama_file);
			$nama_file = str_replace("'","",$nama_file);
			$nama_file = str_replace(" ","-",$nama_file);
			//$nama_file = $kodeBaru.".".$nama_file;
			copy($_FILES['namaFile']['tmp_name'],"../user/img-konfirmasi/".$nama_file);
		}
		else {
			$nama_file = "";
		}
		
		// Simpan data dari form ke database
		$mySql	= "INSERT INTO konfirmasi (no_pemesanan, nm_pelanggan, jumlah_transfer, file_gambar, keterangan, tanggal) 
					VALUES('$txtNoPemesanan', '$txtNama', '$txtJumlahTransfer', '$nama_file',  '$txtKeterangan', '$tanggal')";
		$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
		if($myQry){				
			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=?open=Barang'>";
		}
	}	
} 

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$dataNoPemesanan	= isset($_POST['txtNoPemesanan']) ? $_POST['txtNoPemesanan'] : '';
$dataNama			= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataJumlahTransfer	= isset($_POST['txtJumlahTransfer']) ? $_POST['txtJumlahTransfer'] : '';
$dataKeterangan 	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="frmadd">
<table class="table-list" width="100%" style="margin-top:0px;">
	<tr>
	  <th colspan="3"><strong>KONFIRMASI </strong></th>
	</tr>
	<tr>
      <td width="459"><b><font color="black"><font face="Comic Sans">No. Pemesanan</font> 
      </font></b></td>
      <td width="5"><b>:</b></td>
	  <td><select name="txtNoPemesanan">
        <option value="KOSONG">....</option>
        <?php
		  $mySql = "SELECT * FROM pemesanan ORDER BY no_pemesanan";
		  $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
		  while ($myData = mysql_fetch_array($myQry)) {
			if ($myData['no_pemesanan']== $dataNoPemesanan) {
				$cek = " selected";
			} else { $cek=""; }
			echo "<option value='$myData[no_pemesanan]' $cek> $myData[no_pemesanan] </option>";
		  }
		  ?>
      </select></td>
      <!--<td width="726"><input name="txtNoPemesanan" type="text" value="<?php echo $dataNoPemesanan; ?>" size="20" maxlength="20" /></td>-->
    </tr>
	  <td><strong>Nama Pelanggan </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtNama" value="<?php echo $dataNama; ?>" size="80" maxlength="200" /></td>
	</tr>
	<tr>
      <td><strong>Jumlah Transfer  (Rp) </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtJumlahTransfer" type="text" value="<?php echo $dataJumlahTransfer; ?>" size="20" maxlength="12" /></td>
    </tr>
	<tr>
	  <td><strong>File Gambar </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="namaFile" type="file" size="70" /></td>
    </tr>
	<tr>
	  <td><strong>Keterangan</strong></td>
	  <td><strong>:</strong></td>
	  <td><textarea id="elm1" name="txtKeterangan" cols="70" rows="6"><?php echo $dataKeterangan; ?></textarea></td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" KIRIM " style="cursor:pointer;"></td>
    </tr>
</table>
</form>
