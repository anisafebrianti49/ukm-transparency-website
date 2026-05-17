<?php
session_start();
include 'config/koneksi.php';

// proteksi login & role
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'bendahara'){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kas Keluar</title>
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
                    Tambah Kas Keluar
                </div>

                <div class="card-body">
                    <form method="POST" action="simpan_keluar.php">

                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>

                        <!-- KATEGORI / PENGGUNAAN -->
                        <div class="mb-3">
                            <label class="form-label">Penggunaan Dana</label>
                            <select name="jenis" class="form-control" required>
                                <option value="">-- Pilih Penggunaan --</option>
                                <option>Konsumsi</option>
                                <option>ATK</option>
                                <option>Transport</option>
                                <option>Dokumentasi</option>
                                <option>Kegiatan</option>
                                <option>Perlengkapan</option>
                                <option>Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="kas_keluar.php" class="btn btn-outline-sky btn-sm">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-sky btn-sm">
                                Simpan Data
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
