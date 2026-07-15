<?php
include "securityadmin.php";
include "../koneksi.php";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Database connection failed : " . $e->getMessage());
}

// ===== PROSES CRUD =====

// Tambah
if (isset($_POST['add_announcement'])) {
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);
    $status = $_POST['status'] ?? 'inactive';
    $date = date('Y-m-d');
    $user_id = $_SESSION['user_id'] ?? 1; // sesuaikan dengan session Anda

    if (!empty($title) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO announcements (user_id, title, message, announcement_date, announcement_status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $title, $message, $date, $status]);
        $msg = "Announcement berhasil ditambahkan.";
        $type = "success";
    } else {
        $msg = "Title dan Message tidak boleh kosong.";
        $type = "error";
    }
    header("Location: announcement.php?msg=" . urlencode($msg) . "&type=" . $type);
    exit;
}

// Edit
if (isset($_POST['edit_announcement'])) {
    $id = (int)$_POST['announcement_id'];
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);
    $status = $_POST['status'] ?? 'inactive';

    if ($id > 0 && !empty($title) && !empty($message)) {
        $stmt = $pdo->prepare("UPDATE announcements SET title = ?, message = ?, announcement_status = ? WHERE announcement_id = ?");
        $stmt->execute([$title, $message, $status, $id]);
        $msg = "Announcement berhasil diperbarui.";
        $type = "success";
    } else {
        $msg = "Data tidak valid.";
        $type = "error";
    }
    header("Location: announcement.php?msg=" . urlencode($msg) . "&type=" . $type);
    exit;
}

// Hapus
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM announcements WHERE announcement_id = ?");
        $stmt->execute([$id]);
        $msg = "Announcement berhasil dihapus.";
        $type = "success";
    } else {
        $msg = "ID tidak valid.";
        $type = "error";
    }
    header("Location: announcement.php?msg=" . urlencode($msg) . "&type=" . $type);
    exit;
}

// Ubah status (toggle aktif/inaktif via AJAX atau link)
if (isset($_GET['toggle_status'])) {
    $id = (int)$_GET['toggle_status'];
    $status = $_GET['status'] ?? 'inactive';
    $newStatus = ($status === 'active') ? 'inactive' : 'active';
    if ($id > 0) {
        $stmt = $pdo->prepare("UPDATE announcements SET announcement_status = ? WHERE announcement_id = ?");
        $stmt->execute([$newStatus, $id]);
    }
    header("Location: announcement.php");
    exit;
}

// ===== TAMPILKAN DATA =====
$sql = "SELECT a.*, p.username 
        FROM announcements a
        LEFT JOIN profiles p ON a.user_id = p.user_id
        ORDER BY a.announcement_date DESC, a.announcement_id DESC";
$stmt = $pdo->query($sql);
$announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Statistik order (sama seperti halaman lain)
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

