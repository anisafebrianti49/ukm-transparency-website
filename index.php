<?php
session_start();

// Kalau sudah login, langsung ke dashboard sesuai role
if(isset($_SESSION['login'])){
    if($_SESSION['role'] == 'bendahara'){
        header("Location: dashboard.php");
    } else {
        header("Location: dashboard_anggota.php");
    }
    exit;
}

// Kalau belum login → arahkan ke registrasi dulu
header("Location: registrasi.php");
exit;
