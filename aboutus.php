<?php
include "koneksi.php";
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
        <title>About Us - Aneka Galery</title>
        <link rel="stylesheet" href="css/aboutus.css">
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
            <a href="login.php" class="login-btn">
                <i class="fa-solid fa-user-lock"></i>
                <span>Login</span>
            </a>
        </section>

        <div class="about-hero-wrapper">
            <div class="about-slider">
                <div class="about-slide active">
                    <img src="img/slide1.jpeg" alt="slide1">
                </div>
                <div class="about-slide">
                    <img src="img/slide2.jpeg" alt="slide2">
                </div>
                <div class="about-slide">
                    <img src="img/slide3.jpeg" alt="slide3">
                </div>
                <div class="about-overlay"></div>
            </div>
            <div class="about-hero">
                <h1>About Us</h1>
            </div>
        </div>

        <div class="service-work">
            <div class="service-work-badge">
                <span>Service</span>
            </div>
            <div class="service-work-cards">
                <div class="feature-box">
                    <i class="fas fa-print"></i>
                    <h3>Printing</h3>
                    <p>Proses produksi untuk memindahkan teks, gambar, atau desain ke media kertas
                        menggunakan tinta dan mesin cetak.</p>
                </div>
                <div class="feature-box">
                    <i class="fas fa-paint-brush"></i>
                    <h3>Desain</h3>
                    <p>Proses perencanaan, perancangan, dan penyusunan elemen-elemen untuk
                        menciptakan sesuatu yang memenuhi tujuan fungsional, estetika, dan pengalaman
                        pengguna.</p>
                </div>
                <div class="feature-box">
                    <i class="fas fa-copy"></i>
                    <h3>Fotocopy</h3>
                    <p>Proses menggandakan atau menyalin dokumen, gambar, atau teks secara identik
                        dari dokumen asli ke kertas baru menggunakan mesin khusus.</p>
                </div>
            </div>
        </div>
        <br/>
         <div
            style="width: 60%; margin: 0 auto; height: 2px; background: linear-gradient(to right, transparent, #1f8a8a, transparent);"></div>
            <br/>
            <br/>
        <section class="about">

            <div class="about-section">
                <div class="about-img">
                    <img src="img/contact2.jpeg" alt="Lokasi Aneka Galeri"/>
                </div>
                <div class="about-text">
                    <span class="tag">Awal Mula</span>
                    <h2>Berawal dari Kebutuhan Sederhana</h2>
                    <p>
                        Aneka Galeri didirikan pada tahun 2018 oleh Vebrio Chang, berawal dari sebuah toko kecil yang sederhana. Pada akhir Desember 2023 Aneka Galeri resmi berpindah menjadi toko utama yang menghadirkan layanan lebih lengkap.
                    </p>
                    <p>
                        Seiring dengan perkembangan teknologi dan meningkatnya kebutuhan akan layanan digital, Aneka Galeri bertransformasi menjadi penyedia jasa percetakan yang modern dan terpercaya. Kami menyediakan berbagai layanan seperti printing, pembuatan banner, desain, serta penjualan produk lainnya yang mendukung kebutuhan pelanggan. 
                        Dengan komitmen pada kualitas, kemudahan, dan pelayanan yang ramah, Aneka Galeri hadir sebagai mitra terpercaya untuk memenuhi berbagai kebutuhan cetak dan digital Anda.
                    </p>
                </div>
                <div style="width: 60%; margin: 0 auto; height: 2px; background: linear-gradient(to right, transparent, #1f8a8a, transparent);"></div>
            </div>

            <div class="about-section reverse">
                <div class="about-img">
                    <img src="img/contact3.jpeg" alt="Proses Produksi"/>
                </div>
                <div class="about-text">
                    <span class="tag">Komitmen Kami</span>
                    <h2>Lebih dari Sekadar Printing</h2>
                    <p>
                         Aneka Galeri merupakan layanan percetakan yang berkomitmen dalam memberikan solusi praktis, cepat, serta berkualitas. Kami melayani berbagai macam kebutuhan seperti printing, pembuatan banner, sticker, printing foto, desain grafis, dan penyediaan produk pendukung lainnya.
                    </p>
                    <p>
                        Didukung dengan penggunaan peralatan yang mendukung serta mengikuti perkembangan teknologi, Aneka Galeri berusaha untuk memberikan hasil yang terbaik kepada setiap pelanggan. Kami juga memahami kebutuhan dari setiap kebutuhan detail dan tujuan berbeda dari para pelanggan, sehingga kami siap untuk memberikan layanan yang baik, fleksibel dan sesuai dengan keinginan anda. Dengan memberikan pelayanan yang ramah, proses yang cepat dan mudah, serta memberikan hasil yang dapat diandalkan, Aneka Galeri hadir sebagai mitra terpercaya dalam memenuhi kebutuhan layanan percetakan anda
                    </p>
                </div>
            </div>
 <div
            style="width: 60%; margin: 0 auto; height: 2px; background: linear-gradient(to right, transparent, #1f8a8a, transparent);"></div>
