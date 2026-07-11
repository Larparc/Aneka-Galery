<?php
include "security.php";
include "../koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM projects WHERE project_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$post) {
    header("Location: project.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Project - Aneka Galery</title>
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
        <h1>Edit Project</h1>
        <a href="project.php" class="btn-add-project">← Kembali</a>
      </div>

      <form class="project-form" action="update_project.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="project_id" value="<?php echo $post['project_id']; ?>">

        <div class="form-group">
          <label for="title">Judul</label>
          <input type="text" id="title" name="title" required maxlength="50" value="<?php echo htmlspecialchars($post['title']); ?>">
        </div>

        <div class="form-group">
          <label for="description">Deskripsi</label>
          <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($post['description']); ?></textarea>
        </div>

        <div class="form-group">
          <label>Gambar Saat Ini</label>
          <img src="../project_upload/<?php echo htmlspecialchars($post['image']); ?>" class="current-image-preview" alt="current image">
        </div>

        <div class="form-group">
          <label for="image">Ganti Gambar (kosongkan jika tidak ingin ganti)</label>
          <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
        </div>

        <button type="submit" class="btn-submit-project">Simpan Perubahan</button>
      </form>
    </main>
  </div>
</div>
</body>
</html>