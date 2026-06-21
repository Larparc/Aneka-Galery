<?php
session_start();

$username = $_SESSION['username'];

if($username == ""){
    header("Location: ../index.php");
    exit;
}