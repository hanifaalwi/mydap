<?php
session_start();

// Cek apakah user sudah login dan memiliki status 'user'
if (!isset($_SESSION['username']) || $_SESSION['status'] !== 'madya') {
    header('Location: login.php'); // Redirect ke halaman login jika belum login atau bukan user
    exit();
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
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Formulir</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="madya.php">Data</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->
    <!-- Jumbotron -->
    <section class="jumbotron text-center">
    <div class="card-custom mx-auto" style="max-width: 1500px;">
      <h1 class="display-4">Formulir Pengajuan</h1>
      <p class="lead">Penilaian Kinerja JF Ahli Madya</p>
      <form action="input.php" method="POST" enctype="multipart/form-data">
        <div style="padding-left: 2rem; padding-right: 2rem">
          <div class="input-group mb-3">
            <span class="input-group-text" id="Nama">Nama</span>
            <input type="text" placeholder="Nama" name="Nama" class="form-control" required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="NIP">NIP</span>
            <input type="number" name="NIP" class="form-control" value="<?= $_SESSION['username']; ?>" readonly required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="Jabatan">Jabatan</span>
            <input type="text" placeholder="Jabatan" name="Jabatan" class="form-control" required />
          </div>
          <div class="input-group mb-3">
            <span id="Bidang" class="input-group-text">Bidang</span>
            <select class="form-select" name="Bidang">
              <option value="Kearsipan">Kearsipan</option>
              <option value="Pembinaan dan Pengawasan">Pembinaan dan Pengawasan</option>
              <option value="Deposit, Pengembangan, dan Pelestarian Bahan Perpustakaan">Deposit, Pengembangan, dan Pelestarian Bahan Perpustakaan</option>
              <option value="Layanan, Otomasi, dan Kerja sama Perpustakaan">Layanan, Otomasi, dan Kerja sama Perpustakaan</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="Kabid">Kepala Bidang</span>
            <select class="form-select" name="Kabid">
              <option value="Sosy Findra, S.Kom">Sosy Findra, S.Kom</option>
              <option value="Kiswati SS,MPA">Kiswati SS,MPA</option>
              <option value="Dian Dewi Kartika, S.Sos, M.Si">Dian Dewi Kartika, S.Sos, M.Si</option>
              <option value="Fajri Rahmad Ersya, S.STP, M.Si">Fajri Rahmad Ersya, S.STP, M.Si</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="SKP">SKP</span>
            <input type="file" name="SKP" class="form-control" accept="application/pdf" required/>
  
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="Link">Link Bukti Dukung</span>
            <input type="text" placeholder="https://example.com/users/" name="Link" class="form-control" required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="Periode">Periode</span>
            <select class="form-select" name="Periode">
              <option value="Awal">Awal</option>
              <option value="TW1">TW1</option>
              <option value="TW2">TW2</option>
              <option value="TW3">TW3</option>
              <option value="Tahunan">Tahunan</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="status">Status Kabid</span>
            <input type="text" name="status" class="form-control" value="pending" required readonly />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="statuss">Status Kadis</span>
            <input type="text" name="statuss" class="form-control" value="pending" required readonly />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="tanggal">Tanggal</span>
            <input type="datetime-local" name="tanggal" class="form-control"  value="<?php echo date('Y-m-d\TH:i'); ?>" required readonly />
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
