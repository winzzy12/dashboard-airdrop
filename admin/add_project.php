<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../auth/auth_check.php';
require '../config/database.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validasi logo
    if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0){

        $logoName = time() . "_" . basename($_FILES['logo']['name']);
        $targetPath = "../uploads/" . $logoName;

        if(!is_dir("../uploads")){
            mkdir("../uploads", 0777, true);
        }

        move_uploaded_file($_FILES['logo']['tmp_name'], $targetPath);

    } else {
        $logoName = null;
    }

    $stmt = $conn->prepare("INSERT INTO projects 
    (name,project_link,task_type,update_status,reward_type,raise_amount,wallet_address,private_key,logo)
    VALUES (?,?,?,?,?,?,?,?,?)");

    $stmt->execute([
        $_POST['name'],
        $_POST['project_link'],
        $_POST['task_type'],
        $_POST['update_status'],
        $_POST['reward_type'],
        $_POST['raise_amount'],
        $_POST['wallet_address'],
        $_POST['private_key'],
        $logoName
    ]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Upload Project</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/style.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<link rel="icon" href="/assets/logo.png" sizes="any">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/logo.png">
<link rel="apple-touch-icon" href="/assets/logo.png">
<link rel="icon" type="image/png" href="/assets/logo.png">
</head>

<body>

<div class="d-flex">
<?php include 'sidebar.php'; ?>

<div class="container p-4">

<h4 class="mb-4">Upload Project</h4>

<div class="card p-4 shadow-sm">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Project Name</label>
<input name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Project Link</label>
<input name="project_link" class="form-control" required>
</div>

<div class="mb-3">
<label>Task Type</label>
<input name="task_type" class="form-control">
</div>

<div class="mb-3">
<label>Update Status</label>
<select name="update_status" class="form-control">
<option value="Potential">Potential</option>
<option value="Confirmed">Confirmed</option>
<option value="Reward Available">Reward Available</option>
</select>
</div>

<div class="mb-3">
<label>Reward Type</label>
<input name="reward_type" class="form-control">
</div>

<div class="mb-3">
<label>Raise Amount</label>
<input name="raise_amount" class="form-control">
</div>

<div class="mb-3">
<label>Wallet Address</label>
<input name="wallet_address" class="form-control">
</div>

<div class="mb-3">
<label>Private Key</label>
<input name="private_key" class="form-control">
</div>

<div class="mb-3">
<label>Logo (PNG)</label>
<input type="file" name="logo" accept="image/png" class="form-control">
</div>

<button class="btn btn-primary">Upload Project</button>

</form>

</div>

</div>
</div>

</body>
</html>