<?php
session_start();
include 'config/koneksi.php';

// proteksi login & role
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'bendahara'){
    header("Location: login.php");
    exit;
}

// validasi id
if(!isset($_GET['id'])){
    header("Location: kas_keluar.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$data = mysqli_query($conn,"SELECT * FROM kas_keluar WHERE id_keluar='$id'");
$d = mysqli_fetch_assoc($data);

if(!$d){
    header("Location: kas_keluar.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kas Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar_bendahara.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card card-sky shadow">
                <div class="card-header text-black fw-bold">
                    Edit Kas Keluar
                </div>

                <div class="card-body">
                    <form method="POST" action="update_keluar.php">

                        <input type="hidden" name="id" value="<?= $d['id_keluar']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= $d['tanggal']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" value="<?= $d['jumlah']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="<?= $d['keterangan']; ?>" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="kas_keluar.php" class="btn btn-outline-sky btn-sm">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-sky btn-sm">
                                Update Data
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="assets/js/script.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>
