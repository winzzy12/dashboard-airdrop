<?php
session_start();
require '../config/database.php';

if(!isset($_SESSION['admin'])){
    echo "error";
    exit;
}

$stmt = $conn->prepare("SELECT pin FROM admins WHERE id=?");
$stmt->execute([$_SESSION['admin']]);
$user = $stmt->fetch();

if($user && password_verify($_POST['pin'], $user['pin'])){
    echo "success";
}else{
    echo "error";
}
?>