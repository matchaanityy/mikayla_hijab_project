<?php
require_once '../helper/connection.php';

if($_POST){
$id_user=$_POST['id_user'];
$nama_user=$_POST['nama_user'];
$password_user=$_POST['password_user'];
$alamat=$_POST['alamat'];
$telp_user=$_POST['telp_user'];

if(empty($id_user)){
    echo "<script>alert('id customer tidak boleh kosong');location.href='../user/index.php';</script>";
    } elseif(empty($nama_user)){
    echo "<script>alert('nama customer tidak boleh kosong');location.href='../user/index.php';</script>";
    } elseif(empty($password_user)){
    echo "<script>alert('password tidak boleh kosong');location.href='../user/index.php';</script>";
    }elseif(empty($telp_user)){
    echo "<script>alert('no telp tidak boleh kosong');location.href='../user/index.php';</script>";
    } else {
    include "../helper/connection.php";
    $insert=mysqli_query($conn,"insert into tbuser (id_user,nama_user, password_user, alamat, telp_user) value ('".$id_user."','".$nama_user."','".$password_user."','".$alamat."','".$telp_user."')") or die(mysqli_error($conn));
if($insert){

    echo "<script>alert('Sukses menambahkan Customer');location.href='../user/index.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan Customer');location.href='../user/index.php';</script>";
}
}
}
?>