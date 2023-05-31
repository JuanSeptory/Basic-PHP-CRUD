<?php
session_start();

//cek apakah ada session, jika belum kembalikan ke halaman login
//jika tidak ada session balikan ke halaman login (perhatikan !isset)
if (!isset($_SESSION["login"]) ) {
	header("location: login.php");
	exit();
}


require 'Functions.php';

//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"]) ) {
	

//cek apakah data berhasil ditambahkan atau tidak
	if (tambah ($_POST) > 0 ){
			echo "
				<script>
					alert('Data Berhasil Ditambahkan!');
					document.location.href = 'index.php'
				</script>
				";
	}
	else{
			echo "
				<script>
					alert('Data Gagal Ditambahkan!');
					document.location.href = 'tambah data pemain baru.php'
				</script>
				";
	}
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Pemain</title>
	<link rel="stylesheet" type="text/css" href="css/tambah pemain.css">
</head>

<body>

	<h1>Tambah Data Pemain</h1>

	<form action="" method="Post" enctype="multipart/form-data">	<!-- action untuk menentukan datanya mau dikrim ke mana -->
	 <!-- enctype untuk menangkap file	-->
	 		
			<label for = "Nama">Nama: </label>	<!-- pada for dan name harus sama 	-->
		<input type="text" name="Nama" id = "Nama"required autocomplete="off">
			<br>
		
			<label for = "Age">Age: </label>
			<input type="number" name="Age"  id = "Age"required autocomplete="off"> <!-- required berfungsi untuk mengecek apakah form sdh diisi atau belum -->
			<br>

			<label for = "Club">Club: </label>
			<input type="text" name="Club"  id = "Club"required autocomplete="off">
			<br>
			
			<label for = "Gambar">Gambar: </label>
			<input type="file" name="Gambar"  id = "Gambar" autocomplete="off" width="50">
			<br><br>
	
			<button type="submit" name="submit">Tambah Data Pemain </button>


	</form>
</body>


</html>