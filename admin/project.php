<?php
include "security.php";
include "../koneksi.php";

$sql = "SELECT *
        FROM projects";

$result = $conn->query($sql);
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
      <a href="customercontact.php">customer Contact</a>
    </nav>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="user">
        <button class="btn round" id="menu-btn" aria-label="Buka menu"></button>
        <img src="../img/foto.jpg" alt="Avatar" class="user-avatar">
        <a href="account.php">
          <div>
            <b><?php echo "welcome, " . $username; ?></b>
            <span>Administrator</span>
          </div>
        </a>
      </div>
      <div style="display:flex;align-items:center;gap:10px;">
        <a href="logout.php" class="btn light">Logout</a>
      </div>
    </header>

    <main class="content">
      <div class="project-head">
        <h1>Project</h1>
        <a href="add.php" class="btn-add-project">Tambah Project</a>
      </div>

      <div class="project-grid">
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
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
          <?php endwhile; ?>
        <?php else: ?>
          <div class="empty">Belum ada project yang diposting.</div>
        <?php endif; ?>
      </div>
    </main>
  </div>
</div>
</body>
</html>