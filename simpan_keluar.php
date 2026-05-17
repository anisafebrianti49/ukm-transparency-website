<?php
session_start();
include 'config/koneksi.php';

$tgl = $_POST['tanggal'];
$jml = $_POST['jumlah'];
$kategori = $_POST['jenis'];
$ket = $_POST['keterangan'];

mysqli_query($conn,"
INSERT INTO kas_keluar (tanggal, jumlah, jenis, keterangan)
VALUES ('$tgl','$jml','$kategori','$ket')
");

header("Location: kas_keluar.php");
?>
