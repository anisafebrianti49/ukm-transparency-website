<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role']!='bendahara'){
    header("Location: login.php");
    exit;
}

if(!isset($_GET['id'])){
    header("Location: kas_masuk.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

$query = mysqli_query($conn, "
    SELECT km.*, u.username 
    FROM kas_masuk km
    LEFT JOIN users u ON km.id_user = u.id_user
    WHERE km.id_masuk = '$id'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    header("Location: kas_masuk.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kas Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar_bendahara.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow">
                <div class="card-header text-white fw-bold" style="background:#2ea3db;">
                    Detail Transaksi Kas Masuk
                </div>

                <div class="card-body">

                    <table class="table">
                        <tr>
                            <th width="40%">Tanggal</th>
                            <td><?= $data['tanggal']; ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>
                                <span class="badge-rp">
                                    Rp <?= number_format($data['jumlah'],0,',','.'); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><?= $data['keterangan']; ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Pemasukan</th>
                            <td>
                                <?= $data['id_user'] ? 'Iuran Anggota' : 'Pemasukan Lainnya'; ?>
                            </td>
                        </tr>

                        <?php if($data['id_user']){ ?>
                        <tr>
                            <th>Nama Anggota</th>
                            <td><?= $data['username']; ?></td>
                        </tr>
                        <?php } ?>

                    </table>

                    <a href="kas_masuk.php" class="btn btn-secondary btn-sm">
                        Kembali
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
