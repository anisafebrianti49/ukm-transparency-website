<?php
session_start();
include 'config/koneksi.php';

// hanya anggota
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'anggota'){
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bayar Kas - UKM EC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar_anggota.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow">
                <div class="card-header text-white fw-bold" style="background:#2ea3db;">
                    Pembayaran Kas Anggota (Transfer Bank)
                </div>

                <div class="card-body">

                    <!-- INFO IURAN (SUDAH RAPI & NYATU) -->
                    <p class="info-iuran-inside">
                        Setiap anggota UKM EC diwajibkan membayar iuran kas sebesar 
                        <strong>Rp10.000 per bulan</strong> untuk mendukung kegiatan dan operasional UKM. 
                        Pembayaran dicatat pada sistem untuk menjaga transparansi keuangan.
                    </p>

                    <form method="POST" action="proses_bayar.php" enctype="multipart/form-data">

                        <!-- INFO TRANSFER -->
                        <div class="card card-sky p-3 mb-4">
                            <h6 class="text-sky mb-3">Silakan Transfer ke Rekening Berikut</h6>

                            <label class="fw-semibold">SeaBank</label>
                            <div class="input-group mb-1">
                                <input type="text" id="norek" class="form-control" 
                                value="901555269940" readonly>
                                <button class="btn btn-sky" type="button" onclick="copyRek()">Salin</button>
                            </div>
                            <small>a.n Anisa Febrianti</small>
                        </div>

                        <!-- JUMLAH -->
                        <div class="mb-3">
                            <label class="form-label">Jumlah Bayar</label>
                            <input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Contoh: 10.000" required>
                        </div>

                        <!-- UPLOAD BUKTI -->
                        <div class="mb-3">
                            <label class="form-label">Upload Bukti Pembayaran</label>
                            <input type="file" name="bukti" class="form-control" accept="image/*" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-sky px-4">
                                Kirim Bukti Pembayaran
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
// tombol salin rekening
function copyRek(){
    const copyText = document.getElementById("norek");
    navigator.clipboard.writeText(copyText.value);
    alert("Nomor rekening berhasil disalin!");
}

// format ribuan di input jumlah
const jumlahInput = document.getElementById('jumlah');
if(jumlahInput){
    jumlahInput.addEventListener('keyup', function(){
        let angka = this.value.replace(/\D/g, '');
        this.value = new Intl.NumberFormat('id-ID').format(angka);
    });
}
</script>

<?php include 'footer.php'; ?>
</body>
</html>
