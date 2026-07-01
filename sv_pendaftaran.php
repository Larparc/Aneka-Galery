<?php
include 'koneksi.php';

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');

$sql = "INSERT INTO profiles
(
    role_id,
    username,
    password,
    phone_number,
    email
)
VALUES
(
    2,
    '$username',
    md5('$password'),
    '$phone',
    '$email'
)";

$query = mysqli_query($conn, $sql);

header("Location: index_login.php");
exit;
?>