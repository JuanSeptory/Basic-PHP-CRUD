<?php
//menghubungkan databases ke php menggunakan mysqli

//parameter pertama untuk server databases disimpan
//parameter kedua  login sebagai admin
//parameter ketiga password (kosong karna root)
//parameter keempat databases yang digunakan
// test komen
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query){
	//ambil data dari tabel daftar_pemain menggunakan query sql
	global $conn;
$result = mysqli_query($conn, $query);
$rows = [];
 while ( $row = mysqli_fetch_assoc($result) ) {
	$rows[] = $row;
}
	return $rows;
}


function tambah($POST){
	global $conn;
//untuk mempermudah ambil data dari tiap elemen
//untuk itu dibuat variabel pembantu
//htmlspecialchars() digunakan untuk menangkal user yang ingin menginput script html
	$Nama = htmlspecialchars($_POST["Nama"]);
	$Age = htmlspecialchars($_POST["Age"]);
	$Club = htmlspecialchars($_POST["Club"]);

// upload gambar
	$Gambar = upload ();
	if (!$Gambar) {		// jika gambar tidak disi maka akan mengembalikan false
		return false; 	// dan $query tidak akan dieksekusi
	}


//query untuk insert data
$query = "INSERT INTO daftar_pemain VALUES ('', '$Nama', '$Age', '$Club', '$Gambar')";

mysqli_query ($conn, $query);	//masukkan parameter koneksi database & query yang akan digunakan
	return mysqli_affected_rows($conn); //mengembailkan jumlah baris yang ditambahkan

}

function upload(){

//untuk mengecek namafile,ukuran,error,dan tmpname saat mau apload gambar

	$namaFile = $_FILES ['Gambar']['name'];	//$_FILES adlh variable superglobal untuk file
	$ukuranFile = $_FILES['Gambar']['size']; // dlm $_FILES terdapat name,size,error,dan tmp_name
	$error = $_FILES['Gambar']['error']; // $_FILES adlh array multydimensi
	$tmpName = $_FILES['Gambar']['tmp_name']; //['Gambar'] dpt dari name pada form tambah data pemain baru

//cek apakah tidak ada gambar yang diupload 
//jika error === 4 (maka blm ada gambar yang diisi)
	if ($error === 4) {
		echo "<script>
						alert('pilih gambar terlebih dahulu!');
			</script>";

	return false;
		}

//cek apakah yang diupload adalah gambar
	$ekstensiGambarvalid = ['jpg','jpeg','png']; // ekstensi gambar yg diijinkan, boleh diinput
	$ekstensiGambar = explode('.', $namaFile); //explode untuk memecah string, ingat delimiter
	$ekstensiGambar = strtolower(end($ekstensiGambar)); //strtolower untuk memaksa inputan menjadi huruf kecil
															//end untuk mengambil bagian akhir dari inputan yang diijinkan

if (!in_array($ekstensiGambar, $ekstensiGambarvalid)) { //in_array(jarum, jerami)
					// untuk mengecek inputan yang dikirim sesuai tidak dengan yang diijinkan
	echo "<script>
					alert('yang anda upload bukan gambar!');
		</script>";

		return false;
}

//cek jika ukurannya terlalu besar
//ukuran gambar dihitung kilobyte
	if ($ukuranFile > 10000000) {
		echo "<script>
						alert('ukuran gambar terlalu besar!');
			</script>";

			return false;
	}

//ganerate nama gambar baru, jika user menginput nama gambar yang sama
// akan kembali ke bagian ekstansi gambar untuk mengecek apakah yang diupload itu gambar atau bukan
	$namaFileBaru = uniqid(); //agar namanya random
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

//lolos pengecekan, gambar siap diupload
//jadi gambarnya akan dimasukkan ke folder image dengan nama baru (jika user menginput nama gambar yang sama)

move_uploaded_file($tmpName, 'image/'. $namaFileBaru);

return $namaFileBaru; //supaya bisa di eksekusi, lihat //upload

}


function hapus($Id){
global $conn;
mysqli_query ($conn, "DELETE FROM daftar_pemain WHERE Id = $Id"); //menghapus mengikuti id

return mysqli_affected_rows ($conn);
}


function update($POST){
global $conn;

	$Id = $POST["Id"];
	$Nama = htmlspecialchars($_POST["Nama"]);
	$Age = htmlspecialchars($_POST["Age"]);
	$Club = htmlspecialchars($_POST["Club"]);
	$GambarLama = htmlspecialchars($_POST["GambarLama"]);

//cek apakah user pilih gambar baru atau tidak
if ($_FILES['Gambar']['error'] === 4) {
	$Gambar = $GambarLama;
	} 
	else {
		$Gambar = upload();
	}


//query untuk update data
$query =  "UPDATE daftar_pemain SET 
			Nama = '$Nama', 
			Age = '$Age',
			Club = '$Club',
			Gambar = '$Gambar'
			WHERE Id = $Id
			";
mysqli_query ($conn, $query);	//masukkan parameter koneksi database & query yang akan digunakan
	return mysqli_affected_rows($conn);
}


function cari($keyword){
	$query = "SELECT * FROM daftar_pemain WHERE
			Nama LIKE '%$keyword%' OR 
			Age LIKE '%$keyword%' OR
			Club LIKE '%$keyword%'

	";

return query($query);

}

function registrasi ($data){
global $conn;


$username = strtolower(stripcslashes($data["username"] ) ); //stripcslashes  membersikan backslahes
$password = mysqli_real_escape_string($conn, $data["password"] ); //mysqli_real_escape_string untuk tanda kutip password aman
$password2 = mysqli_real_escape_string($conn, $data["password2"] ); //membutuhkan 2 parameter (koneksi dan post)

// cek apakah username sudah digunakan belum
$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

if (mysqli_fetch_row($result) ) { //$result sebagai variable penampung
	echo "
				<script>
					alert('username sudah terdaftar !');
				</script>
				";
	return false;
}

//cek konfirmasi password
if ($password !== $password2) {
	echo "
				<script>
					alert('Konfirmasi Password Tidak Sesuai!');
				</script>
				";
	return false;
}

//enkripsi password
//password_hash untuk mengenkripsi password (lihat varian enkripsi di web php)
$password = password_hash($password, PASSWORD_DEFAULT);

//tambahkan user baru ke database
mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

return mysqli_affected_rows($conn);



}
?>
