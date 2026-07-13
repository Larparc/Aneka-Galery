<?php
session_start();

$username = $_SESSION['username'] ?? '';
$no_phone = $_SESSION['no_phone'] ?? '';
$email    = $_SESSION['email'] ?? '';
$user_id = $_SESSION['user_id'] ?? '';


if($username == ""){
    echo "<script>
    alert('Anda belum login, silakan login terlebih dahulu!');
    window.location.href = '../login.php';
    </script>";
    exit;
}