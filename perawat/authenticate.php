<?php
// File: authenticate.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require '../luxury/koneksi.php';

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Enkripsi password yang dimasukkan menggunakan SHA1
$hashedPassword = sha1($password);

// Query untuk mencari user berdasarkan username
$stmt = $pdo->prepare('SELECT * FROM user WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch();

// Verifikasi password
if ($user && $hashedPassword === $user['password']) {
    // Jika password cocok, set session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header('Location: dashboard.php');
    exit();
} else {
    // Jika password tidak cocok, kembali ke login dengan pesan error
    header('Location: index.php?error=1');
    exit();
}
?>