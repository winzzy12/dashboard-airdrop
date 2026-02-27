<?php
require '../auth/auth_check.php';
require '../config/database.php';

// Ambil data
$stmt = $conn->prepare("SELECT * FROM projects ORDER BY id DESC");
$stmt->execute();
$projects = $stmt->fetchAll();

// Header supaya jadi file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=projects.xls");

echo "Name\tLink\tTask\tStatus\tReward\tWallet Address\tPrivate Key\tCreated At\tEarn\n";

foreach($projects as $row){
    echo $row['name']."\t";
    echo $row['project_link']."\t";
    echo $row['task_type']."\t";
    echo $row['update_status']."\t";
    echo $row['reward_type']."\t";
    echo $row['wallet_address']."\t";
    echo $row['private_key']."\t";
    echo $row['created_at']."\t";
    echo $row['earn']."\n";
}


exit;
?>