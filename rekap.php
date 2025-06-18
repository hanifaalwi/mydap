<?php
session_start();

// Cek apakah user sudah login dan memiliki status 'admin'
if (!isset($_SESSION['username']) || $_SESSION['status'] !== 'admin' && $_SESSION['status'] !== 'kadis') {
    header('Location: login.php'); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}
// echo "<h1>Welcome Admin, " . $_SESSION['username'] . "!</h1>";
// echo "<p>Ini adalah halaman khusus admin.</p>";
// ?>


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

    <!-- <style>
      h1,
      h2 {
        text-align: center;
        color: #69bf64;
      }
    </style> -->
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: darkolivegreen">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="dap.png" alt="" width="30" height="30" class="d-inline-block align-text-top" /> DAP</a>
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
      <h1 class="display-4">Rekap Data</h1>
      <p class="lead">Pertimbangan Penilaian Kinerja JF Ahli Madya</p>
 
    <div style="padding-left: 2rem; padding-right: 2rem">
          <table class="table table-striped">
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
                <!-- <th colspan="2" style="vertical-align : middle;text-align:center;">Tools</th> -->
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
                  <td><?php echo $pecah['status']; ?></td>
                  <!-- <td>
                    <a href="acc.php?id=<?php echo $pecah['Nomor']; ?>&status=setujui" type="button" class="nav-item btn btn-success tombol" href="acc.php?Nomor=<?php echo $pecah['Nomor'] ?>"><i class="fa fa-check mr-3"></i></a> 
                  </td> -->
                </tr>
                 <?php
                  // $no++;}
                ?>
              </tbody>
              <?php } ?>
          </table>
    </div>

      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path
          fill="#ffffff"
          fill-opacity="1"
          d="M0,160L24,149.3C48,139,96,117,144,122.7C192,128,240,160,288,149.3C336,139,384,85,432,80C480,75,528,117,576,117.3C624,117,672,75,720,58.7C768,43,816,53,864,48C912,43,960,21,1008,53.3C1056,85,1104,171,1152,181.3C1200,192,1248,128,1296,90.7C1344,53,1392,43,1416,37.3L1440,32L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"
        ></path>
      </svg>
    </section>
    <!-- Jumbotron End -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
