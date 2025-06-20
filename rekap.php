<?php
session_start();

// Cek apakah user sudah login dan memiliki status 'admin'
if (!isset($_SESSION['username']) || $_SESSION['status'] !== 'admin' && $_SESSION['status'] !== 'kadis') {
    header('Location: login.php'); // Redirect ke halaman login jika belum login atau bukan admin
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

    <title>Project</title>
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
              <a class="nav-link active" aria-current="page" href="#">Rekap</a>
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
      <h1 class="display-4">Rekap Data</h1>
      <p class="lead">Pertimbangan Penilaian Kinerja JF Ahli Madya</p>
 
    <div style="padding-left: 2rem; padding-right: 2rem">
            <?php 
            include "koneksi.php";
            $query_mysqli = mysqli_query($connect,"SELECT * FROM data ORDER BY Kabid")or die(mysqli_error());

            $kelompok_kabid = [];
            while ($row = mysqli_fetch_assoc($query_mysqli)) {
                $kelompok_kabid[$row['Kabid']][] = $row;
            }
                        
            foreach ($kelompok_kabid as $kabid => $list_pegawai) {
              echo "<h4 class='mt-5 mb-3 text-start'><b>$kabid</b></h4>";
              echo "<div class='table-responsive'>";
              echo "<table class='table table-hover table-striped'>";
              echo "<thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Bidang</th>
                        <th>SKP</th>
                        <th>Link</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>";
            $Nomor = 1;
            foreach ($list_pegawai as $pegawai) {
              echo "<tr style='vertical-align : middle;text-align:center;'>";
              echo "<td>{$Nomor}</td>";
              echo "<td>{$pegawai['Nama']}</td>";
              echo "<td>{$pegawai['NIP']}</td>";
              echo "<td>{$pegawai['Jabatan']}</td>";
              echo "<td>{$pegawai['Bidang']}</td>";
              echo "<td><a class='btn btn-success' href='skp.php?Nomor={$pegawai['Nomor']}' target='_blank'>SKP</a></td>";
              echo "<td><a class='btn btn-success' href='{$pegawai['Link']}' target='_blank'>Link</a></td>";
               
               $status = strtolower($pegawai['status']);
                if ($status === 'disetujui') {
                    echo "<td><a class='btn btn-success' href='surat.php?Nomor={$pegawai['Nomor']}' target='_blank'><i class='fa fa-print'></i></a></td>";
                } elseif ($status === 'revisi') {
                    echo "<td><a class='btn btn-danger' href='#'><i class='fa fa-ban'></i></a></td>";
                } else {
                    echo "<td><a class='btn btn-warning' href='#'><i class='fa fa-spinner'></i></a></td>";
                }

                echo "</tr>";
                $Nomor++;
            } 
            echo "</tbody></table></div>";
          }
          ?>
    </div>
    </div>
    </section>
    <!-- Jumbotron End -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
