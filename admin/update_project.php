<?php
include "security.php";
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: project.php");
    exit;
}

$id = isset($_POST['project_id']) ? (int) $_POST['project_id'] : 0;
$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');

if ($id <= 0 || $title === '' || $description === '') {
    header("Location: project.php?status=error");
    exit;
}

// kalau ada gambar baru diupload, ganti file lama
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    $fileType = mime_content_type($_FILES['image']['tmp_name']);

    if (!in_array($fileType, $allowedTypes)) {
        header("Location: edit_project.php?id=" . $id . "&status=invalid_type");
        exit;
    }

    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $fileName = uniqid('project_', true) . '.' . $ext;
    $targetPath = "../project_upload/" . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        // hapus gambar lama
        $stmt = $conn->prepare("SELECT image FROM projects WHERE project_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $old = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($old && file_exists("../project_upload/" . $old['image'])) {
            unlink("../project_upload/" . $old['image']);
        }

        $stmt = $conn->prepare("UPDATE projects SET title = ?, description = ?, image = ? WHERE project_id = ?");
        $stmt->bind_param("sssi", $title, $description, $fileName, $id);
        $stmt->execute();
        $stmt->close();
    }
} else {
    $stmt = $conn->prepare("UPDATE projects SET title = ?, description = ? WHERE project_id = ?");
    $stmt->bind_param("ssi", $title, $description, $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: project.php?status=updated");
exit;
?>