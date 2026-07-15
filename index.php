<?php
include "koneksi.php";
include "admin/security.php";

// Koneksi PDO untuk announcement
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    $pdo = null;
}
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
        <title>Home - Aneka Galery</title>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/announcement_banner.css">
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
                <div class="menu-profile">
                    <b><?php echo $username; ?></b>
                        <a href="profil.php">
                            <img src="img/foto.jpg" class="profile-img" alt="Profile Picture"/>
                        </a>
                </div>
                    <a href="index.php">Home</a>
                    <a href="aboutus.php">About</a>
                    <a href="service.php">Service</a>
                    <a href="contact.php">Contact</a>
            </nav>
            <div class="profile">
                <b><?php echo $username; ?></b>
                <a href="profil.php">
                    <img src="img/foto.jpg" class="profile-img" alt="Profile Picture"/>
                </a>
            </div>
        </section>

        <?php include "announcement_banner.php"; ?>

        <div class="slider">

            <div class="slide active">
                <img src="img/slide1.jpeg">
            </div>

            <div class="slide">
                <img src="img/slide2.jpeg">
            </div>

            <div class="slide">
                <img src="img/slide3.jpeg">
            </div>

            <div class="overlay"></div>

            <div class="content">
                <div class="badge">Our Service</div>
                <div class="title">Your Trusted Digital Printing Partner</div>
            </div>

            <button class="btn" onclick="window.location.href='service.php'">
                Order Now
                <i class="fas fa-external-link-alt"></i>
            </button>

        </div>

        <div
            style="width: 60%; margin: 0 auto; height: 2px; background: linear-gradient(to right, transparent, #1f8a8a, transparent);"></div>

        <section id="category">
            <div class="category-header">
                <div class="badge" style="color:white;">Kategori Layanan</div>
            </div>
            <div class="carousel-wrapper">
                <div class="card pos-center" data-index="0">
                    <div class="card-icon">🖨️</div>
                    <div class="card-title">Printing Cepat & Berkualitas</div>
                    <div class="card-desc">Proses produksi untuk memindahkan teks, gambar, atau
                        desain ke media kertas menggunakan tinta dan mesin cetak berkualitas tinggi.</div>
                </div>
                <div class="card pos-right" data-index="1">
                    <div class="card-icon">🎨</div>
                    <div class="card-title">Jasa Desain Profesional</div>
                    <div class="card-desc">Perencanaan dan perancangan elemen visual untuk
                        menciptakan desain yang memenuhi tujuan fungsional, estetika, dan pengalaman
                        pengguna.</div>
                </div>
                <div class="card pos-left" data-index="2">
                    <div class="card-icon">📍</div>
                    <div class="card-title">Aneka Galeri Siap Melayani</div>
                    <div class="card-desc">Proses menggandakan atau menyalin dokumen, gambar, atau
                        teks secara identik dari dokumen asli menggunakan mesin khusus.</div>
                </div>
            </div>
        </section>

        <div
            style="width: 60%; margin: 0 auto; height: 2px; background: linear-gradient(to right, transparent, #1f8a8a, transparent);"></div>
        <br/>
        <br/>
        <br/>
        <section class="branding">
            <div class="branding-content">
                <span class="brand-tag">ANEKA GALERI</span>
                <h2>Your Trusted Printing Partner</h2>
                <p>
                    From simple prints to high-quality designs, we bring your ideas to life with
                    precision, speed, and creativity.
                </p>
            </div>
        </section>
        <br/>
        <br/>
        <br/>
        <br/>
        <div
            style="width: 60%; margin: 0 auto; height: 2px; background: linear-gradient(to right, transparent, #1f8a8a, transparent);"></div>

        <section class="features">
            <div class="feature-box">
                <i class="fa-solid fa-business-time"></i>
                <h3>Jam Operasional</h3>
                <p>Dibuka setiap senin-sabtu dalam waktu 08.00-19.00</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-calendar-check"></i>
                <h3>Best Quality</h3>
                <p>Kualitas terbaik, hasil maksimal</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-star"></i>
                <h3>Best Service</h3>
                <p>Layanan cepat, tepat, dan bergaransi</p>
            </div>
        </section>

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
            // Slider hero
            let slides = document.querySelectorAll('.slide');
            let slideIndex = 0;

            function showSlide() {
                slides.forEach(slide => slide.classList.remove('active'));
                slides[slideIndex]
                    .classList
                    .add('active');
                slideIndex = (slideIndex + 1) % slides.length;
            }
            setInterval(showSlide, 3000);

            const cards = document.querySelectorAll('.card');
            const positions = ['pos-center', 'pos-right', 'pos-left'];
            let currentCenter = 0;

            function updateCarousel() {
                cards.forEach((card, i) => {
                    card
                        .classList
                        .remove('pos-center', 'pos-left', 'pos-right');
                    const posIndex = (i - currentCenter + cards.length) % cards.length;
                    card
                        .classList
                        .add(positions[posIndex]);
                });
            }

            function goToCard(index) {
                currentCenter = index;
                updateCarousel();
            }

            function nextCard() {
                currentCenter = (currentCenter + 1) % cards.length;
                updateCarousel();
            }

            setInterval(nextCard, 3000);
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