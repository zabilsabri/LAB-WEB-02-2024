<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'mahasiswa_db');

if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
?>
