<?php
session_start();
//cek dulu jika tidak ada session
//maka akan dikembalikan ke halaman login
if (!isset($_SESSION["login"]) ) {
	header("location: login.php");
	exit();
}


require 'Functions.php';		//untuk memanggil  file function  

$daftar_pemain = query("SELECT * FROM daftar_pemain");

//tombol cari ditekan
if (isset($_POST["cari"])) {	//ingat method & name
	$daftar_pemain = cari($_POST["keyword"]); //dia akan mencari apa yg diketik user
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- cari cara gambar loding bisa dimuat
	<style> .loader{
			width: 100px;
			position: absolute;
			top: 175px;
			left: 285px;
			z-index: -1;
			opacity: 70px;
			
	}
	</style>
-->

</head>


<body>

	<h1>Daftar Pemain</h1>
<a href="logout.php" class="logout">Logout </a> <br><br>


<form action="" method="post"> 

	<input type="text" name="keyword" size="40" autofocus
	placeholder="masukkan keyword pencarian..." autocomplete="off" id="keyword">
	<!-- tombol cari lagi diihapus, cari cara untuk hiden 
	<img src="loading.gif" class="loader">
-->
</form>
<p> klick 
	<a href="registrasi.php" class="regist"> Registrasi</a>
 untuk membuat akun login</p>
<br> <!-- untuk baris baru -->

<a href="tambah data pemain baru.php" class="tambah"> tambah data pemain baru </a> <!-- untuk pindah ke halaman tambah pemain --> 

<br><br>
<div id="container">
<table border="1" cellpadding="10" cellspacing="0">

	<tr>
		<th>Aksi</th>
		<th>No.</th>	
		<th>Name</th>
		<th>Age</th>
		<th>Club</th>
		<th>Image</th>
	</tr>


	<?php $i= 1; ?>
	<?php foreach ($daftar_pemain as $row) : ?>
		
	
			<tr>
				
					<td>
						<a href="update.php?Id= <?php echo $row ["Id"]; ?>" class = "update">ubah ||</a>
						<a href="hapus data.php?Id= <?php echo $row["Id"]; ?>" onclick = "return confirm ('yakin?'); " class = "hapus">hapus</a>
					</td>

					<td><?php echo $row["Id"]; ?></td>
					<td><?php echo $row["Nama"]; ?></td>
					<td><?php echo $row["Age"]; ?></td>
					<td><?php echo $row["Club"]; ?></td>
					<td><img src ="image/<?php echo $row["Gambar"]; ?>" width = "50"></td>


			</tr>

	<?php $i++; ?>
	<?php endforeach; ?>



</table>
</div>
<script src="js/jquery-3.5.0.min.js"></script>
<script src="js/java.js"></script>

</body>
</html>
