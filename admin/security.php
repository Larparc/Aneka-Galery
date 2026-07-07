<?php
session_start();

$username = $_SESSION['username'] ?? '';
$no_phone = $_SESSION['no_phone'] ?? '';
$email    = $_SESSION['email'] ?? '';
$user_id = $_SESSION['user_id'] ?? '';


if($username == ""){
    header("Location: ../login.php");
    exit;
}