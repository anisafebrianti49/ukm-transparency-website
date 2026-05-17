<?php
include 'config/koneksi.php';

$id = $_POST['id'];
$tgl = $_POST['tanggal'];
$jml = $_POST['jumlah'];
$ket = $_POST['keterangan'];

mysqli_query($conn,
"UPDATE kas_keluar SET
tanggal='$tgl',
jumlah='$jml',
keterangan='$ket'
WHERE id_keluar='$id'");

header("Location: kas_keluar.php");
?>
