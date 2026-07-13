<?php
session_start();

$username = $_SESSION['username'] ?? '';
$no_phone = $_SESSION['no_phone'] ?? '';
$email    = $_SESSION['email'] ?? '';
$user_id = $_SESSION['user_id'] ?? '';
$role_id = $_SESSION['role_id'] ?? '';


if($username == ""){
    echo "<script>
    alert('Anda belum login, silakan login terlebih dahulu!');
    window.location.href = '../login.php';
    </script>";
    exit;
} if($role_id == 2){
    echo "<script>
    alert('Anda tidak memiliki akses admin ke halaman ini!');
    window.location.href = '../index.php';
    </script>";
    exit;
}