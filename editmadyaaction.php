<?php
require 'vendor/autoload.php'; // AWS SDK for MinIO
include 'koneksi.php';
include 'minio.php';
session_start();

$Nomor    = $_POST['Nomor'];
$Nama     = $_POST['Nama'];
$NIP      = $_POST['NIP'];
$Jabatan  = $_POST['Jabatan'];
$Bidang   = $_POST['Bidang'];
$Kabid    = $_POST['Kabid'];
$Link     = $_POST['Link'];
$Periode  = $_POST['Periode'];
$status   = $_POST['status'];
$statuss   = $_POST['statuss'];
$tanggal  = $_POST['tanggal'];
$komentar = $_POST['komentar'] ?? '';
$user     = $_SESSION['username'];

// Ambil data lama
$cek = mysqli_query($connect, "SELECT * FROM data WHERE Nomor='$Nomor'");
$data_lama = mysqli_fetch_assoc($cek);
$data_lama_json = json_encode($data_lama);

// Cek apakah file baru diupload
$SKP_url = null;

if (isset($_FILES['SKP']) && $_FILES['SKP']['error'] == 0) {
    $file_tmp  = $_FILES['SKP']['tmp_name'];
    $key       = '' . time() . '_' . basename($_FILES['SKP']['name']);
    $bucket   = 'uploads';
    $s3 = getMinioClient(); // pastikan fungsi ini mengembalikan objek S3Client
    try {
        $result = $s3->putObject([
            'Bucket' => $bucket,
            'Key'    => $key,
            'SourceFile' => $file_tmp,
            'ACL'    => 'public-read',
            'ContentType' => 'application/pdf'
        ]);

        $SKP_url = $s3->getObjectUrl($bucket, $key); // ✅ PAKAI INI, BUKAN $result['ObjectURL']
    } catch (Aws\Exception\AwsException $e) {
        echo "Gagal upload SKP ke MinIO: " . $e->getMessage();
        exit();
    }
}


// Susun data baru untuk log
$data_baru = [
  'Nama' => $Nama,
  'NIP' => $NIP,
  'Jabatan' => $Jabatan,
  'Bidang' => $Bidang,
  'Kabid' => $Kabid,
  'SKP' => $SKP_url ?? $data_lama['SKP'],
  'Link' => $Link,
  'Periode' => $Periode,
  'status' => $status,
  'statuss' => $statuss,
  'komentar' => $komentar,
  'tanggal' => $tanggal
];
$data_baru_json = json_encode($data_baru);

// Update data ke tabel utama
$query = "UPDATE data SET 
  Nama='$Nama',
  NIP='$NIP',
  Jabatan='$Jabatan',
  Bidang='$Bidang',
  Kabid='$Kabid',";
  
if ($SKP_url) {
  $query .= "SKP='$SKP_url',";
}

$query .= "
  Link='$Link',
  Periode='$Periode',
  status='$status',
  statuss='$statuss',
  komentar='$komentar',
  tanggal='$tanggal'
  WHERE Nomor='$Nomor'";

$update = mysqli_query($connect, $query);

// Simpan ke history jika update berhasil
if ($update) {
    mysqli_query($connect, "INSERT INTO history_data 
      (data_id, user_input, aksi, data_lama, data_baru)
      VALUES ('$Nomor', '$user', 'update', '$data_lama_json', '$data_baru_json')");

    echo "<script>alert('Data berhasil diupdate'); window.location='madya.php';</script>";
} else {
    echo "Update gagal: " . mysqli_error($connect);
}
?>
