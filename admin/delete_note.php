<?php
require '../auth/auth_check.php';
require '../config/database.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header("Location: dashboard.php");
    exit;
}

$note_id = (int) $_GET['id'];
$project_id = (int) $_GET['project'];

$conn->prepare("DELETE FROM project_notes WHERE id=?")
->execute([$note_id]);

header("Location: notes.php?id=".$project_id);
exit;
?>