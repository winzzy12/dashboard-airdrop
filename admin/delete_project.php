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

// Ambil data project dulu (untuk hapus logo)
$stmt = $conn->prepare("SELECT logo FROM projects WHERE id=?");
$stmt->execute([$id]);
$project = $stmt->fetch();

if(!$project){
    header("Location: dashboard.php");
    exit;
}

// Hapus logo jika ada
if(!empty($project['logo'])){
    $filePath = "../uploads/" . $project['logo'];
    if(file_exists($filePath)){
        unlink($filePath);
    }
}

// Hapus data dari database
$stmtDelete = $conn->prepare("DELETE FROM projects WHERE id=?");
$stmtDelete->execute([$id]);

// Redirect kembali
header("Location: dashboard.php");
exit;
?>