<?php
session_start();
session_unset(); // Menghapus semua session variable
session_destroy(); // Menghancurkan session
header('Location: index.html'); // Redirect ke halaman login
exit();
?>
