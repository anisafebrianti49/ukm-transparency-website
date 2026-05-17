<?php
session_start();
include 'config/koneksi.php';

// proteksi login & role
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'bendahara'){
    header("Location: login.php");
    exit;
}

// ambil data anggota
$anggota = mysqli_query($conn,"SELECT id_user, nama FROM users WHERE role='anggota' ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kas Masuk</title>
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
                    Tambah Kas Masuk
                </div>

                <div class="card-body">
                    <form method="POST" action="simpan_masuk.php">

                        <!-- JENIS PEMASUKAN -->
                        <div class="mb-3">
                            <label class="form-label">Jenis Pemasukan</label>
                            <select name="jenis" id="jenis" class="form-control" required onchange="toggleAnggota()">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="anggota">Iuran Anggota</option>
                                <option value="lainnya">Pemasukan Lainnya (Sponsor, Bazar, dll)</option>
                            </select>
                        </div>

                        <!-- PILIH ANGGOTA -->
                        <div class="mb-3" id="anggotaField" style="display:none;">
                            <label class="form-label">Pilih Anggota</label>
                            <select name="id_user" class="form-control">
                                <option value="">-- Pilih Anggota --</option>
                                <?php while($a = mysqli_fetch_assoc($anggota)){ ?>
                                    <option value="<?= $a['id_user']; ?>">
                                        <?= $a['nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="kas_masuk.php" class="btn btn-secondary btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-sky btn-sm">Simpan Data</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function toggleAnggota(){
    var jenis = document.getElementById("jenis").value;
    var anggotaField = document.getElementById("anggotaField");

    if(jenis === "anggota"){
        anggotaField.style.display = "block";
    } else {
        anggotaField.style.display = "none";
    }
}
</script>

<script src="assets/js/script.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>
