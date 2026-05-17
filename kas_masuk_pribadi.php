<?php
session_start();
include 'config/koneksi.php';

// hanya anggota yang boleh akses
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'anggota'){
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// ambil riwayat pembayaran dari tabel pembayaran_kas
$queryData = mysqli_query($conn,"
    SELECT * FROM pembayaran_kas
    WHERE id_user='$id_user'
    ORDER BY tanggal DESC
");

// hitung total yang SUDAH LUNAS saja
$queryTotal = mysqli_query($conn,"
    SELECT SUM(jumlah) as total 
    FROM pembayaran_kas 
    WHERE id_user='$id_user' AND status='diterima'
");
$total = mysqli_fetch_assoc($queryTotal)['total'] ?? 0;

$jumlahData = mysqli_num_rows($queryData);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pembayaran Kas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar_anggota.php'; ?>

<div class="container mt-4">

    <h4 class="text-black mb-3">Riwayat Pembayaran Kas</h4>

    <!-- Total Bayar -->
    <div class="card card-sky shadow mb-3">
        <div class="card-body text-center">
            <small>Total Kas Sudah Dibayar (Terverifikasi)</small>
            <h4 class="fw-bold text-sky">
                Rp <?= number_format($total,0,',','.'); ?>
            </h4>
        </div>
    </div>

    <!-- Tabel Riwayat -->
    <div class="card card-sky shadow">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-sky text-white">
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($jumlahData > 0){ 
                        $no = 1;
                        while($d = mysqli_fetch_assoc($queryData)){ ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $d['tanggal']; ?></td>
                            <td>Rp <?= number_format($d['jumlah'],0,',','.'); ?></td>
                            <td><?= strtoupper($d['metode']); ?></td>
                            <td>
                                <?php
                                if($d['status'] == 'pending'){
                                    echo '<span class="badge bg-warning text-dark">Menunggu Verifikasi</span>';
                                }elseif($d['status'] == 'diterima'){
                                    echo '<span class="badge bg-success">Diterima</span>';
                                }else{
                                    echo '<span class="badge bg-danger">Ditolak</span>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } } else { ?>
                        <tr>
                            <td colspan="5" class="text-center py-3">
                                Belum ada pembayaran kas
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tombol Bayar Kas -->
    <div class="area-bayar-kas text-center mt-4">
        <a href="bayar_kas.php" class="btn btn-sky btn-bayar-kas">
            Bayar Kas Sekarang
        </a>
    </div>

</div>

<script src="assets/js/script.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>
