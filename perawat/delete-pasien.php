<?php
require '../luxury/koneksi.php';

session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Pastikan ada parameter ID di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data pasien berdasarkan ID
    $sql = "DELETE FROM pasien WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        header("Location: data-pasien.php?deleted=1");
        exit();
    } else {
        echo "Terjadi kesalahan saat menghapus data.";
    }
} else {
    echo "ID pasien tidak ditemukan.";
}
?>
