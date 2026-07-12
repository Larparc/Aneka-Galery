<?php
include "security.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Project - Aneka Galery</title>
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
        <h1>Tambah Project</h1>
        <a href="project.php" class="btn-add-project">Kembali</a>
      </div>

      <form class="project-form" action="sv_project.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Judul</label>
          <input type="text" id="title" name="title" required maxlength="50" placeholder="Judul project">
        </div>

        <div class="form-group">
          <label for="description">Deskripsi</label>
          <textarea id="description" name="description" rows="5" required placeholder="Ceritakan tentang project ini..."></textarea>
        </div>

        <div class="form-group">
          <label for="image">Gambar</label>
          <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" required>
          <img id="imagePreview" class="image-preview" alt="Preview gambar">
        </div>

        <button type="submit" class="btn-submit-project">Post Project</button>
      </form>
    </main>
  </div>
</div>
<script>
  const imageInput = document.getElementById('image');
  const imagePreview = document.getElementById('imagePreview');

  imageInput.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.classList.add('show');
      };
      reader.readAsDataURL(file);
    } else {
      imagePreview.classList.remove('show');
      imagePreview.removeAttribute('src');
    }
  });
</script>
</body>
</html>