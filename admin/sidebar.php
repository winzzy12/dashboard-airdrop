<div class="sidebar p-3">
    <h5 class="mb-4 fw-bold">Airdrop Dashboard</h5>

    <ul class="nav flex-column gap-1">

        <li class="nav-item">
            <a href="dashboard.php" class="nav-link d-flex align-items-center gap-2">
                <i class="bi bi-grid-1x2-fill"></i>
                Active
            </a>
        </li>

        <li class="nav-item">
            <a href="dashboard.php?status=waitlist" class="nav-link d-flex align-items-center gap-2">
                <i class="bi bi-hourglass-split"></i>
                Waitlist
            </a>
        </li>

        <li class="nav-item">
            <a href="dashboard.php?status=hidden" class="nav-link d-flex align-items-center gap-2">
                <i class="bi bi-eye-slash-fill"></i>
                Hidden
            </a>
        </li>

        <li class="nav-item">
            <a href="dashboard.php?status=finished" class="nav-link d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                Finished
            </a>
        </li>

        <li class="nav-item">
            <a href="add_project.php" class="nav-link d-flex align-items-center gap-2">
                <i class="bi bi-cloud-upload-fill"></i>
                Upload
            </a>
        </li>

        <li class="nav-item mt-3">
            <a href="../auth/logout.php" class="nav-link d-flex align-items-center gap-2 text-danger">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </a>
        </li>

    </ul>
</div>