<?php
include "security.php";
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: project.php");
    exit;
}

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');

if ($title === '' || $description === '' || !isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    header("Location: add_project.php?status=error");
    exit;
}

$allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
$fileType = mime_content_type($_FILES['image']['tmp_name']);

if (!in_array($fileType, $allowedTypes)) {
    header("Location: add_project.php?status=invalid_type");
    exit;
}

$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$fileName = uniqid('project_', true) . '.' . $ext;
$targetDir = "../project_upload/";
$targetPath = $targetDir . $fileName;

if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
    header("Location: add_project.php?status=upload_failed");
    exit;
}

$stmt = $conn->prepare("INSERT INTO projects (user_id, title, description, image, created_at) VALUES (?, ?, ?, ?, NOW())");
$stmt->bind_param("isss", $user_id, $title, $description, $fileName);
$stmt->execute();
$stmt->close();

header("Location: project.php?status=success");
exit;
?>