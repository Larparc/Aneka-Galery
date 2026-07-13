<?php
session_start();

$username = $_SESSION['username'] ?? '';
$no_phone = $_SESSION['no_phone'] ?? '';
$email    = $_SESSION['email'] ?? '';
$user_id = $_SESSION['user_id'] ?? '';
$role_id = $_SESSION['role_id'] ?? '';


if($username == "" or $role_id == 2){
    header("Location: ../login.php");
    exit;
}