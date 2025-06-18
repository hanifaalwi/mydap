<?php
include 'koneksi.php';

if (isset($_POST['id']) && isset($_POST['komentar'])) {
    $id = $_POST['id'];
    $komentar = $_POST['komentar'];

    $query = "UPDATE data SET komentar = ? WHERE Nomor = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("si", $komentar, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Komentar berhasil disimpan.'); window.location='data.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan komentar.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Data tidak lengkap.'); window.history.back();</script>";
}
?>
