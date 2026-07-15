<?php
include "securityadmin.php";
include "../koneksi.php";

$message = '';
$messageType = '';

// ===== KONEKSI PDO UNTUK NOTIFIKASI =====
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    // Jika gagal, notifikasi tidak akan muncul, tapi halaman tetap jalan
    $pdo = null;
}

// Tambah Output
if (isset($_POST['add_output'])) {
    $name = trim($_POST['output_name']);
    if (!empty($name)) {
        $stmt = $conn->prepare("INSERT INTO outputs (output_name) VALUES (?)");
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            $message = "Output berhasil ditambahkan.";
            $messageType = "success";
        } else {
            $message = "Gagal menambahkan output: " . $conn->error;
            $messageType = "error";
        }
        $stmt->close();
    } else {
        $message = "Nama output tidak boleh kosong.";
        $messageType = "error";
    }
    header("Location: editoutput.php?msg=" . urlencode($message) . "&type=" . $messageType);
    exit;
}

// Edit Output
if (isset($_POST['edit_output'])) {
    $id = (int)$_POST['output_id'];
    $name = trim($_POST['output_name']);
    if ($id > 0 && !empty($name)) {
        $stmt = $conn->prepare("UPDATE outputs SET output_name = ? WHERE output_id = ?");
        $stmt->bind_param("si", $name, $id);
        if ($stmt->execute()) {
            $message = "Output berhasil diperbarui.";
            $messageType = "success";
        } else {
            $message = "Gagal memperbarui output: " . $conn->error;
            $messageType = "error";
        }
        $stmt->close();
    } else {
        $message = "Data tidak valid.";
        $messageType = "error";
    }
    header("Location: editoutput.php?msg=" . urlencode($message) . "&type=" . $messageType);
    exit;
}

// Hapus Output
if (isset($_GET['delete_output'])) {
    $id = (int)$_GET['delete_output'];
    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM outputs WHERE output_id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $message = "Output berhasil dihapus.";
            $messageType = "success";
        } else {
            $message = "Gagal menghapus output: " . $conn->error;
            $messageType = "error";
        }
        $stmt->close();
    } else {
        $message = "ID tidak valid.";
        $messageType = "error";
    }
    header("Location: editoutput.php?msg=" . urlencode($message) . "&type=" . $messageType);
    exit;
}

// Tampilkan pesan jika ada
if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
    $messageType = isset($_GET['type']) ? $_GET['type'] : 'info';
}

