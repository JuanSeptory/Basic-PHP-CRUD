<?php
session_start();
require 'Functions.php';

//cek dulu ada tidak cookienya

if (isset($_COOKIE["id"]) && isset($_COOKIE["key"]) ) {
	$id = $_COOKIE['id'];
	$key= $_COOKIE['key'];

	//ambil username berdasarkan id
		$result = mysqli_query("SELECT Username FROM user WHERE Id = $id");

		//masukan dlm variable $row, username nya
		$row = mysqli_fetch_assoc($result);

		//cek cookie dan username nya
		if ($key === hash('sha256', $row['Username'])) {
		$_SESSION['login'] = true;
	}
}


//cek kalo sudah ada session, maka akan langsung pindah ke halaman index 
if (isset($_SESSION["login"]) ) {
	header("location: index.php");
	exit();
}



if (isset($_POST["login"]) ) {
	
	$username = $_POST["username"];
	$password = $_POST["password"];

//cek apakah ada username di database atau tidak
$result = mysqli_query($conn,"SELECT * FROM user WHERE Username = '$username'");

	
//cek apakah ada baris yang dikembalikan dari $result, kalo ada berarti username ada di databases	
	if (mysqli_num_rows($result) === 1) { 

	//cek passsword
			$row = mysqli_fetch_assoc($result); //dlm $row sdh ada datanya id, username, password

//cek password_verify
			// kebalikan dari password_hash
		if (password_verify($password, $row["Password"]) ) { //parameternya ada 2, 1 string yg sdh diacak 1 lagi sring yg blm diacak

	//set session
		$_SESSION["login"] = true; //dikasih nilai true jika session nya ada

	//cek remember me 
		if (isset($_POST["remember"]) ) {
			//buat cookie
			setcookie('id', $row['Id'], time() +60); //id & key adlh nama dari cookie. sha256 adlh algortima untuk yg digunakan untuk mengencriptsi
			setcookie('key',hash('sha256', $row['Username'], time() +60)); // hash untuk mengencriptsi usernamenya yg diambil dari database
		}


			header("Location: index.php");
			exit;
}

	}

	$error = true;

}

?>

<!DOCTYPE html>
<html>
<head>
	<title> Halaman Login </title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
	<h1>Halaman Login</h1>
<?php if (isset($error) ): ?>
	<p style="color: red; font-style: italic;"> usename atau password salah</p>

<?php endif; ?>
	
<form action="" method="post" class="form">

	<label for="username">Username:</label>
	<input type="text" name="username" id="username" placeholder="Masukkan Username">
	<br>

	<label for="password">Password :</label>
	<input type="password" name="password" id="password" placeholder="Masukkan Password">
	<br>

	<input type="checkbox" name="remember" id="remember">
	<label for="remember" class="remember">Remember Me</label>

	<br>
	<button type="submit" name="login">Login</button>

</form>

</body>
</html>