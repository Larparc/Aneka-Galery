<?php
include "security.php";
?>
<!DOCTYPE html>
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
      <i></i>
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
    </nav>
  </aside>
<div class="main">
    <header class="topbar">
      <div class="user">
        <button class="btn round" id="menu-btn" aria-label="Buka menu">
        </button>
        <i></i>
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

    <main class="content">
      <h1>Dashboard</h1>

      <div class="cards">
        <a href="project.php" class="card">
          <i></i>
          <div><b id="stat-projects">0</b><span>Total Project</span></div>
        </a>
        <a href="orderpending.php" class="card">
          <i></i>
          <div><b id="stat-pending">0</b><span>Order Pending</span></div>
        </a>
        <a href="ordercomplete.php" class="card">
          <i></i>
          <div><b id="stat-complete">0</b><span>Order Complete</span></div>
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
    </main>
  </div>
</div>
</body>
</html>
