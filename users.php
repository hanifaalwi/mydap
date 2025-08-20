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
          <li class="nav-item"><a class="nav-link" href="admin.php">Rekap Data</a></li>
          <li class="nav-item"><a class="nav-link active" href="#">Data User</a></li>
          <li class="nav-item"><a class="nav-link" href="tambahuser.php">Tambah User</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->

  <section class="jumbotron text-center">
    <div class="card-custom mx-auto" style="max-width: 1500px;">

      <h1 class="display-4">Data User</h1><br>

      <div style="padding: 0 2rem;">
        <table class="table table-hover table-striped">
          <thead>
            <tr class="text-center">
              <th>No</th>
              <th>NIP</th>
              <th>Password</th>
              <th>Status</th>
              <th>Tools</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "koneksi.php";
            $query_mysqli = mysqli_query($connect,"SELECT * FROM users") or die(mysqli_error($connect));

            $id = 1;
            while($pecah = mysqli_fetch_array($query_mysqli)) {
            ?>
              <tr class="text-center">
                <th scope="row"><?php echo $id++; ?></th>
                <td><?php echo $pecah['username']; ?></td>
                <td><?php echo $pecah['password']; ?></td>
                <td><?php echo $pecah['status']; ?></td>
                <td>
                  <a class="btn btn-secondary" href="edituser.php?id=<?php echo $pecah['id']; ?>"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-dark" href="hapususer.php?id=<?php echo $pecah['id']; ?>"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <section class="jumbotron2 text-center">
    <div class="card-custom mx-auto" style="max-width: 1500px;">
      <h1 class="display-4">Data Kepala Bidang</h1><br>
      <div style="padding: 0 2rem;">
        <table class="table table-hover table-striped">
          <thead>
            <tr class="text-center">
              <th>No</th>
              <th>Nama</th>
              <th>NIP</th>
              <th>Status</th>
              <th>Tools</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "koneksi.php";
            $query_mysqli = mysqli_query($connect,"SELECT * FROM kabid") or die(mysqli_error($connect));

            $No = 1;
            while($pecah = mysqli_fetch_array($query_mysqli)) {
            ?>
              <tr class="text-center">
                <th scope="row"><?php echo $No++; ?></th>
                <td><?php echo $pecah['Namak']; ?></td>
                <td><?php echo $pecah['NIPk']; ?></td>
                <td><?php echo $pecah['Statusk']; ?></td>
                <td>
                  <a class="btn btn-secondary" href="editkabid.php?No=<?php echo $pecah['No']; ?>"><i class="fa fa-edit"></i></a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <br>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
