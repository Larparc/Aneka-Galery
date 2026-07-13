<?php
include "securityadmin.php";
include "../koneksi.php";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Database connection failed : " . $e->getMessage());
}

$sql = "SELECT user_id, role_id, username, password, no_phone, email 
        FROM profiles 
        ORDER BY user_id ASC";
$stmt = $pdo->query($sql);
$profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Account - Aneka Galery</title>
        <link rel="stylesheet" href="../css/account.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body></body>
    <div class="app">
        <div class="overlay" id="overlay"></div>

        <aside class="sidebar" id="sidebar">
            <div class="logo">
                <i><img src="../img/anekagalery_32x32.png" alt="logo"></i>
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
                <a href="account.php" class="active">
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
                <a href="editoutput.php" class="sub">
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
                    <button class="btn round" id="menu-btn" aria-label="Buka menu"></button>
                    <img src="../img/foto.jpg" alt="Avatar" class="user-avatar">
                    <a href="account.php">
                        <div>
                            <b><?php echo "Welcome, ".$username; ?></b>
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

            <main class="content">
                <h1>Account</h1>
                <a href="addadmin.php" class="btn-add-admin">Add Admin</a>
                <div class="account-cards">
                    <?php foreach ($profiles as $row): ?>
                    <div class="account-card">
                        <!-- Avatar: bisa pakai ikon default atau foto jika ada -->
                        <i class="account-avatar">
                            <img
                                src="../img/foto.jpg"
                                alt="Avatar"
                                style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        </i>

                        <p>
                            <span>User ID</span>
                            <span><?php echo (int)$row['user_id']; ?></span>
                        </p>
                        <p>
                            <span>Role ID</span>
                            <span><?php echo (int)$row['role_id']; ?></span>
                        </p>
                        <p>
                            <span>Username</span>
                            <span><?php echo htmlspecialchars($row['username']); ?></span>
                        </p>
                        <!-- Menampilkan password TIDAK disarankan, tapi jika diperlukan: -->
                        <p>
                            <span>Password</span>
                            <span><?php echo htmlspecialchars($row['password']); // ! Hanya jika benar-benar perlu ?></span>
                        </p>
                        <p>
                            <span>No. Phone</span>
                            <span><?php echo htmlspecialchars($row['no_phone']); ?></span>
                        </p>
                        <p>
                            <span>Email</span>
                            <span><?php echo htmlspecialchars($row['email']); ?></span>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </main>
        </div>
    </div>
</html>