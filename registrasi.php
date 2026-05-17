<?php
session_start();
include 'config/koneksi.php';

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    if($password !== $password2){
        $error = "Password dan konfirmasi password tidak cocok!";
    } else {
        $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
        if(mysqli_num_rows($cek) > 0){
            $error = "Username sudah digunakan!";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $role = "anggota";
            $query = mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password_hash', '$role')");

            if($query){
                $success = "Registrasi berhasil! Silakan login.";
            } else {
                $error = "Gagal registrasi: ".mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Registrasi | UKM EC</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">

<style>
    .auth-wrapper{
        min-height:100vh;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .auth-card{
        width:100%;
        max-width:420px;
    }
</style>
</head>
<body>

<div class="auth-wrapper">
    <div class="card card-sky p-4 auth-card">

        <h5 class="text-sky text-center mb-3">Registrasi Anggota Baru</h5>

        <?php if(isset($success)){ ?>
            <div class="alert alert-success"><?= $success ?></div>
            <a href="login.php" class="btn btn-sky d-block">Login Sekarang</a>
        <?php } else { ?>

            <?php if(isset($error)){ ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>

            <form method="POST">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password2" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" name="submit" class="btn btn-sky">Daftar</button>
                </div>
            </form>

            <a href="login.php" class="btn btn-outline-sky btn-sm mt-3 d-block text-center">
                Sudah punya akun? Login
            </a>

        <?php } ?>

    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
