<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../auth/auth_check.php';
require '../config/database.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header("Location: dashboard.php");
    exit;
}

$project_id = (int) $_GET['id'];

// Ambil data project
$stmt = $conn->prepare("SELECT name FROM projects WHERE id=?");
$stmt->execute([$project_id]);
$project = $stmt->fetch();

if(!$project){
    header("Location: dashboard.php");
    exit;
}

// Tambah note
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $note = trim($_POST['note']);
    if(!empty($note)){
        $insert = $conn->prepare("INSERT INTO project_notes (project_id, note) VALUES (?,?)");
        $insert->execute([$project_id, $note]);
    }
    header("Location: notes.php?id=".$project_id);
    exit;
}

// Ambil semua notes
$notesStmt = $conn->prepare("SELECT * FROM project_notes WHERE project_id=? ORDER BY created_at DESC");
$notesStmt->execute([$project_id]);
$notes = $notesStmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Notes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/style.css" rel="stylesheet">
</head>

<body>

<div class="d-flex">
<?php include 'sidebar.php'; ?>

<div class="container p-4">

<h4 class="mb-3">Notes - <?= htmlspecialchars($project['name']) ?></h4>

<div class="card p-4 shadow-sm mb-4">
<form method="POST">
<textarea name="note" class="form-control mb-3" rows="3" placeholder="Tulis catatan..." required></textarea>
<button class="btn btn-primary">Tambah Catatan</button>
</form>
</div>

<?php if(count($notes) > 0): ?>
<div class="card p-3 shadow-sm">
<?php foreach($notes as $n): ?>
<div class="border-bottom pb-3 mb-3">

<div class="small text-muted mb-1">
<?= date("d M Y H:i", strtotime($n['created_at'])) ?>
</div>

<div class="mb-2">
<?= nl2br(htmlspecialchars($n['note'])) ?>
</div>

<a href="delete_note.php?id=<?= $n['id'] ?>&project=<?= $project_id ?>"
class="text-danger small"
onclick="return confirm('Hapus catatan ini?')">
Hapus
</a>

</div>
<?php endforeach; ?>
</div>
<?php else: ?>
<div class="alert alert-light">Belum ada catatan.</div>
<?php endif; ?>

</div>
</div>

</body>
</html>