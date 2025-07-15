<?php
include "koneksi.php";
session_start();

$id = $_GET['id']; // Ambil ID dari URL
$query = mysqli_query($connect, "SELECT * FROM users WHERE id ='$id'") or die(mysqli_error($connect));
$row = mysqli_fetch_assoc($query);

// Proteksi akses
if (!isset($_SESSION['username']) || $_SESSION['status'] !== 'admin') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />

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
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Edit</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">Back</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->

  <section class="jumbotron text-center">
    <div class="card-custom mx-auto" style="max-width: 1500px;">
      <h1 class="display-4">Edit User</h1><br>
      <form action="edituseraction.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <div style="padding-left: 2rem; padding-right: 2rem">
          <div class="input-group mb-3">
            <span class="input-group-text">Username</span>
            <input type="number" name="username" class="form-control" value="<?= $row['username']; ?>" readonly required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Password</span>
            <input type="text" name="password" class="form-control" value="<?= $row['password']; ?>" required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Status</span>
            <select class="form-select" name="status" required>
              <option <?= $row['status'] == 'kadis' ? 'selected' : '' ?>>Kepala Dinas</option>
              <option <?= $row['status'] == 'kabid' ? 'selected' : '' ?>>Kepala Bidang</option>
              <option <?= $row['status'] == 'madya' ? 'selected' : '' ?>>Fungsional Ahli Madya</option>
              <option <?= $row['status'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
          </div>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-dark me-3">Update</button>
          <a href="users.php" class="btn btn-dark">Back</a>
        </div>
      </form>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
