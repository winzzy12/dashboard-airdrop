<?php
session_start();
require '../config/database.php';

$stmt = $conn->prepare("SELECT * FROM admins WHERE username=?");
$stmt->execute([$_POST['username']]);
$user = $stmt->fetch();

if($user && password_verify($_POST['password'], $user['password'])){
    $_SESSION['admin'] = $user['id'];
    header("Location: ../admin/dashboard.php");
}else{
    echo "Login gagal";
}