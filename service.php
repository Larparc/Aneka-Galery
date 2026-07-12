<?php
include "koneksi.php";
include "admin/security.php";

$showToast = false;
if(isset($_GET['success'])){
    $showToast = true;
}

$query_service = mysqli_query($conn, "SELECT * FROM services");
$query_size = mysqli_query($conn, "SELECT * FROM sizes");
$query_type = mysqli_query($conn, "SELECT * FROM types");
$query_output = mysqli_query($conn, "SELECT * FROM outputs");
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
            <div class="profile">
                <b><?php echo $username; ?></b>
                <a href="profil.php">
                    <img src="img/foto.jpg" class="profile-img" alt="Profile Picture"/>
                </a>
            </div>
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

                    <form
                        id="orderForm"
                        action="sv_order.php"
                        method="POST"
                        enctype="multipart/form-data">
                         <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            <div class="form-grid">
                                <div class="input-group">
                                    <label for="nama">Nama</label>
                                    <div class="display-text">
                                        <i class="fas fa-user" style="color: #1f8a8a; margin-right: 8px;"></i>
                                            <?php echo $username; ?>
                                    </div>
                                </div>

                            <div class="input-group">
                                <label for="number">Nomor Telephone</label>
                                    <div class="display-text">
                                        <i class="fas fa-phone" style="color: #1f8a8a; margin-right: 8px;"></i>
                                        <?php echo $no_phone; ?>
                                    </div>
                                
                                </div>
                        <div class="row-2">
                            <div class="input-group">
                                <label for="layanan">Layanan</label>
                                <select id="layanan" name="service_id" required>
                                    <option value="" disabled selected>
                                    -- Pilih Layanan --
                                    </option>
                                        <?php while($service = mysqli_fetch_assoc($query_service)){ ?>
                                    <option value="<?= $service['service_id']; ?>">
                                        <?= $service['service_name']; ?>
                                    </option>
                                        <?php } ?>
                                </select>
                            </div>

                        <div class="input-group">
                            <label for="jumlah">Jumlah</label>
                            <input
                                type="number"
                                id="jumlah"
                                name="total_paper"
                                min="1"
                                placeholder="Contoh: 10"
                                required="required"/>
                        </div>
                    </div>

                    <div class="row-3" id="dynamicFields">
                        <div class="input-group">
                            <label for="ukuran">Ukuran</label>
                            <select id="ukuran" name="size_id" required>
                                <option value="" disabled selected>
                                -- Pilih Ukuran --
                                </option>
                                    <?php while($size = mysqli_fetch_assoc($query_size)){ ?>
                                <option value="<?= $size['size_id']; ?>">
                                    <?= $size['size_name']; ?>
                                </option>
                                    <?php } ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="jenis">Jenis</label>
                            <select id="jenis" name="type_id" required>
                                <option value="" disabled selected>
                                -- Pilih Jenis --
                                </option>
                                    <?php while($type = mysqli_fetch_assoc($query_type)){ ?>
                                <option value="<?= $type['type_id']; ?>">
                                    <?= $type['type_name']; ?>
                                </option>
                                    <?php } ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="finish">Jenis Kertas</label>
                            <select id="finish" name="output_id" required>
                                <option value="" disabled selected>
                                -- Pilih Kertas --
                                </option>
                                    <?php while($output = mysqli_fetch_assoc($query_output)){ ?>
                                <option value="<?= $output['output_id']; ?>">
                                    <?= $output['output_name']; ?>
                                </option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="deskripsi">Deskripsi / Catatan</label>
                        <textarea
                            id="deskripsi"
                            rows="4"
                            name="description"
                            placeholder="background biru, laminating, etc"
                            required="required"></textarea>
                    </div>

                    <div class="input-group upload-box">
                        <label for="fileUpload">Upload File / Gambar</label>
                        <input type="file" id="fileUpload" name="file" accept="image/*,.pdf,.doc,.docx"/>
                        <div class="helper-text">
                            Upload file desain, foto, atau dokumen yang ingin diproses.
                        </div>
                        <img id="preview" class="preview" alt="Preview upload"/>
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

        <div class="toast <?php echo $showToast ? 'show' : ''; ?>" id="toast">
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
           const toast = document.getElementById("toast");
            if (toast && toast.classList.contains("show")) {
            setTimeout(function(){
                toast.classList.remove("show");
                window.history.replaceState(
                null,
                null,
                "service_login.php");
                }, 3000);
            }
        </script>

        <script>
            const navLinks = document.querySelectorAll('.menu a');
            const currentPage = location
                .pathname
                .split('/')
                .pop() || 'index_login.php';
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