<?php
include "koneksi.php";
session_start();

$No = $_GET['No']; // Ambil ID dari URL
$query = mysqli_query($connect, "SELECT * FROM kabid WHERE No ='$No'") or die(mysqli_error($connect));
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
      <form action="editkabidaction.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="No" value="<?= $row['No']; ?>">
        <div style="padding-left: 2rem; padding-right: 2rem">
          <div class="input-group mb-3">
            <span class="input-group-text">Nama</span>
            <input type="text" name="Namak" class="form-control" value="<?= $row['Namak']; ?>" required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">NIP</span>
            <input type="number" name="NIPk" class="form-control" value="<?= $row['NIPk']; ?>" required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Status</span>
            <input type="text" name="Statusk" class="form-control" value="<?= $row['Statusk']; ?>" readonly required />
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
