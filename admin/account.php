<?php
include "security.php";
include "../koneksi.php";

// ===== KONEKSI PDO UNTUK NOTIFIKASI =====
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    // Jika gagal, notifikasi tidak akan muncul, tapi halaman tetap jalan
    $pdo = null;
}

$sql = "SELECT user_id, username, email, no_phone, role_id FROM profiles ORDER BY role_id ASC, username ASC";
$res = mysqli_query($conn, $sql);

$admins = [];
$users  = [];
while ($row = mysqli_fetch_assoc($res)) {
    if ((int) $row['role_id'] === 1) {
        $admins[] = $row;
    } else {
        $users[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Account - Aneka Galery</title>
  <link rel="stylesheet" href="../css/account.css">
  <link rel="stylesheet" href="../css/notif.css"> <!-- NOTIFIKASI CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="shortcut icon" href="../img/anekagalery_32x32.png">
  <script src="../js/notif.js" defer></script> <!-- NOTIFIKASI JS -->
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
      <a href="account.php" class="active">
        <i class="fas fa-user"></i>
        Account</a>
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
        <button class="btn round" id="menu-btn" aria-label="Buka menu"><i class="fas fa-bars"></i></button>
        <img src="../img/foto.jpg" alt="Avatar" class="user-avatar">
        <a href="account.php">
          <div>
            <b><?php echo "Welcome, " . htmlspecialchars($username); ?></b>
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
      <div class="account-page-head">
        <h1>Account</h1>
        <button type="button" class="btn" id="addAccountBtn"><i class="fas fa-plus"></i> Tambah Akun</button>
      </div>

      <!-- Akun kamu sendiri -->
      <div class="account">
        <img src="../img/foto.jpg" alt="Avatar" class="account-avatar">
        <p><span>Nama</span><span><?php echo htmlspecialchars($username); ?></span></p>
        <p><span>Email</span><span><?php echo htmlspecialchars($email); ?></span></p>
        <p><span>No Phone</span><span><?php echo htmlspecialchars($no_phone); ?></span></p>
        <p><span>Role</span><span>Administrator</span></p>
        <p><span>Toko</span><span>Aneka Galeri Printing</span></p>
        <p><span>Status</span><span style="color:#147a4f;">Aktif</span></p>
      </div>

      <!-- Section Admin -->
      <section class="block">
        <div class="head">
          <span class="section-pill pill-admin">Admin</span>
        </div>
        <div class="list" id="admin-list">
          <?php if (empty($admins)): ?>
            <div class="empty">Belum ada akun admin.</div>
          <?php else: ?>
            <?php foreach ($admins as $row): ?>
              <div class="row acc-row"
                   data-id="<?php echo (int) $row['user_id']; ?>"
                   data-username="<?php echo htmlspecialchars($row['username'], ENT_QUOTES); ?>"
                   data-email="<?php echo htmlspecialchars($row['email'], ENT_QUOTES); ?>"
                   data-phone="<?php echo htmlspecialchars($row['no_phone'], ENT_QUOTES); ?>"
                   data-role="<?php echo (int) $row['role_id']; ?>">
                <div class="left">
                  <i style="background:var(--teal);"></i>
                  <div>
                    <b><?php echo htmlspecialchars($row['username']); ?></b>
                    <span><?php echo htmlspecialchars($row['email']); ?></span>
                  </div>
                </div>
                <div class="right">
                  <span class="badge" style="background:var(--green-bg);color:var(--green);">Admin</span>
                  <button type="button" class="icon-btn edit-acc-btn" title="Edit"><i class="fas fa-pen"></i></button>
                  <button type="button" class="icon-btn del del-acc-btn" title="Delete"><i class="fas fa-trash"></i></button>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </section>

      <!-- Section User -->
      <section class="block">
        <div class="head">
          <span class="section-pill pill-user">User</span>
        </div>
        <div class="list" id="user-list">
          <?php if (empty($users)): ?>
            <div class="empty">Belum ada akun user.</div>
          <?php else: ?>
            <?php foreach ($users as $row): ?>
              <div class="row acc-row"
                   data-id="<?php echo (int) $row['user_id']; ?>"
                   data-username="<?php echo htmlspecialchars($row['username'], ENT_QUOTES); ?>"
                   data-email="<?php echo htmlspecialchars($row['email'], ENT_QUOTES); ?>"
                   data-phone="<?php echo htmlspecialchars($row['no_phone'], ENT_QUOTES); ?>"
                   data-role="<?php echo (int) $row['role_id']; ?>">
                <div class="left">
                  <i style="background:var(--amber);"></i>
                  <div>
                    <b><?php echo htmlspecialchars($row['username']); ?></b>
                    <span><?php echo htmlspecialchars($row['email']); ?></span>
                  </div>
                </div>
                <div class="right">
                  <span class="badge" style="background:var(--amber-bg);color:var(--amber);">User</span>
                  <button type="button" class="icon-btn del del-acc-btn" title="Delete"><i class="fas fa-trash"></i></button>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </section>
    </main>
  </div>

  <!-- Popup Tambah / Edit Akun -->
  <div class="modal-overlay-edit" id="accModalOverlay">
    <div class="edit-modal-box acc-modal-box">
      <div class="edit-header">
        <button type="button" class="edit-back-btn" onclick="closeAccModal()"><i class="fas fa-arrow-left"></i></button>
        <div class="edit-title-group">
          <span class="edit-label" id="accModalLabel">Tambah Akun</span>
          <h2 class="edit-title" id="accModalTitle">Akun Baru</h2>
        </div>
      </div>

      <form id="accForm" method="post">
        <input type="hidden" name="user_id" id="accUserId">

        <div class="acc-form-grid">
          <div class="field">
            <label>Nama / Username</label>
            <input type="text" name="username" id="accUsername" required maxlength="50">
          </div>
          <div class="field">
            <label>Email</label>
            <input type="email" name="email" id="accEmail" required maxlength="100">
          </div>
          <div class="field">
            <label>No Phone</label>
            <input type="text" name="no_phone" id="accPhone" required maxlength="20">
          </div>
          <div class="field">
            <label>Role</label>
            <select name="role_id" id="accRole" required>
              <option value="1">Admin</option>
              <option value="2">User</option>
            </select>
          </div>
          <div class="field" style="grid-column:1 / -1;">
            <label id="accPassLabel">Password</label>
            <input type="password" name="password" id="accPassword" minlength="8" placeholder="Minimal 8 karakter">
            <small class="field-hint" id="accPassHint">Leave blank if you don't want to change the password.</small>
          </div>
        </div>

        <div class="edit-footer">
          <button type="button" class="btn-edit-delete" onclick="closeAccModal()">Batal</button>
          <button type="submit" class="btn-edit-confirm" id="accSubmitBtn">Save</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Popup Konfirmasi Hapus -->
  <div class="modal-overlay" id="deleteAccModalOverlay">
    <div class="modal-box">
      <h3>Delete Account?</h3>
      <p class="modal-warning-text">
        Account "<span id="deleteAccUsername"></span>" will be permanently deleted and cannot be restored.
      </p>
      <div class="modal-actions">
        <button type="button" class="btn-modal-cancel" onclick="closeDeleteAccModal()">Batal</button>
        <button type="button" class="btn-modal-confirm" id="confirmDeleteAccBtn">Ya, Hapus</button>
      </div>
    </div>
  </div>

<script>
const currentUserId = <?php echo (int) $user_id; ?>;
let deleteTargetId = null;

const accModalOverlay = document.getElementById('accModalOverlay');
const accForm = document.getElementById('accForm');
const accPassword = document.getElementById('accPassword');
const accPassHint = document.getElementById('accPassHint');

function openAddAccModal() {
  accForm.reset();
  document.getElementById('accUserId').value = '';
  document.getElementById('accModalLabel').textContent = 'Tambah Akun';
  document.getElementById('accModalTitle').textContent = 'Akun Baru';
  accPassword.required = true;
  accPassword.placeholder = 'Minimal 8 karakter';
  accPassHint.style.display = 'none';
  accForm.action = 'add_account.php';
  accModalOverlay.classList.add('show');
}

function openEditAccModal(el) {
  accForm.reset();
  document.getElementById('accUserId').value = el.dataset.id;
  document.getElementById('accUsername').value = el.dataset.username;
  document.getElementById('accEmail').value = el.dataset.email;
  document.getElementById('accPhone').value = el.dataset.phone;
  document.getElementById('accRole').value = el.dataset.role;
  document.getElementById('accModalLabel').textContent = 'Edit Akun';
  document.getElementById('accModalTitle').textContent = el.dataset.username;
  accPassword.required = false;
  accPassword.placeholder = 'Kosongkan jika tidak ganti password';
  accPassHint.style.display = 'block';
  accForm.action = 'update_account.php';
  accModalOverlay.classList.add('show');
}

function closeAccModal() {
  accModalOverlay.classList.remove('show');
}

document.getElementById('addAccountBtn').addEventListener('click', openAddAccModal);

document.querySelectorAll('.acc-row').forEach(function (row) {
  row.addEventListener('click', function (e) {
    if (e.target.closest('.icon-btn')) return;
    openEditAccModal(row);
  });

  const editBtn = row.querySelector('.edit-acc-btn');
  if (editBtn) {
    editBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      openEditAccModal(row);
    });
  }

  const delBtn = row.querySelector('.del-acc-btn');
  if (delBtn) {
    delBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      openDeleteAccModal(row.dataset.id, row.dataset.username);
    });
  }
});

function openDeleteAccModal(id, uname) {
  deleteTargetId = id;
  document.getElementById('deleteAccUsername').textContent = uname;
  document.getElementById('deleteAccModalOverlay').classList.add('show');
}
function closeDeleteAccModal() {
  deleteTargetId = null;
  document.getElementById('deleteAccModalOverlay').classList.remove('show');
}
document.getElementById('confirmDeleteAccBtn').addEventListener('click', function () {
  if (!deleteTargetId) return;
  if (parseInt(deleteTargetId, 10) === currentUserId) {
    alert('Kamu tidak bisa menghapus akun yang sedang kamu pakai untuk login.');
    return;
  }
  window.location.href = 'delete_account.php?id=' + encodeURIComponent(deleteTargetId);
});

accModalOverlay.addEventListener('click', function (e) {
  if (e.target === this) closeAccModal();
});
document.getElementById('deleteAccModalOverlay').addEventListener('click', function (e) {
  if (e.target === this) closeDeleteAccModal();
});
</script>
</div>
</body>
</html>