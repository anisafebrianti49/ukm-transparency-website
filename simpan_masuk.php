<?php
session_start();
include 'config/koneksi.php';

// proteksi
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'bendahara'){
    header("Location: login.php");
    exit;
}

$tgl   = $_POST['tanggal'];
$jml   = $_POST['jumlah'];
$ket   = $_POST['keterangan'];
$jenis = $_POST['jenis'];

// kalau iuran anggota, id_user wajib ada
if($jenis == "anggota"){
    $id_user = $_POST['id_user'];

    if(empty($id_user)){
        die("Anggota harus dipilih untuk iuran anggota!");
    }

}else{
    // pemasukan lain, id_user NULL
    $id_user = NULL;
}

// pakai prepared statement biar aman & tidak FK error
$stmt = $conn->prepare("INSERT INTO kas_masuk (tanggal, jumlah, keterangan, id_user) VALUES (?, ?, ?, ?)");
$stmt->bind_param(
    "sisi",
    $tgl,
    $jml,
    $ket,
    $id_user
);

if(!$stmt->execute()){
    die("Gagal simpan: " . $stmt->error);
}

$stmt->close();

header("Location: kas_masuk.php");
exit;
?>
