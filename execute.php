<?php
// File: edit-pasien.php

require 'luxury/koneksi.php';

session_start();

if (isset($_GET['patientIdentity'])) {
  $patientIdentity = $_GET['patientIdentity'];

  $sql = "SELECT * FROM pasien WHERE patientIdentity = :patientIdentity";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":patientIdentity", $patientIdentity);
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
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="asset/style.css">
    <link rel="icon" href="img/logo.jpeg">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Viga&display=swap" rel="stylesheet">

    <title>Sistem Manajemen Waktu Minum Obat Pasien</title>
  </head>
  <body>

    <section class="box-data">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-4 bg-box">
            <center><img src="img/logo.jpeg" width="100" alt=""></center>
            <hr><br>
            <?php if ($pasien): ?>
            <div>
              <b>Nama:</b> <?= htmlspecialchars($pasien['nama']) ?> <br><br>
              <b>No. Ruangan:</b> <?= htmlspecialchars($pasien['no_ruangan']) ?> <br><br>
              <b>No. Bed:</b> <?= htmlspecialchars($pasien['no_bed']) ?> <br>
            </div>

            <?php if (!isset($_SESSION['user_id'])): ?>
            <div style="margin-top: 50px;">
            <?php if ($pasien['status'] === 'Y'): ?>
              <center>
              <span style="color: green;">Terimakasih Sudah Meminum Obat🙏🏻</span><br>
              <span style="color: green;">Tunggu Obatnya Diberikan Lagi Yah😊</span><br>
              </center>
              <?php else: ?>
              <form action="edit-submit.php" method="post">
              <input type="hidden" value="<?= htmlspecialchars($pasien['id']) ?>" name="id">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" value="Y" name="status" id="flexCheckDefault" required>
                  <label class="form-check-label" for="flexCheckDefault">
                    Centang Jika Sudah Minum Obat
                  </label>
                </div>
                <div class="mb-3">
                  <input type="submit" value="Submit" class="btn btn-green">
                </div>
              </form>
              <?php endif; ?>
            </div>


            <?php else: ?>
            <div style="margin-top: 50px;">
            <?php if ($pasien['status'] === 'Y'): ?>
              <span style="color: green;">Pasien Sudah Meminum Obat Sebelumnya</span><br><br>
              <?php else: ?>
              <span style="color: red;">Pasien Belum Meminum Obat Sebelumnya</span><br><br>
              <?php endif; ?>
              <form action="edit-obat.php" method="post">
                <input type="hidden" value="<?= htmlspecialchars($pasien['id']) ?>" name="id">
                <div class="mb-3">
                  <label for="namaObat" class="form-label">Nama Obat</label>
                  <input type="text" class="form-control" id="namaObat" placeholder="Paracetamol, Amoxilyn, Bodrex" required name="nama_obat">
                </div>
                <div class="mb-3">
                  <label for="waktuMinum" class="form-label">Waktu Minum</label>
                  <select class="form-select" aria-label="Default select example" id="waktuMinum" required name="waktu_minum">
                    <option value="Sebelum Makan">Sebelum Makan</option>
                    <option value="Sesudah Makan">Sesudah Makan</option>
                  </select>
                </div>
                <div class="mb-3">
                  <input type="submit" value="Submit" class="btn btn-green">
                </div>
              </form>
            </div>
            <?php endif; ?>
            <?php else: ?>
            <p>Data pasien tidak ditemukan.</p>
          <?php endif; ?>
          </div>
        </div>
      </div>
    </section>


    <section class="footer" style="padding-bottom: 50px;">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-12">
            <p class="copy-parag">
              Development by UMKT
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="asset/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>