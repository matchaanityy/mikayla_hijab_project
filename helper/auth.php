<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('Silakan login terlebih dahulu');
        location.href='../../../proses_login.php';
    </script>";
    exit;
}

// Redirect berdasarkan role
if ($_SESSION['role'] == 'admin') {
    header("Location: ../../dashboard/index.php");
    exit;
} elseif ($_SESSION['role'] == 'customer') {
    header("Location: ../../dashboard_user/index.php");
    exit;
} else {
    // Jika role tidak valid, kembalikan ke halaman login
    echo "<script>
        alert('Role tidak dikenali!');
        location.href='../../../proses_login.php';
    </script>";
    exit;
}
?>