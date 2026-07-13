<?php
include "security.php";
include "../koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header("Location: account.php?status=error");
    exit;
}

// jangan biarkan admin menghapus akun yang lagi pake buat login
if ($id === (int) ($_SESSION['user_id'] ?? 0)) {
    header("Location: account.php?status=self_delete_blocked");
    exit;
}

$stmt = mysqli_prepare($conn, "DELETE FROM profiles WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: account.php?status=deleted");
exit;
?>
