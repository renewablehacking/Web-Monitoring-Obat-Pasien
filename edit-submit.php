<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "luxury/koneksi.php";

session_start();

date_default_timezone_set('Asia/Makassar');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $waktu_submit = date("Y-m-d H:i:s");

    $sql = "UPDATE pasien SET status = :status, waktu_submit = :waktu_submit WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":waktu_submit", $waktu_submit);
    
    if ($stmt->execute()) {
        echo "<center><span style='color: green;'>Terimakasih Sudah Meminum Obat</span></center>";
    } else {
        echo "Terjadi kesalahan.";
    }
} else {
    echo "ID pasien tidak ditemukan.";
}
?>
