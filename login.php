<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Login page for DAP project" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />
    <!-- CSS End -->
    <link rel="icon" href="dap.png" />
    <title>FSKP DAP</title>
  </head>
  <body style="background-color: whitesmoke">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: black">
      <div class="container">
        <a class="navbar-brand" href="index.html"><img src="dap.png" alt="" width="30" height="30" class="d-inline-block align-text-top" /> Dinas Kearsipan dan Perpustakaan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->
    <!-- Jumbotron -->
    <section class="jumbotron text-center">
    <div class="card-custom mx-auto" style="max-width: 400px;">

      <form action="cek-login.php" method="POST" class="row g-3" style="padding: 2rem; margin: auto" >
        <div class="mb-3">
          <input type="number" class="form-control" id="username" name="username" placeholder="Username" required/>
        </div><br>
        <div class="mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required/>
        </div><br>
        <div class="mb-3">
          <select class="form-select" name="status" id="status" required>
            <option value="" selected disabled>Pilih Status</option>
            <option value="madya">Jabatan Fungsional Madya</option>
            <option value="kabid">Kepala Bidang</option>
            <option value="kadis">Kepala Dinas</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-dark">Log in</button>
        </div>
      </form>
    </div>
    </section>
    <!-- Jumbotron End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
