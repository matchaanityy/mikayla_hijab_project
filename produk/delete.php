<?php
    if($_GET['nama_produk']){
        include "../helper/connection.php";
        $qry_hapus=mysqli_query($conn,"delete from tbproduk where nama_produk='".$_GET['nama_produk']."'");
        if($qry_hapus){
            echo "<script>alert('Sukses hapus produk');location.href='../produk/pashmina.php';</script>";
        } else {
            echo "<script>alert('Gagal hapus produk');location.href='../produk/pashmina.php';</script>";
        }
    }
?>
