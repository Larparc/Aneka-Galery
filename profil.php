<?php
include "koneksi.php";
include "admin/security.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/anekagalery_32x32.png"/>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
        <title>Profile - Aneka Galery</title>
        <link rel="stylesheet" href="css/profil.css">
    </head>
    <body>
        <section id="navbar">
            <a href="index_login.php">
                <img src="img/LOGO ANEKA GALERI PRINTING.png" id="logo"/>
            </a>
            <div class="hamburger" id="hamburger" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <nav class="menu" id="navMenu">
                <a href="index_login.php">Home</a>
                <a href="aboutus_login.php">About</a>
                <a href="service_login.php">Service</a>
                <a href="contact_login.php">Contact</a>
            </nav>
            <div class="profile">
                <b><?php echo $username; ?></b>
                <a href="profil.php">
                    <img src="img/foto.jpg" class="profile-img" alt="Profile Picture"/>
                </a>
            </div>
        </section>

        <?php if (isset($_GET['status'])): ?>
        <div
            class="profiletoast"
            id="profiletoast"
            style="color: <?php echo $_GET['status'] == 'success' ? 'green' : 'red'; ?>;">
            <?php if ($_GET['status'] == 'success'): ?>
            Profil berhasil diperbarui.
        <?php elseif ($_GET['status'] == 'error'): ?>
            Gagal update:
            <?php echo htmlspecialchars($_GET['msg'] ?? 'Terjadi kesalahan'); ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="profileedit">
            <form id="edit" action="sv_update_profil.php" method="POST">
                <div class="select">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="<?php echo htmlspecialchars($username); ?>"
                        required="required">

                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?php echo htmlspecialchars($email); ?>">

                    <label for="no_phone">No HP</label>
                    <input
                        type="text"
                        id="no_phone"
                        name="no_phone"
                        value="<?php echo htmlspecialchars($no_phone); ?>">

                    <label for="password">Password Baru</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Kosongkan jika tidak ingin mengganti password">

                    <div class="actions">
                        <button type="submit" class="btn save">Simpan Perubahan</button>
                        <button type="reset" class="btn reset">Reset</button>
                    </div>
                    <div class="actions">
                        <a href="admin/logout.php" class="btn logout">
                            Logout
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <footer class="footer">
            <div class="footer-container">
                <div class="footer-brand">
                    <h2>Aneka Galeri</h2>
                    <p>Your Trusted Printing Partner.</p>
                    <p>
                        Kami menyediakan layanan digital printing berkualitas tinggi dengan hasil cepat,
                        rapi, dan profesional.
                    </p>
                </div>

                <div class="footer-links">
                    <h3>Navigation</h3>
                    <ul>
                        <li>
                            <a href="index_login.php">Home</a>
                        </li>
                        <li>
                            <a href="aboutus_login.php">About</a>
                        </li>
                        <li>
                            <a href="service_login.php">Service</a>
                        </li>
                        <li>
                            <a href="contact_login.php">Contact</a>
                        </li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h3>Services</h3>
                    <ul>
                        <li>Printing</li>
                        <li>Design</li>
                        <li>Sticker</li>
                        <li>Banner</li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h3>Contact</h3>
                    <a href="https://maps.app.goo.gl/2bwvWDF4fZMi2M7X7">
                        <p>📍 Pontianak Barat</p>
                    </a>
                    <a href="https://wa.me/6282254068851">
                        <p>📞 +62 822-5406-8851</p>
                    </a>
                    <a
                        href="https://www.instagram.com/anekagaleri1?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
                        <p>
                            <i class="fa-brands fa-instagram" style="color: palevioletred;"></i>
                            @anekagalery</p>
                    </a>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2026 Aneka Galeri. All Rights Reserved.</p>
                <img src="img/LOGO ANEKA GALERI PRINTING.png" alt="Logo" class="footer-logo"/>
            </div>
        </footer>

        <script>
            function toggleMenu() {
                const hamburger = document.getElementById('hamburger');
                const navMenu = document.getElementById('navMenu');
                hamburger
                    .classList
                    .toggle('open');
                navMenu
                    .classList
                    .toggle('open');
            }

            document.addEventListener('DOMContentLoaded', function () {
                const toast = document.getElementById('profiletoast');
                if (toast) {
                    toast
                        .classList
                        .add('show');
                    setTimeout(function () {
                        toast
                            .classList
                            .remove('show');
                    }, 3000);
                }
            });
        </script>

        <a href="https://wa.me/6282254068851" target="_blank" class="wa-float">
            <div class="wa-pulse"></div>
            <div class="wa-pulse wa-pulse2"></div>
            <div class="wa-pulse wa-pulse3"></div>
            <div class="wa-icon">
                <i class="fab fa-whatsapp"></i>
            </div>
        </a>
        <script src="js/index.js"></script>
    </body>
</html>