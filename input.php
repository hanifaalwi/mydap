<?php
include 'koneksi.php';
$No = $_POST['No'];
$Nama = $_POST['Nama'];
$NIP = $_POST['NIP'];
$Jabatan = $_POST['Jabatan'];
$Bidang = $_POST['Bidang'];
$Kabid = $_POST['Kabid'];
$SKP = $_POST['SKP'];
$Link = $_POST['Link'];
$status = $_POST['status'];
$komentar = $_POST['komentar'];
$tanggal = $_POST['tanggal'];

mysqli_query($connect, "INSERT INTO data VALUES ('','$Nama', '$NIP', '$Jabatan','$Bidang','$Kabid', '$SKP', '$Link', '$status', '','$tanggal')");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf'])) {
    $tmp = $_FILES['pdf']['tmp_name'];
    $fileType = $_FILES["pdf_file"]["type"];

    if ($fileType != "application/pdf") {
        die("File bukan PDF.");
    }
    $data = file_get_contents($tmp);

    // Simpan ke database
    $stmt = $connect->prepare("INSERT INTO data (SKP) VALUES (?)");
    $stmt->bind_param("s", $SKP);
    $stmt->send_long_data(2, $SKP); // kirim data besar

    if ($stmt->execute()) {
        echo "File berhasil diunggah!";
    } else {
        echo "Gagal: " . $stmt->error;
    }
}

header("location:form.php?berhasil=yes");

?>