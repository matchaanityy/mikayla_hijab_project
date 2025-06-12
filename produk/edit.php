<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?
require_once '../helper/connection.php';

// Ambil data produk berdasarkan nama_produk dari URL
if (isset($_GET['nama_produk'])) {
    $nama_produk = $_GET['nama_produk'];
    $query = mysqli_query($conn, "SELECT * FROM tbproduk WHERE nama_produk='$nama_produk'");
    $data = mysqli_fetch_assoc($query);
}

// Proses jika form dikirim (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    // Proses upload file
    $ekstensi = array('png', 'jpg', 'jpeg');
    $namafile = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
    $ukuran = $_FILES['file']['size'];

    // Validasi input
    if (empty($nama_produk)) {
        echo "<script>alert('Nama produk tidak boleh kosong');location.href='../produk/edit.php?nama_produk=$nama_produk';</script>";
    } elseif (!in_array($tipe_file, $ekstensi)) {
        echo "<script>alert('Ekstensi file tidak diperbolehkan');location.href='../produk/edit.php?nama_produk=$nama_produk';</script>";
    } elseif ($ukuran > 1044070) {
        echo "<script>alert('Ukuran file terlalu besar');location.href='../produk/edit.php?nama_produk=$nama_produk';</script>";
    } else {
        // Upload file ke folder
        move_uploaded_file($tmp, '../assets/foto_produk/' . $namafile);

        // Update data produk
        $update = mysqli_query($conn, "UPDATE tbproduk SET 
                        nama_produk='$nama_produk',
                        deskripsi='$deskripsi',
                        harga='$harga',
                        gambar='$namafile'
                    WHERE nama_produk='$nama_produk'") or die(mysqli_error($conn));

        if ($update) {
            echo "<script>alert('Sukses update produk');location.href='pashmina.php';</script>";
        } else {
            echo "<script>alert('Gagal update produk');location.href='../produk/edit.php?nama_produk=$nama_produk';</script>";
        }
    }
}
?>
