<?php
session_start();

$username = $_SESSION['username'] ?? '';
$user_id  = $_SESSION['user_id'] ?? '';
$no_phone = $_SESSION['no_phone'] ?? '';
$email    = $_SESSION['email'] ?? '';

if($username == ""){
    header("Location: ../login.php");
    exit;
}