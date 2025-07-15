<?php
include 'koneksi.php';

if (isset($_GET['Nomor']) && isset($_GET['statuss'])) {
    $Nomor = $_GET['Nomor'];
    $status_baru = $_GET['statuss'];

    // Validasi status (opsional, untuk keamanan)
    $status_izin = ['disetujui', 'pending'];
    if (!in_array($status_baru, $status_izin)) {
        die("Status tidak valid.");
    }

    // Update status
    $query = "UPDATE data SET statuss = '$status_baru' WHERE Nomor = '$Nomor'";
    $result = mysqli_query($connect, $query);

    if ($result) {
        header("Location: rekap.php"); // redirect kembali ke halaman utama
        exit();
    } else {
        echo "Gagal mengubah status: " . mysqli_error($connect);
    }
} else {
    echo "Parameter tidak lengkap.";
}
?>
