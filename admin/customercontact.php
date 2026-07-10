<?php
include "security.php";
include "../koneksi.php";

$sql = "SELECT c.no_contact, c.date, c.message, p.username, p.email, p.no_phone
        FROM contacts c
        JOIN profiles p ON c.user_id = p.user_id
        ORDER BY c.date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Contact - Aneka Galery</title>
  <link rel="stylesheet" href="../css/customercontact.css">
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
      <a href="panel.php">
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
      <a href="customercontact.php" class="active">
        customer Contact
      </a>
    </nav>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="user">
        <button class="btn round" id="menu-btn" aria-label="Buka menu">
        </button>
        <img src="../img/foto.jpg" alt="Avatar" class="user-avatar">
        <a href="account.php">
        <div>
          <b><?php echo "welcome, ".$username; ?></b>
          <span>Administrator</span>
        </div>
      </a>
      </div>
      <div style="display:flex;align-items:center;gap:10px;">
        <button class="btn round" aria-label="Notifikasi">
        </button>
        <a href="logout.php" class="btn light">
          Logout
        </a>
      </div>
    </header>

    <main class="content">
      <h1>Customer Contact</h1>

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
          <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?php echo htmlspecialchars(date('d M Y', strtotime($row['date']))); ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['no_phone']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
              </tr>
            <?php endwhile; ?>
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