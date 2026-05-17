<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role']!='bendahara'){
    header("Location: login.php");
    exit;
}

// join ke tabel users biar bisa ambil nama anggota
$kas = mysqli_query($conn,"
    SELECT km.*, u.username 
    FROM kas_masuk km
    LEFT JOIN users u ON km.id_user = u.id_user
    ORDER BY km.tanggal DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kas Masuk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar_bendahara.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-black m-0">Data Kas Masuk</h5>
        <a href="tambah_masuk.php" class="btn btn-sky btn-sm">+ Tambah Kas Masuk</a>
    </div>

    <div class="card card-table">
        <div class="card-body p-0">

            <table class="table mb-0">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="12%">Tanggal</th>
                        <th width="15%">Jumlah</th>
                        <th width="15%">Sumber</th>
                        <th width="18%">Nama Anggota</th>
                        <th>Keterangan</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; while($row = mysqli_fetch_assoc($kas)){ ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['tanggal'] ?></td>

                        <td>
                            <span class="badge-rp">
                                Rp <?= number_format($row['jumlah'],0,',','.') ?>
                            </span>
                        </td>

                        <!-- SUMBER -->
                        <td>
                            <?php if($row['jenis']=='anggota'){ ?>
                                <span class="badge bg-primary">Anggota</span>
                            <?php } else { ?>
                                <span class="badge bg-secondary">Lainnya</span>
                            <?php } ?>
                        </td>

                        <!-- NAMA ANGGOTA -->
                        <td>
                            <?= ($row['username']) ? $row['username'] : '-' ?>
                        </td>

                        <td><?= $row['keterangan'] ?></td>

                        <td class="aksi-btn">
                            <a href="edit_masuk.php?id=<?= $row['id_masuk'] ?>" class="btn btn-outline-sky btn-sm">Edit</a>
                            <a href="hapus_masuk.php?id=<?= $row['id_masuk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                            <a href="lihat_masuk.php?id=<?= $row['id_masuk'] ?>" class="btn btn-info btn-sm text-white">Lihat</a>
                        </td>
                    </tr>
                <?php } ?>

                <?php if(mysqli_num_rows($kas)==0){ ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">Belum ada data kas masuk</td>
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
