<?php
include "security.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Account - Aneka Galery</title>
  <link rel="stylesheet" href="../css/account.css">
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
      <a href="orderpending.php" class="active">
        Order Pending
      </a>
      <a href="ordercomplete.php">
        Order Complete
      </a>
    </nav>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="user">
        <button class="btn round" id="menu-btn" aria-label="Buka menu">
        </button>
        <img src="../img/foto.jpg" alt="Avatar" class="user-avatar">
        <div>
          <b><?php echo "welcome, ".$username; ?></b>
          <span>Administrator</span>
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:10px;">
        <button class="btn round" aria-label="Notifikasi">
        </button>
        <a href="logout.php" class="btn light">
          Logout
        </a>
      </div>
    </header>
  </div>
</div>
</html>