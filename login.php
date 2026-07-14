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
         <h2>Baru disini?</h2>
         <p>Ayo Daftar dan dapatkan akses dalam fitur-fitur <br> menarik dan keuntungan tanpa batas. <br>Daftar sekarang dan mulai jelajahi dunia baru dari kami.</p>
         <a href="pendaftaran_form.php">Create Account</a>
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

            <button type="submit">Login</button>
            <div class="terms">Dengan mendaftar, Anda menyetujui Syarat &amp; Ketentuan kami</div>
        </form>
    </div>

</section>
</body>
</html>