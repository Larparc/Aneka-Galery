<?php
date_default_timezone_set('Asia/Jakarta');

$host = "localhost";
$user = "root";
$pass = "";
$db = "aneka galery";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
die("Koneksi database gagal: " . mysqli_connect_error());
}

?>