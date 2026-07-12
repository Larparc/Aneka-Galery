<?php
include 'koneksi.php';

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');

$hashedPassword = md5($password);

$stmt = mysqli_prepare($conn, "INSERT INTO profiles (role_id, username, password, no_phone, email) VALUES (2, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssss", $username, $hashedPassword, $phone, $email);

try {
    mysqli_stmt_execute($stmt);
    header("Location: login.php");
    exit;
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) {
        $pesan = "Username '$username' sudah dipakai, silakan pilih username lain.";
    } else {
        $pesan = "Terjadi kesalahan, silakan coba lagi.";
    }
    // tampilkan popup lalu balik ke halaman daftar
    echo "<script>
        alert(" . json_encode($pesan) . ");
        window.location.href = 'pendaftaran_form.php';
    </script>";
    exit;
}
?>