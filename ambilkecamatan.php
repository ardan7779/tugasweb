<?php
include("koneksi.php");

$kota = $_GET['kota'];
$kec = mysqli_query($koneksi, "SELECT id_kec,nama_kec FROM kec WHERE id_kabkot='$kota' order by nama_kec");
echo "<option>-- Pilih Kecamatan --</option>";
while($k = mysqli_fetch_array($kec)){
    echo "<option value=\"".$k['id_kec']."\">".$k['nama_kec']."</option>\n";
}
?>