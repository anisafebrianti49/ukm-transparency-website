<?php
session_start();
include 'config/koneksi.php';

$id = $_GET['id'];

mysqli_query($conn,"
    UPDATE pembayaran_kas
    SET status='ditolak'
    WHERE id_bayar='$id' AND status='pending'
");

header("Location: verifikasi_pembayaran.php");

