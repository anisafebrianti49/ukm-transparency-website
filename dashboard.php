<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['role'] != 'bendahara'){
    header("Location: dashboard_anggota.php");
    exit;
}

$username = $_SESSION['username'];

// Ambil data kas
$masuk  = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(jumlah) AS total FROM kas_masuk"))['total'] ?? 0;
$keluar = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(jumlah) AS total FROM kas_keluar"))['total'] ?? 0;
$saldo  = $masuk - $keluar;


$pending = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT COUNT(*) as jml 
    FROM pembayaran_kas 
    WHERE status='pending'
"))['jml'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Bendahara - UKM EC</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>

<body>

<?php include 'navbar_bendahara.php'; ?>

<div class="container mt-4">

    <!-- Welcome -->
    <div class="text-center mb-4">
        <?php if($pending > 0){ ?>
        <div class="alert alert-warning d-flex justify-content-between align-items-center shadow-sm">
            <div>
                <strong>🔔 Ada <?= $pending; ?> pembayaran kas menunggu verifikasi</strong><br>
                Segera periksa dan lakukan ACC agar tercatat ke kas masuk.
            </div>
            <a href="verifikasi_pembayaran.php" class="btn btn-sm btn-dark">
                Verifikasi Sekarang
            </a>
        </div>
        <?php } ?>

       <div class="text-center mb-4">
        <h4 class="fw-semibold text-sky mb-1">
        Dashboard Bendahara UKM English Club</h4>
        <p class="text-muted mb-1">
        Kelola seluruh pemasukan dan pengeluaran kas UKM EC</p>

        <p class="narasi-bendahara"></br>Halaman ini digunakan oleh bendahara untuk memantau, mencatat, dan mengelola seluruh transaksi kas UKM English Club.
        Setiap pemasukan dari anggota dan pengeluaran kegiatan dicatat secara sistematis untuk menjaga transparansi dan akuntabilitas keuangan UKM.</p>
    </div>

    <!-- Ringkasan -->
    <div class="row text-center mb-4">
        <div class="col-md-4 mb-3">
            <div class="card card-sky p-4">
                <div>Total Kas Masuk</div>
                <div class="angka">Rp <?= number_format($masuk,0,',','.'); ?></div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-sky p-4">
                <div>Total Kas Keluar</div>
                <div class="angka">Rp <?= number_format($keluar,0,',','.'); ?></div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-sky p-4">
                <div>Saldo Saat Ini</div>
                <div class="angka">Rp <?= number_format($saldo,0,',','.'); ?></div>
            </div>
        </div>
    </div>

    <!-- Menu Bendahara -->
    <div class="row text-center mb-4">

        <div class="col-md-4 mb-3">
            <a href="kas_masuk.php" class="text-decoration-none text-dark">
                <div class="card card-sky p-4 menu-card">
                    <h5 class="text-sky">Kelola Kas Masuk</h5>
                    <p>Tambah, edit, hapus kas masuk</p>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="kas_keluar.php" class="text-decoration-none text-dark">
                <div class="card card-sky p-4 menu-card">
                    <h5 class="text-sky">Kelola Kas Keluar</h5>
                    <p>Tambah, edit, hapus kas keluar</p>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="laporan_rekap.php" class="text-decoration-none text-dark">
                <div class="card card-sky p-4 menu-card">
                    <h5 class="text-sky">Rekap Saldo</h5>
                    <p>Lihat laporan keseluruhan kas</p>
                </div>
            </a>
        </div>

        <div class="col-md-6 mb-3">
            <a href="laporan_masuk.php" class="text-decoration-none text-dark">
                <div class="card card-sky p-4 menu-card">
                    <h5 class="text-sky">Laporan Kas Masuk</h5>
                    <p>Riwayat detail pemasukan kas</p>
                </div>
            </a>
        </div>

        <div class="col-md-6 mb-3">
            <a href="laporan_keluar.php" class="text-decoration-none text-dark">
                <div class="card card-sky p-4 menu-card">
                    <h5 class="text-sky">Laporan Kas Keluar</h5>
                    <p>Riwayat detail pengeluaran kas</p>
                </div>
            </a>
        </div>

    </div>

</div>
<?php include 'footer.php'; ?>
</body>
</html>
