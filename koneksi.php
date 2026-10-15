<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "adminlte";

// Create connection
    $koneksi = mysqli_connect($server, $user, $password, $database);

// Cek Koneksi
if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>