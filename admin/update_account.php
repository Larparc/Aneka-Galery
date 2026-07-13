<?php
include "security.php";
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: account.php");
    exit;
}

$id       = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0;
$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$phone    = trim($_POST['no_phone'] ?? '');
$roleId   = isset($_POST['role_id']) ? (int) $_POST['role_id'] : 2;
$password = trim($_POST['password'] ?? '');

if ($id <= 0 || $username === '' || $email === '' || $phone === '' || !in_array($roleId, [1, 2], true)) {
    header("Location: account.php?status=error");
    exit;
}

if ($password !== '') {
    if (strlen($password) < 8) {
        header("Location: account.php?status=error");
        exit;
    }
    $hashed = md5($password);
    $stmt = mysqli_prepare($conn, "UPDATE profiles SET username=?, email=?, no_phone=?, role_id=?, password=? WHERE user_id=?");
    mysqli_stmt_bind_param($stmt, "sssisi", $username, $email, $phone, $roleId, $hashed, $id);
} else {
    $stmt = mysqli_prepare($conn, "UPDATE profiles SET username=?, email=?, no_phone=?, role_id=? WHERE user_id=?");
    mysqli_stmt_bind_param($stmt, "sssii", $username, $email, $phone, $roleId, $id);
}

if (mysqli_stmt_execute($stmt)) {
    // kalau yang diedit akun yang lagi login, sync session-nya juga
    if ($id === (int) ($_SESSION['user_id'] ?? 0)) {
        $_SESSION['username'] = $username;
        $_SESSION['email']    = $email;
        $_SESSION['no_phone'] = $phone;
        $_SESSION['role_id']  = $roleId;
    }
    header("Location: account.php?status=updated");
} else {
    if (mysqli_errno($conn) === 1062) {
        header("Location: account.php?status=duplicate");
    } else {
        header("Location: account.php?status=error");
    }
}
mysqli_stmt_close($stmt);
exit;
?>
