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
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                    <a href="panel.php">
                        <i class="fas fa-th-large"></i>
                        Dashboard</a>
                    <a href="account.php">
                        <i class="fas fa-user"></i>
                        Account</a>
                    <small>Pages</small>
                    <a href="project.php" class="active">
                        <i class="fas fa-folder-open"></i>
                        Project</a>
                    <a>
                        <i class="fas fa-pencil-alt"></i>
                        Service</a>
                    <a href="editlayanan.php" class="sub">
                        <i class="fas fa-cogs"></i>
                        Edit Layanan</a>
                    <a href="editukuran.php" class="sub">
                        <i class="fas fa-ruler"></i>
                        Edit Ukuran</a>
                    <a href="editjenis.php" class="sub">
                        <i class="fas fa-palette"></i>
                        Edit Jenis</a>
                    <a href="editoutput.php" class="sub">
                        <i class="fas fa-print"></i>
                        Edit Output</a>
                    <a href="orderpending.php">
                        <i class="fas fa-clock"></i>
                        Order Pending</a>
                    <a href="ordercomplete.php">
                        <i class="fas fa-check-circle"></i>
                        Order Complete</a>
                    <a href="customercontact.php">
                        <i class="fas fa-envelope"></i>
                        Customer Contact</a>
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

                    <form
                        class="project-form"
                        action="update_project.php"
                        method="post"
                        enctype="multipart/form-data">
                        <input
                            type="hidden"
                            name="project_id"
                            value="<?php echo $post['project_id']; ?>">

                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                required="required"
                                maxlength="50"
                                value="<?php echo htmlspecialchars($post['title']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea id="description" name="description" rows="5" required="required"><?php echo htmlspecialchars($post['description']); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Gambar Saat Ini</label>
                            <img
                                src="../project_upload/<?php echo htmlspecialchars($post['image']); ?>"
                                class="current-image-preview"
                                alt="current image">
                        </div>

                        <div class="form-group">
                            <label for="image">Ganti Gambar (kosongkan jika tidak ingin ganti)</label>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/jpeg,image/png,image/webp">
                        </div>

                        <button type="submit" class="btn-submit-project">Simpan Perubahan</button>
                    </form>
                </main>
            </div>
        </div>
    </body>
</html>