<?php
include "koneksi.php";
session_start();

// Proteksi akses hanya untuk admin
if (!isset($_SESSION['username']) || $_SESSION['status'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $status   = $_POST['status'];

    // Cek duplikat username (optional)
    $cek = mysqli_query($connect, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan.";
    } else {
        // Insert ke database
        $query = "INSERT INTO users (username, password, status) VALUES ('$username', '$password', '$status')";
        $result = mysqli_query($connect, $query);

        if ($result) {
            header("Location: users.php?pesan=tambah_sukses");
            exit();
        } else {
            $error = "Gagal menambahkan user: " . mysqli_error($connect);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />
    <!-- CSS End -->

    <style>
      .jumbotron2 {
      background-color: whitesmoke;
      padding-bottom: 2rem;
    }
    </style>

    <link rel="icon" href="dap.png" />
    <title>FSKP DAP</title>
  </head>
  <body style="background-color: whitesmoke">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: black">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="dap.png" alt="" width="30" height="30" class="d-inline-block align-text-top" /> Dinas Kearsipan dan Perpustakaan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="admin.php">Rekap Data</a></li>
            <li class="nav-item"><a class="nav-link" href="users.php">Kelola User</a></li>
            <li class="nav-item"><a class="nav-link  active" href="#">Tambah User</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->
    <!-- Jumbotron -->
    <section class="jumbotron text-center">
    <div class="card-custom mx-auto" style="max-width: 1500px;">
      <h1 class="display-4">Tambah Data User</h1>
      <form action="" method="POST" enctype="multipart/form-data">
        <div style="padding-left: 2rem; padding-right: 2rem">
          <div class="input-group mb-3">
            <span class="input-group-text" id="username">Username</span>
            <input type="number" placeholder="Username" name="username" class="form-control"  required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="password">Password</span>
            <input type="text" placeholder="Password" name="password" class="form-control" required />
          </div>
          <div class="input-group mb-3">
            <span id="status" class="input-group-text">Status</span>
            <select class="form-select" name="status">
              <option value="kadis">Kepala Dinas</option>
              <option value="arsip">Kepala Bidang Kearsipan</option>
              <option value="bina">Kepala Bidang Pembinaan</option>
              <option value="deposit">Kepala Bidang Deposit</option>
              <option value="layanan">Kepala Bidang Layanan</option>
              <option value="madya">Fungsional Ahli Madya</option>
              <option value="admin">Admin</option>
            </select>
          </div>
        </div>
        <div class="col-12">
          <button type="SUBMIT" class="btn btn-dark me-3">Submit</button>
          <button type="reset" class="btn btn-dark">Reset</button>
        </div>
      </form>
    </div>
    </section>
    <!-- Jumbotron End -->
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