// Ambil pesan sukses/error
$message = '';
$messageType = '';
if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
    $messageType = isset($_GET['type']) ? $_GET['type'] : 'info';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Announcement - Aneka Galery</title>
    <link rel="stylesheet" href="../css/announcement.css">
    <link rel="stylesheet" href="../css/notif.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <a href="announcement.php" class="active">
                <i class="fas fa-bullhorn"></i> 
                Announcement</a>

            <small>Pages</small>
            <a href="project.php">
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
                <button class="btn round" id="menu-btn"><i class="fas fa-bars"></i></button>
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
                <?php include "notif_widget.php"; ?>
                <a href="logout.php" class="btn light"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </header>

        <main class="content">
            <div class="announcement-head">
                <h1>Announcement</h1>
                <button class="btn-add-announcement" id="btnAddAnnouncement">
                    <i class="fas fa-plus-circle"></i> Add Announcement
                </button>
            </div>

            <!-- Statistik -->
            <div class="cards">
                <div class="card">
                    <div><i class="fas fa-shopping-cart"></i><span>Total Order</span></div>
                    <b><?= $totalOrder; ?></b>
                </div>
                <div class="card">
                    <div><i class="fas fa-hourglass-half"></i><span>Order Pending</span></div>
                    <b><?= $pendingCount; ?></b>
                </div>
                <div class="card">
                    <div><i class="fas fa-check-circle"></i><span>Order Complete</span></div>
                    <b><?= $completeCount; ?></b>
                </div>
            </div>

            <?php if ($message): ?>
                <div class="alert alert-<?= $messageType ?>">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <!-- Tabel Announcement -->
            <div class="table-wrapper">
                <table class="announcement-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">ID</th>
                            <th style="min-width:150px;">Title</th>
                            <th>Message</th>
                            <th style="width:130px;">Date</th>
                            <th style="width:100px;">Status</th>
                            <th style="width:160px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($announcements)): ?>
                            <?php foreach ($announcements as $row): ?>
                                <tr>
                                    <td><?= (int)$row['announcement_id'] ?></td>
                                    <td><strong><?= htmlspecialchars($row['title']) ?></strong></td>
                                    <td><?= htmlspecialchars(mb_strimwidth($row['message'], 0, 80, '...')) ?></td>
                                    <td><?= htmlspecialchars(date('d M Y', strtotime($row['announcement_date']))) ?></td>
                                    <td>
                                        <span class="status-badge <?= $row['announcement_status'] ?>">
                                            <?= ucfirst($row['announcement_status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn-action edit" 
                                                data-id="<?= $row['announcement_id'] ?>"
                                                data-title="<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>"
                                                data-message="<?= htmlspecialchars($row['message'], ENT_QUOTES) ?>"
                                                data-status="<?= $row['announcement_status'] ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn-action delete" 
                                                data-id="<?= $row['announcement_id'] ?>"
                                                data-title="<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                        <a href="?toggle_status=<?= $row['announcement_id'] ?>&status=<?= $row['announcement_status'] ?>" 
                                           class="btn-action toggle <?= $row['announcement_status'] === 'active' ? 'active' : 'inactive' ?>"
                                           title="Toggle status">
                                            <i class="fas <?= $row['announcement_status'] === 'active' ? 'fa-toggle-on' : 'fa-toggle-off' ?>"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="empty-row">Belum ada announcement.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- ===================== MODAL ADD ===================== -->
<div class="modal-overlay" id="addModal">
    <div class="modal-box">
        <button class="close-modal" id="closeAddModal">&times;</button>
        <h2>Add Announcement</h2>
        <form method="POST" action="">
            <input type="hidden" name="add_announcement" value="1">
            <div class="form-group">
                <label for="addTitle">Title</label>
                <input type="text" id="addTitle" name="title" placeholder="Masukkan judul" required>
            </div>
            <div class="form-group">
                <label for="addMessage">Message</label>
                <textarea id="addMessage" name="message" rows="4" placeholder="Tulis pengumuman..." required></textarea>
            </div>
            <div class="form-group">
                <label for="addStatus">Status</label>
                <select id="addStatus" name="status">
                    <option value="inactive">Inactive</option>
                    <option value="active">Active</option>
                </select>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" id="cancelAdd">Cancel</button>
                <button type="submit" class="btn btn-confirm">Confirm & Add</button>
            </div>
        </form>
    </div>
</div>

<!-- ===================== MODAL EDIT ===================== -->
<div class="modal-overlay" id="editModal">
    <div class="modal-box">
        <button class="close-modal" id="closeEditModal">&times;</button>
        <h2>Edit Announcement</h2>
        <form method="POST" action="">
            <input type="hidden" name="edit_announcement" value="1">
            <input type="hidden" id="editId" name="announcement_id">
            <div class="form-group">
                <label for="editTitle">Title</label>
                <input type="text" id="editTitle" name="title" placeholder="Masukkan judul" required>
            </div>
            <div class="form-group">
                <label for="editMessage">Message</label>
                <textarea id="editMessage" name="message" rows="4" placeholder="Tulis pengumuman..." required></textarea>
            </div>
            <div class="form-group">
                <label for="editStatus">Status</label>
                <select id="editStatus" name="status">
                    <option value="inactive">Inactive</option>
                    <option value="active">Active</option>
                </select>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" id="cancelEdit">Cancel</button>
                <button type="submit" class="btn btn-confirm">Confirm & Change</button>
            </div>
        </form>
    </div>
</div>

<!-- ===================== MODAL DELETE ===================== -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal-box" style="max-width:420px;">
        <button class="close-modal" id="closeDeleteModal">&times;</button>
        <h2>Konfirmasi Hapus</h2>
        <p style="margin-bottom:16px;font-size:15px;">Apakah Anda yakin ingin menghapus announcement ini?</p>
        <div style="background:#f8f9fa;padding:12px 16px;border-radius:8px;margin-bottom:20px;">
            <div><strong>Title:</strong> <span id="deleteTitleDisplay">-</span></div>
        </div>
        <div class="modal-actions">
            <button type="button" class="btn btn-cancel" id="cancelDelete">Cancel</button>
            <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Confirm & Delete</a>
        </div>
    </div>
</div>

<script>
    // ===== MODAL ADD =====
    const addModal = document.getElementById('addModal');
    const btnAdd = document.getElementById('btnAddAnnouncement');
    const closeAdd = document.getElementById('closeAddModal');
    const cancelAdd = document.getElementById('cancelAdd');

    btnAdd.addEventListener('click', () => addModal.classList.add('active'));
    closeAdd.addEventListener('click', () => addModal.classList.remove('active'));
    cancelAdd.addEventListener('click', () => addModal.classList.remove('active'));
    addModal.addEventListener('click', (e) => { if (e.target === addModal) addModal.classList.remove('active'); });

    // ===== MODAL EDIT =====
    const editModal = document.getElementById('editModal');
    const closeEdit = document.getElementById('closeEditModal');
    const cancelEdit = document.getElementById('cancelEdit');
    const editId = document.getElementById('editId');
    const editTitle = document.getElementById('editTitle');
    const editMessage = document.getElementById('editMessage');
    const editStatus = document.getElementById('editStatus');

    document.querySelectorAll('.btn-action.edit').forEach(btn => {
        btn.addEventListener('click', function() {
            editId.value = this.dataset.id;
            editTitle.value = this.dataset.title;
            editMessage.value = this.dataset.message;
            editStatus.value = this.dataset.status;
            editModal.classList.add('active');
        });
    });
    closeEdit.addEventListener('click', () => editModal.classList.remove('active'));
    cancelEdit.addEventListener('click', () => editModal.classList.remove('active'));
    editModal.addEventListener('click', (e) => { if (e.target === editModal) editModal.classList.remove('active'); });

    // ===== MODAL DELETE =====
    const deleteModal = document.getElementById('deleteModal');
    const closeDelete = document.getElementById('closeDeleteModal');
    const cancelDelete = document.getElementById('cancelDelete');
    const deleteTitleDisplay = document.getElementById('deleteTitleDisplay');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    document.querySelectorAll('.btn-action.delete').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const title = this.dataset.title;
            deleteTitleDisplay.textContent = title;
            confirmDeleteBtn.href = '?delete_id=' + id;
            deleteModal.classList.add('active');
        });
    });
    closeDelete.addEventListener('click', () => deleteModal.classList.remove('active'));
    cancelDelete.addEventListener('click', () => deleteModal.classList.remove('active'));
    deleteModal.addEventListener('click', (e) => { if (e.target === deleteModal) deleteModal.classList.remove('active'); });

    // ESC close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.active').forEach(modal => modal.classList.remove('active'));
        }
    });

    // Hilangkan alert setelah 5 detik
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) alert.style.display = 'none';
    }, 5000);
</script>
<script src="../js/notif.js" defer></script>
</body>
</html>