<?php 

include 'koneksi.php';
$id = $_GET['id'];

mysqli_query($connect,"DELETE FROM users WHERE id='$id'")
or die(mysqli_error($connect));
 
header("location:users.php?pesan=hapus");
?>