<?php
// include "koneksi.php";

// if (!isset($_GET['Nomor'])) {
//     die("Parameter tidak valid.");
// }

// $Nomor = $_GET['Nomor'];
// $query = mysqli_query($connect, "SELECT SKP FROM data WHERE Nomor = '$Nomor'");
// $data  = mysqli_fetch_assoc($query);

// if (!$data || empty($data['SKP'])) {
//     die("❌ File tidak ditemukan dalam database.");
// }

// $namaFile = trim($data['SKP']);
// // Jika nama file sudah ada 'uploads/' di dalamnya, jangan tambah lagi
// if (strpos($namaFile, 'uploads/') === 0) {
//     $pathFile = $namaFile;
// } else {
//     $pathFile = 'uploads/' . $namaFile;
// }

// if (!file_exists($pathFile)) {
//     die("❌ File fisik tidak ditemukan: $pathFile");
// }

// header('Content-Type: application/pdf');
// header('Content-Disposition: inline; filename="' . basename($pathFile) . '"');
// readfile($pathFile);
// exit();
?>

<?php
require 'vendor/autoload.php';
include 'koneksi.php';

// Pastikan Nomor ada
if (!isset($_GET['Nomor'])) {
    die("❌ Parameter 'Nomor' tidak ditemukan.");
}

$nomor = $_GET['Nomor'];

// Ambil nama file dari database
$query = mysqli_query($connect, "SELECT SKP FROM data WHERE Nomor = '$nomor'");
$data  = mysqli_fetch_assoc($query);

if (!$data || empty($data['SKP'])) {
    die("❌ File tidak ditemukan di database.");
}

$namaFile = $data['SKP']; // Nama file yang tersimpan di MinIO
$bucket   = 'uploads';

// Konfigurasi MinIO client
use Aws\S3\S3Client;

$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1',
    'endpoint' => 'http://127.0.0.1:9000',
    'use_path_style_endpoint' => true,
    'credentials' => [
        'key'    => 'minioadmin',
        'secret' => 'minioadmin',
    ],
]);

try {
    // Ambil file dari MinIO
    $result = $s3->getObject([
        'Bucket' => $bucket,
        'Key'    => $namaFile,
    ]);

    // Tampilkan langsung di browser (preview PDF)
    header("Content-Type: application/pdf");
    header('Content-Disposition: inline; filename="' . basename($namaFile) . '"');
    echo $result['Body'];
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "❌ Gagal menampilkan file dari MinIO: " . $e->getMessage();
}
?>

