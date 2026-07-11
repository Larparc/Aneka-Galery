<?php
include "security.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Project - Aneka Galery</title>
        <link rel="stylesheet" href="../css/project.css">
        <link rel="shortcut icon" href="../img/anekagalery_32x32.png">
    </head>
    <body>
        <div class="app">
            <div class="overlay" id="overlay"></div>

            <aside class="sidebar" id="sidebar">
                <div class="logo">
                    <i><img src="../img/anekagalery_32x32.png" alt="logo"></i>
                    <div>
                        <b>ANEKA GALERI</b>
                        <span>Digital Printing</span>
                    </div>
                </div>

                <nav>
                    <a href="panel.php">Dashboard</a>
                    <a href="account.php">Account</a>
                    <small>Pages</small>
                    <a href="project.php" class="active">Project</a>
                    <a href="orderpending.php">Order Pending</a>
                    <a href="ordercomplete.php">Order Complete</a>
                    <a href="customercontact.php">Customer Contact</a>
                </nav>
            </aside>

            <div class="main">
                <header class="topbar">
                    <div class="user">
                        <button class="btn round" id="menu-btn" aria-label="Buka menu"></button>
                        <img src="../img/foto.jpg" alt="Avatar" class="user-avatar">
                        <a href="account.php">
                            <div>
                                <b><?php echo "welcome, ".$username; ?></b>
                                <span>Administrator</span>
                            </div>
                        </a>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <a href="logout.php" class="btn light">Logout</a>
                    </div>
                </header>

                <div class="content">
                    <h1>Project (Untuk skala besar)</h1>
                    <div class="action-buttons">
                        <button class="btn btn-add" onclick="openModal()">Tambah Project</button>
                        <button class="btn btn-delete">Hapus Project</button>
                    </div>

                    <div class="project-list">
                        <div class="project-card" onclick="openEditModal(this)">
                            <img
                                src="../img/project1.jpg"
                                alt="Judul Projek Desain"
                                class="project-card-img"
                                onerror="this.src='../img/anekagalery_32x32.png'">
                            <h4>Judul Projek Desain</h4>
                            <p>Deskripsi</p>
                        </div>

                        <div class="project-card" onclick="openEditModal(this)">
                            <img
                                src="../img/project2.jpg"
                                alt="Pengembangan Aplikasi"
                                class="project-card-img"
                                onerror="this.src='../img/anekagalery_32x32.png'">
                            <h4>Pengembangan Aplikasi</h4>
                            <p>Membuat aplikasi untuk manajemen proyek secara efisien.</p>
                        </div>

                        <div class="project-card" onclick="openEditModal(this)">
                            <img
                                src="../img/project3.jpg"
                                alt="Desain UI/UX"
                                class="project-card-img"
                                onerror="this.src='../img/anekagalery_32x32.png'">
                            <h4>Desain UI/UX</h4>
                            <p>Merancang antarmuka pengguna yang intuitif dan menarik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="projectModal" class="modal-overlay">
            <div class="modal-box">
                <h3>Judul Projek Desain</h3>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" name="nama" class="modal-input" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <input type="text" name="deskripsi" class="modal-input" placeholder="Deskripsi">
                    </div>
                    <div class="form-group">
                        <input type="text" name="gambar" class="modal-input" placeholder="Gambar">
                    </div>
                    <div class="modal-actions">
                        <button type="submit" class="btn-modal-confirm">Konfirmasi</button>
                        <button type="button" class="btn-modal-cancel" onclick="closeModal()">Ga jadi, pengen tidur</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="editProjectModal" class="modal-overlay-edit">
            <div class="edit-modal-box">

                <div class="edit-header">
                    <button class="edit-back-btn" onclick="closeEditModal()">
                        <svg
                            width="24"
                            height="24"
                            viewbox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="3"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>
                    <div class="edit-title-group">
                        <span class="edit-label">Nama Projek:</span>
                        <h2 class="edit-title">Judul Proyek</h2>
                    </div>
                    <button class="edit-header-edit-btn">
                        <svg
                            width="20"
                            height="20"
                            viewbox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </button>
                </div>

                <div class="edit-body">
                    <div class="edit-image-area">
                        <div class="edit-image-placeholder">
                            <svg
                                width="80"
                                height="80"
                                viewbox="0 0 24 24"
                                fill="none"
                                stroke="black"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="4" ry="4"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </div>
                    </div>

                    <div class="edit-desc-area">
                        <div class="edit-desc-header">
                            <span class="edit-desc-label">Deskripsi:</span>
                            <button class="edit-desc-edit-btn">
                                <svg
                                    width="16"
                                    height="16"
                                    viewbox="0 0 24 24"
                                    fill="none"
                                    stroke="black"
                                    stroke-width="2.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                </svg>
                            </button>
                        </div>
                        <textarea class="edit-desc-input" rows="8">Deskripsi Proyek akan muncul di sini...</textarea>
                    </div>
                </div>

                <div class="edit-footer">
                    <button
                        class="btn-edit-confirm"
                        onclick="alert('Perubahan berhasil disimpan!')">Konfirmasi Perubahan</button>
                    <button class="btn-edit-delete" onclick="alert('Proyek berhasil dihapus!')">Hapus Perubahan</button>
                </div>

            </div>
        </div>

        <script src="../js/project.js"></script>
    </body>
</html>