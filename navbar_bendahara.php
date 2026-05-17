<?php
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'bendahara'){
    header("Location: login.php");
    exit;
}

$notif = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT COUNT(*) as jml 
    FROM pembayaran_kas 
    WHERE status='pending'
"))['jml'];

?>

<nav class="navbar navbar-expand-lg navbar-dark navbar-ec">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="dashboard.php">
    <img src="assets/img/logo.png" alt="Logo UKM" width="40" class="me-2">
    UKM English Club
</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBendahara">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarBendahara">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Kas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="kas_masuk.php">Kas Masuk</a></li>
                        <li><a class="dropdown-item" href="kas_keluar.php">Kas Keluar</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Laporan
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="laporan_masuk.php">Laporan Kas Masuk</a></li>
                        <li><a class="dropdown-item" href="laporan_keluar.php">Laporan Kas Keluar</a></li>
                        <li><a class="dropdown-item" href="laporan_rekap.php">Rekap Saldo</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="dashboard_user.php">Manajemen User</a>
                </li>

                <li class="nav-item position-relative">
                    <a class="nav-link" href="verifikasi_pembayaran.php">Verifikasi Pembayaran
                        <?php if($notif > 0){ ?>
                        <span class="badge bg-danger notif-badge">
                            <?= $notif; ?>
                        </span>
                        <?php } ?>
                    </a>
                </li>

            </ul>               

            <span class="navbar-text me-3">
                <?= $_SESSION['username']; ?>
            </span>

            <a href="logout.php" onclick="return confirm('Logout sekarang?')" class="btn btn-outline-light btn-sm">
                Logout
            </a>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
