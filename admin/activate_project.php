<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../auth/auth_check.php';
require '../config/database.php';

// Validasi ID
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET['id'];

// Cek project ada
$stmt = $conn->prepare("SELECT id FROM projects WHERE id=?");
$stmt->execute([$id]);

if(!$stmt->fetch()){
    header("Location: dashboard.php");
    exit;
}

// Update status ke active
$update = $conn->prepare("UPDATE projects SET status='active' WHERE id=?");
$update->execute([$id]);

// Redirect kembali ke active
header("Location: dashboard.php?status=active");
exit;
?>