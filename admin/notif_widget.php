<?php
/**
 * Widget notifikasi admin (order pending + pesan customer terbaru).
 */

// Debug: Cek koneksi tersedia
echo "<!-- Debug: PDO=" . (isset($pdo) ? 'YES' : 'NO') . " | CONN=" . (isset($conn) ? 'YES' : 'NO') . " -->";

$notifications = [];

// Support untuk PDO (panel.php) dan MySQLi (file admin lain)
if (isset($pdo)) {
    // Menggunakan PDO
    try {
        $stmt_notif_order = $pdo->query("
            SELECT o.order_id, o.date, p.username
            FROM orders o
            JOIN profiles p ON o.user_id = p.user_id
            WHERE o.order_status = 'pending'
            ORDER BY o.date DESC
            LIMIT 8
        ");
        while ($o = $stmt_notif_order->fetch(PDO::FETCH_ASSOC)) {
            $notifications[] = [
                "type"  => "order",
                "id"    => $o['order_id'],
                "date"  => $o['date'],
                "title" => "Order baru dari " . $o['username'],
                "desc"  => "Order #" . $o['order_id'] . " menunggu diproses",
                "link"  => "orderpending.php"
            ];
        }

        $stmt_notif_contact = $pdo->query("
            SELECT c.no_contact, c.date, c.message, p.username
            FROM contacts c
            JOIN profiles p ON c.user_id = p.user_id
            ORDER BY c.date DESC
            LIMIT 8
        ");
        while ($c = $stmt_notif_contact->fetch(PDO::FETCH_ASSOC)) {
            $notifications[] = [
                "type"  => "contact",
                "id"    => $c['no_contact'],
                "date"  => $c['date'],
                "title" => "Pesan dari " . $c['username'],
                "desc"  => mb_strimwidth($c['message'], 0, 60, "..."),
                "link"  => "customercontact.php"
            ];
        }
    } catch (PDOException $e) {
        // Silent fail untuk notifikasi
    }
} elseif (isset($conn)) {
    // Menggunakan MySQLi
    $sql_notif_order = "
        SELECT o.order_id, o.date, p.username
        FROM orders o
        JOIN profiles p ON o.user_id = p.user_id
        WHERE o.order_status = 'pending'
        ORDER BY o.date DESC
        LIMIT 8
    ";
    $res_notif_order = mysqli_query($conn, $sql_notif_order);
    if ($res_notif_order) {
        while ($o = mysqli_fetch_assoc($res_notif_order)) {
            $notifications[] = [
                "type"  => "order",
                "id"    => $o['order_id'],
                "date"  => $o['date'],
                "title" => "Order baru dari " . $o['username'],
                "desc"  => "Order #" . $o['order_id'] . " menunggu diproses",
                "link"  => "orderpending.php"
            ];
        }
    }

    $sql_notif_contact = "
        SELECT c.no_contact, c.date, c.message, p.username
        FROM contacts c
        JOIN profiles p ON c.user_id = p.user_id
        ORDER BY c.date DESC
        LIMIT 8
    ";
    $res_notif_contact = mysqli_query($conn, $sql_notif_contact);
    if ($res_notif_contact) {
        while ($c = mysqli_fetch_assoc($res_notif_contact)) {
            $notifications[] = [
                "type"  => "contact",
                "id"    => $c['no_contact'],
                "date"  => $c['date'],
                "title" => "Pesan dari " . $c['username'],
                "desc"  => mb_strimwidth($c['message'], 0, 60, "..."),
                "link"  => "customercontact.php"
            ];
        }
    }
}

// Sort dan limit notifikasi
if (!empty($notifications)) {
    usort($notifications, function ($a, $b) {
        return strtotime($b['date']) <=> strtotime($a['date']);
    });
    $notifications = array_slice($notifications, 0, 8);
}
?>
<div class="notif-wrapper" id="notif-wrapper">
    <button class="btn round" id="notif-btn" type="button">
        <i class="fas fa-bell"></i>
        <?php 
        $unreadCount = count($notifications);
        if ($unreadCount > 0): 
        ?>
        <span class="notif-badge" id="notif-badge"><?= $unreadCount > 9 ? '9+' : $unreadCount ?></span>
        <?php else: ?>
        <span class="notif-badge" id="notif-badge" style="display:none;">0</span>
        <?php endif; ?>
    </button>
    <div class="notif-dropdown" id="notif-dropdown">
        <div class="notif-head">
            <span>Notifikasi</span>
        </div>
        <div class="notif-list" id="notif-list">
            <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $n): ?>
                    <a href="<?= htmlspecialchars($n['link']) ?>"
                       class="notif-item"
                       data-time="<?= strtotime($n['date']) ?>">
                        <span class="notif-icon <?= $n['type'] ?>">
                            <i class="fas <?= $n['type'] === 'order' ? 'fa-shopping-cart' : 'fa-envelope' ?>"></i>
                        </span>
                        <span class="notif-body">
                            <b><?= htmlspecialchars($n['title']) ?></b>
                            <span><?= htmlspecialchars($n['desc']) ?></span>
                            <small><?= htmlspecialchars((new DateTime($n['date']))->format('d M Y H:i')) ?></small>
                        </span>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="notif-empty">No notification.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
