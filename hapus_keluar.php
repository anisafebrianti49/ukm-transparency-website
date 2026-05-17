<?php
include 'config/koneksi.php';

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM kas_keluar WHERE id_keluar='$id'");

header("Location: kas_keluar.php");
?>
