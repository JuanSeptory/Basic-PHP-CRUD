<?php  
session_start();

//cek apakah ada session, jika belum kembalikan ke halaman login
if (!isset($_SESSION["login"]) ) {
	header("location: login.php");
	exit();
}




require 'Functions.php';

$Id = $_GET["Id"];

if (hapus($Id) > 0) {
	echo "
	<script>
					alert('Data Berhasil Dihapus!');
					document.location.href = 'index.php'
				</script>
				";
} else{
	echo "
	<script>
					alert('Data Gagal Dihapus!');
					document.location.href = 'index.php'
				</script>
				";
}

?>