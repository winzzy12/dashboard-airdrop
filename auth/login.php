<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" href="/assets/logo.png" sizes="any">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/logo.png">
<link rel="apple-touch-icon" href="/assets/logo.png">
<link rel="icon" type="image/png" href="/assets/logo.png">
<style>
body{background:#f5f7fb;height:100vh;display:flex;align-items:center;justify-content:center;}
.card{width:400px;padding:30px;border-radius:15px;box-shadow:0 10px 30px rgba(0,0,0,.05);}
</style>
</head>
<body>

<div class="card">
<h4 class="text-center mb-4">Login</h4>
<form action="process_login.php" method="POST">
<input name="username" class="form-control mb-3" placeholder="Username" required>
<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
<button class="btn btn-dark w-100">Login</button>
</form>
</div>

</body>
</html>