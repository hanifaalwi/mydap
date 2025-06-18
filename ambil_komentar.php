<?php
header('Content-Type: application/json'); // Penting agar fetch bisa parsing JSON

include 'koneksi.php';

if ($connect->connect_error) {
  die(json_encode(["error" => "Koneksi gagal: " . $connect->connect_error]));
}

// Cek apakah parameter Nomor dikirim
if (!isset($_GET['Nomor'])) {
  echo json_encode(["error" => "Parameter Nomor tidak ditemukan"]);
  exit();
}

$Nomor = $_GET['Nomor'];

// Gunakan prepared statement untuk keamanan (hindari SQL injection)
$stmt = $connect->prepare("SELECT komentar FROM data WHERE Nomor = ?");
$stmt->bind_param("i", $Nomor);
$stmt->execute();

$result = $stmt->get_result();
$komentar = [];

while ($pecah = $result->fetch_assoc()) {
  $komentar[] = $pecah['komentar'] . " - Mohon untuk mengisi ulang formulir.";
}

echo json_encode($komentar);
?>
