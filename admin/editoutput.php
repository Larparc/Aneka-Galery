<?php
include "security.php";
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Panel - Admin</title>
        <link rel="shortcut icon" href="../img/anekagalery_32x32.png">
        <link rel="stylesheet" href="../css/panel.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <div class="app">
            <div class="overlay" id="overlay"></div>

            <aside class="sidebar" id="sidebar">
                <div class="logo">
                    <i><img src="../img/anekagalery_32x32.png" alt=""></i>
                    <div>
                        <a href="../index.php">
                            <b>ANEKA GALERI</b>
                            <span>Digital Printing</span>
                        </div>
                    </a>
                </div>
                <nav>
                    <a href="panel.php">
                        <i class="fas fa-th-large"></i>
                        Dashboard</a>
                    <a href="account.php">
                        <i class="fas fa-user"></i>
                        Account</a>
                    <small>Pages</small>
                    <a href="project.php">
                        <i class="fas fa-folder-open"></i>
                        Project</a>
                    <a>
                        <i class="fas fa-pencil-alt"></i>
                        Service</a>
                    <a href="editlayanan.php" class="sub">
                        <i class="fas fa-cogs"></i>
                        Edit Layanan</a>
                    <a href="editukuran.php" class="sub">
                        <i class="fas fa-ruler"></i>
                        Edit Ukuran</a>
                    <a href="editjenis.php" class="sub">
                        <i class="fas fa-palette"></i>
                        Edit Jenis</a>
                    <a href="editoutput.php" class="sub active">
                        <i class="fas fa-print"></i>
                        Edit Output</a>
                    <a href="orderpending.php">
                        <i class="fas fa-clock"></i>
                        Order Pending</a>
                    <a href="ordercomplete.php">
                        <i class="fas fa-check-circle"></i>
                        Order Complete</a>
                    <a href="customercontact.php">
                        <i class="fas fa-envelope"></i>
                        Customer Contact</a>
                </nav>
            </aside>
            <div class="main">
                <header class="topbar">
                    <div class="user">
                        <button class="btn round" id="menu-btn">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="user-avatar-wrapper">
                            <img src="../img/foto.jpg" class="user-avatar" alt="avatar">
                        </div>
                        <a href="account.php">
                            <div>
                                <b><?= "Welcome, " . htmlspecialchars($username ?? "Admin"); ?></b>
                                <span>Administrator</span>
                            </div>
                        </a>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <button class="btn round">
                            <i class="fas fa-bell"></i>
                        </button>
                        <a href="logout.php" class="btn light">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout</a>
                    </div>
                </header>
            </div>
        </div>
    </body>
</html>