<?php
include 'koneksi.php';

$user_id = trim($_POST['user_id'] ?? '');
$date = trim($_POST['date'] ?? '');
$pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

$sql = "INSERT INTO contacts
(
    user_id,
    date,
    message
)
VALUES
(
    '$user_id',
    '$date',
    '$pesan'
)";

$query = mysqli_query($conn, $sql);

header("Location: contact.php");
exit;
?>