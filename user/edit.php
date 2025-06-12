<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once __DIR__ . '/../helper/connection.php';

if (!isset($_GET['id_user']) || !is_numeric($_GET['id_user'])) {
    header("Location: index.php");
    exit;
}

$id_user = (int)$_GET['id_user'];
$query = mysqli_query($conn, "SELECT * FROM tbuser WHERE id_user='$id_user'");

if (mysqli_num_rows($query) == 0) {
    echo "<script>alert('Data user tidak ditemukan');location.href='index.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = (int)$_POST['id_user'];
    $nama_user = mysqli_real_escape_string($conn, $_POST['nama_user']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telp_user = mysqli_real_escape_string($conn, $_POST['telp_user']);

    // Validasi input
    if (empty($nama_user)) {
        echo "<script>alert('Nama user tidak boleh kosong');location.href='edit.php?id_user=$id_user';</script>";
        exit;
    } elseif (empty($alamat)) {
        echo "<script>alert('Alamat tidak boleh kosong');location.href='edit.php?id_user=$id_user';</script>";
        exit;
    } elseif (empty($telp_user)) {
        echo "<script>alert('Nomor telepon tidak boleh kosong');location.href='edit.php?id_user=$id_user';</script>";
        exit;
    }

    $update = mysqli_query($conn, "UPDATE tbuser SET 
        nama_user='$nama_user',
        alamat='$alamat',
        telp_user='$telp_user'
        WHERE id_user='$id_user'");

    if ($update) {
        $_SESSION['success'] = 'Sukses update user';
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Gagal update user: " . addslashes(mysqli_error($conn)) . "');location.href='edit.php?id_user=$id_user';</script>";
        exit;
    }
}

// Ambil data user
$user = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Customer
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    </head>

    <div class="container mt-5">
    <h2>Edit Customer</h2>
    <form method="POST" action="edit.php?id_user=<?= $user['id_user'] ?>">
        <input type="hidden" name="id_user" value="<?= htmlspecialchars($user['id_user']) ?>">

        <div class="mb-3">
        <label for="nama_user" class="form-label">Nama Customer</label>
        <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?= htmlspecialchars($user['nama_user']) ?>" required>
        </div>

        <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= htmlspecialchars($user['alamat']) ?>" required>
        </div>

        <div class="mb-3">
        <label for="telp_user" class="form-label">No. Telp</label>
        <input type="text" class="form-control" id="telp_user" name="telp_user" value="<?= htmlspecialchars($user['telp_user']) ?>" required>
        </div>

        <!-- Optional: Bisa juga mengedit password -->
        <!--
        <div class="mb-3">
        <label for="password_user" class="form-label">Password</label>
        <input type="text" class="form-control" id="password_user" name="password_user" value="<?= htmlspecialchars($user['password_user']) ?>">
        </div>
        -->

        <button type="submit" class="btn btn-primary">Update Customer</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
    </div>
</html>
