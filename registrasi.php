<?php
session_start();
//cek dulu jika tidak ada session
//maka akan dikembalikan ke halaman login
if (!isset($_SESSION["login"]) ) {
	header("location: login.php");
	exit();
}

require 'Functions.php';

if (isset($_POST["register"])) {
	
	if (registrasi($_POST) > 0) {
		echo "
				<script>
					alert('User Baru Berhasil Ditambahkan!');
					alert('Silahkan Kembali Login');

				</script>
				";

	} else {
		echo mysqli_error($conn);
	}


}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
<link rel="stylesheet" type="text/css" href="css/registrasi.css">


</head>
<body>
	<h1> Halaman Registrasi	</h1>

<form action="" method="post" class="form">

	<label for="username"> Username:</label>
	 <input type="text" name="username" id="username" required autocomplete="off">
	<br>
	
	<label for="password">Password :</label>
	<input type="password" name="password" id="password" required autocomplete="off">
	<br>
	
	<label for="password2"> Konfirmasi:</label>
	<input type="password" name="password2" id="password2" required autocomplete="off">

	<br><br>


	<button type="submit" name="register">Register !</button>

</form>



</body>
</html>