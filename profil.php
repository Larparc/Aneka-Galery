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
            <a href="index.php">
                <img src="img/LOGO ANEKA GALERI PRINTING.png" id="logo"/>
            </a>
            <div class="hamburger" id="hamburger" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <nav class="menu" id="navMenu">
                <a href="index.php">Home</a>
                <a href="aboutus.php">About</a>
                <a href="service.php">Service</a>
                <a href="contact.php">Contact</a>
            </nav>
            <div class="profile">
                <a href="profil.php" class="nickname">
                    <p><?php echo $username; ?></p>
                </a>
                <a href="profil.php" class="profile" id="profile">
                    <img src="img/foto.jpg" alt="profile">
                </a>
            </div>
        </section>
        <div class="profileedit">
            <Form id="edit">
                <div class="select">
                        <label for="nama"><?php echo $username; ?></label>
                        <label for="nama"><?php echo $email; ?></label>
                        <label for="nama"><?php echo $password; ?></label>
                        <label for="nama"><?php echo $no_phone; ?></label>

                    </div>
            </Form>
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
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="aboutus.php">About</a>
                        </li>
                        <li>
                            <a href="service.php">Service</a>
                        </li>
                        <li>
                            <a href="contact.php">Contact</a>
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
                    <a href="https://maps.app.goo.gl/2bwvWDF4fZMi2M7X7"><p>📍 Pontianak Barat</p></a>
                    <a href="https://wa.me/6282254068851"><p>📞 +62 822-5406-8851</p></a>
                    <a href="https://www.instagram.com/anekagaleri1?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><p> <i class="fa-brands fa-instagram" style="color: palevioletred;"></i> @anekagalery</p></a>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2026 Aneka Galeri. All Rights Reserved.</p>
                <img src="img/LOGO ANEKA GALERI PRINTING.png" alt="Logo" class="footer-logo" />
            </div>
        </footer>

        <script>
           
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