<?php
// Validasi Login : yang boleh mengakses halaman ini hanya yang sudah Login admin
include_once "../library/inc.sesadmin.php";
include_once "../library/inc.library.php";

# TOMBOL SIMPAN DIKLIK
if (isset($_POST['btnSimpan'])) {
	// Baca form
	$txtNama	= $_POST['txtNama'];
	$txtNama 	= str_replace("'", "&acute;", $txtNama);
	$txtNama	= ucwords(strtolower($txtNama));

	$txtHrgModal	= $_POST['txtHrgModal'];
	$txtHrgModal 	= str_replace("'", "&acute;", $txtHrgModal);

	$txtHrgJual		= $_POST['txtHrgJual'];
	$txtHrgJual 	= str_replace("'", "&acute;", $txtHrgJual);

	$txtStok	= $_POST['txtStok'];
	$txtStok 	= str_replace("'", "&acute;", $txtStok);

	$txtKeterangan	= $_POST['txtKeterangan'];
	$txtKeterangan 	= str_replace("'", "&acute;", $txtKeterangan);

	$cmbKategori	= $_POST['cmbKategori'];

	// Validasi form
	$pesanError = array();
	if (trim($txtNama) == "") {
		$pesanError[] = "Data <b>Nama Barang</b> tidak boleh kosong !";
	}
	if (trim($txtHrgModal) == ""  or !is_numeric(trim($txtHrgModal))) {
		$pesanError[] = "Data <b>Harga Modal (Rp)</b> tidak boleh kosong !";
	}
	if (trim($txtHrgJual) == ""  or !is_numeric(trim($txtHrgJual))) {
		$pesanError[] = "Data <b>Harga Jual (Rp)</b> tidak boleh kosong !";
	}
	if (trim($txtStok) == "" or !is_numeric(trim($txtStok))) {
		$pesanError[] = "Data <b>Stok</b>  tidak boleh kosong !";
	}
	if (trim($txtKeterangan) == "") {
		$pesanError[] = "Data <b>Keterangan</b> tidak boleh kosong !";
	}
	if (trim($cmbKategori) == "KOSONG") {
		$pesanError[] = "Data <b>Kategori</b> belum dipilih !";
	}

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError) >= 1) {
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
		$noPesan = 0;
		foreach ($pesanError as $indeks => $pesan_tampil) {
			$noPesan++;
			echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
		}
		echo "</div> <br>";
	} else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		// Membuat kode baru
		$kodeBaru	= buatKode("barang", "B");
		
		$lokasi_file    = $_FILES['namaFile']['tmp_name'];
		$tipe_file      = $_FILES['namaFile']['type'];
		$nama_file      = $_FILES['namaFile']['name'];
		$acak           = rand(000000,999999);
		$nama_file_unik = $acak.$nama_file;
		// Mengkopi file gambar
		if (!empty($_FILES['namaFile']['tmp_name'])) {
			/* $nama_file = $_FILES['namaFile']['name'];
			$nama_file = stripslashes($nama_file);
			$nama_file = str_replace("'", "", $nama_file);
			$nama_file = str_replace(" ", "-", $nama_file);
			$nama_file = $kodeBaru . "." . $nama_file;
			copy($_FILES['namaFile']['tmp_name'], "../Rukmana/img-barang/" . $nama_file); */
			if($tipe_file =="image/jpeg" || $tipe_file == "image/png") {
				move_uploaded_file($lokasi_file, "../img-barang/$nama_file_unik");
				// Simpan data dari form ke database
				$mySql	= "INSERT INTO barang (kd_barang, nm_barang, harga_modal, harga_jual, stok, keterangan, file_gambar,  kd_kategori) 
							VALUES('$kodeBaru', '$txtNama', '$txtHrgModal', '$txtHrgJual',  '$txtStok', '$txtKeterangan', '$nama_file_unik', '$cmbKategori')";
				$myQry	= mysql_query($mySql, $koneksidb)  or die("Query salah : " . mysql_error());
				if ($myQry) {
					// Refresh
					echo "<meta http-equiv='refresh' content='0; url=?open=Barang-Add'>";
				}
			}
			else{
				echo "Gagal menyimpan data !!! <br>
				Tipe file <b>$nama_file</br> : $tipe_file <br>
				Tipe file yang diperbolehkan adalah : <b>JPG/JPEG</b>.<br>";
				echo "<a href='javascript:history.go(-1)'>Ulangi Lagi</a>";
			}
		}
		else {
			# code...
			$mySql	= "INSERT INTO barang (kd_barang, nm_barang, harga_modal, harga_jual, stok, keterangan,  kd_kategori) 
							VALUES('$kodeBaru', '$txtNama', '$txtHrgModal', '$txtHrgJual',  '$txtStok', '$txtKeterangan', '$cmbKategori')";
				$myQry	= mysql_query($mySql, $koneksidb)  or die("Query salah : " . mysql_error());
				if ($myQry) {
					// Refresh
					echo "<meta http-equiv='refresh' content='0; url=?open=Barang-Add'>";
				}
		} 

	}
}

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$dataKode		= buatKode("barang", "B");
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataHrgModal	= isset($_POST['txtHrgModal']) ? $_POST['txtHrgModal'] : '';
$dataHrgJual	= isset($_POST['txtHrgJual']) ? $_POST['txtHrgJual'] : '';
$dataStok		= isset($_POST['txtStok']) ? $_POST['txtStok'] : '';
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
$dataKategori	= isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="frmadd">
	<table class="table-list" width="100%" style="margin-top:0px;">
		<tr>
			<th colspan="3"><strong>TAMBAH DATA BARANG </strong></th>
		</tr>
		<tr>
			<td width="14%"><strong>Kode</strong></td>
			<td width="1%"><strong>:</strong></td>
			<td width="85%"><input name="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="10" readonly="readonly" /></td>
		</tr>
		<tr>
			<td><strong>Nama Barang </strong></td>
			<td><strong>:</strong></td>
			<td><input name="txtNama" value="<?php echo $dataNama; ?>" size="80" maxlength="200" /></td>
		</tr>
		<tr>
			<td><strong>Modal (Rp) </strong></td>
			<td><strong>:</strong></td>
			<td><input type="number" placeholder="100000" name="txtHrgModal" value="<?php echo $dataHrgModal; ?>" size="80" maxlength="200" /></td>
		</tr>
		<tr>
			<td><strong>Harga Jual (Rp) </strong></td>
			<td><strong>:</strong></td>
			<td><input type="number" placeholder="100000" name="txtHrgJual" value="<?php echo $dataHrgJual; ?>" size="80" maxlength="200" /></td>
		</tr>
		<tr>
			<td><strong>Stok </strong></td>
			<td><strong>:</strong></td>
			<td><input type="number" name="txtStok" value="<?php echo $dataStok; ?>" size="80" maxlength="200" /></td>
		<tr>
			<td><strong>Kategori</strong></td>
			<td><strong>:</strong></td>
			<td>
				<?php
				$result = mysql_query("select * from kategori");
				$jsArray = "var bank = new Array();\n";
				echo '<select name="cmbKategori" >';
				echo '<option>Pilih Kategori</option>';
				while ($row = mysql_fetch_array($result)) {
					echo '<option value="' . $row['kd_kategori'] . '">' . $row['nm_kategori'] . '</option>';
				}
				echo '</select>';
				?>
			</td>
		</tr>
		</tr>
		<tr>
			<td><strong>keterangan </strong></td>
			<td><strong>:</strong></td>
			<td><textarea name="txtKeterangan" value="<?php echo $dataKeterangan; ?>"></textarea></td>
		</tr>
		<tr>
			<td><strong>Gambar Produk</strong></td>
			<td><strong>:</strong></td>
			<td><input type="file" name="namaFile"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="btnSimpan" value=" SIMPAN DATA " style="cursor:pointer;"></td>
		</tr>
	</table>
</form>