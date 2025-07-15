<?php
include "koneksi.php";
session_start();

// Proteksi akses hanya untuk admin
if (!isset($_SESSION['username']) || $_SESSION['status'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Ambil data dari form
$id       = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$status   = $_POST['status'];

// Validasi sederhana (bisa ditambah jika perlu)
if (empty($id) || empty($username) || empty($password) || empty($status)) {
    echo "Data tidak boleh kosong.";
    exit();
}

// Update ke database
$query = "UPDATE users SET username='$username', password='$password', status='$status' WHERE id='$id'";
$result = mysqli_query($connect, $query);

if ($result) {
    // Redirect ke halaman users dengan pesan sukses (opsional)
    header("Location: users.php?pesan=update_sukses");
} else {
    echo "Gagal mengupdate data: " . mysqli_error($connect);
}
?>
