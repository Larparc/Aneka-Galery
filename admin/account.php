<?php
include "security.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Account - Aneka Galery</title>
  <link rel="stylesheet" href="../css/account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  
</body>
<div class="app">
  <div class="overlay" id="overlay"></div>

  <aside class="sidebar" id="sidebar">
    <div class="logo">
      <i><img src="../img/anekagalery_32x32.png" alt="logo"></i>
      <div><a href="../index.php">
          <b>ANEKA GALERI</b>
          <span>Digital Printing</span>
      </div></a>
    </div>

        <nav>
            <a href="panel.php"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="account.php" class="active"><i class="fas fa-user"></i> Account</a>
            <small>Pages</small>
            <a href="project.php"><i class="fas fa-folder-open"></i> Project</a>
            <a href="orderpending.php"><i class="fas fa-clock"></i> Order Pending</a>
            <a href="ordercomplete.php"><i class="fas fa-check-circle"></i> Order Complete</a>
            <a href="customercontact.php"><i class="fas fa-envelope"></i> Customer Contact</a>
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
          <b><?php echo "Welcome, ".$username; ?></b>
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
      <h1>Account</h1>
      <div class="account">
        <img src="../img/foto.jpg" alt="Avatar" class="account-avatar">
        <p><span>Nama</span><span><?php echo "".$username; ?></span></p>
        <p><span>Email</span><span><?php echo htmlspecialchars($email); ?></span></p>
        <p><span>No Phone</span><span><?php echo htmlspecialchars($no_phone); ?></span></p>
        <p><span>Role</span><span>Administrator</span></p>
        <p><span>Toko</span><span>Aneka Galeri Printing</span></p>
        <p><span>Status</span><span style="color:#147a4f;">Aktif</span></p>
      </div>
    </main>
  </div>
</div>
</html>