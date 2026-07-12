<?php
include "security.php";
include "../koneksi.php";

$sql = "SELECT c.no_contact, c.date, c.message, p.username, p.email, p.no_phone
        FROM contacts c
        JOIN profiles p ON c.user_id = p.user_id
        ORDER BY c.date DESC
        LIMIT 5";
$result = $conn->query($sql);

$sql = "SELECT pr.*, p.username
        FROM projects pr
        JOIN profiles p ON pr.user_id = p.user_id
        ORDER BY pr.created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Panel - Admin</title>
        <link rel="shortcut icon" href="../img/anekagalery_32x32.png">
        <link rel="stylesheet" href="../css/panel.css">
    </head>
    <body>
        <div class="app">
            <div class="overlay" id="overlay"></div>

            <aside class="sidebar" id="sidebar">
                <div class="logo">
                    <i><img src="../img/anekagalery_32x32.png" alt=""></i>
                    <div>
                        <b>ANEKA GALERI</b>
                        <span>Digital Printing</span>
                    </div>
                </div>

                <nav>
                    <a href="panel.php" class="active">
                        Dashboard
                    </a>
                    <a href="account.php">
                        Account
                    </a>

                    <small>Pages</small>

                    <a href="project.php">
                        Project
                    </a>
                    <a href="orderpending.php">
                        Order Pending
                    </a>
                    <a href="ordercomplete.php">
                        Order Complete
                    </a>
                    <a href="customercontact.php">
                        customer Contact
                    </a>
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
                        <div class="notif-wrap" id="notif-wrap">
                            <button class="btn round notif-btn" id="notif-btn" aria-label="Notifikasi">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="18"
                                    viewbox="0 0 24 24"
                                    fill="none"
                                    stroke="#fff"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                                </svg>
                                <span class="notif-badge" id="notif-badge">3</span>
                            </button>
                            <div class="notif-dropdown" id="notif-dropdown">
                                <a href="orderpending.php" class="notif-footer">Lihat semua order →</a>
                            </div>
                        </div>
                        <a href="logout.php" class="btn light">
                            Logout
                        </a>
                    </div>
                </header>

                <main class="content">
                    <h1>Dashboard</h1>

      <div class="cards">
        <a href="project.php" class="card">
          <i></i>
          <div><b>0</b><span>Total Project</span></div>
        </a>
        <a href="orderpending.php" class="card">
          <i></i>
          <div><b>0</b><span>Order Pending</span></div>
        </a>
        <a href="ordercomplete.php" class="card">
          <i></i>
          <div><b>0</b><span>Order Complete</span></div>
        </a>
      </div>

                    <div class="block">
                        <div class="head">
                            <h2>Uncomplete order</h2>
                            <a href="orderpending.php">Lihat semua</a>
                        </div>
                        <div class="list" id="dash-pending"></div>
                    </div>

                    <div class="block">
                        <div class="head">
                            <h2>Complete Order</h2>
                            <a href="ordercomplete.php">Lihat semua</a>
                        </div>
                        <div class="list" id="dash-complete"></div>
                    </div>

                    <div class="block">
                        <div class="head">
                            <h2>Customer Contact</h2>
                            <a href="customercontact.php">Lihat semua</a>
                        </div>
                        <div class="list" id="dash-contact">
                            <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="row">
                                <div class="left">
                                    <i></i>
                                    <div>
                                        <b><?php echo htmlspecialchars($row['username']); ?></b>
                                        <span><?php echo htmlspecialchars($row['message']); ?></span>
                                    </div>
                                </div>
                                <div class="right">
                                    <span><?php echo htmlspecialchars(date('d M Y H:i', strtotime($row['date']))); ?></span>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="empty">Belum ada pesan masuk.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <script>
            const notifBtn = document.getElementById('notif-btn');
            const notifDrop = document.getElementById('notif-dropdown');
            const notifBadge = document.getElementById('notif-badge');

            notifBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                notifDrop
                    .classList
                    .toggle('show');
            });

            document.addEventListener('click', function () {
                notifDrop
                    .classList
                    .remove('show');
            });

            notifDrop.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        </script>
    </body>
</html>