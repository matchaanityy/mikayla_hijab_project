<?php
    if($_GET['id_user']){
        include "../helper/connection.php";
        $qry_hapus=mysqli_query($conn,"delete from tbuser where id_user='".$_GET['id_user']."'");
        if($qry_hapus){
            echo "<script>alert('Sukses hapus Customer');location.href='../user/index.php';</script>";
        } else {
            echo "<script>alert('Gagal hapus Customer');location.href='../user/index.php';</script>";
        }
    }
?>