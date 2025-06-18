<?php
include 'koneksi.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status_baru = $_GET['status'];

    // Validasi status (opsional, untuk keamanan)
    $status_izin = ['disetujui', 'pending'];
    if (!in_array($status_baru, $status_izin)) {
        die("Status tidak valid.");
    }

    // Update status
    $query = "UPDATE data SET status = '$status_baru' WHERE Nomor = '$id'";
    $result = mysqli_query($connect, $query);

    if ($result) {
        header("Location: data.php"); // redirect kembali ke halaman utama
        exit();
    } else {
        echo "Gagal mengubah status: " . mysqli_error($connect);
    }
} else {
    echo "Parameter tidak lengkap.";
}
?>
