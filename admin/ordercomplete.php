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

// Base path untuk upload
$uploadBase = '../uploads/';

// Ambil data order complete
$sql = "
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
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kelompokkan per order
$orderList = [];
foreach($data as $row){
    $id = $row['order_id'];
    if(!isset($orderList[$id])){
        $orderList[$id] = [
            "order_id" => $row['order_id'],
            "date" => $row['date'],
            "status" => $row['order_status'],
            "total" => $row['total'],
            "user_id" => $row['user_id'],
            "username" => $row['username'],
            "email" => $row['email'],
            "phone" => $row['no_phone'],
            "details" => []
        ];
    }
    if($row['no']){
        $filePath = !empty($row['file']) ? $uploadBase . $row['file'] : null;
        $orderList[$id]['details'][] = [
            "service" => $row['service_name'],
            "paper" => $row['total_paper'],
            "size" => $row['size_name'],
            "type" => $row['type_name'],
            "output" => $row['output_name'],
            "description" => $row['description'],
            "file" => $filePath
        ];
    }
}
$ordersComplete = array_values($orderList);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Complete - Aneka Galeri</title>
    <link rel="stylesheet" href="../css/ordercomplete.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../img/anekagalery_32x32.png">
</head>
<body>
<div class="app">
    <div class="overlay" id="overlay"></div>
    <aside class="sidebar" id="sidebar">
        <div class="logo">
            <i><img src="../img/anekagalery_32x32.png" alt="logo"></i>
            <div><a href="../index.php">
                <b>ANEKA GALERI</b>
                <span>Digital Printing</span>
            </div></a>
        </div>
        <nav>
            <a href="panel.php"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="account.php"><i class="fas fa-user"></i> Account</a>
            <small>Pages</small>
            <a href="project.php"><i class="fas fa-folder-open"></i> Project</a>
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
            <a href="orderpending.php"><i class="fas fa-clock"></i> Order Pending</a>
            <a href="ordercomplete.php" class="active"><i class="fas fa-check-circle"></i> Order Complete</a>
            <a href="customercontact.php"><i class="fas fa-envelope"></i> Customer Contact</a>
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
                <button class="btn round"><i class="fas fa-bell"></i></button>
                <a href="logout.php" class="btn light"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </header>

        <main class="content">
            <h1>Order Complete</h1>

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

            <!-- Daftar pesanan complete dengan filter -->
            <section class="block">
                <div class="head">
                    <h2 class="complete-title">Complete</h2>
                    <div class="filter-wrapper">
                        <button class="filter-btn" id="filterBtn">
                            <i class="fas fa-filter"></i> <span id="filterLabel">Terbaru</span>
                        </button>
                        <div class="filter-dropdown" id="filterDropdown">
                            <button class="filter-option active" data-sort="date_desc">
                                <i class="fas fa-arrow-down-wide-short"></i> Terbaru
                            </button>
                            <button class="filter-option" data-sort="date_asc">
                                <i class="fas fa-arrow-up-wide-short"></i> Terlama
                            </button>
                            <button class="filter-option" data-sort="username_asc">
                                <i class="fas fa-sort-alpha-up"></i> A-Z
                            </button>
                            <button class="filter-option" data-sort="username_desc">
                                <i class="fas fa-sort-alpha-down"></i> Z-A
                            </button>
                        </div>
                    </div>
                </div>
                <div class="list" id="order-list"></div>
            </section>
        </main>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="statusModal">
    <div class="modal-content">
        <span class="close-modal" id="closeModalBtn">&times;</span>
        <h3>Detail Order</h3>
        <div id="modalBody"></div>
        <div class="modal-actions">
            <button class="btn light" id="modalCancelBtn">Cancel</button>
            <button class="btn" id="modalSaveBtn">Save</button>
        </div>
    </div>
</div>

<script>
    window.ordersData = <?= json_encode($ordersComplete); ?>;
</script>
<script src="../js/ordercomplete.js"></script>

</body>
</html>