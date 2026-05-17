<?php
include 'config/koneksi.php';

$id = $_POST['id'];
$tgl = $_POST['tanggal'];
$jml = $_POST['jumlah'];
$ket = $_POST['keterangan'];

mysqli_query($conn,
"UPDATE kas_masuk SET
tanggal='$tgl',
jumlah='$jml',
keterangan='$ket'
WHERE id_masuk='$id'");

header("Location: kas_masuk.php");
?>
