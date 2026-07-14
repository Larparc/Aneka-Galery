<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/anekagalery_32x32.png">
    <title>Login - Aneka Galery</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section class="login">
    <div class="login_left">
         <img src="img/LOGO ANEKA GALERI PRINTING.png" alt="Aneka Galeri" class="login_logo">
    </div>
    <div class="login_right">
        <h2>Login</h2>
        <form action="sv_login.php" method="post">
            <div class="login_form">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="login_form">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Sign In</button>
            <p>
                Don't have an account?
                <a href="pendaftaran_form.php">Create Account</a>
            </p>
        </form>
    </div>

</section>
</body>
</html>