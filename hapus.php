<?php 

include 'koneksi.php';
$Nomor = $_GET['Nomor'];

mysqli_query($connect,"DELETE FROM data WHERE Nomor='$Nomor'")
or die(mysqli_error($connect));
 
header("location:data.php?pesan=hapus");
?>