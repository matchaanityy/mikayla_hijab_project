<?php
session_start();

require_once 'helper/connection.php';

$username = $_POST['username'];
$password = $_POST['password'];
$role     = $_POST['role'];

if (empty($username) || empty($password) || empty($role)) {
    echo "<script>alert('Semua field harus diisi');location.href='login.php';</script>";
    exit;
}

if ($role == 'admin') {
    $query = mysqli_query($conn, "SELECT * FROM tbadmin WHERE username = '$username'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        if ($password === $data['password']) {
            $_SESSION['id_admin']    = $data['id_admin'];
            $_SESSION['username']  = $data['username'];
            $_SESSION['role']        = 'admin';
            $_SESSION['login']       = true;
            header("Location: dashboard/index.php");
            exit;
        } else {
            echo "<script>alert('Password salah');location.href='login.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Username admin tidak ditemukan');location.href='login.php';</script>";
        exit;
    }

} elseif ($role == 'customer') {
    $query = mysqli_query($conn, "SELECT * FROM tbuser WHERE nama_user = '$username'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        if ($password === $data['password_user']) {
            $_SESSION['id_user']     = $data['id_user'];
            $_SESSION['nama_user']   = $data['nama_user'];
            $_SESSION['role']        = 'customer';
            $_SESSION['login']       = true;
            header("Location: dashboard_user/index.php");
            exit;
        } else {
            echo "<script>alert('Password salah');location.href='login.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Username customer tidak ditemukan');location.href='login.php';</script>";
        exit;
    }

} else {
    echo "<script>alert('Role tidak valid');location.href='login.php';</script>";
    exit;
}
?>
