<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'anggota'){
    header("Location: login.php");
    exit;
}
$username = $_SESSION['username'];
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2ca7f8;"> 
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="dashboard.php">
    <img src="assets/img/logo.png" alt="Logo UKM" width="40" class="me-2">
    UKM English Club
</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAnggota">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarAnggota">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link text-white" href="dashboard_anggota.php">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="kas_masuk_pribadi.php">Kas Masuk Pribadi</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="riwayat_pembayaran.php">Riwayat Pembayaran</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="kas_seluruh.php">Lihat Seluruh Kas</a>
                </li>

            </ul>

            <span class="navbar-text text-white me-3">
                <?= htmlspecialchars($username); ?>
            </span>

            <a href="logout.php" onclick="return confirm('Logout sekarang?')" class="btn btn-outline-light btn-sm">
                Logout
            </a>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
