<?php
include "security.php";
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: account.php");
    exit;
}

$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$phone    = trim($_POST['no_phone'] ?? '');
$roleId   = isset($_POST['role_id']) ? (int) $_POST['role_id'] : 2;
$password = trim($_POST['password'] ?? '');

if ($username === '' || $email === '' || $phone === '' || strlen($password) < 8 || !in_array($roleId, [1, 2], true)) {
    header("Location: account.php?status=error");
    exit;
}

$hashed = md5($password);

$stmt = mysqli_prepare($conn, "INSERT INTO profiles (role_id, username, password, no_phone, email) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "issss", $roleId, $username, $hashed, $phone, $email);

if (mysqli_stmt_execute($stmt)) {
    header("Location: account.php?status=added");
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
