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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $no_wa = $_POST['no_wa'];
    $no_ruangan = $_POST['no_ruangan'];
    $no_bed = $_POST['no_bed'];
    $status = "T";
    $waktu_pemberian = "-";
    $nama_obat = "-";
    $waktu_minum = "-";
    $waktu_submit = "-";

    $patientIdentity = bin2hex(random_bytes(16));

    $sql = "INSERT INTO pasien (nama, no_wa, no_ruangan, no_bed, status, waktu_pemberian, nama_obat, waktu_minum, waktu_submit, patientIdentity) VALUES (:nama, :no_wa, :no_ruangan, :no_bed, :status, :waktu_pemberian, :nama_obat, :waktu_minum, :waktu_submit, :patientIdentity)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(":nama", $nama);
    $stmt->bindParam(":no_wa", $no_wa);
    $stmt->bindParam(":no_ruangan", $no_ruangan);
    $stmt->bindParam(":no_bed", $no_bed);
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":waktu_pemberian", $waktu_pemberian);
    $stmt->bindParam(":nama_obat", $nama_obat);
    $stmt->bindParam(":waktu_minum", $waktu_minum);
    $stmt->bindParam(":waktu_submit", $waktu_submit);
    $stmt->bindParam(":patientIdentity", $patientIdentity);
    
    if ($stmt->execute()) {
        header("Location: data-pasien.php?added=1");
    } else {
        echo "Terjadi kesalahan.";
    }
}
?>