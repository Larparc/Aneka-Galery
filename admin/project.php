<?php
include "security.php";
include "../koneksi.php";

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
  <title>Project - Aneka Galery</title>
  <link rel="stylesheet" href="../css/account.css">
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

      <a href="project.php" class="active">
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
</div>

<div class="content">

</div>
</div>
</div>
</html>