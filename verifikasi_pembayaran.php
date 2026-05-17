<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role']!='bendahara'){
    header("Location: login.php");
    exit;
}

// ambil pembayaran yang MENUNGGU
$data = mysqli_query($conn,"
    SELECT p.*, u.username 
    FROM pembayaran_kas p
    JOIN users u ON p.id_user = u.id_user
    WHERE p.status = 'pending'
    ORDER BY p.tanggal ASC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Verifikasi Pembayaran</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar_bendahara.php'; ?>

<div class="container mt-4">

    <h5 class="text-black mb-3">Verifikasi Pembayaran Kas Anggota</h5>

    <div class="card card-table">
        <div class="card-body p-0">

            <table class="table mb-0">
                <thead class="table-sky text-white">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Metode</th>
                        <th>Jumlah</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['username']; ?></td>
                        <td><?= $d['tanggal']; ?></td>
                        <td><?= strtoupper($d['metode']); ?></td>
                        <td>Rp <?= number_format($d['jumlah'],0,',','.'); ?></td>
                        <td>
                            <a href="assets/bukti/<?= $d['bukti']; ?>" target="_blank" class="btn btn-info btn-sm">Lihat</a>
                        </td>
                        <td>
                            <a href="acc_pembayaran.php?id=<?= $d['id_bayar']; ?>" 
                               class="btn btn-success btn-sm"
                               onclick="return confirm('ACC pembayaran ini?')">
                               ACC
                            </a>

                            <a href="tolak_pembayaran.php?id=<?= $d['id_bayar']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Tolak pembayaran ini?')">
                               Tolak
                            </a>
                        </td>
                    </tr>
                <?php } ?>

                <?php if(mysqli_num_rows($data)==0){ ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            Tidak ada pembayaran menunggu verifikasi
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>

        </div>
    </div>

</div>

<?php include 'footer.php'; ?>
</body>
</html>
