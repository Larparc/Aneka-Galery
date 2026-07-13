<?php
// Test file untuk debug notifikasi
include "../koneksi.php";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✓ PDO Connection OK<br>";
} catch(PDOException $e){
    die("Database connection failed : " . $e->getMessage());
}

echo "<h3>Test Notifikasi Widget</h3>";
echo "Memuat notif_widget.php...<br>";

include "notif_widget.php";

echo "<br><strong>Jumlah notifikasi:</strong> " . count($notifications) . "<br>";
echo "<pre>";
print_r($notifications);
echo "</pre>";

echo "<hr>";
echo "<h3>Preview Widget:</h3>";
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/notif.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { padding: 50px; font-family: Arial; }
        .btn { 
            padding: 10px 15px; 
            border: none; 
            cursor: pointer;
            background: #0c5d59;
            color: white;
            border-radius: 5px;
        }
        .btn.round {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div style="padding: 20px;">
        <!-- Notifikasi Widget sudah di-include di atas -->
        <p>Widget notifikasi harus muncul di sebelah kanan tombol ini:</p>
    </div>
    
    <script src="../js/panel.js"></script>
</body>
</html>
