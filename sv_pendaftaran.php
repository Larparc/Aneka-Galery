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
    no_phone,
    email
)
VALUES
(
    2,
    '$username',
    '$password',
    '$phone',
    '$email'
)";

$query = mysqli_query($conn, $sql);

header("Location: index.php");
exit;
?>