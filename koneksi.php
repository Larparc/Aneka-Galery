<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "nyaw";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi DataBase Gagal: " . mysqli_connect_error());
}

?>