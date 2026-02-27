<?php
require '../auth/auth_check.php';
require '../config/database.php';

$status = $_GET['status'] ?? 'active';

if($status == 'all'){
    $stmt = $conn->prepare("SELECT * FROM projects ORDER BY id DESC");
    $stmt->execute();
} else {
    $stmt = $conn->prepare("SELECT * FROM projects WHERE status=? ORDER BY id DESC");
    $stmt->execute([$status]);
}

$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html data-bs-theme="light" id="htmlTheme">
<head>
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

<div class="container-fluid p-4">

<div class="table-custom shadow-sm p-3">
<table class="table align-middle">
<thead>
<tr>
<th width="50">No</th>
<th>Name</th>
<th>Note</th>
<th>Task</th>
<th>Status</th>
<th>Reward</th>
<th>Funding</th>
<th>Earn</th>
<th>Wallet</th>
<th>Private</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php $no = 1; ?>
<?php foreach($projects as $row): ?>

<tr>

<td><?= $no++ ?></td>

<td>
    
<div class="d-flex align-items-center gap-3">
<img src="../uploads/<?= $row['logo'] ?>" class="logo-circle">
<a href="<?= $row['project_link'] ?>" target="_blank" class="fw-semibold text-dark text-decoration-none">
<?= $row['name'] ?>
</a>
</div>
</td>
<td class="text-center">
    <a href="notes.php?id=<?= $row['id'] ?>" 
       class="text-primary fs-5">
        <i class="bi bi-journal-text"></i>
    </a>
</td>

<td><?= $row['task_type'] ?></td>

<td>

<?php
$statuses = ["Potential","Confirmed","Reward Available","Finish","Hold","Waitlist","No Rewards"];

$currentClass = "status-potential";

if($row['update_status']=="Confirmed") $currentClass="status-confirmed";
if($row['update_status']=="Reward Available") $currentClass="status-reward";
if($row['update_status']=="Finish") $currentClass="status-confirmed";
if($row['update_status']=="No Rewards") $currentClass="status-danger";
?>

<select class="form-select form-select-sm update-status <?= $currentClass ?>"
        data-id="<?= $row['id'] ?>">

<?php foreach($statuses as $st): ?>
<option value="<?= $st ?>"
<?= $row['update_status']==$st?"selected":"" ?>>
<?= $st ?>
</option>
<?php endforeach; ?>

</select>

</td>

<td><?= $row['reward_type'] ?></td>
<td class="fw-bold text-success"><?= $row['raise_amount'] ?></td>

<?php
$earn = (float)$row['earn'];

$earnClass = "text-danger";

if($earn > 10 && $earn <= 30) $earnClass = "text-warning";
if($earn > 30 && $earn <= 100) $earnClass = "text-primary";
if($earn > 100 && $earn <= 100000) $earnClass = "text-success";
?>

<td class="fw-bold earn-cell <?= $earnClass ?>"
    data-id="<?= $row['id'] ?>"
    data-value="<?= $earn ?>">

    $<?= rtrim(rtrim(number_format($earn,2), '0'), '.') ?>

</td>

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
        onclick="return confirm('Masukan Projek Ini Ke Waitlist?')"
        href="waitlist_project.php?id=<?= $row['id'] ?>">
            <i class="bi bi-hourglass-split"></i>
        Waitlist
        </a>
    </li>
    
       <li>
        <a class="dropdown-item"
        onclick="return confirm('Masukan Projek Ini Ke Vesting?')"
        href="vesting_project.php?id=<?= $row['id'] ?>">
            <i class="bi bi-stopwatch-fill"></i>
        Vesting
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
    
<?php elseif($status == 'vesting'): ?>
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

<script>
function toggleTheme() {
    const html = document.getElementById("htmlTheme");
    const currentTheme = html.getAttribute("data-bs-theme");

    if (currentTheme === "light") {
        html.setAttribute("data-bs-theme", "dark");
        localStorage.setItem("theme", "dark");
    } else {
        html.setAttribute("data-bs-theme", "light");
        localStorage.setItem("theme", "light");
    }
}

// Load saved theme
document.addEventListener("DOMContentLoaded", function() {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        document.getElementById("htmlTheme")
            .setAttribute("data-bs-theme", savedTheme);
    }
});
</script>

<script>
function getStatusClass(status){
    if(status === "Confirmed") return "status-confirmed";
    if(status === "Reward Available") return "status-reward";
    if(status === "Finish") return "status-confirmed";
    return "status-potential";
}

document.querySelectorAll('.update-status').forEach(select => {

    select.addEventListener('change', function(){

        let id = this.dataset.id;
        let status = this.value;

        fetch("ajax_update_status.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "id=" + id + "&update_status=" + encodeURIComponent(status)
        })
        .then(res => res.text())
        .then(data => {
            if(data === "success"){

                // Reset class lama
                this.classList.remove("status-confirmed","status-reward","status-potential");

                // Tambah class baru
                this.classList.add(getStatusClass(status));

            } else {
                alert("Gagal update status");
            }
        });

    });

});
</script>

<script>
document.querySelectorAll('.earn-cell').forEach(cell => {

    cell.addEventListener('click', function(){

        if(this.querySelector('input')) return;

        let currentValue = this.dataset.value;
        let id = this.dataset.id;

        this.innerHTML = `<input type="number" step="0.01" 
                            class="form-control form-control-sm"
                            value="${currentValue}">`;

        let input = this.querySelector('input');
        input.focus();

        function saveValue(){
            let newValue = input.value;

            fetch("ajax_update_earn.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + id + "&earn=" + encodeURIComponent(newValue)
            })
            .then(res => res.text())
            .then(data => {

                if(data === "success"){

                    cell.dataset.value = newValue;

                    let formatted = parseFloat(newValue || 0)
                        .toFixed(2)
                        .replace(/\.?0+$/, '');

                    cell.innerHTML = `<span class="earn-text">$${formatted}</span>`;
                    cell.classList.remove("text-danger","text-warning","text-primary","text-success");

cell.classList.add(getEarnColorClass(newValue));

                } else {
                    alert("Gagal update earn");
                }

            });
        }

        input.addEventListener('blur', saveValue);
        input.addEventListener('keydown', function(e){
            if(e.key === "Enter") saveValue();
        });

    });

});

function getEarnColorClass(value){
    value = parseFloat(value);

    if(value <= 10) return "text-danger";
    if(value > 10 && value <= 30) return "text-warning";
    if(value > 30 && value <= 100) return "text-primary";
    if(value > 100 && value <= 1000) return "text-success";

    return "text-dark";
}
</script>

</body>
</html>