<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../luxury/koneksi.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $no_wa = $_POST['no_wa'];
    $no_ruangan = $_POST['no_ruangan'];
    $no_bed = $_POST['no_bed'];

    $sql = "UPDATE pasien SET nama = :nama, no_wa = :no_wa, no_ruangan = :no_ruangan, no_bed = :no_bed WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":nama", $nama);
    $stmt->bindParam(":no_wa", $no_wa);
    $stmt->bindParam(":no_ruangan", $no_ruangan);
    $stmt->bindParam(":no_bed", $no_bed);
    
    if ($stmt->execute()) {
        header("Location: data-pasien.php?updated=1");
    } else {
        echo "Terjadi kesalahan.";
    }
} else {
    echo "ID pasien tidak ditemukan.";
}
?>