// Ambil data output
$sql = "SELECT output_id, output_name FROM outputs ORDER BY output_id ASC";
$result = $conn->query($sql);
$outputs = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $outputs[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Output - Aneka Galery</title>
    <link rel="shortcut icon" href="../img/anekagalery_32x32.png">
    <link rel="stylesheet" href="../css/editoutput.css">
    <link rel="stylesheet" href="../css/notif.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <a href="project.php">
                <i class="fas fa-folder-open"></i> 
                Project</a>
            <a>
                <i class="fas fa-pencil-alt"></i> 
                Service</a>
            <a href="editlayanan.php" class="sub">
                <i class="fas fa-cogs"></i> 
                Edit Services</a>
            <a href="editukuran.php" class="sub">
                <i class="fas fa-ruler"></i> 
                Edit Sizes</a>
            <a href="editjenis.php" class="sub" >
                <i class="fas fa-palette"></i> 
                Edit Types</a>
            <a href="editoutput.php" class="sub active">
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
                <?php include "notif_widget.php"; ?> <!-- NOTIFIKASI DINAMIS -->
                    <a href="logout.php" class="btn light"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </header>

        <main class="content">
            <h1>Output</h1>

            <?php if ($message): ?>
                <div class="alert alert-<?= $messageType ?>">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <div class="toolbar">
                <button class="btn-add" id="btnAdd">
                    <i class="fas fa-plus-circle"></i> Add Output
                </button>
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari output..." onkeyup="filterTable()">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <table class="data-table" id="dataTable">
                <thead>
                    <tr>
                        <th style="width:60px;">No</th>
                        <th>Nama Output</th>
                        <th style="width:180px; text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php if (count($outputs) > 0): ?>
                        <?php foreach ($outputs as $out): ?>
                        <tr>
                            <td><?= (int)$out['output_id'] ?></td>
                            <td><?= htmlspecialchars($out['output_name']) ?></td>
                            <td class="actions" style="text-align:center;">
                                <button class="btn-action edit" data-id="<?= $out['output_id'] ?>" data-name="<?= htmlspecialchars($out['output_name']) ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn-action delete" data-id="<?= $out['output_id'] ?>" data-name="<?= htmlspecialchars($out['output_name']) ?>">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="no-data">No have data output yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<!-- ===================== MODAL ADD ===================== -->
<div class="modal-overlay" id="addModal">
    <div class="modal-box">
        <button class="close-modal" id="closeAddModal">&times;</button>
        <h2>Add Output</h2>
        <form method="POST" action="">
            <input type="hidden" name="add_output" value="1">
            <div class="form-group">
                <label for="addName">Name</label>
                <input type="text" id="addName" name="output_name" placeholder="Masukkan nama output" required>
            </div>
            <div class="form-group">
                <label>Type</label>
                <div class="readonly-input">Output</div>
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
        <h2>Edit Output</h2>
        <form method="POST" action="">
            <input type="hidden" name="edit_output" value="1">
            <input type="hidden" id="editId" name="output_id">
            <div class="form-group">
                <label for="editName">Name</label>
                <input type="text" id="editName" name="output_name" placeholder="Masukkan nama output" required>
            </div>
            <div class="form-group">
                <label>Type</label>
                <div class="readonly-input">Output</div>
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
    <div class="modal-box" style="max-width: 420px;">
        <button class="close-modal" id="closeDeleteModal">&times;</button>
        <h2>Konfirmasi Hapus</h2>
        <p style="margin-bottom: 16px; font-size: 15px;">Apakah Anda yakin ingin menghapus output ini?</p>
        <div style="background: #f8f9fa; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
            <div><strong>Nama:</strong> <span id="deleteNameDisplay">-</span></div>
            <div><strong>Type:</strong> Output</div>
        </div>
        <div class="modal-actions">
            <button type="button" class="btn btn-cancel" id="cancelDelete">Cancel</button>
            <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Confirm & Delete</a>
        </div>
    </div>
</div>

<script>
    // Filter Tabel
    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            const td = row.querySelector('td:nth-child(2)');
            if (td) {
                const text = td.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            }
        });
    }

    // Add
    const addModal = document.getElementById('addModal');
    const btnAdd = document.getElementById('btnAdd');
    const closeAdd = document.getElementById('closeAddModal');
    const cancelAdd = document.getElementById('cancelAdd');

    btnAdd.addEventListener('click', () => addModal.classList.add('active'));
    closeAdd.addEventListener('click', () => addModal.classList.remove('active'));
    cancelAdd.addEventListener('click', () => addModal.classList.remove('active'));
    addModal.addEventListener('click', (e) => { if (e.target === addModal) addModal.classList.remove('active'); });

    // Edit
    const editModal = document.getElementById('editModal');
    const closeEdit = document.getElementById('closeEditModal');
    const cancelEdit = document.getElementById('cancelEdit');
    const editId = document.getElementById('editId');
    const editName = document.getElementById('editName');

    document.querySelectorAll('.btn-action.edit').forEach(btn => {
        btn.addEventListener('click', function() {
            editId.value = this.dataset.id;
            editName.value = this.dataset.name;
            editModal.classList.add('active');
        });
    });
    closeEdit.addEventListener('click', () => editModal.classList.remove('active'));
    cancelEdit.addEventListener('click', () => editModal.classList.remove('active'));
    editModal.addEventListener('click', (e) => { if (e.target === editModal) editModal.classList.remove('active'); });

    // Delete
    const deleteModal = document.getElementById('deleteModal');
    const closeDelete = document.getElementById('closeDeleteModal');
    const cancelDelete = document.getElementById('cancelDelete');
    const deleteNameDisplay = document.getElementById('deleteNameDisplay');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    document.querySelectorAll('.btn-action.delete').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            deleteNameDisplay.textContent = name;
            confirmDeleteBtn.href = '?delete_output=' + id;
            deleteModal.classList.add('active');
        });
    });
    closeDelete.addEventListener('click', () => deleteModal.classList.remove('active'));
    cancelDelete.addEventListener('click', () => deleteModal.classList.remove('active'));
    deleteModal.addEventListener('click', (e) => { if (e.target === deleteModal) deleteModal.classList.remove('active'); });

    // Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.active').forEach(modal => modal.classList.remove('active'));
        }
    });

    // Auto close alert
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) alert.style.display = 'none';
    }, 5000);
</script>
<script src="../js/notif.js" defer></script>
</body>
</html>