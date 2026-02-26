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

// Cek apakah project ada
$stmt = $conn->prepare("SELECT id FROM projects WHERE id=?");
$stmt->execute([$id]);

if(!$stmt->fetch()){
    header("Location: dashboard.php");
    exit;
}

// Update status ke finished
$update = $conn->prepare("UPDATE projects SET status='finished' WHERE id=?");
$update->execute([$id]);

// Redirect ke tab finished
header("Location: dashboard.php?status=finished");
exit;
?>