<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'bendahara'){
    header("Location: login.php");
    exit;
}

if(!isset($_GET['id'])){
    header("Location: kas_masuk.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$data = mysqli_query($conn, "SELECT * FROM kas_masuk WHERE id_masuk='$id'");
$d = mysqli_fetch_assoc($data);

if(!$d){
    header("Location: kas_masuk.php");
    exit;
}

// ambil data anggota
$anggota = mysqli_query($conn,"SELECT id_user, username FROM users WHERE role='anggota' ORDER BY username ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kas Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar_bendahara.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header text-white fw-bold" style="background:#2ea3db;">
                    Edit Kas Masuk
                </div>

                <div class="card-body">
                    <form method="POST" action="update_masuk.php">

                        <input type="hidden" name="id" value="<?= $d['id_masuk']; ?>">

                        <!-- KATEGORI SUMBER UANG -->
                        <div class="mb-3">
                            <label class="form-label">Jenis Pemasukan</label>
                            <select name="jenis" id="jenis" class="form-control" onchange="toggleAnggota()" required>
                                <option value="anggota" <?= ($d['jenis']=='anggota')?'selected':''; ?>>Dari Anggota</option>
                                <option value="lainnya" <?= ($d['jenis']=='lainnya')?'selected':''; ?>>Dari Lainnya</option>
                            </select>
                        </div>

                        <!-- PILIH ANGGOTA -->
                        <div class="mb-3" id="anggotaField" style="display:none;">
                            <label class="form-label">Pilih Anggota</label>
                            <select name="id_user" class="form-control">
                                <option value="">-- Pilih Anggota --</option>
                                <?php while($a=mysqli_fetch_assoc($anggota)){ ?>
                                    <option value="<?= $a['id_user']; ?>"
                                        <?= ($d['id_user']==$a['id_user'])?'selected':''; ?>>
                                        <?= $a['username']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

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
                            <a href="kas_masuk.php" class="btn btn-secondary btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-sky btn-sm">Update Data</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="assets/script.js"></script>
<?php include 'footer.php'; ?>

<script>
// supaya saat halaman dibuka langsung sesuai kondisi data lama
document.addEventListener("DOMContentLoaded", function(){
    toggleAnggota();
});
</script>

</body>
</html>
