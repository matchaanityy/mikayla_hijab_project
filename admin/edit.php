<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once __DIR__ . '/../helper/connection.php';

if (!isset($_GET['id_admin']) || !is_numeric($_GET['id_admin'])) {
    header("Location: index.php");
    exit;
}

$id_admin = (int)$_GET['id_admin'];
$query = mysqli_query($conn, "SELECT * FROM tbadmin WHERE id_admin='$id_admin'");

if (mysqli_num_rows($query) == 0) {
    echo "<script>alert('Data admin tidak ditemukan');location.href='index.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_admin = (int)$_POST['id_admin'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $telp_admin = mysqli_real_escape_string($conn, $_POST['telp_admin']);

    // Validasi input
    if (empty($telp_admin)) {
        echo "<script>alert('Nama admin tidak boleh kosong');location.href='edit.php?id_admin=$id_admin';</script>";
        exit;
    } elseif (empty($password)) {
        echo "<script>alert('Password tidak boleh kosong');location.href='edit.php?id_admin=$id_admin';</script>";
        exit;
    } elseif (empty($telp_admin)) {
        echo "<script>alert('Nomor telepon tidak boleh kosong');location.href='edit.php?id_admin=$id_admin';</script>";
        exit;
    }

    $update = mysqli_query($conn, "UPDATE tbadmin SET 
        username='$username',
        password='$password',
        telp_admin='$telp_admin'
        WHERE id_admin='$id_admin'");

    if ($update) {
        $_SESSION['success'] = 'Sukses update admin';
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Gagal update admin: " . addslashes(mysqli_error($conn)) . "');location.href='edit.php?id_admin=$id_admin';</script>";
        exit;
    }
}

$admin = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Admin
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
    <h2>Edit Admin</h2>
    <form method="POST" action="edit.php?id_admin=<?= $admin['id_admin'] ?>">
        <input type="hidden" name="id_admin" value="<?= htmlspecialchars($admin['id_admin']) ?>">

        <div class="mb-3">
        <label for="username" class="form-label">Nama Admin</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($admin['username']) ?>" required>
        </div>

        <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="text" class="form-control" id="password" name="password" value="<?= htmlspecialchars($admin['password']) ?>" required>
        </div>

        <div class="mb-3">
        <label for="telp_admin" class="form-label">No. Telp</label>
        <input type="text" class="form-control" id="telp_admin" name="telp_admin" value="<?= htmlspecialchars($admin['telp_admin']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Admin</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
    </div>
</html>
