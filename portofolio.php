<?php
include "koneksi.php";
include "admin/security.php";

$sql = "SELECT * FROM projects ORDER BY created_at DESC";
$result = $conn->query($sql);
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
        <title>Portfolio - Aneka Galery</title>
        <link rel="stylesheet" href="css/portofolio.css">
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
                <a href="service.php">Service</a>                <a href="contact.php">Contact</a>
            </nav>
            <div class="profile">
                <b><?php echo $username; ?></b>
                <a href="profil.php">
                    <img src="img/foto.jpg" class="profile-img" alt="Profile Picture"/>
                </a>
            </div>
        </section>

        <div class="service-hero">
            <div class="service-hero-overlay"></div>
            <div class="service-hero-content">
                <div class="badge">Our Work</div>
                <h1>Portfolio</h1>
                <p>Beberapa hasil project yang sudah kami kerjakan.</p>
            </div>
        </div>

        <section class="service-section">
            <div class="service-grid">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="service-card">
                            <div class="service-card-img">
                                <img src="project_upload/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                            </div>
                            <div class="service-card-body">
                                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                                <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                                <span class="service-date">
                                    <i class="fa-regular fa-clock"></i>
                                    <?php echo htmlspecialchars(date('d M Y, H:i', strtotime($row['created_at']))); ?>
                                </span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="service-empty">Belum ada project yang diposting.</div>
                <?php endif; ?>
            </div>
        </section>

        <div
            style="width: 60%; margin: 0 auto; height: 2px; background: linear-gradient(to right, transparent, #1f8a8a, transparent);"></div>

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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="aboutus.php">About</a></li>
                        <li><a href="service.php">Service</a></li>
                        <li><a href="contact.php">Contact</a></li>
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
                document.getElementById('hamburger').classList.toggle('open');
                document.getElementById('navMenu').classList.toggle('open');
            }
        </script>
        <a href="https://wa.me/6282254068851" target="_blank" class="wa-float">
            <div class="wa-pulse"></div>
            <div class="wa-pulse wa-pulse2"></div>
            <div class="wa-pulse wa-pulse3"></div>
            <div class="wa-icon">
                <i class="fab fa-whatsapp"></i>
            </div>
        </a>
    </body>
</html>