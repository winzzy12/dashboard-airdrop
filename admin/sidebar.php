<?php $status = $_GET['status'] ?? 'active'; ?>
<div class="sidebar p-3">
    <h5 class="mb-4 fw-bold">Airdrop Dashboard</h5>

    <ul class="nav flex-column gap-1">

        <li class="nav-item">
            <a href="dashboard.php" class="nav-link d-flex align-items-center gap-2 ">
                <i class="bi bi-grid-1x2-fill"></i>
                Active
            </a>
        </li>

        <li class="nav-item">
            <a href="dashboard.php?status=waitlist" class="nav-link d-flex align-items-center gap-2 <?= $status=='waitlist'?'active fw-bold':'' ?>">
                <i class="bi bi-hourglass-split"></i>
                Waitlist
            </a>
        </li>
        
                <li class="nav-item">
            <a href="dashboard.php?status=vesting" class="nav-link d-flex align-items-center gap-2 <?= $status=='vesting'?'active fw-bold':'' ?>">
                <i class="bi bi-stopwatch-fill"></i>
                Vesting
            </a>
        </li>

        <li class="nav-item">
            <a href="dashboard.php?status=finished" class="nav-link d-flex align-items-center gap-2 <?= $status=='finished'?'active fw-bold':'' ?>">
                <i class="bi bi-check-circle-fill"></i>
                Finished
            </a>
        </li>
        
        <li class="nav-item">
            <a href="dashboard.php?status=hidden" class="nav-link d-flex align-items-center gap-2 <?= $status=='hidden'?'active fw-bold':'' ?>">
                <i class="bi bi-eye-slash-fill"></i>
                Hidden
            </a>
        </li>
        
        <li class="nav-item">
    <a href="dashboard.php?status=all" 
       class="nav-link d-flex align-items-center gap-2 <?= $status=='all'?'active fw-bold':'' ?>">
        <i class="bi bi-collection-fill"></i>
        Show All
    </a>
</li>
        
        <li class="nav-item">
            <a href="add_project.php" class="nav-link d-flex align-items-center gap-2">
                <i class="bi bi-cloud-upload-fill"></i>
                Upload
            </a>
        </li>
        

<li class="nav-item">

    <a class="nav-link d-flex justify-content-between align-items-center"
       data-bs-toggle="collapse"
       href="#settingMenu"
       role="button">

        <span class="d-flex align-items-center gap-2">
            <i class="bi bi-gear-fill"></i>
            Settings
        </span>

        <i class="bi bi-chevron-down small"></i>
    </a>

    <div class="collapse ms-4" id="settingMenu">

        <ul class="nav flex-column gap-1 mt-2">

            <li class="nav-item">
                <a href="change_password.php"
                   class="nav-link d-flex align-items-center gap-2">
                    <i class="bi bi-key-fill"></i>
                    Change Password
                </a>
            </li>

            <li class="nav-item">
                <a href="change_pin.php"
                   class="nav-link d-flex align-items-center gap-2">
                    <i class="bi bi-shield-lock-fill"></i>
                    Change PIN
                </a>
            </li>
            
            <li class="nav-item">
                <a href="export_excel.php"
                   class="nav-link d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-excel-fill"></i>
                    Export Excel
                </a>
            </li>
            
        </ul>

    </div>

</li>
<button class="btn btn-sm btn-outline-secondary mt-3 w-100" onclick="toggleTheme()">
    <i class="bi bi-moon-fill me-1"></i> Dark Mode
</button>
        <li class="nav-item mt-3">
            <a href="../auth/logout.php" class="nav-link d-flex align-items-center gap-2 text-danger">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </a>
        </li>

    </ul>
</div>