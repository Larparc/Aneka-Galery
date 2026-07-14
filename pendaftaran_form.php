<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create - Aneka Galery</title>
    <link rel="shortcut icon" href="img/anekagalery_32x32.png">
    <link rel="stylesheet" href="css/daftar.css">
</head>
<body>

<section class="daftar">
    <div class="daftar_left">
        <h2>Create Account</h2>
        <form action="sv_pendaftaran.php" method="post" name="form">

            <div class="daftar_form">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>
            </div>

            <div class="daftar_form">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Masukkan password" minlength="8" required>
            </div>

            <div class="daftar_form">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Masukkan email" required>
            </div>

            <div class="daftar_form">
                <label for="phone">No Phone</label>
                <input type="text" name="phone" placeholder="Masukkan nomor telepon" required>
            </div>

            <button type="submit">Create Account</button>

        </form>
    </div>
    <div class="daftar_right">
        <img src="img/LOGO ANEKA GALERI PRINTING.png" alt="Aneka Galeri" class="daftar_logo">
        <h2>Sudah Punya Akun?</h2>
        <p>Masuk kembali untuk mengakses fitur eksklusif dan<br>
        seluruh keuntungan yang telah menanti Anda.<br>
        Yuk, lanjutkan perjalanan Anda bersama kami.</p>
        <a href="login.php">Login</a>
    </div>

</section>
</body>
</html>