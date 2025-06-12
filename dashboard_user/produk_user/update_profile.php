<?php
// Mulai session 
session_start();

// Include file koneksi database
require_once "../../helper/connection.php";

// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Validasi request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = "Invalid request method";
    header("Location: profile.php");
    exit();
}

if (!isset($_SESSION['id_user'])) {
    $_SESSION['error'] = "You must be logged in to update profile";
    header("Location: ../../../login.php");
    exit();
}

// Debug: Tampilkan data POST
// echo "<pre>"; print_r($_POST); echo "</pre>"; exit();

// Ambil ID user dari session
$id_user = $_SESSION['id_user'];

// Validasi input yang diperlukan
$required_fields = ['nama_user', 'telp_user', 'alamat'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $_SESSION['error'] = "Field " . ucfirst(str_replace('_', ' ', $field)) . " is required";
        header("Location: profile.php");
        exit();
    }
}

// Escape input untuk mencegah SQL injection
$nama_user = mysqli_real_escape_string($conn, $_POST['nama_user']);
$telp_user = mysqli_real_escape_string($conn, $_POST['telp_user']);
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

// Mulai transaksi
mysqli_begin_transaction($conn);

try {
    // Query update dasar
    $query = "UPDATE tbuser SET 
              nama_user = ?,
              telp_user = ?,
              alamat = ?";
    
    $types = "sss";
    $params = [$nama_user, $telp_user, $alamat];
    
    // Jika password diisi
    if (!empty($_POST['password_user'])) {
        $password_user = mysqli_real_escape_string($conn, $_POST['password_user']);
        $query .= ", password_user = ?";
        $types .= "s";
        $params[] = $password_user;
        
        // Debug: Tampilkan query dan parameter
        // echo "Query: $query<br>";
        // echo "Types: $types<br>";
        // print_r($params);
        // exit();
    }
    
    $query .= " WHERE id_user = ?";
    $types .= "i";
    $params[] = $id_user;
    
    // Prepare statement
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . mysqli_error($conn));
    }
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    
    // Eksekusi statement
    $result = mysqli_stmt_execute($stmt);
    
    if (!$result) {
        throw new Exception("Update failed: " . mysqli_error($conn));
    }
    
    // Commit transaksi jika berhasil
    mysqli_commit($conn);
    
    // Update data session
    $_SESSION['nama_user'] = $nama_user;
    $_SESSION['telp_user'] = $telp_user;
    $_SESSION['alamat'] = $alamat;
    
    $_SESSION['success'] = "Profile updated successfully";
    
} catch (Exception $e) {
    // Rollback jika ada error
    mysqli_rollback($conn);
    $_SESSION['error'] = "Update failed: " . $e->getMessage();
} finally {
    // Tutup statement jika ada
    if (isset($stmt)) {
        mysqli_stmt_close($stmt);
    }
}

// Debug: Tampilkan pesan error/success sebelum redirect
// echo $_SESSION['error'] ?? $_SESSION['success'] ?? 'No message'; exit();

// Redirect kembali ke halaman profile
header("Location: profile.php");
exit();
?>