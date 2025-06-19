<?php
include "koneksi.php";

if (!isset($_GET['Nomor'])) {
    die("Parameter tidak valid.");
}

$Nomor = $_GET['Nomor'];
$query = mysqli_query($connect, "SELECT SKP FROM data WHERE Nomor = '$Nomor'");
$data  = mysqli_fetch_assoc($query);

if (!$data || empty($data['SKP'])) {
    die("❌ File tidak ditemukan dalam database.");
}

$namaFile = trim($data['SKP']);
// Jika nama file sudah ada 'uploads/' di dalamnya, jangan tambah lagi
if (strpos($namaFile, 'uploads/') === 0) {
    $pathFile = $namaFile;
} else {
    $pathFile = 'uploads/' . $namaFile;
}

if (!file_exists($pathFile)) {
    die("❌ File fisik tidak ditemukan: $pathFile");
}

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . basename($pathFile) . '"');
readfile($pathFile);
exit();
?>
