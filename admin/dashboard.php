<?php
require '../auth/auth_check.php';
require '../config/database.php';

$status = $_GET['status'] ?? 'active';

$stmt = $conn->prepare("SELECT * FROM projects WHERE status=?");
$stmt->execute([$status]);
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/style.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
<?php include 'sidebar.php'; ?>

<div class="container-fluid p-4">

<div class="table-custom shadow-sm p-3">
<table class="table align-middle">
<thead>
<tr>
<th>Name</th>
<th>Task</th>
<th>Status</th>
<th>Reward</th>
<th>Raise</th>
<th>Wallet</th>
<th>Private</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php foreach($projects as $row): ?>
<tr>

<td>
<div class="d-flex align-items-center gap-3">
<img src="../uploads/<?= $row['logo'] ?>" class="logo-circle">
<a href="<?= $row['project_link'] ?>" target="_blank" class="fw-semibold text-dark text-decoration-none">
<?= $row['name'] ?>
</a>
</div>
</td>

<td><?= $row['task_type'] ?></td>

<td>
<?php
$class = "status-potential";
if($row['update_status']=="Confirmed") $class="status-confirmed";
if($row['update_status']=="Reward Available") $class="status-reward";
?>
<span class="badge-status <?= $class ?>">
<?= $row['update_status'] ?>
</span>
</td>

<td><?= $row['reward_type'] ?></td>
<td class="fw-bold text-success"><?= $row['raise_amount'] ?></td>
<td>
    <span id="wallet-<?= $row['id'] ?>">
        <?= substr($row['wallet_address'],0,5) ?>...
    </span>

    <button 
        class="btn btn-sm btn-light ms-2"
        id="btn-wallet-<?= $row['id'] ?>"
        onclick="toggleWallet(<?= $row['id'] ?>, '<?= $row['wallet_address'] ?>')">
        <i class="bi bi-eye"></i>
    </button>
</td>

<td>
<button class="btn btn-sm btn-outline-dark"
onclick="showPrivate(<?= $row['id'] ?>)">
<i class="bi bi-lock"></i>
</button>
</td>

<td>
<div class="dropdown">
<button class="btn btn-light btn-sm" data-bs-toggle="dropdown">
<i class="bi bi-three-dots"></i>
</button>
<ul class="dropdown-menu">

<li>
    <a class="dropdown-item"
       href="notes.php?id=<?= $row['id'] ?>">
        <i class="bi bi-journal-text"></i>
       Notes
    </a>
</li>

    <li>
        <a class="dropdown-item"
        onclick="return confirm('Masukan Projek Ini Ke Waitlist?')"
        href="waitlist_project.php?id=<?= $row['id'] ?>">
            <i class="bi bi-hourglass-split"></i>
        Waitlist
        </a>
    </li>

<li>
    <a class="dropdown-item"
       href="#"
       onclick="return requestEditPin(<?= $row['id'] ?>)">
        <i class="bi bi-pencil-square"></i>
       Edit
    </a>
</li>

<?php if($status == 'active'): ?>
    <li>
        <a class="dropdown-item"
        onclick="return confirm('Hide project ini?')"
        href="hide_project.php?id=<?= $row['id'] ?>">
            <i class="bi bi-eye-slash-fill"></i>
        Hide
        </a>
    </li>

    <li>
        <a class="dropdown-item"
        onclick="return confirm('Finish project ini?')"
        href="finish_project.php?id=<?= $row['id'] ?>">
            <i class="bi bi-check-circle-fill"></i>
        Finish
        </a>
    </li>

<?php elseif($status == 'hidden'): ?>
    <li>
        <a class="dropdown-item text-success"
        onclick="return confirm('Aktifkan kembali project ini?')"
        href="activate_project.php?id=<?= $row['id'] ?>">
        Activate
        </a>
    </li>

<?php elseif($status == 'finished'): ?>
    <li>
        <a class="dropdown-item text-success"
        onclick="return confirm('Aktifkan kembali project ini?')"
        href="activate_project.php?id=<?= $row['id'] ?>">
        Activate
        </a>
    </li>
    
<?php elseif($status == 'waitlist'): ?>
    <li>
        <a class="dropdown-item text-success"
        onclick="return confirm('Aktifkan kembali project ini?')"
        href="activate_project.php?id=<?= $row['id'] ?>">
        Activate
        </a>
    </li>
    
<?php endif; ?>

<li>
    <a class="dropdown-item text-danger"
    onclick="return confirm('Hapus project ini?')"
    href="delete_project.php?id=<?= $row['id'] ?>">
        <i class="bi bi-trash3-fill"></i>
    Delete
    </a>
</li>

</ul>

</div>
</td>

</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function showPrivate(id){
let pin = prompt("Masukan PIN:");
fetch("view_private.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:"id="+id+"&pin="+pin
})
.then(res=>res.text())
.then(data=>alert(data));
}
</script>

<script>
function requestEditPin(id){
    let pin = prompt("Masukkan PIN untuk edit project:");

    if(pin === null) return false;

    fetch("verify_pin.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:"pin="+encodeURIComponent(pin)
    })
    .then(res => res.text())
    .then(data => {
        if(data === "success"){
            window.location.href = "edit_project.php?id=" + id;
        }else{
            alert("PIN salah!");
        }
    });

    return false;
}
</script>

<script>
function toggleWallet(id, fullAddress){

    let el = document.getElementById("wallet-"+id);
    let btn = document.getElementById("btn-wallet-"+id);
    let icon = btn.querySelector("i");

    if(el.innerText.includes("...")){
        el.innerText = fullAddress;
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    } else {
        el.innerText = fullAddress.substring(0,5) + "...";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }
}
</script>

</body>
</html>