<?php
session_start();

// Cek apakah user sudah login dan memiliki status 'madya'
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css" />

    <style>
      .jumbotron2 {
        background-color: whitesmoke;
        padding: 0 2rem;
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="form.php">Formulir</a></li>
            <li class="nav-item"><a class="nav-link active" href="#">Data</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->

    <section class="jumbotron text-center">
      <div class="card-custom mx-auto" style="max-width: 1500px;">

        <!-- Tombol Filter -->
        <?php
        $periodeAktif = $_GET['periode'] ?? '';
        function isAktif($val) {
          global $periodeAktif;
          return ($periodeAktif == $val) ? 'btn-warning' : 'btn-info';
        }
        ?>
        <div class="mb-3">
          <a class="btn btn-primary me-2" href="form.php">Tambah</a>
          <a class="btn <?php echo isAktif('awal'); ?> me-2" href="?periode=awal">Awal</a>
          <a class="btn <?php echo isAktif('tw1'); ?> me-2" href="?periode=tw1">TW1</a>
          <a class="btn <?php echo isAktif('tw2'); ?> me-2" href="?periode=tw2">TW2</a>
          <a class="btn <?php echo isAktif('tw3'); ?> me-2" href="?periode=tw3">TW3</a>
          <a class="btn <?php echo isAktif('tahunan'); ?> me-2" href="?periode=tahunan">Tahunan</a>
          <a class="btn <?php echo ($periodeAktif == '') ? 'btn-warning' : 'btn-info'; ?> me-2" href="madya.php">Semua</a>
        </div>

        <h1 class="display-4">Data Kinerja</h1><br>

        <div style="padding: 0 2rem;">
          <table class="table table-hover table-striped">
            <thead>
              <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Bidang</th>
                <th>Kepala Bidang</th>
                <th>SKP</th>
                <th>Link</th>
                <th>Periode</th>
                <th>Status Kabid</th>
                <th>Status Kadis</th>
                <th>Waktu</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "koneksi.php";
              $username = $_SESSION['username'];
              $periodeFilter = $_GET['periode'] ?? '';

              if ($periodeFilter != '') {
                  $query_mysqli = mysqli_query($connect, "SELECT * FROM data WHERE NIP = '$username' AND LOWER(Periode) = '$periodeFilter'") or die(mysqli_error($connect));
              } else {
                  $query_mysqli = mysqli_query($connect, "SELECT * FROM data WHERE NIP = '$username'") or die(mysqli_error($connect));
              }

              $Nomor = 1;
              while($pecah = mysqli_fetch_array($query_mysqli)) {
              ?>
              <tr class="text-center">
                <th scope="row"><?php echo $Nomor++; ?></th>
                <td><?php echo $pecah['Nama']; ?></td>
                <td><?php echo $pecah['NIP']; ?></td>
                <td><?php echo $pecah['Jabatan']; ?></td>
                <td><?php echo $pecah['Bidang']; ?></td>
                <td><?php echo $pecah['Kabid']; ?></td>
                <td><a class="btn btn-success" href="skp.php?Nomor=<?= $pecah['Nomor'] ?>" target="_blank">SKP</a></td>
                <td>
                  <?php if (strtolower($pecah['Periode']) !== 'awal'): ?>
                    <a class="btn btn-success" href="<?php echo $pecah['Link']; ?>" target="_blank">Link</a>
                  <?php else: ?>
                    <a class="btn btn-warning" href="#"><i class="fa fa-chain-broken"></i></a>
                  <?php endif; ?>
                </td>
                <td><?php echo $pecah['Periode']; ?></td>
                <td>
                  <?php $status = strtolower($pecah['status']); ?>
                  <?php if ($status == 'disetujui'): ?>
                    <a class="btn btn-success" href="surat.php?Nomor=<?php echo $pecah['Nomor']; ?>" target="_blank"><i class="fa fa-print"></i></a>
                  <?php elseif ($status == 'revisi'): ?>
                    <a class="btn btn-danger" onclick="tampilkanKomentar(<?php echo $pecah['Nomor']; ?>)"><i class="fa fa-ban"></i></a>
                    <a class="btn btn-danger" href="editmadya.php?Nomor=<?php echo $pecah['Nomor']; ?>"><i class="fa fa-edit"></i></a>
                  <?php else: ?>
                    <a class="btn btn-warning" href="#"><i class="fa fa-spinner"></i></a>
                  <?php endif; ?>
                </td>
                <td>
                  <?php $statuss = strtolower($pecah['statuss']); ?>
                  <?php if ($statuss == 'disetujui'): ?>
                    <a class="btn btn-success" href="surat.php?Nomor=<?php echo $pecah['Nomor']; ?>" target="_blank"><i class="fa fa-print"></i></a>
                  <?php elseif ($statuss == 'revisi'): ?>
                    <a class="btn btn-danger" onclick="tampilkanKomentar(<?php echo $pecah['Nomor']; ?>)"><i class="fa fa-ban"></i></a>
                    <a class="btn btn-danger" href="editmadya.php?Nomor=<?php echo $pecah['Nomor']; ?>"><i class="fa fa-edit"></i></a>
                  <?php else: ?>
                    <a class="btn btn-warning" href="#"><i class="fa fa-spinner"></i></a>
                  <?php endif; ?>
                </td>
                <td><?php echo $pecah['tanggal']; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <section class="jumbotron2 text-center">
      <div class="card-custom mx-auto" style="max-width: 1500px;">
        <h3>Riwayat Edit</h3>
        <div style="padding: 0 2rem;">
          <table  class="table table-hover table-striped">
            <thead>
              <tr class="text-center">
                <th>No</th>
                <th>Waktu</th>
                <th style="table-layout: fixed; word-wrap: break-word; max-width: 1000px;">Data Lama</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "koneksi.php";
              $user_input = $_SESSION['username'];
              $query_mysqli = mysqli_query($connect, "SELECT * FROM history_data WHERE user_input = '$user_input'") or die(mysqli_error($connect));

              $id = 1;
              while($pecah = mysqli_fetch_array($query_mysqli)) {
              ?>
              <tr class="text-center">
                <th scope="row"><?php echo $id++; ?></th>
                <td><?php echo $pecah['waktu']; ?></td>
                <td style="table-layout: fixed; word-wrap: break-word; max-width: 1000px;"><?php echo $pecah['data_lama']; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    
    <!-- JS -->
    <script>
      function tampilkanKomentar(Nomor) {
        fetch("ambil_komentar.php?Nomor=" + Nomor)
          .then(response => response.json())
          .then(data => {
            if (data.length === 0 || data.error) {
              alert(data.error || "Belum ada komentar.");
            } else {
              alert(data.join('\n\n'));
            }
          })
          .catch(error => {
            alert("Gagal mengambil komentar: " + error);
          });
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
