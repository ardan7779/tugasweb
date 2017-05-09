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
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
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
	
	<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#propinsi").change(function(){
    var propinsi = $("#propinsi").val();
    $.ajax({
        url: "ambilkota.php",
        data: "propinsi="+propinsi,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });
  $("#kota").change(function(){
    var kota = $("#kota").val();
    $.ajax({
        url: "ambilkecamatan.php",
        data: "kota="+kota,
        cache: false,
        success: function(msg){
            $("#kec").html(msg);
        }
    });
  });
});
 
</script>
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
				<a class="navbar-brand visible-xs-block visible-sm-block" href="#">Manajemen User</a>
				<a class="navbar-brand hidden-xs hidden-sm" href="#">Manajemen User</a>
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
			<h2>Manajemen User &raquo; Edit Data User</h2>
			<hr />
			
			<?php
			$nis = $_GET['nis'];
			$sql = mysqli_query($koneksi, "SELECT * FROM santri WHERE nis='$nis'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				
				$nama		= $_POST['nama'];
				$tmp		= $_POST['tmp'];
				$tgl		= $_POST['tgl'];
				$nama_wali	= $_POST['nama_wali'];
				$telp		= $_POST['telp'];
				$jk			= $_POST['jenis_kelamin'];
				$sekolah	= $_POST['sekolah'];
				$nama_komplek	= $_POST['nama_komplek'];
				$kamar		= $_POST['kamar'];
				$provinsi 	= $_POST['provinsi'];
				$kota_atau_kabupaten	= $_POST['kota'];
				$kecamatan 	= $_POST['kec'];
				$alamat		= $_POST['alamat'];
				$status		= $_POST['status'];
				
				$update = mysqli_query($koneksi, "UPDATE  santri SET nama='$nama', tempat_lahir='$tmp', tanggal_lahir='$tgl', jenis_kelamin = '$jk', telp = '$telp', sekolah = '$sekolah', nama_komplek = '$nama_komplek', nama_wali = '$nama_wali', kamar = '$kamar', provinsi = '$provinsi', kota_atau_kabupaten = '$kota_atau_kabupaten', kecamatan = '$kecamatan', alamat = '$alamat', status='$status' WHERE nis = '$nis'") or die(mysqli_error());
				if($update){
					header("Location: edit.php?nis=".$nis."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger">Data gagal disimpan, silahkan coba lagi.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success">Data berhasil disimpan.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">NIS</label>
					<div class="col-sm-2">
						<input type="text" name="nis" class="form-control" value="<?php echo $row['nis']; ?>" placeholder="NIS" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NAMA LENGKAP</label>
					<div class="col-sm-4">
						<input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>" placeholder="NAMA LENGKAP" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">TEMPAT & TANGGAL LAHIR</label>
					<div class="col-sm-3">
						<input type="text" name="tmp" class="form-control" value="<?php echo $row['tempat_lahir']; ?>" placeholder="TEMPAT LAHIR" required>
					</div>
					<div class="col-sm-2">
						<div class="input-group date" data-provide="datepicker">
							<input type="text" name="tgl" class="form-control" value="<?php echo $row['tanggal_lahir']; ?>" placeholder="0000-00-00">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NAMA WALI</label>
					<div class="col-sm-3">
						<input type="text" name="nama_wali" class="form-control" value="<?php echo $row['nama_wali']; ?>" placeholder="Nama Wali" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Telepon / Hp</label>
					<div class="col-sm-3">
						<input type="text" name="telp" class="form-control" value="<?php echo $row['telp']; ?>" placeholder="Telepon" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">JENIS KELAMIN</label>
					<div class="col-sm-2">
						<select name="jenis_kelamin" class="form-control" required>
							<option value="">JENIS KELAMIN</option>
							<option value="Laki-Laki" <?php if($row['jenis_kelamin'] == 'Laki-Laki'){ echo 'selected'; } ?>>LAKI-LAKI</option>
							<option value="Perempuan" <?php if($row['jenis_kelamin'] == 'Perempuan'){ echo 'selected'; } ?>>PEREMPUAN</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Sekolah / Kampus</label>
					<div class="col-sm-3">
						<input type="text" name="sekolah" class="form-control" placeholder="Sekolah/Kampus" value="<?php echo $row['sekolah']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">PROVINSI</label>
					<div class="col-sm-3">
						<select name="provinsi" id="propinsi"class="form-control" required>
							<option value=''>PROVINSI</option>
							<?php
							//mengambil nama-nama propinsi yang ada di database
							$propinsi = mysqli_query($koneksi, "SELECT * FROM prov ORDER BY nama_prov");
							while($p = mysqli_fetch_array($propinsi)){
							echo "<option value='$p[id_prov]'>$p[nama_prov]</option>\n";
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">KABUPATEN</label>
					<div class="col-sm-3">
						<select name="kota" id="kota" class="form-control" required>
							<option >KABUPATEN / KOTA</option>
							<?php
							//mengambil nama-nama propinsi yang ada di database
							$kota = mysqli_query($koneksi, "SELECT * FROM kabkot ORDER BY nama_kabkot");
							while($p=mysqli_fetch_array($propinsi)){
							echo "<option value=\"$p[id_kabkot]\">$p[nama_kabkot]</option>\n";
							}
							?>

						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">KECAMATAN</label>
					<div class="col-sm-3">
						<select name="kec" id="kec" class="form-control" required>
							<option>KABUPATEN / KOTA</option>
							
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">ALAMAT DETAIL</label>
					<div class="col-sm-6">
						<textarea name="alamat" class="form-control"placeholder="ALAMAT LENGKAP (Rt, Rw, Jalan, Desa)"  required><?php echo $row['alamat']; ?></textarea>
					</div>
				</div>
					<div class="form-group">
					<label class="col-sm-3 control-label">KOMPLEK ASRAMA</label>
					<div class="col-sm-3">
						<input type="text" name="nama_komplek" class="form-control" placeholder="Komplek Asrama" value="<?php echo $row['nama_komplek']; ?>" required>
					</div>
				</div>
					<div class="form-group">
					<label class="col-sm-3 control-label">KAMAR</label>
					<div class="col-sm-3">
						<input type="text" name="kamar" class="form-control" placeholder="Kamar Tinggal" value="<?php echo $row['kamar']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">STATUS</label>
					<div class="col-sm-2">
						<select name="status" class="form-control" required>
							<option value="">STATUS</option>
							<option value="1" <?php if($row['status'] == '1'){ echo 'selected'; } ?>>AKTIF</option>
							<option value="2" <?php if($row['status'] == '2'){ echo 'selected'; } ?>>TIDAK AKTIF</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-primary" value="SIMPAN">
						<a href="index.php" class="btn btn-warning">BATAL</a>
					</div>
				</div>
			</form>
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
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'yyyy-mm-dd',
	})
	</script>
</body>
</html>