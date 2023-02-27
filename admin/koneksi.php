<?php 
//Membuat koneksi ke db

$koneksi=mysqli_connect("localhost","root","","db_website");

//Membuat fungsi query untuk ambil data
function query($query){
	global $koneksi;

	$result=mysqli_query($koneksi, $query);
	$rows=[];
	while ($row=mysqli_fetch_assoc($result)) {
		$rows[]=$row;
	}
	return $rows;
}

//Buat Fungsi Simpan
function simpan($data){
	global $koneksi;

	//Tampung data dari input.php
	$Nama = $_POST['Nama'];
	$NIK = $_POST['NIK'];
	$Alamat = $_POST['Alamat'];
	$service = $_POST['service'];
	$Keterangan = $_POST['Keterangan'];

	//Simpan Data
	$query = "INSERT INTO tb_input
	values 
	('','$Nama','$NIK','$Alamat','$service','$Keterangan')";

	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}


//FUNGSI REGISTRASI
function registrasi($data){
	global $koneksi;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi,$data["password"]);



	//cek apakah username sudah ada atau belum

	$result = mysqli_query($koneksi, "SELECT username FROM tb_user WHERE username = '$username'");

	if (mysqli_fetch_assoc($result)) {
		echo "
			<script>
			alert('username sudah terdaftar, Silahkan Coba lagi.');
			</script>
		";
		return false;
	}


	//enkripsi password (ada dua yaitu md5 dan hash )

	$password = password_hash($password, PASSWORD_DEFAULT);

	//tambahkan user baru ke data base

	mysqli_query($koneksi, "INSERT INTO tb_user values 
		('','$username','$password')");

		return mysqli_affected_rows($koneksi);
}

 ?>