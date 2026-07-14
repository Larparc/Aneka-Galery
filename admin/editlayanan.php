<?php
include "securityadmin.php";
include "../koneksi.php";

$message = '';
$messageType = '';

// Tambah Layanan
if (isset($_POST['add_service'])) {
    $name = trim($_POST['service_name']);
    if (!empty($name)) {
        $stmt = $conn->prepare("INSERT INTO services (service_name) VALUES (?)");
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            $message = "Layanan berhasil ditambahkan.";
            $messageType = "success";
        } else {
            $message = "Gagal menambahkan layanan: " . $conn->error;
            $messageType = "error";
        }
        $stmt->close();
    } else {
        $message = "Nama layanan tidak boleh kosong.";
        $messageType = "error";
    }
    // Redirect agar tidak ada resubmit
    header("Location: editlayanan.php?msg=" . urlencode($message) . "&type=" . $messageType);
    exit;
}

// Edit Layanan
if (isset($_POST['edit_service'])) {
    $id = (int)$_POST['service_id'];
    $name = trim($_POST['service_name']);
    if ($id > 0 && !empty($name)) {
        $stmt = $conn->prepare("UPDATE services SET service_name = ? WHERE service_id = ?");
        $stmt->bind_param("si", $name, $id);
        if ($stmt->execute()) {
            $message = "Layanan berhasil diperbarui.";
            $messageType = "success";
        } else {
            $message = "Gagal memperbarui layanan: " . $conn->error;
            $messageType = "error";
        }
        $stmt->close();
    } else {
        $message = "Data tidak valid.";
        $messageType = "error";
    }
    header("Location: editlayanan.php?msg=" . urlencode($message) . "&type=" . $messageType);
    exit;
}

// Hapus Layanan
if (isset($_GET['delete_service'])) {
    $id = (int)$_GET['delete_service'];
    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM services WHERE service_id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $message = "Layanan berhasil dihapus.";
            $messageType = "success";
        } else {
            $message = "Gagal menghapus layanan: " . $conn->error;
            $messageType = "error";
        }
        $stmt->close();
    } else {
        $message = "ID tidak valid.";
        $messageType = "error";
    }
    header("Location: editlayanan.php?msg=" . urlencode($message) . "&type=" . $messageType);
    exit;
}

// Tampilkan pesan jika ada
if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
    $messageType = isset($_GET['type']) ? $_GET['type'] : 'info';
}

// Ambil data layanan
$sql = "SELECT service_id, service_name FROM services ORDER BY service_id ASC";
$result = $conn->query($sql);
$services = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Layanan - Aneka Galery</title>
    <link rel="shortcut icon" href="../img/anekagalery_32x32.png">
    <link rel="stylesheet" href="../css/panel.css">
    <link rel="stylesheet" href="../css/editlayanan.css">
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
                <i class="fas fa-user"></i> Account</a>
                
            <small>Pages</small>
            <a href="project.php">
                <i class="fas fa-folder-open"></i> 
                Project</a>
            <a>
                <i class="fas fa-pencil-alt"></i> 
                Service</a>
            <a href="editlayanan.php" class="sub active">
                <i class="fas fa-cogs"></i> 
                Edit Services</a>
            <a href="editukuran.php" class="sub">
                <i class="fas fa-ruler"></i> 
                Edit Sizes</a>
            <a href="editjenis.php" class="sub" >
                <i class="fas fa-palette"></i> 
                Edit Types</a>
            <a href="editoutput.php" class="sub" >
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
                <div style="position:relative;display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;border-radius:50%;background:rgba(255,255,255,0.14);cursor:default;">
                    <i class="fas fa-bell" style="font-size:18px;color:#fff;"></i>
                    <span style="position:absolute;top:0;right:0;width:12px;height:12px;border-radius:50%;background:#e84545;border:2px solid #156161;"></span>
                </div>
                <a href="logout.php" class="btn light"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </header>

        <main class="content">
            <h1>Services</h1>

            <?php if ($message): ?>
                <div class="alert alert-<?= $messageType ?>">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <div class="layanan-toolbar">
                <button class="btn-add-layanan" id="btnAddLayanan">
                    <i class="fas fa-plus-circle"></i> Add Service
                </button>
                <div class="search-box">
                    <input type="text" id="searchLayanan" placeholder="Cari layanan..." onkeyup="filterTable()">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <table class="layanan-table" id="layananTable">
                <thead>
                    <tr>
                        <th style="width:60px;">No</th>
                        <th>Nama Service</th>
                        <th style="width:180px; text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php if (count($services) > 0): ?>
                        <?php foreach ($services as $svc): ?>
                        <tr>
                            <td><?= (int)$svc['service_id'] ?></td>
                            <td><?= htmlspecialchars($svc['service_name']) ?></td>
                            <td class="actions" style="text-align:center;">
                                <button class="btn-action edit" data-id="<?= $svc['service_id'] ?>" data-name="<?= htmlspecialchars($svc['service_name']) ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn-action delete" data-id="<?= $svc['service_id'] ?>" data-name="<?= htmlspecialchars($svc['service_name']) ?>">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="no-data">No have data service yet.</td></tr>
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
        <h2>Add Layanan</h2>
        <form method="POST" action="">
            <input type="hidden" name="add_service" value="1">
            <div class="form-group">
                <label for="addName">Name</label>
                <input type="text" id="addName" name="service_name" placeholder="Masukkan nama layanan" required>
            </div>
            <div class="form-group">
                <label>Type</label>
                <div class="readonly-input">Layanan</div>
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
        <h2>Edit Layanan</h2>
        <form method="POST" action="">
            <input type="hidden" name="edit_service" value="1">
            <input type="hidden" id="editId" name="service_id">
            <div class="form-group">
                <label for="editName">Name</label>
                <input type="text" id="editName" name="service_name" placeholder="Masukkan nama layanan" required>
            </div>
            <div class="form-group">
                <label>Type</label>
                <div class="readonly-input">Layanan</div>
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
        <p style="margin-bottom: 16px; font-size: 15px;">Apakah Anda yakin ingin menghapus layanan ini?</p>
        <div style="background: #f8f9fa; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
            <div><strong>Nama:</strong> <span id="deleteNameDisplay">-</span></div>
            <div><strong>Type:</strong> Layanan</div>
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
        const input = document.getElementById('searchLayanan');
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
    const btnAdd = document.getElementById('btnAddLayanan');
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
            confirmDeleteBtn.href = '?delete_service=' + id;
            deleteModal.classList.add('active');
        });
    });
    closeDelete.addEventListener('click', () => deleteModal.classList.remove('active'));
    cancelDelete.addEventListener('click', () => deleteModal.classList.remove('active'));
    deleteModal.addEventListener('click', (e) => { if (e.target === deleteModal) deleteModal.classList.remove('active'); });

    // Exit/Close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.active').forEach(modal => modal.classList.remove('active'));
        }
    });

    // Alert/Notifikasi
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) alert.style.display = 'none';
    }, 5000);
</script>

</body>
</html>