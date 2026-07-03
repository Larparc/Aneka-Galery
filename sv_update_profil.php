<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username']) || $_SESSION['username'] == "") {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$no_phone = trim($_POST['no_phone'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username == "") {
    header("Location: profil.php?status=error&msg=Nama tidak boleh kosong");
    exit;
}

$cek = mysqli_query($conn, "SELECT user_id FROM profiles WHERE username='" . mysqli_real_escape_string($conn, $username) . "' AND user_id != $user_id");
if (mysqli_num_rows($cek) > 0) {
    header("Location: profil.php?status=error&msg=Username sudah dipakai");
    exit;
}

$username_esc = mysqli_real_escape_string($conn, $username);
$email_esc    = mysqli_real_escape_string($conn, $email);
$phone_esc    = mysqli_real_escape_string($conn, $no_phone);

if ($password !== "") {
    $password_hash = md5($password);
    $sql = "UPDATE profiles
            SET username='$username_esc',
                email='$email_esc',
                no_phone='$phone_esc',
                password='$password_hash'
            WHERE user_id=$user_id";
} else {
    $sql = "UPDATE profiles
            SET username='$username_esc',
                email='$email_esc',
                no_phone='$phone_esc'
            WHERE user_id=$user_id";
}

$query = mysqli_query($conn, $sql);

if ($query) {
    $_SESSION['username'] = $username;
    $_SESSION['email']    = $email;
    $_SESSION['no_phone'] = $no_phone;

    header("Location: profil.php?status=success");
    exit;
} else {
    header("Location: profil.php?status=error&msg=" . urlencode(mysqli_error($conn)));
    exit;
}