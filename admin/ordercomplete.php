<?php
include "security.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/anekagalery_32x32.png">
    <title>OrderComplete</title>
    <link rel="stylesheet" href="../css/ordercomplete.css">
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
      <a href="ordercomplete.php" class="active">
        Order Complete
      </a>
    </nav>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="user">
        <button class="btn round" id="menu-btn" aria-label="Buka menu">
        </button>
        <i><img src="../img/foto.jpg" alt="profile" class="user-avatar"></i>
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
      <h1>Order Complete</h1>
      <div class="list" id="order-complete-list"></div>
    </main>
  </div>
</div>

</body>
</html>