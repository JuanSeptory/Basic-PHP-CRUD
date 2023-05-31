<?php
session_start();

// 3 script dibawah ini untuk memastikan bahwa session telah dihapus
$_SESSION = [];
session_destroy();
session_unset();

// menghapus cookie
//liat penjelasan cookie di file cookie
setcookie('id','', time() -3600);
setcookie('key','', time() -3600);

//untuk membuat berpindah ke halaman berikutnya
//setelah mengeksekusi session dan cookie
header("location: login.php");
exit();

?>