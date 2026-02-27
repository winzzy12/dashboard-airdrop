<?php
require '../auth/auth_check.php';
require '../config/database.php';

$id = $_POST['id'] ?? null;
$new_status = $_POST['update_status'] ?? null;

$allowed = [
    "Potential",
    "Confirmed",
    "Reward Available",
    "Finish",
    "Hold",
    "No Rewards",
    "Waitlist"
];

if($id && in_array($new_status, $allowed)){
    $stmt = $conn->prepare("UPDATE projects SET update_status=? WHERE id=?");
    $stmt->execute([$new_status, $id]);
    echo "success";
} else {
    echo "error";
}