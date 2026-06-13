<?php
include 'koneksi.php';

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$no_phone = trim($_POST['no_phone'] ?? '');
$email = trim($_POST['email'] ?? 0);

$sql = "insert into registrations (username, password, no_phone, email) values(
    '$username',
    '$password',
    '$no_phone',
    '$email')";
$query = mysqli_query($conn, $sql);

header("Location: index.php");
exit;
?>