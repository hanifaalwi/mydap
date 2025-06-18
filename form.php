<?php
session_start();

// Cek apakah user sudah login dan memiliki status 'user'
if (!isset($_SESSION['username']) || $_SESSION['status'] !== 'madya') {
    header('Location: login.php'); // Redirect ke halaman login jika belum login atau bukan user
    exit();
}

// echo "<h1>Welcome User, " . $_SESSION['username'] . "!</h1>";
// echo "<p>Ini adalah halaman khusus user.</p>";
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
              <a class="nav-link active" aria-current="page" href="#">Form</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="data.php">Data</a>
            </li> -->
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
      <h1 class="display-4">Formulir Pertimbangan</h1>
      <p class="lead">Penilaian Kinerja JF Ahli Madya</p>
      <form action="input.php" method="POST" enctype="multipart/form-data">
        <div style="padding-left: 2rem; padding-right: 2rem">
          <div class="input-group mb-3">
            <span class="input-group-text" id="Nama">Nama</span>
            <input type="text" placeholder="Nama" name="Nama" class="form-control" required />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="NIP">NIP</span>
            <input type="number" placeholder="NIP" name="NIP" class="form-control" required />
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
            <span class="input-group-text" id="status">Status</span>
            <input type="text" name="status" class="form-control" value="pending" required readonly />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="tanggal">Tanggal</span>
            <input type="datetime-local" name="tanggal" class="form-control"  value="<?php echo date('Y-m-d\TH:i'); ?>" required readonly />
          </div>
        </div>
        <div class="col-12">
          <button type="SUBMIT" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-primary">Reset</button>
        </div>
      </form>
    </section>
    <!-- Jumbotron End -->

    <!-- Tabel -->
    <section class="jumbotron text-center">
      <!-- <h1 class="display-4">Data Pengajuan</h1> -->
      <p class="lead">Data Pengajuan</p>

    <div style="padding-left: 2rem; padding-right: 2rem">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="vertical-align : middle;text-align:center;">No</th>
                <th style="vertical-align : middle;text-align:center;">Nama</th>
                <th style="vertical-align : middle;text-align:center;">NIP</th>
                <th style="vertical-align : middle;text-align:center;">Jabatan</th>
                <th style="vertical-align : middle;text-align:center;">Bidang</th>
                <th style="vertical-align : middle;text-align:center;">Kepala Bidang</th>
                <th style="vertical-align : middle;text-align:center;">SKP</th>
                <th style="vertical-align : middle;text-align:center;">Link</th>
                <th style="vertical-align : middle;text-align:center;">Tools</th>
                <th style="vertical-align : middle;text-align:center;">Waktu</th>
              </tr>
            </thead>
            <tbody>

            <?php 
            include "koneksi.php";
            $username = $_SESSION['username']; // Contoh: '196707241999031006'

            // Query data milik user login saja
            $query_mysqli = mysqli_query($connect, "SELECT * FROM data WHERE NIP = '$username'") or die(mysqli_error($connect));
            // $query_mysqli = mysqli_query($connect,"SELECT * FROM data")or die(mysqli_error());

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

                  <td><a type="button" class="nav-item btn btn-success tombol" href="skp.php?Nomor={$pecah['Nomor']}" target="_blank">SKP</a></td>

                  <td><a type="button" class="nav-item btn btn-success tombol" href="<?php echo $pecah['Link']; ?>" target="_blank">Link</a></td>

                  <td>
                    <?php $status = $pecah['status']; ?>
                    <?php if (strtolower($status) == 'disetujui'): ?>
                      <a type="button" class="nav-item btn btn-warning tombol" href="surat.php?Nomor=<?php echo $pecah['Nomor']; ?>" target="_blank"><i class="fa fa-print mr-3"></i></a>
                    <?php elseif (strtolower($status) == 'revisi'): ?>
                      <a type="button" class="nav-item btn btn-warning tombol" onclick="tampilkanKomentar(<?php echo $pecah['Nomor']; ?>)"><i class="fa fa-comment mr-3"></i></a>
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
                    <?php else: ?>
                      <a type="button" class="nav-item btn btn-warning tombol" href="#"><i class="fa fa-spinner mr-3"></i></a>
                    <?php endif; ?>
                  </td>

                  <td><?php echo $pecah['tanggal']; ?></td>
                </tr>
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
    <!-- Table End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
