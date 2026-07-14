<?php
// Ambil total pending
$sql_total_pending = "SELECT COUNT(*) as pending FROM orders WHERE order_status='pending'";
$stmt = $pdo->query($sql_total_pending);
$pendingCount = $stmt->fetchColumn();

// Ambil total order
$sql_total_all = "SELECT COUNT(*) as total FROM orders";
$stmt = $pdo->query($sql_total_all);
$totalOrder = $stmt->fetchColumn();

// Ambil 2 order pending terbaru dengan detail lengkap (1 detail per order)
$sql = "
SELECT
    o.order_id,
    o.date,
    o.order_status,
    p.username,
    od.total_paper,
    od.description,
    od.file,
    s.service_name,
    sz.size_name,
    t.type_name,
    outp.output_name
FROM orders o
JOIN profiles p ON o.user_id = p.user_id
LEFT JOIN orders_detail od ON o.order_id = od.order_id
LEFT JOIN services s ON od.service_id = s.service_id
LEFT JOIN sizes sz ON od.size_id = sz.size_id
LEFT JOIN types t ON od.type_id = t.type_id
LEFT JOIN outputs outp ON od.output_id = outp.output_id
WHERE o.order_status = 'pending'
ORDER BY o.date DESC
LIMIT 2
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$recentPending = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="notif-wrapper" id="notifWrapper">
    <button class="btn round notif-btn" id="notifBtn" aria-label="Notifikasi">
        <i class="fas fa-bell"></i>
        <span class="notif-badge" id="notifBadge" <?= $pendingCount > 0 ? '' : 'style="display:none;"' ?>>
            <?= $pendingCount > 9 ? '9+' : $pendingCount ?>
        </span>
    </button>
    <div class="notif-dropdown" id="notifDropdown">
        <div class="notif-header">
            <span>Notifikasi</span>
            <button class="notif-clear" id="notifClear">Tandai sudah dibaca</button>
        </div>
        <div class="notif-list" id="notifList">
            <?php if ($pendingCount > 0 && !empty($recentPending)): ?>
                <?php foreach ($recentPending as $order): ?>
                    <div class="notif-item <?= isset($_SESSION['notif_last_seen']) && strtotime($order['date']) > $_SESSION['notif_last_seen'] ? 'unread' : '' ?>" data-time="<?= strtotime($order['date']) ?>">
                        <div class="notif-icon order">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="notif-body">
                            <b><?= htmlspecialchars($order['username']) ?></b>
                            <span>
                                <?= htmlspecialchars($order['service_name'] ?? 'Print') ?> · 
                                <?= (int)($order['total_paper'] ?? 0) ?> pcs
                                <?php if (!empty($order['size_name'])): ?>
                                    · <?= htmlspecialchars($order['size_name']) ?>
                                <?php endif; ?>
                            </span>
                            <small><?= date('d M Y H:i', strtotime($order['date'])) ?></small>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="notif-empty">Tidak ada order pending.</div>
            <?php endif; ?>
        </div>
        <div class="notif-footer">
            <span>Total Order: <strong><?= $totalOrder ?></strong> &nbsp;|&nbsp; Pending: <strong><?= $pendingCount ?></strong></span>
            <a href="orderpending.php" class="check-order-btn">Check Order</a>
        </div>
    </div>
</div>