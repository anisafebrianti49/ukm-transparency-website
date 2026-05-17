<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role']!='bendahara'){
    header("Location: login.php");
    exit;
}

if(!isset($_GET['id'])){
    header("Location: kas_keluar.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM kas_keluar WHERE id_keluar='$id'");
$data = mysqli_fetch_assoc($query);

if(!$data){
    header("Location: kas_keluar.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kas Keluar</title>
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
                    Detail Transaksi Kas Keluar
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
                                <span class="badge_rp ">
                                    Rp <?= number_format($data['jumlah'],0,',','.'); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><?= $data['keterangan']; ?></td>
                        </tr>
                    </table>

                    <a href="kas_keluar.php" class="btn btn-secondary btn-sm">
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
