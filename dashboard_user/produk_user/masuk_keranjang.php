<?php
session_start();
include "../../helper/connection.php";

// Cek login
if(!isset($_SESSION['id_user'])) {
    header("Location: masuk_keranjang.php");
    exit();
}

// Validasi input
if(!isset($_GET['id_produk']) || !isset($_POST['jumlah_barang'])) {
    $_SESSION['error'] = "Data tidak lengkap";
    header("Location: beli_produk.php?id_produk=".$_GET['id_produk']);
    exit();
}

$qry_get_produk = mysqli_query($conn, "SELECT * FROM tbproduk WHERE id_produk = '" . $_GET['id_produk'] . "'");
$dt_produk = mysqli_fetch_array($qry_get_produk);
$_SESSION['cart'][] = array(
    'id_produk' => $dt_produk['id_produk'], 
    'nama_produk' => $dt_produk['nama_produk'],
    'harga' => $dt_produk['harga'],
    'jumlah_barang'=>$_POST['jumlah_barang'],
);

header('location: keranjang.php');
?>