<br/>
<br/>
<br/>
<br/>
<br/>
            <div class="about-cta">
                <div class="cta-stripe"></div>
                <div class="cta-inner">
                <span class="cta-badge">Mulai Sekarang</span>
                <h2>Siap Mencetak<br />Kebutuhan Anda?</h2>
                <p class="cta-sub">
                    Tim kami siap membantu Anda dari konsultasi desain hingga hasil
                    cetak siap pakai. Hubungi kami sekarang!
                </p>
                <div class="cta-buttons">
                    <a href="https://wa.me/+6282254068851" class="btn-primary">
                    <span class="btn-icon">💬</span> Chat via WhatsApp
                    </a>
                    <a href="mailto:info@anekagaleri.com" class="btn-outline">
                    <span class="btn-icon">✉️</span> Kirim Email
                    </a>
                </div>
                <div class="cta-contacts">
                    <span class="cta-chip">
                    <span class="chip-icon">📍</span> Pontianak, Kalimantan Barat
                    </span>
                    <span class="cta-chip">
                    <span class="chip-icon">🕐</span> Buka Setiap Hari 08.00–21.00
                    </span>
                </div>
                </div>
            </div>
            </section>
<br/>
<br/>
<br/>
<br/>
<br/>
<div
            style="width: 60%; margin: 0 auto; height: 2px; background: linear-gradient(to right, transparent, #1f8a8a, transparent);"></div>
<br/>
<br/>
            <div class="owner-section">
                <h2>Owner</h2>
                <div class="owner-cards">
                    <div class="owner-card">
                        <div class="owner-avatar-placeholder">
                            <img src="img/vebrio.jpeg" alt="Vebrio Chang" class="owner-avatar">
                        </div>
                        <h4>Vebrio Chang</h4>
                        <p>Founder & Owner</p>
                    </div>
                    <div class="owner-card">
                        <div class="owner-avatar-placeholder">
                            <img src="img/ferry.jpeg" alt="Ferry Febrianto" class="owner-avatar">
                        </div>
                        <h4>Ferry Febrianto</h4>
                        <p>Co-Owner</p>
                    </div>
                </div>
            </div>

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
                const aboutSlides = document.querySelectorAll('.about-slide');
                let aboutIndex = 0;
                function showAboutSlide() {
                    aboutSlides.forEach(s => s.classList.remove('active'));
                    aboutSlides[aboutIndex]
                        .classList
                        .add('active');
                    aboutIndex = (aboutIndex + 1) % aboutSlides.length;
                }
                setInterval(showAboutSlide, 3000);
            </script>
            <a href="https://wa.me/6282254068851" target="_blank" class="wa-float">
                <div class="wa-pulse"></div>
                <div class="wa-pulse wa-pulse2"></div>
                <div class="wa-pulse wa-pulse3"></div>
                <div class="wa-icon">
                    <i class="fab fa-whatsapp"></i>
                </div>
            </a>
            <script src="js/aboutus.js"></script>
        </body>
    </html>