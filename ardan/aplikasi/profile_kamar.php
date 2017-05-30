<?php
include("koneksi.php");
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
			$namakamar = $_GET['nama_kamar'];
			
			$sql = mysqli_query($koneksi, "SELECT * FROM data_kamar WHERE nama_kamar='$namakamar'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: datakamar.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			if(isset($_GET['aksi']) == 'delete'){
				$delete = mysqli_query($koneksi, "DELETE FROM data_kamar WHERE nama_kamar='$namakamar'");
				if($delete){
					echo '<div class="alert alert-info">Data berhasil dihapus.</div>';

				}else{
					echo '<div class="alert alert-danger">Data gagal dihapus .</div>';
				}
			}
			?>
			
			<table class="table table-striped">
				<tr>
					<th width="20%">NAMA KAMAR</th>
					<td><?php echo $row['nama_kamar']; ?></td>
				</tr>
				<tr>
					<th>NAMA KOMPLEK</th>
					<td><?php echo $row['nama_komplek']; ?></td>
				</tr>
				<tr>
					<th>KEADAAN KAMAR</th>
					<td><?php echo $row['keadaan_kamar']; ?></td>
				</tr>
				<tr>
					<th>KAPASITAS KAMAR</th>
					<td><?php echo $row['kapasitas']; ?></td>
				</tr>
				<tr>
					<th>JUMLAH PENGHUNI SEKARANG</th>
					<td><?php echo $row['penghuni_sekarang']; ?></td>
				</tr>
				<tr>
					<th>JUMLAH LEMARI</th>
					<td><?php echo $row['jumlah_lemari']; ?></td>
				</tr>
				
			</table>
			
			<a href="datakamar.php" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>Beranda</a>
			<a href="edit_kamar.php?namakamar=<?php echo $row['nama_kamar']; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Data</a>
			<a href="profile_kamar.php?aksi = delete & datakamar = <?php echo $row['data_kamar']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus Data</a>
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