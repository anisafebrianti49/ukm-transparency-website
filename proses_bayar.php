<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role']!='anggota'){
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$tanggal = date('Y-m-d');

// ✅ bersihkan format rupiah
$jumlah  = str_replace(['Rp ', '.'], '', $_POST['jumlah']);
$metode  = 'transfer'; // karena sekarang hanya transfer

// ================== VALIDASI UPLOAD ==================
$namaFile = $_FILES['bukti']['name'];
$tmp      = $_FILES['bukti']['tmp_name'];
$size     = $_FILES['bukti']['size'];

$folder = "assets/bukti/";
if(!is_dir($folder)){
    mkdir($folder,0777,true);
}

$ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
$allowed = ['jpg','jpeg','png'];

if(!in_array($ext, $allowed)){
    die("Format file harus jpg / jpeg / png");
}

if($size > 2000000){
    die("Ukuran file maksimal 2MB");
}

$namaBaru = time()."_".rand(100,999).".".$ext;
move_uploaded_file($tmp, $folder.$namaBaru);

// ================== SIMPAN DATABASE ==================
$query = mysqli_query($conn,"
INSERT INTO pembayaran_kas
(id_user,tanggal,jumlah,metode,bukti)
VALUES
('$id_user','$tanggal','$jumlah','$metode','$namaBaru')
");

if(!$query){
    die("Gagal simpan: ".mysqli_error($conn));
}

header("Location: dashboard_anggota.php?pesan=menunggu_verifikasi");
exit;
?>
