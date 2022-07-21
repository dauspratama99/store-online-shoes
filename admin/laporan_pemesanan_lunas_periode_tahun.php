<form action="cetak_lap_tahun.php" method="post">

<h3>Silahkan Pilih Tahun</h3>

<label for="#">Tahun</label>
<select name="tahun" class="input_field">
<?php
$mulai= date('Y') - 50;
for($i = $mulai;$i<$mulai + 100;$i++){
    $sel = $i == date('Y') ? ' selected="selected"' : '';
    echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
}
?>
</select>
<input type="submit" value="post">
</form>















