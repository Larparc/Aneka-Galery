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
        <title>Contact - Aneka Galery</title>
        <link rel="stylesheet" href="css/contact.css">
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

        <div class="contact-hero-wrapper">
            <div class="contact-slider">
                <div class="contact-slide active">
                    <img src="img/contact1.jpeg" alt="slide1">
                </div>
                <div class="contact-slide">
                    <img src="img/contact2.jpeg" alt="slide2">
                </div>
                <div class="contact-slide">
                    <img src="img/contact3.jpeg" alt="slide3">
                </div>
                <div class="contact-overlay"></div>
            </div>
            <div class="contact-hero">
                <h1>Contact</h1>
            </div>
        </div>

        <br/>
        <br/>
        <br/>
        <div class="location-section">
            <h2>Location</h2>
            <div class="location-address">
                <i class="fas fa-map-marker-alt"></i>
                <span style="text-align: center;">Jl. Komodor Yos Sudarso No.11 A-B, Sungai
                    Belitung, Kec. Pontianak Barat, Kota Pontianak, Kalimantan Barat 78113</span>
            </div>
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.818295040523!2d109.30775687636743!3d-0.006452735569276112!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d58a17eabf9cf%3A0xf702d191e1509de8!2sAneka%20Galeri%20Digital%20Printing!5e0!3m2!1sid!2sid!4v1776855800663!5m2!1sid!2sid"
                    width="600"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="see-more-btn">
                <a href="https://maps.app.goo.gl/2bwvWDF4fZMi2M7X7" target="_blank">
                    See more
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>

        <br/>
         <div
            style="width: 60%; margin: 0 auto; height: 2px; background: linear-gradient(to right, transparent, #1f8a8a, transparent);"></div>

        <br/>
        <br/>
        <br/>
        <div class="form-section">
            <div class="form-section-header">
                <h2>Hubungi Kami disini</h2>
            </div>
            <div class="form-outer">
                <div class="form-inner">
                    <form>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" placeholder="Masukkan nama Anda"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" placeholder="Masukkan email Anda"/>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telephone</label>
                            <input type="tel" placeholder="Contoh: 08xx-xxxx-xxxx"/>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea placeholder="Tulis pesan Anda..."></textarea>
                        </div>
                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- HUBUNGI KAMI -->
        <div class="hubungi-section">
            <h2>Hubungi Kami</h2>
            <div class="hubungi-items-wrapper">
                <a href="https://wa.me/6282254068851" target="_blank" class="hubungi-item">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp</span>
                </a>
                <a
                    href="https://www.instagram.com/anekagaleriprinting"
                    target="_blank"
                    class="hubungi-item">
                    <i class="fab fa-instagram"></i>
                    <span>Instagram</span>
                </a>
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
            const contactSlides = document.querySelectorAll('.contact-slide');
            let contactIndex = 0;
            function showContactSlide() {
                contactSlides.forEach(s => s.classList.remove('active'));
                contactSlides[contactIndex]
                    .classList
                    .add('active');
                contactIndex = (contactIndex + 1) % contactSlides.length;
            }
            setInterval(showContactSlide, 3000);
        </script>
        <a href="https://wa.me/+6282254068851" target="_blank" class="wa-float">
            <div class="wa-pulse"></div>
            <div class="wa-pulse wa-pulse2"></div>
            <div class="wa-pulse wa-pulse3"></div>
            <div class="wa-icon">
                <i class="fab fa-whatsapp"></i>
            </div>
        </a>
        <script src="js/contact.js"></script>
    </body>
</html>