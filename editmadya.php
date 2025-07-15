<?php
include "koneksi.php";
session_start();

$Nomor = $_GET['Nomor']; // Ambil ID dari URL
$query = mysqli_query($connect, "SELECT * FROM data WHERE Nomor ='$Nomor'") or die(mysqli_error($connect));
$row = mysqli_fetch_assoc($query);

// Proteksi akses
if (!isset($_SESSION['username']) || $_SESSION['status'] !== 'madya') {
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
              <a class="nav-link" href="madya.php">Back</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->

  <section class="jumbotron text-center">
    <div class="card-custom mx-auto" style="max-width: 1500px;">
      <h1 class="display-4">Edit Pengajuan</h1><br>
      <form action="editmadyaaction.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="Nomor" value="<?= $row['Nomor']; ?>">
        <div style="padding-left: 2rem; padding-right: 2rem">
          <div class="input-group mb-3">
            <span class="input-group-text">Nama</span>
            <input type="text" name="Nama" class="form-control" value="<?= $row['Nama']; ?>" required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">NIP</span>
            <input type="number" name="NIP" class="form-control" value="<?= $_SESSION['username']; ?>" readonly required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Jabatan</span>
            <input type="text" name="Jabatan" class="form-control" value="<?= $row['Jabatan']; ?>" required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Bidang</span>
            <select class="form-select" name="Bidang" required>
              <option <?= $row['Bidang'] == 'Kearsipan' ? 'selected' : '' ?>>Kearsipan</option>
              <option <?= $row['Bidang'] == 'Pembinaan dan Pengawasan' ? 'selected' : '' ?>>Pembinaan dan Pengawasan</option>
              <option <?= $row['Bidang'] == 'Deposit, Pengembangan, dan Pelestarian Bahan Perpustakaan' ? 'selected' : '' ?>>Deposit, Pengembangan, dan Pelestarian Bahan Perpustakaan</option>
              <option <?= $row['Bidang'] == 'Layanan, Otomasi, dan Kerja sama Perpustakaan' ? 'selected' : '' ?>>Layanan, Otomasi, dan Kerja sama Perpustakaan</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Kepala Bidang</span>
            <select class="form-select" name="Kabid" required>
              <option <?= $row['Kabid'] == 'Sosy Findra, S.Kom' ? 'selected' : '' ?>>Sosy Findra, S.Kom</option>
              <option <?= $row['Kabid'] == 'Kiswati SS,MPA' ? 'selected' : '' ?>>Kiswati SS,MPA</option>
              <option <?= $row['Kabid'] == 'Dian Dewi Kartika, S.Sos, M.Si' ? 'selected' : '' ?>>Dian Dewi Kartika, S.Sos, M.Si</option>
              <option <?= $row['Kabid'] == 'Fajri Rahmad Ersya, S.STP, M.Si' ? 'selected' : '' ?>>Fajri Rahmad Ersya, S.STP, M.Si</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="SKP">SKP</span>
            <input type="file" name="SKP" class="form-control" accept="application/pdf" />
          </div>            
          <div class="input-group mb-3">
            <span class="input-group-text">Link Bukti Dukung</span>
            <input type="text" name="Link" class="form-control" value="<?= $row['Link']; ?>" required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Periode</span>
            <select class="form-select" name="Periode" required>
              <option <?= $row['Periode'] == 'Awal' ? 'selected' : '' ?>>Awal</option>
              <option <?= $row['Periode'] == 'TW1' ? 'selected' : '' ?>>TW1</option>
              <option <?= $row['Periode'] == 'TW2' ? 'selected' : '' ?>>TW2</option>
              <option <?= $row['Periode'] == 'TW3' ? 'selected' : '' ?>>TW3</option>
              <option <?= $row['Periode'] == 'Tahunan' ? 'selected' : '' ?>>Tahunan</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Status Kabid</span>
            <input type="text" name="status" class="form-control" value="pending" readonly required/>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Status Kadis</span>
            <input type="text" name="statuss" class="form-control" value="pending" readonly required/>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Tanggal</span>
            <input type="datetime-local" name="tanggal" class="form-control" value="<?= date('Y-m-d\TH:i'); ?>" readonly required/>
          </div>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-dark me-3">Update</button>
          <a href="madya.php" class="btn btn-dark">Back</a>
        </div>
      </form>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
