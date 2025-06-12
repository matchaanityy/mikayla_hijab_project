<?php
$conn = mysqli_connect("localhost", "root", "", "hijab_store");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>