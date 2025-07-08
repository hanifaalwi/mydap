<?php
// include 'koneksi.php';
// $Nomor = $_POST['Nomor'];
// $Nama = $_POST['Nama'];
// $NIP = $_POST['NIP'];
// $Jabatan = $_POST['Jabatan'];
// $Bidang = $_POST['Bidang'];
// $Kabid = $_POST['Kabid'];
// $SKP = $_POST['SKP'];
// $Link = $_POST['Link'];
// $status = $_POST['status'];
// $komentar = $_POST['komentar'];
// $tanggal = $_POST['tanggal'];

// mysqli_query($connect, "INSERT INTO data VALUES ('','$Nama', '$NIP', '$Jabatan','$Bidang','$Kabid', '$SKP', '$Link', '$status', '','$tanggal')");

// header("location:form.php?berhasil=yes");
?>
<?php
// include 'koneksi.php';

// $Nama     = $_POST['Nama'];
// $NIP      = $_POST['NIP'];
// $Jabatan  = $_POST['Jabatan'];
// $Bidang   = $_POST['Bidang'];
// $Kabid    = $_POST['Kabid'];
// $Link     = $_POST['Link'];
// $Periode  = $_POST['Periode'];
// $status   = $_POST['status'];
// $tanggal  = $_POST['tanggal'];

// $namaFile = $_FILES['SKP']['name'];
// $tmpFile  = $_FILES['SKP']['tmp_name'];
// $ext      = pathinfo($namaFile, PATHINFO_EXTENSION);

// if (strtolower($ext) != 'pdf') {
//     die("❌ Hanya file PDF yang diizinkan.");
// }

// // Buat nama file unik
// $namaBaru = uniqid() . '_' . $namaFile;
// $target   = 'uploads/' . $namaBaru;

// if (move_uploaded_file($tmpFile, $target)) {
//     mysqli_query($connect, "INSERT INTO data VALUES (
//         '', '$Nama', '$NIP', '$Jabatan', '$Bidang', '$Kabid',
//         '$namaBaru', '$Link', '$Periode', '$status', '', '$tanggal'
//     )");
//     header("Location: madya.php?berhasil=1");
//     exit();
// } else {
//     die("❌ Gagal upload file.");
// }
?>

<?php
require 'vendor/autoload.php';
include 'koneksi.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Ambil data dari form
$Nama     = $_POST['Nama'];
$NIP      = $_POST['NIP'];
$Jabatan  = $_POST['Jabatan'];
$Bidang   = $_POST['Bidang'];
$Kabid    = $_POST['Kabid'];
$Link     = $_POST['Link'];
$Periode  = $_POST['Periode'];
$status   = $_POST['status'];
$tanggal  = $_POST['tanggal'];

$namaFile = $_FILES['SKP']['name'];
$tmpFile  = $_FILES['SKP']['tmp_name'];
$ext      = pathinfo($namaFile, PATHINFO_EXTENSION);

// Validasi file harus PDF
if (strtolower($ext) != 'pdf') {
    die("❌ Hanya file PDF yang diizinkan.");
}

// Buat nama unik untuk file
$namaBaru = uniqid() . '_' . $namaFile;

// Konfigurasi MinIO
$s3 = new S3Client([
    'version'     => 'latest',
    'region'      => 'us-east-1',
    'endpoint'    => 'http://127.0.0.1:9000', // Ganti jika akses dari jaringan lain
    'use_path_style_endpoint' => true,
    'credentials' => [
        'key'    => 'minioadmin',
        'secret' => 'minioadmin',
    ],
]);

try {
    // Upload ke MinIO bucket "uploads"
    $s3->putObject([
        'Bucket'     => 'uploads',
        'Key'        => $namaBaru,
        'SourceFile' => $tmpFile,
        'ACL'        => 'private' // Atau 'public-read' jika ingin bisa diakses langsung via URL
    ]);

    // Simpan info file (namaBaru) ke database
    mysqli_query($connect, "INSERT INTO data VALUES (
        '', '$Nama', '$NIP', '$Jabatan', '$Bidang', '$Kabid',
        '$namaBaru', '$Link', '$Periode', '$status', '', '$tanggal'
    )");

    header("Location: madya.php?berhasil=1");
    exit();

} catch (AwsException $e) {
    die("❌ Gagal upload ke MinIO: " . $e->getMessage());
}
?>

