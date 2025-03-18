<?php
// File: edit-pasien.php

require '../luxury/koneksi.php';

session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Ambil data pasien berdasarkan ID
$pasien = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pasien WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $pasien = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$pasien) {
        echo "<p>Data pasien tidak ditemukan.</p>";
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../asset/style.css">
    <link rel="icon" href="../img/logo.jpeg">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Viga&display=swap" rel="stylesheet">

    <title>Dashboard Monitoring Pemberian Obat</title>
  </head>
  <body class="dash-body">


    <nav class="navbar navbar-expand-lg navbar-color bg-navbar">
      <div class="container">
        <a class="navbar-brand" href="dashboard.php">RSUD I.A. Moeis</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-diamond" viewBox="0 0 16 16">
            <path d="M7.987 16a1.53 1.53 0 0 1-1.07-.448L.45 9.082a1.53 1.53 0 0 1 0-2.165L6.917.45a1.53 1.53 0 0 1 2.166 0l6.469 6.468A1.53 1.53 0 0 1 16 8.013a1.53 1.53 0 0 1-.448 1.07l-6.47 6.469A1.53 1.53 0 0 1 7.988 16zM7.639 1.17 4.766 4.044 8 7.278l3.234-3.234L8.361 1.17a.51.51 0 0 0-.722 0M8.722 8l3.234 3.234 2.873-2.873c.2-.2.2-.523 0-.722l-2.873-2.873zM8 8.722l-3.234 3.234 2.873 2.873c.2.2.523.2.722 0l2.873-2.873zM7.278 8 4.044 4.766 1.17 7.639a.51.51 0 0 0 0 .722l2.874 2.873z"/>
          </svg>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pasien
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="data-pasien.php">Data Pasien</a></li>
                <li><a class="dropdown-item" href="monitor-obat.php">Monitor Obat</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Log Out</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li> -->
          </ul>
        </div>
      </div>
    </nav>



    <!-- Add Data Pasien -->
    <section class="add-data">
      <div class="container">
        <div class="row gy-5">
          <div class="col-lg-12">
            <h1>Add Data Pasien</h1>
          </div>
          <?php if ($pasien): ?>
          <form action="edit-pasien-proses.php" method="post">
          <input type="hidden" name="id" value="<?= htmlspecialchars($pasien['id']) ?>">
            <div class="row gy-5">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="nama-pasien" class="form-label">Nama Pasien <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="nama-pasien" placeholder="Nama Pasien" required name="nama" value="<?= htmlspecialchars($pasien['nama']) ?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="no-wa" class="form-label">No WhatsApp <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" id="no-wa" placeholder="WA Pasien/Perawat" required name="no_wa" value="<?= htmlspecialchars($pasien['no_wa']) ?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="no-ruangan" class="form-label">No Ruangan <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" id="no-ruangan" placeholder="Nomor Ruangan" required name="no_ruangan" value="<?= htmlspecialchars($pasien['no_ruangan']) ?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="no-bed" class="form-label">No Bed <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" id="no-bed" placeholder="Nomor Bed" required name="no_bed" value="<?= htmlspecialchars($pasien['no_bed']) ?>">
                </div>
              </div>
              <div class="col-lg-6">
                <input type="submit" value="Submit" class="btn btn-green">
              </div>
            </div>
          </form>
          <?php else: ?>
            <p>Data pasien tidak ditemukan.</p>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <!-- Add Data Pasien -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="../asset/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>