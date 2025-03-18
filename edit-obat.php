<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "luxury/koneksi.php";

session_start();

date_default_timezone_set('Asia/Makassar');
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $status = "T";
    $waktu_pemberian = date("Y-m-d H:i:s");
    $nama_obat = $_POST['nama_obat'];
    $waktu_minum = $_POST['waktu_minum'];

    $sql = "UPDATE pasien SET status = :status, waktu_pemberian = :waktu_pemberian, nama_obat = :nama_obat, waktu_minum = :waktu_minum WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":waktu_pemberian", $waktu_pemberian);
    $stmt->bindParam(":nama_obat", $nama_obat);
    $stmt->bindParam(":waktu_minum", $waktu_minum);
    
    if ($stmt->execute()) {
        echo "<center><span style='color: green;'>Data Berhasil Submit</span></center>";
    } else {
        echo "Terjadi kesalahan.";
    }
} else {
    echo "ID pasien tidak ditemukan.";
}
?>
