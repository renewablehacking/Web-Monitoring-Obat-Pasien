<?php
// File: dashboard.php

require '../luxury/koneksi.php';

session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
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



    <!-- Data Pesien -->
    <section class="data-pasien">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-6">
            <h1>Monitor Obat Pasien</h1>
          </div>
          <div class="col-lg-6">
            <div class="input-group mb-3">
              <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search-Data-Pasien" aria-describedby="button-addon2">
              <button class="btn btn-green" type="button" id="button-addon2">Search</button>
            </div>
          </div>
          <div class="col-lg-12" style="overflow: auto;">
            <table class="table table-hover" id="dataTable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">No. Ruangan</th>
                  <th scope="col">No. Bed</th>
                  <th scope="col">Waktu Pemberian</th>
                  <th scope="col">Nama Obat</th>
                  <th scope="col">Waktu Minum</th>
                  <th scope="col">Waktu Submit</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                // Query untuk mengambil data dari tabel users
                $stmt = $pdo->query('SELECT * FROM pasien ORDER BY id desc');
                $data_obat = $stmt->fetchAll();
                $no=1;
                foreach ($data_obat as $data_obat):
                ?>
                <tr>
                  <th scope="row"><?= $no++ ?></th>
                  <td><?= $data_obat['nama'] ?></td>
                  <td><?= $data_obat['no_ruangan'] ?></td>
                  <td><?= $data_obat['no_bed'] ?></td>
                  <td><?= $data_obat['waktu_pemberian'] ?></td>
                  <td><?= $data_obat['nama_obat'] ?></td>
                  <td><?= $data_obat['waktu_minum'] ?></td>
                  <td><?= $data_obat['waktu_submit'] ?></td>
                  <td>
                    <div class="row">
                    <?php if ($data_obat['status'] === 'T'): ?>
                      <div class="col-12 col-lg-6">
                        <span style="color: red;">Belum Diminum</span>
                      </div>
                      <?php 
                      $nama_obat = htmlspecialchars($data_obat['nama_obat']);
                      $waktu_pemberian = htmlspecialchars($data_obat['waktu_pemberian']);
                      $no_wa = htmlspecialchars($data_obat['no_wa']);

                      // Format pesan WhatsApp
                      $pesan = "Assalamu'alaikum wr wb %0A"
                      . "Kami ingatkan kembali untuk meminum obat yang telah diberikan🙏. %0A%0A"
                      . "Waktu Pemberian: *$waktu_pemberian* %0A"
                      . "Obat: *$nama_obat* %0A%0A"
                      . "Jika sudah meminumnya silahkan untuk scan QR Code yang berada dibelakang bed.%0A%0A"
                      . "Terimakasih atas perhatiannya🙏";

                      $wa_link = "https://wa.me/$no_wa?text=$pesan_encoded";
                      ?>
                      <div class="col-12 col-lg-6">
                        <a href="https://wa.me/<?php echo $no_wa; ?>?text=<?php echo $pesan; ?>" class="btn btn-danger">Ingatkan!</a>
                      </div>


                      <?php else: ?>
                      <div class="col-12 col-lg-6">
                        <span style="color: green;">Sudah Diminum</span>
                      </div>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <?php 
                endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!-- Data Pesien -->

    <!-- Optional JavaScript; choose one of the two! -->

    <script>
      document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const table = document.getElementById("dataTable");
    const rows = table.getElementsByTagName("tr");

    searchInput.addEventListener("keyup", function () {
        const filter = searchInput.value.toLowerCase();

        for (let i = 1; i < rows.length; i++) { // Mulai dari 1 untuk melewati header
            let cells = rows[i].getElementsByTagName("td");
            let rowContainsText = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toLowerCase().includes(filter)) {
                    rowContainsText = true;
                    break;
                }
            }

            rows[i].style.display = rowContainsText ? "" : "none";
        }
    });
});
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="../asset/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>