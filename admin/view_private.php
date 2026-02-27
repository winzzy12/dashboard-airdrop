<?php
session_start();
require '../config/database.php';

$stmt = $conn->prepare("SELECT * FROM admins WHERE id=?");
$stmt->execute([$_SESSION['admin']]);
$user = $stmt->fetch();

if(password_verify($_POST['pin'], $user['pin'])){
$stmt2 = $conn->prepare("SELECT private_key FROM projects WHERE id=?");
$stmt2->execute([$_POST['id']]);
$p = $stmt2->fetch();
echo $p['private_key'];
}else{
echo "PIN salah";
}