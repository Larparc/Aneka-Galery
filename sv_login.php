<?php
session_start();

include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT *
        FROM profiles
        WHERE username='$username'
        AND password='$password'";

$query = mysqli_query($conn, $sql);

$num = mysqli_num_rows($query);

if($num > 0){

    $_SESSION['username'] = $username;

    header("Location: index.php");
    exit;

}else{

    header("Location: index.php");
    exit;

}
?>