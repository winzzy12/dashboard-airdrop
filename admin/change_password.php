<?php
require '../auth/auth_check.php';
require '../config/database.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $current = $_POST['current_password'];
    $new = $_POST['new_password'];

    $stmt = $conn->prepare("SELECT password FROM admins WHERE id=?");
    $stmt->execute([$_SESSION['admin']]);
    $user = $stmt->fetch();

    if($user && password_verify($current, $user['password'])){

        $newHash = password_hash($new, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE admins SET password=? WHERE id=?");
        $update->execute([$newHash, $_SESSION['admin']]);

        $success = "Password berhasil diubah.";
    } else {
        $error = "Password lama salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Change Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="../assets/style.css" rel="stylesheet">

</head>

<body>

<div class="d-flex">

<?php include 'sidebar.php'; ?>

<div class="flex-grow-1 p-4">

<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">

<div class="card shadow-sm border-0 rounded-4">
<div class="card-body p-4">

<h5 class="mb-4 d-flex align-items-center gap-2">
<i class="bi bi-key-fill text-primary"></i>
Change Password
</h5>

<?php if(isset($success)): ?>
<div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>

<?php if(isset($error)): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">

<div class="mb-3">
<label class="form-label">Current Password</label>
<input type="password" name="current_password"
class="form-control rounded-3" required>
</div>

<div class="mb-3">
<label class="form-label">New Password</label>
<input type="password" name="new_password"
class="form-control rounded-3" required>
</div>

<button class="btn btn-primary w-100 rounded-3">
<i class="bi bi-check-circle-fill me-1"></i>
Update Password
</button>

</form>

</div>
</div>

</div>
</div>
</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>