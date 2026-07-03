<?php
session_start();

$username = $_SESSION['username'] ?? '';
$no_phone = $_SESSION['no_phone'] ?? '';
$email    = $_SESSION['email'] ?? '';


if($username == ""){
    header("Location: ../login.php");
    exit;
}