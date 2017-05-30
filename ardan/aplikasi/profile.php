<?php
// include("koneksi.php");
include("class.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Manajemen</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
	
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
	
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<header>
		<div class="jumbotron" >
			<div class="container" >
				<h1> Manajemen Santri Anwarul Huda</h1>

			</div>
		</div>
	</header>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand visible-xs-block visible-sm-block" href="#">Manajemen Santri</a>
				<a class="navbar-brand hidden-xs hidden-sm" href="#">Manajemen Santri</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Beranda</a></li>
					<li><a href="add.php">Tambah Data</a></li>
					<li><a href="datakamar.php">Data Kamar</a></li>
					<li><a href="add_kamar.php">Tambah Data Kamar</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Manajemen User &raquo; Profile Santri</h2>
			<hr />
			
			<?php
			$nis = $_GET['nis'];
			
			if(isset($_GET['aksi']) == 'delete'){
				$objek->hapus_data($nis);
				if ($objek) {
					echo '<div class="alert alert-danger">Data berhasil dihapus.</div>';
				} else {
					echo '<div class="alert alert-info">Data gagal dihapus.</div>';
				}
			}
			?>

			<?php

				$data_array = $objek->tampil_data_by_nis($nis);

				foreach ($data_array as $row) {	
			?>
			
			<table class="table table-striped">
				<tr>
					<th width="20%">NIS</th>
					<td><?php echo $row['nis']; ?></td>
				</tr>
				<tr>
					<th>NAMA LENGKAP</th>
					<td><?php echo $row['nama']; ?></td>
				</tr>
				<tr>
					<th>TEMPAT LAHIR</th>
					<td><?php echo $row['tempat_lahir']; ?></td>
				</tr>
				<tr>
					<th>Tanggal Lahir</th>
					<td><?php echo $row['tanggal_lahir']; ?></td>
				</tr>
				<tr>
					<th>Nama Wali</th>
					<td><?php echo $row['nama_wali']; ?></td>
				</tr>

				<tr>
					<th>Telepon</th>
					<td><?php echo $row['telp']; ?></td>
				</tr>
				<tr>
					<th>Jenis Kelamin</th>
					<td><?php echo $row['jenis_kelamin']; ?></td>
				</tr>
				<tr>
					<th>Sekolah</th>
					<td><?php echo $row['sekolah']; ?></td>
				</tr>
				<tr>
					<th>Komplek</th>
					<td><?php echo $row['nama_komplek']; ?></td>
				</tr>
				<tr>
					<th>Kamar</th>
					<td><?php echo $row['kamar']; ?></td>
				</tr>
				<tr>
					<th>Provinsi</th>
					<?php
						$data_prov = $objek->tampil_data_propinsi_by_nis($nis);
						foreach ($data_prov as $p) {
							echo "<td>$p[nama_prov]</td>";
						}
					?>
					
				</tr>
				<tr>
					<th>Kota / Kabupaten</th>
					<?php					
						$data_kabkot = $objek->tampil_data_kabkot_by_nis($nis);
						foreach ($data_kabkot as $k) {
							echo "<td>$k[nama_kabkot]</td>";
						}
					?>
				</tr>
				<tr>
					<th>Kecamatan</th>
					<?php
							
						$data_kecamatan = $objek->tampil_data_kecamatan_by_nis($nis);
						foreach ($data_kecamatan as $kc) {

							echo "<td>$kc[nama_kec]</td>";
						}
					?>
				</tr>
				<tr>
					<th>Alamat</th>
					<td><?php echo $row['alamat']; ?></td>
				</tr>
				<tr>
					<th>Status</th>
					<td><?php if($row['status'] == 1){ echo '<span class="label label-success">Aktif</span>'; }else{ echo '<span class="label label-warning">Tidak Aktif</span>'; } ?></td>
				</tr>
			</table>

			<?php
				};
			?>
			
			<a href="index.php" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>Beranda</a>
			<a href="edit.php?nis=<?php echo $row['nis']; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Data</a>
			<a href="profile.php?aksi = delete & nis = <?php echo $row['nis']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus Data</a>
		</div>
	</div>
	<div class="row-fluid">
			<div class="span12">
			  <div class="row-fluid">
				<div class="alert alert-info">
					<a name="contact"></a>
				  <h2 align="center">Anwarul Huda</h2>
				  <p class="text-info" align="center">Pesantren & Diniyah</p>
				  <p align="center">&copy; <a href="http://kureview">Tim IT 2014</a>&nbsp<?php echo date("Y");?></p>
				</div><!--/span-->
			  </div><!--/row-->
			</div><!--/span-->
	</div><!--/row-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>