<?php
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "obat");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika user sudah login, redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = sha1($password);

    $query = "SELECT id FROM user WHERE username = '$username' AND password = '$hashedPassword'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        header("Location: dashboard.php");
        exit;
  } else {
        Header('Location: index.php?error=1');
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

    <title>Log In Perawat | Monitoring Obat RSUD Inhace Abdoel Moeis</title>
  </head>
  <body>
    

    <section class="box-login">
      <div class="container">
        <div class="row justify-content-center gy-5">
          <div class="col-lg-8 bg-box">
            <center><img src="../img/logo.jpeg" width="100" alt=""></center>
            <?php
            if (isset($_GET['error'])) {
                echo "<center><p style='color:red;'>Username atau password salah!</p></center>";
            }
            ?>
            <form method="post">
              <div class="row justify-content-center gy-5">
                <div class="col-8 col-lg-8">
                  <div class="mb-3">
                    <label for="Username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="Username" placeholder="Username Perawat" name="username" required>
                  </div>
                  <div class="mb-3">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="Password" placeholder="Kata Sandi Perawat" name="password" required>
                  </div>
                  <div class="mb-3">
                    <input type="submit" value="Log In" class="btn btn-login">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>


    <section class="footer">
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
    <script src="../asset/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>