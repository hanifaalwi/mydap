<?php
// 1. Koneksi ke database
include 'koneksi.php'; // pastikan file koneksi ini ada dan sesuai

// 2. Validasi input
if (isset($_GET['Nomor']) && isset($_GET['statuss'])) {
    $Nomor = $_GET['Nomor'];
    $newStatus = $_GET['statuss'];

    // 3. Cek apakah statusnya "revisi"
    if ($newStatus == 'revisi') {
        // 4. Eksekusi query update
        $query = "UPDATE data SET statuss = 'revisi' WHERE Nomor = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("i", $Nomor);
        $success = $stmt->execute();

        // 5. Feedback ke user
        if ($success) {
            echo "<script>alert('Status berhasil diubah menjadi ditolak/revisi.'); window.location='rekap.php';</script>";
        } else {
            echo "<script>alert('Gagal mengubah status.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Status tidak valid.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Parameter tidak lengkap.'); window.history.back();</script>";
}
?>

