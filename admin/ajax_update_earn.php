<?php
require '../auth/auth_check.php';
require '../config/database.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_POST['id'] ?? null;
$earn = $_POST['earn'] ?? null;

if(!$id){
    echo "ID kosong";
    exit;
}

if($earn === null || $earn === ''){
    $earn = 0;
}

if(!is_numeric($earn)){
    echo "Earn bukan angka";
    exit;
}

try {

    $stmt = $conn->prepare("UPDATE projects SET earn=? WHERE id=?");
    $stmt->execute([$earn, $id]);

    echo "success";

} catch(PDOException $e){
    echo $e->getMessage();
}