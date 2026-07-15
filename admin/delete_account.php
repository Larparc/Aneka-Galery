<?php
include "security.php";
include "../koneksi.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: account.php?status=error");
    exit;
}

// Cegah menghapus akun sendiri
if ($id === (int)($_SESSION['user_id'] ?? 0)) {
    header("Location: account.php?status=self_delete_blocked");
    exit;
}

// 1. Hapus semua orders_detail yang terkait dengan order milik user ini
//    Menggunakan subquery untuk mendapatkan order_id milik user
$deleteDetails = mysqli_prepare($conn,
    "DELETE FROM orders_detail WHERE order_id IN (SELECT order_id FROM orders WHERE user_id = ?)"
);
if ($deleteDetails) {
    mysqli_stmt_bind_param($deleteDetails, "i", $id);
    mysqli_stmt_execute($deleteDetails);
    mysqli_stmt_close($deleteDetails);
}

// 2. Hapus semua orders milik user ini
$deleteOrders = mysqli_prepare($conn, "DELETE FROM orders WHERE user_id = ?");
if ($deleteOrders) {
    mysqli_stmt_bind_param($deleteOrders, "i", $id);
    mysqli_stmt_execute($deleteOrders);
    mysqli_stmt_close($deleteOrders);
}

// 3. Hapus customer contact yang terkait dengan user ini
$deleteContacts = mysqli_prepare($conn, "DELETE FROM contacts WHERE user_id = ?");
if ($deleteContacts) {
    mysqli_stmt_bind_param($deleteContacts, "i", $id);
    mysqli_stmt_execute($deleteContacts);
    mysqli_stmt_close($deleteContacts);
}

// 4. Hapus announcements yang dibuat oleh user ini
$deleteAnnouncements = mysqli_prepare($conn, "DELETE FROM announcements WHERE user_id = ?");
if ($deleteAnnouncements) {
    mysqli_stmt_bind_param($deleteAnnouncements, "i", $id);
    mysqli_stmt_execute($deleteAnnouncements);
    mysqli_stmt_close($deleteAnnouncements);
}

// 5. Hapus profil user
$stmt = mysqli_prepare($conn, "DELETE FROM profiles WHERE user_id = ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    $success = mysqli_stmt_execute($stmt);
    $deleted = mysqli_affected_rows($conn);
    mysqli_stmt_close($stmt);

    if ($success && $deleted > 0) {
        header("Location: account.php?status=deleted");
    } else {
        header("Location: account.php?status=delete_failed");
    }
} else {
    header("Location: account.php?status=delete_error");
}
exit;