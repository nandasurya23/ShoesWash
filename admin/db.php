<?php
// Konfigurasi database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'shoes');

// Membuat koneksi
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset untuk menghindari masalah encoding
$conn->set_charset('utf8');
?>
