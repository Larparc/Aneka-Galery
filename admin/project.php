<?php
include "securityadmin.php";
include "../koneksi.php";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Database connection failed : " . $e->getMessage());
}

$sql = "SELECT projects.*, profiles.username AS username
        FROM projects
        LEFT JOIN profiles ON projects.user_id = profiles.user_id
        ORDER BY projects.created_at DESC";
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("
    SELECT
        COUNT(*) AS total,
        SUM(order_status='pending') AS pending,
        SUM(order_status='complete') AS complete
    FROM orders
");
$stats = $stmt->fetch(PDO::FETCH_ASSOC);
$totalOrder = $stats['total'] ?? 0;
$pendingCount = $stats['pending'] ?? 0;
$completeCount = $stats['complete'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Project - Aneka Galery</title>
        <link rel="stylesheet" href="../css/project.css">
        <link rel="stylesheet" href="../css/notif.css">
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
            <i><img src="../img/anekagalery_32x32.png" alt=""></i>
            <div>
                <a href="../index.php">
                    <b>ANEKA GALERI</b>
                    <span>Digital Printing</span>
                </a>
            </div>
        </div>

                <nav>
                    <a href="panel.php">
                        <i class="fas fa-th-large"></i>
                        Dashboard</a>
                    <a href="account.php">
                        <i class="fas fa-user"></i>
                        Account</a>
                    <a href="announcement.php">
                        <i class="fas fa-bullhorn"></i> 
                        Announcement</a>

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
                        <button class="btn round" id="menu-btn">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="user-avatar-wrapper">
                            <img src="../img/foto.jpg" class="user-avatar" alt="avatar">
                        </div>
                        <a href="account.php">
                            <div>
                                <b><?= "Welcome, " . htmlspecialchars($username ?? "Admin"); ?></b>
                                <span>Administrator</span>
                            </div>
                        </a>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <?php include "notif_widget.php"; ?> <!-- NOTIFIKASI DINAMIS -->
                            <a href="logout.php" class="btn light"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </header>

                <main class="content">
                    <div class="project-head">
                        <h1>Project</h1>
                    </div>
                    <!-- Statistik -->
                    <div class="cards">
                        <div class="card">
                            <div>
                                <i class="fas fa-shopping-cart"></i>
                                <span>Total Order</span></div>
                            <b><?= $totalOrder; ?></b>
                        </div>
                        <div class="card">
                            <div>
                                <i class="fas fa-hourglass-half"></i>
                                <span>Order Pending</span></div>
                            <b><?= $pendingCount; ?></b>
                        </div>
                        <div class="card">
                            <div>
                                <i class="fas fa-check-circle"></i>
                                <span>Order Complete</span></div>
                            <b><?= $completeCount; ?></b>
                        </div>
                    </div>
                    <a href="addproject.php" class="btn-add-project">Add Project</a>

                    <div class="project-grid">
                        <?php if (!empty($result)): ?>
                        <?php foreach ($result as $row): ?>
                        <div class="project-card">
                            <a
                                href="#"
                                class="btn-edit project-photo-link"
                                data-id="<?php echo (int) $row['project_id']; ?>"
                                data-title="<?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?>"
                                data-desc="<?php echo htmlspecialchars($row['description'], ENT_QUOTES); ?>"
                                data-image="<?php echo htmlspecialchars($row['image'], ENT_QUOTES); ?>">
                                <img
                                    src="../project_upload/<?php echo htmlspecialchars($row['image']); ?>"
                                    alt="<?php echo htmlspecialchars($row['title']); ?>">
                            </a>
                            <div class="project-card-body">
                                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                                <p><?php echo htmlspecialchars(mb_strimwidth($row['description'], 0, 100, '...')); ?></p>
                                <span class="project-date"><?php echo htmlspecialchars(date('d M Y H:i', strtotime($row['created_at']))); ?>
                                    · by
                                    <?php echo htmlspecialchars($row['username']); ?></span>
                                <div class="project-actions">
                                    <a
                                        href="#"
                                        class="btn-edit"
                                        data-id="<?php echo (int) $row['project_id']; ?>"
                                        data-title="<?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?>"
                                        data-desc="<?php echo htmlspecialchars($row['description'], ENT_QUOTES); ?>"
                                        data-image="<?php echo htmlspecialchars($row['image'], ENT_QUOTES); ?>">Edit</a>
                                    <a
                                        href="#"
                                        class="btn-delete"
                                        data-id="<?php echo (int) $row['project_id']; ?>"
                                        data-title="<?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?>">Delete</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty">Belum ada project yang diposting.</div>
                        <?php endif; ?>
                    </div>
                </main>
            </div>

            <!-- Popup Konfirmasi Hapus -->
            <div class="modal-overlay" id="deleteModalOverlay">
                <div class="modal-box">
                    <h3>Hapus Project?</h3>
                    <p class="modal-warning-text">
                        "<span id="deleteProjectTitle"></span>" akan dihapus permanen dan tidak bisa dikembalikan.
                    </p>
                    <form id="deleteForm" action="delete_project.php" method="get">
                        <input type="hidden" name="id" id="deleteProjectId">
                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                            <button type="submit" class="btn-modal-confirm">Ya, Hapus</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Popup Edit Project -->
            <div class="modal-overlay-edit" id="editModalOverlay">
                <div class="edit-modal-box">
                    <div class="edit-header">
                        <button type="button" class="edit-back-btn" onclick="closeEditModal()">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <div class="edit-title-group">
                            <span class="edit-label">Edit Project</span>
                            <h2 class="edit-title" id="editTitleDisplay">Judul Project</h2>
                        </div>
                    </div>

                    <form
                        id="editForm"
                        action="update_project.php"
                        method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="project_id" id="editProjectId">

                        <div class="edit-body">
                            <div class="edit-image-area">
                                <img id="editImagePreview" src="" alt="preview" class="edit-image-preview-img">
                            </div>
                            <div class="edit-desc-area">
                                <div class="edit-desc-header">
                                    <span class="edit-desc-label">Judul</span>
                                </div>
                                <input
                                    type="text"
                                    name="title"
                                    id="editTitleInput"
                                    class="edit-desc-input edit-title-input"
                                    required="required"
                                    maxlength="50">

                                <div class="edit-desc-header">
                                    <span class="edit-desc-label">Deskripsi</span>
                                </div>
                                <textarea
                                    name="description"
                                    id="editDescInput"
                                    class="edit-desc-input edit-textarea-input"
                                    rows="5"
                                    required="required"></textarea>

                                <div class="edit-desc-header" style="margin-top:14px;">
                                    <span class="edit-desc-label">Ganti Gambar (opsional)</span>
                                </div>
                                <input
                                    type="file"
                                    name="image"
                                    class="edit-file-input"
                                    accept="image/jpeg,image/png,image/webp">
                            </div>
                        </div>

                        <div class="edit-footer">
                            <button type="button" class="btn-edit-delete" onclick="closeEditModal()">Batal</button>
                            <button type="submit" class="btn-edit-confirm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                function openDeleteModal(id, title) {
                    document
                        .getElementById('deleteProjectId')
                        .value = id;
                    document
                        .getElementById('deleteProjectTitle')
                        .textContent = title;
                    document
                        .getElementById('deleteModalOverlay')
                        .classList
                        .add('show');
                }
                function closeDeleteModal() {
                    document
                        .getElementById('deleteModalOverlay')
                        .classList
                        .remove('show');
                }

                function openEditModal(id, title, description, image) {
                    document
                        .getElementById('editProjectId')
                        .value = id;
                    document
                        .getElementById('editTitleInput')
                        .value = title;
                    document
                        .getElementById('editTitleDisplay')
                        .textContent = title;
                    document
                        .getElementById('editDescInput')
                        .value = description;
                    document
                        .getElementById('editImagePreview')
                        .src = '../project_upload/' + image;
                    document
                        .getElementById('editModalOverlay')
                        .classList
                        .add('show');
                }
                function closeEditModal() {
                    document
                        .getElementById('editModalOverlay')
                        .classList
                        .remove('show');
                }

                // pasang event listener ke semua tombol Edit
                document
                    .querySelectorAll('.btn-edit')
                    .forEach(function (btn) {
                        btn.addEventListener('click', function (e) {
                            e.preventDefault();
                            openEditModal(
                                this.dataset.id,
                                this.dataset.title,
                                this.dataset.desc,
                                this.dataset.image
                            );
                        });
                    });

                // pasang event listener ke semua tombol Hapus
                document
                    .querySelectorAll('.btn-delete')
                    .forEach(function (btn) {
                        btn.addEventListener('click', function (e) {
                            e.preventDefault();
                            openDeleteModal(this.dataset.id, this.dataset.title);
                        });
                    });

                // klik di luar box popup buat nutup
                document
                    .getElementById('deleteModalOverlay')
                    .addEventListener('click', function (e) {
                        if (e.target === this) 
                            closeDeleteModal();
                        }
                    );
                document
                    .getElementById('editModalOverlay')
                    .addEventListener('click', function (e) {
                        if (e.target === this) 
                            closeEditModal();
                        }
                    );
            </script>
            <script src="../js/notif.js" defer></script>
        </div>
    </body>
</html>