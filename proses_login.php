<?php
session_start();
include 'config/koneksi.php';

// Ambil input user
$username = mysqli_real_escape_string($conn, trim($_POST['username']));
$password = trim($_POST['password']);

// Cari user di DB
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

$login_berhasil = false;
$redirect = "login.php?error=1";

// Cek apakah user ditemukan
if($data){
    // Cek password: pertama coba password_verify (untuk hash)
    // Jika gagal, cek plain text (untuk user lama)
    if(password_verify($password, $data['password']) || $password === $data['password']){
        $_SESSION['login'] = true;
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        $redirect = ($data['role'] == 'bendahara') ? "dashboard.php" : "dashboard_anggota.php";
        $login_berhasil = true;

        // Jika password masih plain text, otomatis hash dan update DB
        if(!password_needs_rehash($data['password'], PASSWORD_DEFAULT)){
            $new_hash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE users SET password='$new_hash' WHERE id_user='".$data['id_user']."'");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Proses Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="refresh" content="2;url=<?= $redirect ?>">
    <style>
        body { background-color: #eaf4ff; }
        .card { border-radius: 12px; }
    </style>
</head>
<body>
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4">
        <div class="card p-4 text-center shadow">
            <?php if($login_berhasil){ ?>
                <div class="spinner-border text-primary mb-3"></div>
                <h5 class="text-primary">Login berhasil</h5>
                <p>Mengalihkan ke dashboard...</p>
            <?php } else { ?>
                <div class="alert alert-danger">
                    Login gagal!<br>
                    Username atau password salah
                </div>
                <p>Mengalihkan kembali ke halaman login...</p>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>
