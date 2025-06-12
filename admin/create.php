<?php
if($_POST){
$id_admin=$_POST['id_admin'];
$username=$_POST['username'];
$password=$_POST['password'];
$telp_admin=$_POST['telp_admin'];

if(empty($id_admin)){
    echo "<script>alert('id admin tidak boleh
    kosong');location.href='../user/index.php';</script>";
    } elseif(empty($username)){
    echo "<script>alert('username tidak boleh
    kosong');location.href='../admin/index.php';</script>";
    } elseif(empty($telp_admin)){
    echo "<script>alert('no telepon admin tidak boleh
    kosong');location.href='../admin/index.php';</script>";
    } else {
    include "../helper/connection.php";
    $insert=mysqli_query($conn,"insert into tbadmin
    (id_admin, username, password, telp_admin )
    value
    ('".$id_admin."','".$username."','".$password."','".$telp_admin."')") or
    die(mysqli_error($conn));
if($insert){
    echo "<script>alert('Sukses menambahkan admin');location.href='../admin/index.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan admin');location.href='../admin/index.php';</script>";
}
}
}
?>