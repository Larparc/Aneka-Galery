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
if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){
    $file_name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $folder = "uploads/";
    if(!is_dir($folder)){
        mkdir($folder);
    }
    move_uploaded_file(
        $tmp_name,
        $folder . $file_name
    );
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

if(mysqli_query($conn,$query_order)){
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

    if(mysqli_query($conn,$query_detail)){
    echo "
    <script>
        window.location='service.php?success=1';
    </script>
    ";
}else{

        echo "Detail order gagal : " . mysqli_error($conn);
    }
}else{
    echo "Order gagal : " . mysqli_error($conn);
}
?>
