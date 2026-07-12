<?php
include "security.php";
$host = "localhost";
$dbname = "aneka_galery";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Database connection failed : " . $e->getMessage());
}

// Statistik
$stmt = $pdo->query("
    SELECT
        COUNT(*) AS total,
        SUM(order_status='pending') AS pending,
        SUM(order_status='complete') AS complete
    FROM orders
");
$stats = $stmt->fetch(PDO::FETCH_ASSOC);
$totalOrder = $stats['total'] ?? 0;
$pendingCount = $stats['pending'] ?? 0;
$completeCount = $stats['complete'] ?? 0;

$sql = "SELECT c.no_contact, c.date, c.message, p.username, p.email, p.no_phone
        FROM contacts c
        JOIN profiles p ON c.user_id = p.user_id
        ORDER BY c.date DESC";
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Contact - Aneka Galery</title>
  <link rel="stylesheet" href="../css/customercontact.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="shortcut icon" href="../img/anekagalery_32x32.png">
</head>
<body>
  
</body>
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
      <a href="panel.php"><i class="fas fa-th-large"></i> Dashboard</a>
      <a href="account.php"><i class="fas fa-user"></i> Account</a>
      <small>Pages</small>
      <a href="project.php"><i class="fas fa-folder-open"></i> Project</a>
      <a href="orderpending.php"><i class="fas fa-clock"></i> Order Pending</a>
      <a href="ordercomplete.php"><i class="fas fa-check-circle"></i> Order Complete</a>
      <a href="customercontact.php" class="active"><i class="fas fa-envelope"></i> Customer Contact</a>
    </nav>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="user">
        <button class="btn round" id="menu-btn"><i class="fas fa-bars"></i></button>
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
        <button class="btn round"><i class="fas fa-bell"></i></button>
        <a href="logout.php" class="btn light"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
    </header>

    <main class="content">
      <h1>Customer Contact</h1>

      <!-- Statistik -->
      <div class="cards">
        <div class="card">
          <div><i class="fas fa-shopping-cart"></i><span>Total Order</span></div>
          <b><?= $totalOrder; ?></b>
        </div>
        <div class="card">
          <div><i class="fas fa-hourglass-half"></i><span>Order Pending</span></div>
          <b><?= $pendingCount; ?></b>
        </div>
        <div class="card">
          <div><i class="fas fa-check-circle"></i><span>Order Complete</span></div>
          <b><?= $completeCount; ?></b>
        </div>
      </div>

      <table class="contact-table">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No. Telp</th>
            <th>Pesan</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($result)): ?>
            <?php foreach ($result as $row): ?>
              <tr>
                <td><?php echo htmlspecialchars(date('d M Y', strtotime($row['date']))); ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['no_phone']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" style="text-align:center; color:#888;">Belum ada pesan masuk.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </main>
  </div>
</div>
</html>