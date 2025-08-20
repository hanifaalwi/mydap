<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cari user berdasarkan username dan password langsung
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ss", $username, $password); // dua string: username dan password
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        $_SESSION['username'] = $data['username'];
        $_SESSION['status'] = $data['status'];

        // Redirect sesuai status
        if ($data['status'] == 'kadis') {
            header('Location: rekap.php');
        } if ($data['status'] == 'madya') {
            header('Location: madya.php');
        } if (in_array($data['status'], ['arsip', 'bina', 'deposit', 'layanan'])) {
            header('Location: data.php');
        } if ($data['status'] == 'admin') {
            header('Location: admin.php');
        }
        exit();
    } else {
        echo "<script>alert('Username atau password salah'); window.location='login.php';</script>";
    }

    $stmt->close();
}
?>
