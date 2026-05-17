<?php
session_start();
include 'config/koneksi.php';

// proteksi hanya anggota
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'anggota'){
    header("Location: login.php");
    exit;
}

// ambil semua kas masuk & keluar
$kas_masuk = mysqli_query($conn,"SELECT * FROM kas_masuk ORDER BY tanggal DESC")
    or die("Query kas_masuk error: " . mysqli_error($conn));

$kas_keluar = mysqli_query($conn,"SELECT * FROM kas_keluar ORDER BY tanggal DESC")
    or die("Query kas_keluar error: " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lihat Seluruh Kas - Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar_anggota.php'; ?>

<div class="container mt-4">
    <h4 class="text-black mb-3">Seluruh Transaksi Uang Kas UKM EC</h4>

    <!-- Tombol laporan -->
    <div class="mb-3">
        <a href="dashboard_anggota.php" class="btn btn-outline-sky btn-sm me-2">Kembali ke Dashboard</a>
        <a href="laporan_masuk.php" class="btn btn-sky btn-sm me-2">Laporan Kas Masuk</a>
        <a href="laporan_keluar.php" class="btn btn-sky btn-sm me-2">Laporan Kas Keluar</a>
        <a href="laporan_rekap.php" class="btn btn-sky btn-sm">Rekap Saldo</a>
    </div>

    <!-- Kas Masuk -->
    <div class="card card-sky shadow mb-4">
        <div class="card-header backro">Kas Masuk</div>
        <div class="card-body p-0">
            <table class="table table-striped table-sky mb-0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no=1;
                    while($d = mysqli_fetch_assoc($kas_masuk)){ ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['tanggal']; ?></td>
                        <td>Rp <?= number_format($d['jumlah'],0,',','.'); ?></td>
                        <td><?= $d['keterangan']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(mysqli_num_rows($kas_masuk)==0){ ?>
                    <tr>
                        <td colspan="4" class="text-center">Belum ada kas masuk</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Kas Keluar -->
    <div class="card card-sky shadow mb-4">
        <div class="card-header">Kas Keluar</div>
        <div class="card-body p-0">
            <table class="table table-striped table-sky mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no=1;
                    while($d = mysqli_fetch_assoc($kas_keluar)){ ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['tanggal']; ?></td>
                        <td>Rp <?= number_format($d['jumlah'],0,',','.'); ?></td>
                        <td><?= $d['keterangan']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(mysqli_num_rows($kas_keluar)==0){ ?>
                    <tr>
                        <td colspan="4" class="text-center">Belum ada kas keluar</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="assets/script.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>
