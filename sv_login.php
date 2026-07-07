<?php
session_start();

include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT *
        FROM profiles
        WHERE username='$username'
        AND password='$password'";

$query = mysqli_query($conn, $sql);

$num = mysqli_num_rows($query);

if($num > 0){

    $row = mysqli_fetch_assoc($query);

    $_SESSION['username'] = $username;
    $_SESSION['user_id']  = $row['user_id'];
    $_SESSION['role_id']  = $row['role_id'];
    $_SESSION['no_phone'] = $row['no_phone'];
    $_SESSION['email']    = $row['email'];

    if($row['role_id'] == 1){
        header("Location: admin/panel.php");
        exit;
    }else{
        header("Location: index_login.php");
        exit;
    }

}else{

    header("Location: login.php");
    exit;

}
?>