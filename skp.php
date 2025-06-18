<?php
include 'koneksi.php';

// if (isset($_GET['Nomor'])) {
//     $Nomor = intval($_GET['Nomor']);
//     $query = "SELECT SKP FROM data WHERE Nomor = $Nomor";
//     $result = $connect->query($query);

//     if ($result && $pecah = $result->fetch_assoc()) {
//         header("Content-Type: application/pdf");
//         header("Content-Disposition: inline");
//         echo $pecah['SKP'];
//         exit;
//     } else {
//         echo "File tidak ditemukan.";
//     }
// } else {
//     echo "Permintaan tidak valid.";
// }


if (!isset($_GET['Nomor'])) {
    die("File tidak tersedia");
}

$Nomor = intval($_GET['Nomor']);

$stmt = $connect->prepare("SELECT SKP FROM data WHERE Nomor = ?");
$stmt->bind_param("i", $Nomor);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($SKP);
if ($stmt->fetch()) {
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline;"); // Nama file default
    echo $SKP;
} else {
    echo "File tidak ditemukan.";
}

$stmt->close();
$connect->close();
?>

