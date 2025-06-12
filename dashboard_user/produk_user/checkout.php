<?php
session_start();
include "../../helper/connection.php";

// Cek login
if (!isset($_SESSION['id_user'])) {
    header("Location: ../../login.php");
    exit();
}

$cart = @$_SESSION['cart'];

if (count($cart) > 0) {
    mysqli_begin_transaction($conn);
    
    try {
        $id_user = $_SESSION['id_user'];
        $tgl_order = date("Y-m-d");

        // Hitung total semua harga
        $total_harga = 0;
        foreach ($cart as $item) {
            $total_harga += $item['jumlah_barang'] * $item['harga'];
        }

        // Simpan ke tborder
        $insert_order = mysqli_query($conn, "INSERT INTO tborder (id_user, tgl_order, total_harga) 
                                              VALUES ('$id_user', '$tgl_order', '$total_harga')");
        
        if (!$insert_order) {
            throw new Exception("Gagal menyimpan data ke tborder");
        }

        // Ambil ID order terakhir
        $id_order = mysqli_insert_id($conn);

        // Simpan ke detail_order
        foreach ($cart as $item) {
            $id_produk = $item['id_produk'];
            $jumlah_barang = $item['jumlah_barang'];
            $harga_satuan = $item['harga'];
            $subtotal = $jumlah_barang * $harga_satuan;

            $insert_detail = mysqli_query($conn, "INSERT INTO detail_order 
                (id_order, id_produk, qty, subtotal) 
                VALUES 
                ('$id_order', '$id_produk', '$jumlah_barang', '$subtotal')");

            if (!$insert_detail) {
                throw new Exception("Gagal menyimpan detail produk $id_produk");
            }
        }

        mysqli_commit($conn);
        unset($_SESSION['cart']);

        echo '<script>alert("Checkout berhasil!"); location.href="struk.php?id_order='.$id_order.'";</script>';

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo '<script>alert("Error: '.$e->getMessage().'"); history.back();</script>';
    }
} else {
    echo '<script>alert("Keranjang belanja kosong!"); history.back();</script>';
}
?>
