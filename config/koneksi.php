<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kas_ukm";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal!");
}
?>
