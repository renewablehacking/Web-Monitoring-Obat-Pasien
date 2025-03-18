<?php
// db.php

$host = 'localhost';      // Host database
$db   = 'obat'; // Nama database
$user = 'root';     // Username database
$pass = '';      // Password database
$charset = 'utf8mb4';    // Charset

// Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opsi untuk PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Aktifkan error mode exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Set fetch mode ke associative array
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Nonaktifkan emulasi prepared statements
];

try {
    // Buat koneksi PDO
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Tangani error jika koneksi gagal
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}