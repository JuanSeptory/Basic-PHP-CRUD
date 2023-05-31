<?php
session_start();

//cek apakah ada session, jika belum kembalikan ke halaman login
if (!isset($_SESSION["login"]) ) {
	header("location: login.php");
	exit();
}


require 'Functions.php';

// ambil data yang data di URL
$id = $_GET["Id"];


// query data daftar pemain berdasarkan id
$Daftarpemain = query("SELECT * FROM daftar_pemain WHERE Id = $id")[0];

//[0] karna menggunakan query dsini, ingat rows & row di fuctions.php


//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"]) ) {
	


//cek apakah data berhasil ditambahkan atau tidak
	if (update ($_POST) > 0 ){
			echo "
				<script>
					alert('Data Berhasil Update!');
					document.location.href = 'index.php'
				</script>
				";
	}
if (update($_POST =0)) {
			echo "
				<script>
					alert('Tidak Ada Data Yang Berubah!');
					document.location.href = 'index.php'
				</script>
				";
	}	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Data</title>
<link rel="stylesheet" type="text/css" href="css/update.css">
</head>
<body>
	<h1>Update Data Pemain</h1>

	<form action="" method="Post" enctype="multipart/form-data">
	
	<input type="hidden" name="Id" value="<?= $Daftarpemain["Id"]; ?>">
	<input type="hidden" name="GambarLama" value="<?= $Daftarpemain["Gambar"]; ?>">
	<br>
		
	<label for="Nama">Nama:</label>
	<input type="text" name="Nama" id="Nama"required
	value="<?= $Daftarpemain["Nama"]; ?>">
	<br>

		
	<label for="Age">Age:</label>
	<input type="number" name="Age" id="Age"required
	value="<?= $Daftarpemain["Age"]; ?>">
	<br>
		
	<label for="Club">Club:</label>
	<input type="text" name="Club" id="Club"required
	value="<?= $Daftarpemain["Club"]; ?>">
	<br>

	<label for="Gambar">Gambar:</label> <br>
	<img src="image/<?= $Daftarpemain['Gambar']; ?>" width = "50"> <br>
	<input type="file" name="Gambar" id="Gambar">
	<br>

	<button type="submit" name="submit">Update Data Pemain</button>




	</form>

</body>
</html>