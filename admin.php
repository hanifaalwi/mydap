<?php
session_start();

if (!isset($_SESSION['username']) || ($_SESSION['status'] !== 'admin')) {
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
          <li class="nav-item"><a class="nav-link active" href="#">Rekap Data</a></li>
          <li class="nav-item"><a class="nav-link" href="users.php">Kelola User</a></li>
          <li class="nav-item"><a class="nav-link" href="tambahuser.php">Tambah User</a></li>
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
      <div class="mb-4">
        <a class="btn <?php echo isAktif('awal'); ?> me-2" href="?periode=awal">Awal</a>
        <a class="btn <?php echo isAktif('tw1'); ?> me-2" href="?periode=tw1">TW1</a>
        <a class="btn <?php echo isAktif('tw2'); ?> me-2" href="?periode=tw2">TW2</a>
        <a class="btn <?php echo isAktif('tw3'); ?> me-2" href="?periode=tw3">TW3</a>
        <a class="btn <?php echo isAktif('tahunan'); ?> me-2" href="?periode=tahunan">Tahunan</a>
        <a class="btn <?php echo ($periodeAktif == '') ? 'btn-warning' : 'btn-info'; ?> me-2" href="rekap.php">Semua</a>
      </div>

      <h1 class="display-4">Rekap Data</h1>
      <p class="lead">Pertimbangan Penilaian Kinerja JF Ahli Madya</p>

      <div style="padding: 0 2rem;">
        <?php
        include "koneksi.php";
        $periodeFilter = $_GET['periode'] ?? '';

        if ($periodeFilter != '') {
            $query_mysqli = mysqli_query($connect,"SELECT * FROM data WHERE LOWER(Periode) = '$periodeFilter' ORDER BY Bidang") or die(mysqli_error($connect));
        } else {
            $query_mysqli = mysqli_query($connect,"SELECT * FROM data ORDER BY Bidang") or die(mysqli_error($connect));
        }

        $kelompok_kabid = [];
        while ($row = mysqli_fetch_assoc($query_mysqli)) {
            $kelompok_kabid[$row['Bidang']][] = $row;
        }

        foreach ($kelompok_kabid as $kabid => $list_pegawai) {
          echo "<h4 class='mt-5 mb-3 text-start'><b>$kabid</b></h4>";
          echo "<div class='table-responsive'>";
          echo "<table class='table table-hover table-striped'>";
          echo "<thead>
                  <tr class='text-center'>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>SKP</th>
                    <th>Link</th>
                    <th>Periode</th>
                    <th>Status Kabid</th>
                    <th>Status Kadis</th>
                    <th>Tools</th>
                  </tr>
                </thead>
                <tbody>";
          $Nomor = 1;
          foreach ($list_pegawai as $pegawai) {
            echo "<tr class='text-center'>";
            echo "<td>{$Nomor}</td>";
            echo "<td>{$pegawai['Nama']}</td>";
            echo "<td>{$pegawai['NIP']}</td>";
            echo "<td>{$pegawai['Jabatan']}</td>";
            echo "<td><a class='btn btn-success' href='{$pegawai['SKP']}' target='_blank'>SKP</a></td>";

            $Periode = strtolower($pegawai['Periode']);
            if ($Periode === 'awal') {
                echo "<td><a class='btn btn-warning' href='#'><i class='fa fa-chain-broken'></i></a></td>";
            } else {
                echo "<td><a class='btn btn-success' href='{$pegawai['Link']}' target='_blank'>Link</a></td>";
            }

            echo "<td>{$pegawai['Periode']}</td>";

            $status = strtolower($pegawai['status']);
            if ($status === 'disetujui') {
                echo "<td><a class='btn btn-success' href='surat.php?Nomor={$pegawai['Nomor']}' target='_blank'><i class='fa fa-print'></i></a></td>";
            } elseif ($status === 'revisi') {
                echo "<td><a class='btn btn-danger' href='#'><i class='fa fa-ban'></i></a></td>";
            } else {
                echo "<td><a class='btn btn-warning' href='#'><i class='fa fa-spinner'></i></a></td>";
            }

            $statuss = strtolower($pegawai['statuss']);
            if ($statuss === 'disetujui') {
                echo "<td><a class='btn btn-success' href='surat.php?Nomor={$pegawai['Nomor']}' target='_blank'><i class='fa fa-print'></i></a></td>";
            } elseif ($statuss === 'revisi') {
                echo "<td><a class='btn btn-danger' href='#'><i class='fa fa-ban'></i></a></td>";
            } else {
                echo "<td><a class='btn btn-warning' href='#'><i class='fa fa-spinner'></i></a></td>";
            } 
            
            echo "<td><a class='btn btn-danger' href='hapus.php?Nomor={$pegawai['Nomor']}' target='_blank'><i class='fa fa-trash-o'></i></a></td>";

            echo "</tr>";
            $Nomor++;
          }
          echo "</tbody></table></div>";
        }
        ?>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
