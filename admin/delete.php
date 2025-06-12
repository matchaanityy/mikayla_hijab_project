<?php
    if($_GET['id_admin']){
        include "../helper/connection.php";
        $qry_hapus=mysqli_query($conn,"delete from tbadmin where id_admin='".$_GET['id_admin']."'");
        if($qry_hapus){
            echo "<script>alert('Sukses hapus Admin');location.href='../admin/index.php';</script>";
        } else {
            echo "<script>alert('Gagal hapus Admin');location.href='../admin/index.php';</script>";
        }
    }
?>