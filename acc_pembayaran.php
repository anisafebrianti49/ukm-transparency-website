<?php
session_start();
include 'config/koneksi.php';

// hanya bendahara yang boleh ACC
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'bendahara'){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// ambil data pembayaran
$p = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT * FROM pembayaran_kas WHERE id_bayar='$id' AND status='pending'
"));

// pastikan data ada dan belum pernah di ACC
if($p){

    // masukkan ke kas_masuk dengan sumber yang BENAR
   
    mysqli_query($conn,"
    INSERT INTO kas_masuk 
    SET 
        tanggal     = '{$p['tanggal']}',
        jumlah      = '{$p['jumlah']}',
        sumber      = 'Iuran Anggota',
        keterangan  = 'Iuran kas via {$p['metode']}',
        id_user     = '{$p['id_user']}'
        ");

    // ubah status pembayaran
    mysqli_query($conn,"
        UPDATE pembayaran_kas
        SET status='diterima'
        WHERE id_bayar='$id'
    ");
}

header("Location: verifikasi_pembayaran.php");
exit;
