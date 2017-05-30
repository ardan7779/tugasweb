<?php
// mysqli_connect("localhost","root","","siada");
include("koneksi.php");

$propinsi = $_GET['propinsi'];
$kota = mysqli_query($koneksi, "SELECT id_kabkot,nama_kabkot FROM kabkot WHERE id_prov='$propinsi' order by nama_kabkot");
echo "<option>-- Pilih Kabupaten/Kota --</option>";
while($k = mysqli_fetch_array($kota)){
    echo "<option value=\"".$k['id_kabkot']."\">".$k['nama_kabkot']."</option>\n";
}
?>
