<?php
// koneksi.php

$host = "localhost";     // host database
$db   = "web"; // nama database
$user = "root";          // username database (default XAMPP: root)
$pass = "";              // password database (default XAMPP: kosong)

try {
    // Buat koneksi dengan PDO
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Set mode error biar kalau ada masalah langsung ketahuan
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Kalau koneksi gagal
    die("⚠️ Koneksi database gagal: " . $e->getMessage());
}
?>