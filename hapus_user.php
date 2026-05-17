<?php
session_start();
include 'config/koneksi.php';

if($_SESSION['role'] != 'bendahara'){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM users WHERE id_user='$id'");

header("Location: dashboard_user.php");
