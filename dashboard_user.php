<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'bendahara'){
    header("Location: login.php");
    exit;
}

/*
Ambil semua user + total pembayaran kas masuknya
*/
$users = mysqli_query($conn,"
    SELECT 
        u.id_user,
        u.username,
        u.role,
        IFNULL(SUM(k.jumlah),0) AS total_bayar
    FROM users u
    LEFT JOIN kas_masuk k ON u.id_user = k.id_user
    GROUP BY u.id_user
    ORDER BY u.role DESC, u.username ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manajemen User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar_bendahara.php'; ?>

<div class="container mt-4">

    <h5 class="text-black mb-3">Manajemen User & Total Pembayaran Kas</h5>

    <div class="card card-table">
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th>Username</th>
                        <th width="15%">Role</th>
                        <th width="25%">Total Sudah Bayar</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; while($u = mysqli_fetch_assoc($users)){ ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $u['username'] ?></td>
                        <td>
                            <span class="badge bg-info text-dark">
                                <?= $u['role'] ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge-rp">
                                Rp <?= number_format($u['total_bayar'],0,',','.') ?>
                            </span>
                        </td>
                        <td class="aksi-btn">
                            <a href="hapus_user.php?id=<?= $u['id_user'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus user ini?')">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php } ?>

                <?php if(mysqli_num_rows($users)==0){ ?>
                    <tr>
                        <td colspan="5" class="text-center py-4">Belum ada user</td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

</div>
<?php include 'footer.php'; ?>
</body>
</html>
