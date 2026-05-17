<?php
session_start();
include 'config/koneksi.php';

// Proteksi login anggota
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'anggota'){
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$username = $_SESSION['username'];

// Ambil data kas dari database
$total_masuk  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as total FROM kas_masuk"))['total'] ?? 0;
$total_keluar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as total FROM kas_keluar"))['total'] ?? 0;
$saldo        = $total_masuk - $total_keluar;

// ambil pembayaran terakhir anggota
$bayar = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT status, tanggal, jumlah
    FROM pembayaran_kas
    WHERE id_user = '$id_user'
    ORDER BY id_bayar DESC
    LIMIT 1
"));

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Anggota - UKM EC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar_anggota.php'; ?>

<div class="container mt-4">

    <!-- Welcome -->
    <div class="text-center mb-4">
         <h3 class="text-black">Dashboard Transparansi Kas</h3>
        <p>Selamat datang di sistem informasi kas UKM EC</p>

        <?php if($bayar){ ?>
        <?php if($bayar['status'] == 'pending'){ ?>
        <div class="alert alert-warning shadow-sm">
            ⏳ Pembayaran kas kamu sebesar 
            <strong>Rp <?= number_format($bayar['jumlah'],0,',','.'); ?></strong>
            pada <?= $bayar['tanggal']; ?> sedang menunggu verifikasi bendahara.
        </div>
        <?php } ?>
        
        <?php if($bayar['status'] == 'lunas'){ ?>
        <div class="alert alert-success shadow-sm">
            ✅ Pembayaran kas kamu sudah diverifikasi dan tercatat sebagai kas masuk.
        </div>
        <?php } ?>
        
        <?php if($bayar['status'] == 'ditolak'){ ?>
        <div class="alert alert-danger shadow-sm">
            ❌ Pembayaran kas kamu ditolak. Silakan cek kembali bukti transfer dan kirim ulang.
            <br>
            <a href="bayar_kas.php" class="btn btn-sm btn-danger mt-2">Bayar Ulang</a>
        </div>
        <?php } ?>
        <?php } ?>

    </div>

    <!-- INFO PENGGUNAAN KAS -->
    <div class="card info-kas mb-4">
        <div class="card-body">
            <h6 class="judul-info">Informasi Penggunaan Dana Kas UKM</h6>
            <p class="mb-1">
                Dana kas yang terkumpul dari iuran anggota akan digunakan untuk mendukung
                seluruh kegiatan UKM EC, seperti pelaksanaan program kerja, perlengkapan kegiatan,
                konsumsi, dokumentasi, serta kebutuhan operasional lainnya.
            </p>
            <p class="mb-0">
                Sistem ini dibuat untuk memastikan transparansi pemasukan dan pengeluaran kas
                sehingga seluruh anggota dapat memantau penggunaan dana secara terbuka.
            </p>
        </div>
    </div>

    <!-- Ringkasan Angka -->
    <div class="row text-center mb-4">
        <div class="col-md-4 mb-3">
            <div class="card card-sky p-4">
                <div>Total Kas Masuk</div>
                <div class="angka">Rp <?= number_format($total_masuk,0,',','.'); ?></div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-sky p-4">
                <div>Total Kas Keluar</div>
                <div class="angka">Rp <?= number_format($total_keluar,0,',','.'); ?></div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-sky p-4">
                <div>Saldo Saat Ini</div>
                <div class="angka">Rp <?= number_format($saldo,0,',','.'); ?></div>
            </div>
        </div>
    </div>

    <!-- Menu Utama -->
    <div class="row text-center mb-4">
        <div class="col-md-6 mb-3">
            <a href="kas_masuk_pribadi.php" class="text-decoration-none text-dark">
                <div class="card card-sky p-4 menu-card">
                    <h5 class="text-sky">Kas Pribadi</h5>
                    <p>Cek riwayat iuran kas kamu</p>
                </div>
            </a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="kas_seluruh.php" class="text-decoration-none text-dark">
                <div class="card card-sky p-4 menu-card">
                    <h5 class="text-sky">Seluruh Kas UKM</h5>
                    <p>Lihat transparansi pemasukan & pengeluaran</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Tentang UKM -->
    <div class="card card-sky p-3">
        <h6 class="text-sky">Tentang UKM EC</h6>
        <p class="mb-0">
            UKM EC adalah wadah bagi mahasiswa untuk berlatih dan meningkatkan kemampuan 
            berbahasa Inggris sambil mengembangkan kualitas pribadi dan interpersonal, 
            serta meningkatkan keterlibatan mahasiswa dengan bahasa Inggris di dalam 
            dan luar kampus.
        </p>
    </div>

</div>

<script src="assets/js/script.js"></script>
<?php include 'footer.php'; ?>

</body>
</html>
