<?php
include 'config/koneksi.php';

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM kas_masuk WHERE id_masuk='$id'");

header("Location: kas_masuk.php");
?>
