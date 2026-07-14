<?php
include "securityadmin.php";
include "../koneksi.php";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Database connection failed : " . $e->getMessage());
}

// Statistik
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

$sql_contact = "SELECT c.no_contact, c.date, c.message, p.username, p.email, p.no_phone
        FROM contacts c
        JOIN profiles p ON c.user_id = p.user_id
        ORDER BY c.date DESC
        LIMIT 5";

$stmt_contact = $pdo->query($sql_contact);
$result_contact = $stmt_contact->fetchAll(PDO::FETCH_ASSOC);

$sql_project = "SELECT * FROM projects";
$stmt_project = $pdo->query($sql_project);
$result_project = $stmt_project->fetchAll(PDO::FETCH_ASSOC);

//Order Limitasi 2 dalam 1 query panel
$sql_pending = "
SELECT
    o.order_id, o.date, o.order_status, o.total,
    p.user_id, p.username, p.email, p.no_phone,
    od.no, od.total_paper, od.description, od.file,
    s.service_name, sz.size_name, t.type_name, outp.output_name
FROM orders o
JOIN profiles p ON o.user_id = p.user_id
LEFT JOIN orders_detail od ON o.order_id = od.order_id
LEFT JOIN services s ON od.service_id = s.service_id
LEFT JOIN sizes sz ON od.size_id = sz.size_id
LEFT JOIN types t ON od.type_id = t.type_id
LEFT JOIN outputs outp ON od.output_id = outp.output_id
WHERE o.order_status='pending'
ORDER BY o.date DESC
LIMIT 2
";
$stmt_pending = $pdo->prepare($sql_pending);
$stmt_pending->execute();
$data_pending = $stmt_pending->fetchAll(PDO::FETCH_ASSOC);

// Kelompokkan per order
$pendingOrders = [];
foreach($data_pending as $row){
    $id = $row['order_id'];
    if(!isset($pendingOrders[$id])){
        $pendingOrders[$id] = [
            "order_id"   => $row['order_id'],
            "date"       => $row['date'],
            "status"     => $row['order_status'],
            "username"   => $row['username'],
            "email"      => $row['email'],
            "phone"      => $row['no_phone'],
            "details"    => []
        ];
    }
    if($row['no']){
        $pendingOrders[$id]['details'][] = [
            "service"     => $row['service_name'],
            "paper"       => $row['total_paper'],
            "size"        => $row['size_name'],
            "colour"      => $row['type_name'],
            "output"      => $row['output_name'],
            "description" => $row['description'],
            "file"        => $row['file']
        ];
    }
}
$pendingOrders = array_values($pendingOrders);

// Order limitasi 2 aja versi complete order status
$sql_complete = "
SELECT
    o.order_id, o.date, o.order_status, o.total,
    p.user_id, p.username, p.email, p.no_phone,
    od.no, od.total_paper, od.description, od.file,
    s.service_name, sz.size_name, t.type_name, outp.output_name
FROM orders o
JOIN profiles p ON o.user_id = p.user_id
LEFT JOIN orders_detail od ON o.order_id = od.order_id
LEFT JOIN services s ON od.service_id = s.service_id
LEFT JOIN sizes sz ON od.size_id = sz.size_id
LEFT JOIN types t ON od.type_id = t.type_id
LEFT JOIN outputs outp ON od.output_id = outp.output_id
WHERE o.order_status='complete'
ORDER BY o.date DESC
LIMIT 2
";
$stmt_complete = $pdo->prepare($sql_complete);
$stmt_complete->execute();
$data_complete = $stmt_complete->fetchAll(PDO::FETCH_ASSOC);

