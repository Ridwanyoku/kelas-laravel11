<?php
// Konfigurasi database
$host = "localhost";
$dbname = "sistem_keuangan_kas_kelas";
$db_user = "root"; // Ganti sesuai username MySQL Anda
$db_pass = ""; // Ganti sesuai password MySQL Anda

// Koneksi ke database
$conn = new mysqli($host, $db_user, $db_pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>
