<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/anekagalery_32x32.png">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
        <title>Service - Aneka Galery</title>
        <link rel="stylesheet" href="css/service.css">
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

        <div class="service-hero-wrapper">
            <div class="service-slider">
                <div class="service-slide active">
                    <img src="img/slide1.jpeg" alt="slide1">
                </div>
                <div class="service-slide">
                    <img src="img/slide2.jpeg" alt="slide2">
                </div>
                <div class="service-slide">
                    <img src="img/slide3.jpeg" alt="slide3">
                </div>
                <div class="service-overlay"></div>
            </div>
            <div class="service-hero">
                <h1>Service</h1>    
            </div>
        </div>

        <br/>
        <br/>
        <br/>
        <div class="card">
            <div class="order-header">
                <div>
                    <div class="card-title">Order Now</div>
                    <div class="card-subtitle">
                        Isi data untuk mengirim pesanan.
                    </div>
                </div>
            </div>

            <form id="orderForm">
                <div class="form-grid">
                    <div class="input-group">
                        <label for="nama">Nama</label>
                        <input
                            type="text"
                            id="nama"
                            placeholder="Masukkan nama kamu"
                            required="required"/>
                    </div>
                    
                    <div class="input-group">
                        <label for="number">Nomor Telephone</label>
                        <input
                            type="number"
                            id="no_phone"
                            placeholder="Masukkan Nomor telephone kamu"
                            required="required"/>
                    </div>

                    <div class="row-2">
                        <div class="input-group">
                            <label for="layanan">Layanan</label>
                            <select id="layanan" required="required">
                                <option value="printing">Print Hvs</option>
                                <option value="photocopy">Print Foto</option>
                                <option value="design">Sticker</option>
                                <option value="finishing">Banner</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="jumlah">Jumlah</label>
                            <input
                                type="number"
                                id="jumlah"
                                min="1"
                                placeholder="Contoh: 10"
                                required="required"/>
                        </div>
                    </div>

                    <div class="row-3" id="dynamicFields">
                        <div class="input-group">
                            <label for="ukuran">Ukuran</label>
                            <select id="ukuran" required="required">
                                <option>A4</option>
                                <option>A5</option>
                                <option>F4</option>
                                <option>Custom</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="jenis">Jenis</label>
                            <select id="jenis" required="required">
                                <option>Hitam Putih</option>
                                <option>Full Color</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="finish">Jenis Kertas</label>
                            <select id="finish" required="required">
                                <option>Cetak foto</option>
                                <option>Hvs</option>
                                <option>Paper glossy</option>
                                <option>matte</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="deskripsi">Deskripsi / Catatan</label>
                        <textarea
                            id="deskripsi"
                            rows="4"
                            placeholder="background biru, laminating, etc"
                            required="required"></textarea>
                    </div>

                    <div class="input-group upload-box">
                        <label for="fileUpload">Upload File / Gambar</label>
                        <input type="file" id="fileUpload" accept="image/*,.pdf,.doc,.docx"/>
                        <div class="helper-text">
                            Upload file desain, foto, atau dokumen yang ingin diproses.
                        </div>
                        <img id="preview" class="upload-preview" alt="Preview upload"/>
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn btn-primary">
                            Kirim Order
                        </button>
                        <button type="reset" class="btn btn-secondary" id="resetBtn">
                            Reset
                        </button>
                    </div>
                </div>
            </form>
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
                    <img src="../img/LOGO ANEKA GALERI PRINTING.png" alt="Logo" class="footer-logo" />
                </div>
        </footer>

        <div class="toast" id="toast">
            Order berhasil dikirim. Tim kami akan segera memproses pesananmu.
        </div>

        <script>
            const serviceSlides = document.querySelectorAll('.service-slide');
            let serviceIndex = 0;

            function showServiceSlide() {
                serviceSlides.forEach(s => s.classList.remove('active'));
                serviceSlides[serviceIndex]
                    .classList
                    .add('active');
                serviceIndex = (serviceIndex + 1) % serviceSlides.length;
            }
            setInterval(showServiceSlide, 3000);
        </script>

        <script>
            const navLinks = document.querySelectorAll('.menu a');
            const currentPage = location
                .pathname
                .split('/')
                .pop() || 'index.php';
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPage) 
                    link
                        .classList
                        .add('active');
                }
            );
            function toggleMenu() {
                document
                    .getElementById('hamburger')
                    .classList
                    .toggle('open');
                document
                    .getElementById('navMenu')
                    .classList
                    .toggle('open');
            }
            document
                .querySelectorAll('.menu a')
                .forEach(link => {
                    link.addEventListener('click', () => {
                        document
                            .getElementById('hamburger')
                            .classList
                            .remove('open');
                        document
                            .getElementById('navMenu')
                            .classList
                            .remove('open');
                    });
                });
        </script>
        <script src="js/service.js"></script>
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