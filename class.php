<?php
	class MyPDO
	{
	
		private $host = "localhost";
		private $dbname = "siada";
		private $user="root";
		private $password="";
		private $port="3306";

		private $con;

		public function __construct()
		{
			try {
				$this->con = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8", $this->user, $this->password);
			} catch (PDOException $e) {
				echo "koneksi gagal";
			}
		}

		public function tampil_data(){
			$query = $this->con->prepare("SELECT * FROM santri ORDER BY nis ASC");
			$query->execute();

			$data = $query->fetchAll(PDO::FETCH_ASSOC);

			return $data;

			$query->closeCursor();

			unset($data);
		}

		public function tampil_data_by_nis($nis){
			$query = $this->con->prepare("SELECT * FROM santri WHERE nis = ?");
			$query->execute(array($nis));

			$data = $query->fetchAll(PDO::FETCH_ASSOC);

			return $data;

			$query->closeCursor();

			unset($data);
			unset($nis);
		}

		public function tampil_data_by_status($urut){
			$query = $this->con->prepare("SELECT * FROM santri WHERE status= ? ORDER BY nis ASC");
			$query->execute(array($urut));

			$data = $query->fetchAll(PDO::FETCH_ASSOC);

			return $data;

			$query->closeCursor();

			unset($data);
			unset($urut);
		}

		public function tampil_data_profinsi(){
			$query = $this->con->prepare("SELECT * FROM prov ORDER BY nama_prov");
			$query->execute();

			$data = $query->fetchAll(PDO::FETCH_ASSOC);

			return $data;

			$query->closeCursor();

			unset($data);
		}

		public function tampil_data_kabkot(){
			$query = $this->con->prepare("SELECT * FROM kabkot ORDER BY nama_kabkot");
			$query->execute();

			$data = $query->fetchAll(PDO::FETCH_ASSOC);

			return $data;

			$query->closeCursor();

			unset($data);
		}

		public function tampil_data_propinsi_by_nis($nis){
			$query = $this->con->prepare("SELECT nama_prov from prov where id_prov = (select provinsi from santri where nis = ?)");
			$query->execute(array($nis));

			$data = $query->fetchAll(PDO::FETCH_ASSOC);

			return $data;

			$query->closeCursor();

			unset($data);
			unset($nis);
		}

		public function tampil_data_kabkot_by_nis($nis){
			$query = $this->con->prepare("SELECT nama_kabkot from kabkot where id_kabkot = (select kota_atau_kabupaten from santri where nis = ?)");
			$query->execute(array($nis));

			$data = $query->fetchAll(PDO::FETCH_ASSOC);

			return $data;

			$query->closeCursor();

			unset($data);
			unset($nis);
		}

		public function tampil_data_kecamatan_by_nis($nis){
			$query = $this->con->prepare("SELECT nama_kec from kec where id_kec = (select kecamatan from santri where nis = ?)");
			$query->execute(array($nis));

			$data = $query->fetchAll(PDO::FETCH_ASSOC);

			return $data;

			$query->closeCursor();

			unset($data);
			unset($nis);
		}

		public function ubah_data($nama, $tmp, $tgl, $jk, $telp, $sekolah, $nama_komplek, $nama_wali, $kamar, $provinsi, $kota_atau_kabupaten, $kecamatan, $alamat, $status, $nis){

			$query = $this->con->prepare("UPDATE santri SET nama = ?, tempat_lahir = ?, tanggal_lahir = ?, jenis_kelamin = ?, telp = ?, sekolah = ?, nama_komplek = ?, nama_wali = ?, kamar = ?, provinsi = ?, kota_atau_kabupaten = ?, kecamatan = ?, alamat = ?, status = ? WHERE nis = ?");
			$query->execute(array($nama, $tmp, $tgl, $jk, $telp, $sekolah, $nama_komplek, $nama_wali, $kamar, $provinsi, $kota_atau_kabupaten, $kecamatan, $alamat, $status, $nis));
		
			$query->closeCursor(); 

			unset($nama, $tmp, $tgl, $jk, $telp, $sekolah, $nama_komplek, $nama_wali, $kamar, $provinsi, $kota_atau_kabupaten, $kecamatan, $alamat, $status, $nis);	
		}

		public function hapus_data($nis){
			$query = $this->con->prepare("DELETE FROM santri WHERE nis = ? ");
			$query->execute(array($nis));

			$query->closeCursor(); 	

			unset($nim_mhs);	
		}

	}

	$objek = new MyPDO();

?>