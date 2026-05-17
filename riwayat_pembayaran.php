<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role']!='anggota'){
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$data = mysqli_query($conn,"
    SELECT * FROM pembayaran_kas
    WHERE id_user='$id_user'
    ORDER BY tanggal DESC
");
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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-black m-0">Riwayat Pembayaran Kas</h4>
    </div>

    <div class="card card-table">
        <div class="card-body p-0">

            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Metode</th>
                        <th>Jumlah</th>
                        <th>Bukti</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                <?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['tanggal']; ?></td>
                    <td><?= strtoupper($d['metode']); ?></td>
                    <td>
                        <span class="badge-rp">
                            Rp <?= number_format($d['jumlah'],0,',','.'); ?>
                        </span>
                    </td>
                    <td>
                        <a href="assets/bukti/<?= $d['bukti']; ?>" target="_blank" class="btn btn-info btn-sm">
                            Lihat
                        </a>
                    </td>
                    <td>
                        <?php if($d['status']=='pending'){ ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php }elseif($d['status']=='diterima'){ ?>
                            <span class="badge bg-success">Diterima</span>
                        <?php }else{ ?>
                            <span class="badge bg-danger">Ditolak</span>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>

                <?php if(mysqli_num_rows($data)==0){ ?>
                <tr>
                    <td colspan="6" class="text-center py-4">
                        Belum ada riwayat pembayaran
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
