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

// Ambil data lama
$stmt = $conn->prepare("SELECT * FROM projects WHERE id=?");
$stmt->execute([$id]);
$project = $stmt->fetch();

if(!$project){
    header("Location: dashboard.php");
    exit;
}

// PROSES UPDATE
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $logoName = $project['logo'];

    // Jika upload logo baru
    if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0){

        $newLogo = time() . "_" . basename($_FILES['logo']['name']);
        $targetPath = "../uploads/" . $newLogo;

        if(!is_dir("../uploads")){
            mkdir("../uploads", 0777, true);
        }

        move_uploaded_file($_FILES['logo']['tmp_name'], $targetPath);

        // Hapus logo lama
        if(!empty($project['logo'])){
            $oldPath = "../uploads/" . $project['logo'];
            if(file_exists($oldPath)){
                unlink($oldPath);
            }
        }

        $logoName = $newLogo;
    }

    $update = $conn->prepare("UPDATE projects SET
        name=?,
        project_link=?,
        task_type=?,
        update_status=?,
        reward_type=?,
        raise_amount=?,
        wallet_address=?,
        private_key=?,
        logo=?
        WHERE id=?");

    $update->execute([
        $_POST['name'],
        $_POST['project_link'],
        $_POST['task_type'],
        $_POST['update_status'],
        $_POST['reward_type'],
        $_POST['raise_amount'],
        $_POST['wallet_address'],
        $_POST['private_key'],
        $logoName,
        $id
    ]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Project</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/style.css" rel="stylesheet">
</head>

<body>

<div class="d-flex">
<?php include 'sidebar.php'; ?>

<div class="container p-4">

<h4 class="mb-4">Edit Project</h4>

<div class="card p-4 shadow-sm">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Project Name</label>
<input name="name" class="form-control" value="<?= $project['name'] ?>" required>
</div>

<div class="mb-3">
<label>Project Link</label>
<input name="project_link" class="form-control" value="<?= $project['project_link'] ?>" required>
</div>

<div class="mb-3">
<label>Task Type</label>
<input name="task_type" class="form-control" value="<?= $project['task_type'] ?>">
</div>

<div class="mb-3">
<label>Update Status</label>
<select name="update_status" class="form-control">
<option <?= $project['update_status']=="Potential"?"selected":"" ?>>Potential</option>
<option <?= $project['update_status']=="Confirmed"?"selected":"" ?>>Confirmed</option>
<option <?= $project['update_status']=="Reward Available"?"selected":"" ?>>Reward Available</option>
</select>
</div>

<div class="mb-3">
<label>Reward Type</label>
<input name="reward_type" class="form-control" value="<?= $project['reward_type'] ?>">
</div>

<div class="mb-3">
<label>Raise Amount</label>
<input name="raise_amount" class="form-control" value="<?= $project['raise_amount'] ?>">
</div>

<div class="mb-3">
<label>Wallet Address</label>
<input name="wallet_address" class="form-control" value="<?= $project['wallet_address'] ?>">
</div>

<div class="mb-3">
<label>Private Key</label>
<input name="private_key" class="form-control" value="<?= $project['private_key'] ?>">
</div>

<div class="mb-3">
<label>Current Logo</label><br>
<?php if($project['logo']): ?>
<img src="../uploads/<?= $project['logo'] ?>" width="80">
<?php endif; ?>
</div>

<div class="mb-3">
<label>Change Logo (PNG)</label>
<input type="file" name="logo" accept="image/png" class="form-control">
</div>

<button class="btn btn-primary">Update Project</button>

</form>

</div>
</div>
</div>

</body>
</html>