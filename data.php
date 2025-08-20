<?php
include "koneksi.php";
session_start();

// Cek apakah user sudah login dan memiliki status yang diizinkan
$allowed_status = ['arsip', 'bina', 'deposit', 'layanan'];

if (!isset($_SESSION['username']) || !in_array($_SESSION['status'], $allowed_status)) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login atau status tidak sesuai
    exit();
}

// Ambil parameter periode
$periodeFilter = $_GET['periode'] ?? '';
function isAktif($val) {
  global $periodeFilter;
  return ($periodeFilter == $val) ? 'btn-warning' : 'btn-info';
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
    <link rel="icon" href="dap.png" />
    <title>FSKP DAP</title>
  </head>
  <body style="background-color: whitesmoke">
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: black">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="dap.png" alt="" width="30" height="30" class="d-inline-block align-text-top" /> Dinas Kearsipan dan Perpustakaan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" href="#">Data</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="jumbotron text-center">
      <div class="card-custom mx-auto" style="max-width: 1500px;">

        <!-- Tombol Filter Periode -->
        <div class="mb-4">
          <a class="btn <?php echo isAktif('awal'); ?> me-2" href="?periode=awal">Awal</a>
          <a class="btn <?php echo isAktif('tw1'); ?> me-2" href="?periode=tw1">TW1</a>
          <a class="btn <?php echo isAktif('tw2'); ?> me-2" href="?periode=tw2">TW2</a>
          <a class="btn <?php echo isAktif('tw3'); ?> me-2" href="?periode=tw3">TW3</a>
          <a class="btn <?php echo isAktif('tahunan'); ?> me-2" href="?periode=tahunan">Tahunan</a>
          <a class="btn <?php echo ($periodeFilter == '') ? 'btn-warning' : 'btn-info'; ?> me-2" href="data.php">Semua</a>
        </div>

        <h1 class="display-4">Data Pengajuan</h1>
        <p class="lead">Pertimbangan Penilaian Kinerja JF Ahli Madya</p><br>

        <div style="padding-left: 2rem; padding-right: 2rem">
          <table class="table table-hover table-stripped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>SKP</th>
                <th>Link</th>
                <th>Periode</th>
                <th>Tools</th>
                <th>Status</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            $bidang = '';
            if ($_SESSION['status'] == 'arsip') $bidang = 'Kearsipan';
            if ($_SESSION['status'] == 'bina') $bidang = 'Pembinaan dan Pengawasan';
            if ($_SESSION['status'] == 'deposit') $bidang = 'Deposit, Pengembangan, dan Pelestarian Bahan Perpustakaan';
            if ($_SESSION['status'] == 'layanan') $bidang = 'Layanan, Otomasi, dan Kerja sama Perpustakaan';

            $sql = "SELECT * FROM data WHERE Bidang = '$bidang'";
            if ($periodeFilter != '') {
              $sql .= " AND LOWER(Periode) = '$periodeFilter'";
            }
            $query_mysqli = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $Nomor = 1;
            while($pecah = mysqli_fetch_array($query_mysqli)){
            ?>
              <tr>
                <th scope="row"><?php echo $Nomor++; ?></th>
                <td><?php echo $pecah['Nama']; ?></td>
                <td><?php echo $pecah['NIP']; ?></td>
                <td><?php echo $pecah['Jabatan']; ?></td>
                <td><a class="btn btn-success" href="<?php echo $pecah['SKP']; ?>" target="_blank">SKP</a></td>
                <td>
                  <?php if (strtolower($pecah['Periode']) !== 'awal'): ?>
                    <a class="btn btn-success" href="<?php echo $pecah['Link']; ?>" target="_blank">Link</a>
                  <?php else: ?>
                    <a class="btn btn-warning" href="#"><i class="fa fa-chain-broken"></i></a>
                  <?php endif; ?>
                </td>

                <td><?php echo $pecah['Periode']; ?></td>

                <td>
                  <?php $status = $pecah['status']; $isFinalStatus = ($status == 'disetujui' || $status == 'revisi'); ?>
                  <a href="acc.php?id=<?php echo $pecah['Nomor']; ?>&status=disetujui" class="btn btn-primary <?php echo $isFinalStatus ? 'disabled-link' : ''; ?>" onclick="return <?php echo $isFinalStatus ? 'false' : 'confirm(\'Apakah Anda yakin ingin menyetujui data ini?\')'; ?>;"><i class="fa fa-check"></i></a>
                  <a href="revisi.php?id=<?php echo $pecah['Nomor']; ?>&status=revisi" class="btn btn-danger <?php echo $isFinalStatus ? 'disabled-link' : ''; ?>" onclick="return <?php echo $isFinalStatus ? 'false' : 'confirm(\'Apakah Anda yakin ingin menolak data ini?\')'; ?>;"><i class="fa fa-times"></i></a>
                </td>
   
                <td>
                  <?php if (strtolower($status) == 'disetujui'): ?>
                    <a class="btn btn-success" href="surat.php?Nomor=<?php echo $pecah['Nomor']; ?>" target="_blank"><i class="fa fa-print"></i></a>
                  <?php elseif (strtolower($status) == 'revisi'): ?>
                    <a class="btn btn-danger" href="#" onclick="showKomentarForm(<?php echo $pecah['Nomor']; ?>)"><i class="fa fa-ban"></i></a>
                    <form id="form-komentar-<?php echo $pecah['Nomor']; ?>" action="komentar.php" method="POST" style="display: none; margin-top: 10px;">
                      <input type="hidden" name="id" value="<?php echo $pecah['Nomor']; ?>">
                      <div class="form-group">
                        <textarea name="komentar" class="form-control" rows="3" placeholder="Tulis komentar..." required></textarea>
                      </div>
                      <button type="submit" class="btn btn-success">Simpan Komentar</button>
                    </form>
                    <script>
                      function showKomentarForm(id) {
                        const form = document.getElementById('form-komentar-' + id);
                        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
                      }
                    </script>
                  <?php else: ?>
                    <a class="btn btn-warning" href="#"><i class="fa fa-spinner"></i></a>
                  <?php endif; ?>
                </td>
                <td><?php echo $pecah['komentar']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
