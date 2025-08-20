<?php
include "koneksi.php";
session_start();

// Proteksi akses hanya untuk admin
if (!isset($_SESSION['username']) || $_SESSION['status'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Ambil data dari form
$No       = $_POST['No'];
$Namak = $_POST['Namak'];
$NIPk = $_POST['NIPk'];
$Statusk   = $_POST['Statusk'];

// Validasi sederhana (bisa ditambah jika perlu)
if (empty($No) || empty($Namak) || empty($NIPk) || empty($Statusk)) {
    echo "Data tidak boleh kosong.";
    exit();
}

// Update ke database
$query = "UPDATE kabid SET Namak='$Namak', NIPk='$NIPk', Statusk='$Statusk' WHERE No='$No'";
$result = mysqli_query($connect, $query);

if ($result) {
    // Redirect ke halaman users dengan pesan sukses (opsional)
    header("Location: users.php?pesan=update_sukses");
} else {
    echo "Gagal mengupdate data: " . mysqli_error($connect);
}
?>
