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
            <h2>Login</h2>
            <form action="sv_login.php" method="post" name="form">
                <div class="login_form">
                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="username">
                </div>
                <div class="login_form">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="password">
                </div>
                <button type="submit">Login</button>
                <p>Dont have a account?
                    <a href="pendaftaran_form.php">Create Account</a>
                </p>
            </form>
        </section>
    </body>
</html>