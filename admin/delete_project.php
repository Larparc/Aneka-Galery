<?php
include "securityadmin.php";
include "../koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT image FROM projects WHERE project_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $post = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($post) {
        $imagePath = "../project_upload/" . $post['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $stmt = $conn->prepare("DELETE FROM projects WHERE project_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: project.php?status=deleted");
exit;
?>