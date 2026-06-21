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
                <input type="text" name="username" id="username" required>
            </div>

            <div class="daftar_form">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="daftar_form">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="daftar_form">
                <label for="phone">Phone Number</label>
                <input type="number" name="phone" id="phone" required>
            </div>

            <button type="submit">Create Account</button>
            <p>
                Already have an account?
                <a href="login.php">Login</a>
            </p>

        </form>
    </div>
    <div class="daftar_right"></div>

</section>
</body>
</html>