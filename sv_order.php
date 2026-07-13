<?php
date_default_timezone_set('Asia/Jakarta');
include "koneksi.php";
session_start();

$user_id = $_SESSION['user_id'];
$service_id = $_POST['service_id'];
$size_id = $_POST['size_id'];
$type_id = $_POST['type_id'];
$output_id = $_POST['output_id'];
$total_paper = $_POST['total_paper'];
$description = $_POST['description'];
$order_status = "Pending";
$total = 0;

$file_name = "";
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {

    // --- Validasi tipe file gambar ---
    $allowedExt  = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'pdf', 'doc', 'docx'];
    $allowedMime = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/zip',
    ];

    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $mime = mime_content_type($tmp_name); 

    $mimeOk = in_array($mime, $allowedMime);
    if (!$mimeOk && $ext === 'docx' && $mime === 'application/zip') {
        $mimeOk = true;
    }

    if (!in_array($ext, $allowedExt) || !$mimeOk) {
        echo "<script>
            alert('File harus berupa gambar (JPG, PNG, WEBP, GIF), PDF, atau dokumen Word (DOC/DOCX).');
            window.location.href = 'service.php';
        </script>";
        exit;
    }

    // batasi ukuran file, misal maksimal 5MB
    if ($_FILES['file']['size'] > 5 * 1024 * 1024) {
        echo "<script>
            alert('Ukuran file maksimal 5MB.');
            window.location.href = 'service.php';
        </script>";
        exit;
    }

    // bikin nama file unik biar nggak bentrok/ketimpa file lain
    $file_name = uniqid('order_', true) . '.' . $ext;

    $folder = "uploads/";
    if (!is_dir($folder)) {
        mkdir($folder);
    }
    move_uploaded_file($tmp_name, $folder . $file_name);
}

$query_order = "
INSERT INTO orders
(
    user_id,
    date,
    order_status,
    total
)

VALUES
(
    '$user_id',
    NOW(),
    '$order_status',
    '$total'
)";

if (mysqli_query($conn, $query_order)) {
    $order_id = mysqli_insert_id($conn);
    $query_detail = "
    INSERT INTO orders_detail
    (
        order_id,
        service_id,
        total_paper,
        size_id,
        type_id,
        output_id,
        description,
        file
    )

    VALUES
    (
        '$order_id',
        '$service_id',
        '$total_paper',
        '$size_id',
        '$type_id',
        '$output_id',
        '$description',
        '$file_name'
    )";

    if (mysqli_query($conn, $query_detail)) {
        echo "
        <script>
            window.location='service.php?success=1';
        </script>
        ";
    } else {
        echo "Detail order gagal : " . mysqli_error($conn);
    }
} else {
    echo "Order gagal : " . mysqli_error($conn);
}
?>