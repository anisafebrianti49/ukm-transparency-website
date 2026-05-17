<?php
session_start();
include 'config/koneksi.php';

// hanya bendahara yang boleh akses
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'bendahara'){
    header("Location: login.php");
    exit;
}

// ambil data kas keluar
$data = mysqli_query($conn,"
    SELECT * FROM kas_keluar
    ORDER BY tanggal DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kas Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar_bendahara.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-black m-0">Data Kas Keluar</h5>
        <div>
            <a href="tambah_keluar.php" class="btn btn-sky btn-sm">+ Tambah Data</a>
        </div>
    </div>

    <div class="card card-table">
        <div class="card-body p-0">

            <table class="table mb-0">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="12%">Tanggal</th>
                        <th width="15%">Jumlah</th>
                        <th width="20%">Penggunaan</th>
                        <th>Keterangan</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>
                    <tr>
                        <td><?= $no++; ?></td>

                        <td><?= $d['tanggal']; ?></td>

                        <td>
                            <span class="badge-rp">
                                Rp <?= number_format($d['jumlah'],0,',','.'); ?>
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-warning text-dark">
                                <?= $d['jenis']; ?>
                            </span>
                        </td>

                        <td><?= $d['keterangan']; ?></td>

                        <td class="aksi-btn">
                            <a href="edit_keluar.php?id=<?= $d['id_keluar']; ?>" class="btn btn-outline-sky btn-sm">Edit</a>
                            <a href="hapus_keluar.php?id=<?= $d['id_keluar']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                            <a href="lihat_keluar.php?id=<?= $d['id_keluar']; ?>" class="btn btn-info btn-sm text-white">Lihat</a>
                        </td>
                    </tr>
                    <?php } ?>

                    <?php if(mysqli_num_rows($data)==0){ ?>
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada data kas keluar</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<script src="assets/js/script.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>
