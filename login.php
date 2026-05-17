<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Uang Kas UKM EC</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">

</head>
<body>

<div class="container vh-100 d-flex justify-content-center align-items-center">

    <div class="col-md-4">
        <div class="login-card p-4">

            <h4 class="text-center title-sky fw-bold">
                LOGIN UANG KAS UKM EC
            </h4>
            <p class="text-center text-muted mb-4">
                Periode 2025 / 2026
            </p>

            <form action="proses_login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-sky">
                        Login
                    </button>
                </div>
            </form>

            <hr>

            <p class="text-center small text-muted">
                © UKM EC – Sistem Informasi Uang Kas
            </p>

        </div>
    </div>

</div>

</body>
</html>
