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
        <h2>Create Account</h2>
        <form action="sv_pendaftaran.php" method="post" name="form">
            <div class="daftar_form">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="username">
            </div>
            <div class="daftar_form">
                <label for="username">Password</label>
                <input type="password" id="password" placeholder="password">
            </div>
            <div class="daftar_form">
                <label for="username">Email</label>
                <input type="email" id="email" placeholder="email">
            </div>
            <div class="daftar_form">
                <label for="username">No Phone</label>
                <input type="number" id="phone" placeholder="phone">
            </div>
            <button type="submit">Create Account</button>
            <p>Already have a account? <a href="login.php">Login</a></p>
        </form>
    </section>
</body>
</html>