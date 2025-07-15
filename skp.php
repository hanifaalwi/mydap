<?php
require 'vendor/autoload.php';
include 'koneksi.php';
include 'minio.php';

if (!isset($_GET['Nomor'])) {
    die("❌ Parameter 'Nomor' tidak ditemukan.");
}

$nomor = $_GET['Nomor'];

$query = mysqli_query($connect, "SELECT SKP FROM data WHERE Nomor = '$nomor'");
$data  = mysqli_fetch_assoc($query);

if (!$data || empty($data['SKP'])) {
    die("❌ File tidak ditemukan di database.");
}

$fullUrl = $data['SKP'];
$parsed = parse_url($fullUrl);
$key = urldecode(ltrim($parsed['path'], '/'));

if (str_starts_with($key, 'uploads/')) {
    $key = substr($key, strlen('uploads/'));
}

$bucket = 'uploads'; // ← ini yang kurang!
$s3 = getMinioClient();

try {
    $result = $s3->getObject([
        'Bucket' => $bucket,
        'Key'    => $key
    ]);

    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=\"" . basename($key) . "\"");
    echo $result['Body'];

} catch (Aws\S3\Exception\S3Exception $e) {
    echo "❌ Gagal menampilkan file dari MinIO: " . $e->getMessage();
}
