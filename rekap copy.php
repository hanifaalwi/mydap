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
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th rowspan="2" style="vertical-align : middle;text-align:center;">No</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center;">Nama</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center;">NIP</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center;">Jabatan</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center;">Bidang</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center;">Kepala Bidang</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center;">SKP</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center;">Link</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center;">Status</th>
              </tr>
            </thead>
            <tbody>

            <?php 
            include "koneksi.php";
            $query_mysqli = mysqli_query($connect,"SELECT * FROM data")or die(mysqli_error());
                        
            $Nomor = 1;
            while($pecah = mysqli_fetch_array($query_mysqli)){
            ?>
                <tr style="vertical-align : middle;text-align:center;">
                  <th scope="row"><?php echo $Nomor++; ?></th>
                  <td><?php echo $pecah['Nama']; ?></td>
                  <td><?php echo $pecah['NIP']; ?></td>
                  <td><?php echo $pecah['Jabatan']; ?></td>
                  <td><?php echo $pecah['Bidang']; ?></td>
                  <td><?php echo $pecah['Kabid']; ?></td>
                  <td><a type="button" class="nav-item btn btn-success tombol" href="skp.php?Nomor=<?php echo $pecah['Nomor']; ?>" target="_blank">SKP</a></td>
                  <td><a type="button" class="nav-item btn btn-success tombol" href="<?php echo $pecah['Link']; ?>" target="_blank">Link</a></td>
                  <td>
                    <?php $status = $pecah['status']; ?>
                    <?php if (strtolower($status) == 'disetujui'): ?>
                      <a type="button" class="nav-item btn btn-success tombol" href="surat.php?Nomor=<?php echo $pecah['Nomor']; ?>" target="_blank"><i class="fa fa-print mr-3"></i></a>
                    <?php elseif (strtolower($status) == 'revisi'): ?>
                      <a type="button" class="nav-item btn btn-danger tombol" href="#"><i class="fa fa-ban mr-3"></i></a>
                    <?php else: ?>
                      <a type="button" class="nav-item btn btn-warning tombol" href="#"><i class="fa fa-spinner mr-3"></i></a>
                    <?php endif; ?>
                  </td>
                </tr>
                 <?php
                  // $no++;}
                ?>
              </tbody>
              <?php } ?>
          </table>
    </div>
    </div>
    </section>
    <!-- Jumbotron End -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