$completeOrders = [];
foreach($data_complete as $row){
    $id = $row['order_id'];
    if(!isset($completeOrders[$id])){
        $completeOrders[$id] = [
            "order_id"   => $row['order_id'],
            "date"       => $row['date'],
            "status"     => $row['order_status'],
            "username"   => $row['username'],
            "email"      => $row['email'],
            "phone"      => $row['no_phone'],
            "details"    => []
        ];
    }
    if($row['no']){
        $completeOrders[$id]['details'][] = [
            "service"     => $row['service_name'],
            "paper"       => $row['total_paper'],
            "size"        => $row['size_name'],
            "colour"      => $row['type_name'],
            "output"      => $row['output_name'],
            "description" => $row['description'],
            "file"        => $row['file']
        ];
    }
}
$completeOrders = array_values($completeOrders);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Panel - Admin</title>
        <link rel="shortcut icon" href="../img/anekagalery_32x32.png">
        <link rel="stylesheet" href="../css/panel.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                        </div>
                    </a>
                </div>
                <nav>
                    <a href="panel.php" class="active">
                        <i class="fas fa-th-large"></i>
                        Dashboard</a>
                    <a href="account.php">
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
                        <button class="btn round">
                            <i class="fas fa-bell"></i>
                        </button>
                        <a href="logout.php" class="btn light">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout</a>
                    </div>
                </header>

        <main class="content">
            <h1>Dashboard</h1>

            <div class="cards">
                <div class="card">
                    <div>
                        <i class="fas fa-shopping-cart"></i>
                        <span>Total Order</span>
                    </div>
                    <b><?= $totalOrder; ?></b>
                </div>
                <div class="card">
                    <div>
                        <i class="fas fa-hourglass-half"></i>
                        <span>Order Pending</span>
                    </div>
                    <b><?= $pendingCount; ?></b>
                </div>
                <div class="card">
                    <div>
                        <i class="fas fa-check-circle"></i>
                        <span>Order Complete</span>
                    </div>
                    <b><?= $completeCount; ?></b>
                </div>
            </div>

            <!-- Uncomplete order (Pending) -->
            <div class="block">
                <div class="head">
                    <h2>Uncomplete order</h2>
                    <a href="orderpending.php">Lihat semua</a>
                </div>
                <div class="list" id="dash-pending">
                    <?php if (!empty($pendingOrders)): ?>
                        <?php foreach ($pendingOrders as $order): ?>
                            <?php
                                $date = new DateTime($order['date']);
                                $formattedDate = $date->format('d M Y H:i');
                                $firstDetail = $order['details'][0] ?? null;
                                $detailText = '';
                                if ($firstDetail) {
                                    $detailText = ($firstDetail['service'] ?? 'Print') . ' | ' .
                                                  ($firstDetail['paper'] ?? 0) . ' pcs | ' .
                                                  ($firstDetail['size'] ?? '-') . ' | ' .
                                                  ($firstDetail['colour'] ?? '-') . ' | ' .
                                                  ($firstDetail['output'] ?? '-');
                                } else {
                                    $detailText = 'Tidak ada detail';
                                }
                            ?>
                            <div class="dash-order-card">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($order['username']) ?>&background=0c5d59&color=fff&size=44"
                                     alt="<?= htmlspecialchars($order['username']) ?>"
                                     class="avatar-img">
                                <div class="body">
                                    <div class="top">
                                        <span class="name"><?= htmlspecialchars($order['username']) ?></span>
                                        <span class="meta">
                                            <span class="order-id">#<?= $order['order_id'] ?></span>
                                            <span>
                                                <i class="far fa-calendar-alt"></i>
                                                <?= $formattedDate ?>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="details">
                                        <span class="tag"><?= htmlspecialchars($detailText) ?></span>
                                    </div>
                                </div>
                                <span class="status-badge pending">Pending</span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-order">Tidak ada order pending.</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Complete Order -->
            <div class="block">
                <div class="head">
                    <h2>Complete Order</h2>
                    <a href="ordercomplete.php">Lihat semua</a>
                </div>
                <div class="list" id="dash-complete">
                    <?php if (!empty($completeOrders)): ?>
                        <?php foreach ($completeOrders as $order): ?>
                            <?php
                                $date = new DateTime($order['date']);
                                $formattedDate = $date->format('d M Y H:i');
                                $firstDetail = $order['details'][0] ?? null;
                                $detailText = '';
                                if ($firstDetail) {
                                    $detailText = ($firstDetail['service'] ?? 'Print') . ' | ' .
                                                  ($firstDetail['paper'] ?? 0) . ' pcs | ' .
                                                  ($firstDetail['size'] ?? '-') . ' | ' .
                                                  ($firstDetail['colour'] ?? '-') . ' | ' .
                                                  ($firstDetail['output'] ?? '-');
                                } else {
                                    $detailText = 'Tidak ada detail';
                                }
                            ?>
                            <div class="dash-order-card">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($order['username']) ?>&background=0c5d59&color=fff&size=44"
                                     alt="<?= htmlspecialchars($order['username']) ?>"
                                     class="avatar-img">
                                <div class="body">
                                    <div class="top">
                                        <span class="name"><?= htmlspecialchars($order['username']) ?></span>
                                        <span class="meta">
                                            <span class="order-id">#<?= $order['order_id'] ?></span>
                                            <span>
                                                <i class="far fa-calendar-alt"></i>
                                                <?= $formattedDate ?>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="details">
                                        <span class="tag"><?= htmlspecialchars($detailText) ?></span>
                                    </div>
                                </div>
                                <span class="status-badge complete">Complete</span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-order">Tidak ada order complete.</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Customer Contact -->
            <div class="block">
                <div class="head">
                    <h2>Customer Contact</h2>
                    <a href="customercontact.php">Lihat semua</a>
                </div>
                <div class="list" id="dash-contact">
                    <?php if (!empty($result_contact)): ?>
                        <?php foreach ($result_contact as $row): ?>
                            <div class="row">
                                <div class="left">
                                    <i></i>
                                    <div>
                                        <b><?php echo htmlspecialchars($row['username']); ?></b>
                                        <span><?php echo htmlspecialchars($row['message']); ?></span>
                                    </div>
                                </div>
                                <div class="right">
                                    <span><?php echo htmlspecialchars(date('d M Y H:i', strtotime($row['date']))); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty">No incoming messages yet.</div>
                    <?php endif; ?>
                </div>
            </div>

        </main>
    </div>
</div>

<script src="../js/panel.js"></script>
</body>
</html>