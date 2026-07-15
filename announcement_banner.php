<?php
// Ambil announcement dengan status active, urutkan terbaru, ambil 1
$announcement = null;

// Pastikan koneksi PDO tersedia
if (isset($pdo) && $pdo !== null) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM announcements WHERE announcement_status = 'active' ORDER BY announcement_date DESC, announcement_id DESC LIMIT 1");
        $stmt->execute();
        $announcement = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $announcement = null;
    }
}

// Jika tidak ada announcement, jangan tampilkan apa-apa
if (!$announcement) {
    return; // keluar dari file include
}
?>
<div class="announcement-banner" id="announcementBanner">
    <div class="announcement-banner-inner">
        <div class="announcement-icon">
            <i class="fas fa-bullhorn"></i>
        </div>
        <div class="announcement-content">
            <span class="announcement-label">Pengumuman:</span>
            <span class="announcement-title"><?php echo htmlspecialchars($announcement['title']); ?></span>
            <span class="announcement-toggle" id="announcementToggle">Lihat detail</span>
        </div>
        <div class="announcement-expand" id="announcementExpand" style="display: none;">
            <div class="announcement-message">
                <?php echo nl2br(htmlspecialchars($announcement['message'])); ?>
            </div>
            <div class="announcement-date">
                <i class="far fa-calendar-alt"></i>
                <?php echo date('d M Y', strtotime($announcement['announcement_date'])); ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var toggle = document.getElementById('announcementToggle');
    var expand = document.getElementById('announcementExpand');
    var banner = document.getElementById('announcementBanner');

    if (toggle && expand) {
        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            var isOpen = expand.style.display !== 'none';
            expand.style.display = isOpen ? 'none' : 'block';
            toggle.textContent = isOpen ? 'Lihat detail' : 'Tutup';
            if (banner) {
                banner.classList.toggle('expanded', !isOpen);
            }
        });
    }
});
</script>