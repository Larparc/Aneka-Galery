<?php
header('Content-Type: application/json');
$host = "localhost";
$dbname = "aneka_galery";
$user = "root";
$pass = "";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo json_encode(['success'=>false, 'message'=>'DB error']);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = (int)$_POST['order_id'];
    $status = $_POST['status'];
    $valid = ['pending','complete','cancelled'];
    if (!in_array($status, $valid)) {
        echo json_encode(['success'=>false, 'message'=>'Status tidak valid']);
        exit;
    }
    $stmt = $pdo->prepare("UPDATE orders SET order_status = :status WHERE order_id = :id");
    if ($stmt->execute([':status'=>$status, ':id'=>$order_id])) {
        echo json_encode(['success'=>true]);
    } else {
        echo json_encode(['success'=>false, 'message'=>'Gagal update']);
    }
} else {
    echo json_encode(['success'=>false, 'message'=>'Invalid request']);
}
?>