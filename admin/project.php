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

$sql = "SELECT * FROM projects";
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Project - Aneka Galery</title>
  <link rel="stylesheet" href="../css/project.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
      <a href="panel.php"><i class="fas fa-th-large"></i> Dashboard</a>
      <a href="account.php"><i class="fas fa-user"></i> Account</a>
      <small>Pages</small>
      <a href="project.php" class="active"><i class="fas fa-folder-open"></i> Project</a>
      <a href="orderpending.php"><i class="fas fa-clock"></i> Order Pending</a>
      <a href="ordercomplete.php"><i class="fas fa-check-circle"></i> Order Complete</a>
      <a href="customercontact.php"><i class="fas fa-envelope"></i> Customer Contact</a>
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
      <div class="project-head">
        <h1>Project</h1>
        <a href="add.php" class="btn-add-project">Tambah Project</a>
      </div>

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

      <div class="project-grid">
        <?php if (!empty($result)): ?>
          <?php foreach ($result as $row): ?>
            <div class="project-card">
              <img src="../project_upload/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
              <div class="project-card-body">
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <p><?php echo htmlspecialchars(mb_strimwidth($row['description'], 0, 100, '...')); ?></p>
                <span class="project-date"><?php echo htmlspecialchars(date('d M Y H:i', strtotime($row['created_at']))); ?> · by <?php echo htmlspecialchars($row['username']); ?></span>
                <div class="project-actions">
                  <a href="edit.php?id=<?php echo $row['project_id']; ?>" class="btn-edit">Edit</a>
                  <a href="delete.php?id=<?php echo $row['project_id']; ?>"
                     class="btn-delete"
                     onclick="return confirm('Yakin mau hapus project ini?');">Hapus</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="empty">Belum ada project yang diposting.</div>
        <?php endif; ?>
      </div>
    </main>
  </div>
</div>
</body>
</html>