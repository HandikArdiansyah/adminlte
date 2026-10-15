<?php
include "koneksi.php";

$nama_lengkap   = $_POST['nama_lengkap'];
$username       = $_POST['username'];
$alamat         = $_POST['alamat'];
$no_hp          = $_POST['no_hp'];
$password       = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure

// simpan data
$query = "INSERT INTO tb_user (username, password, nama_lengkap, alamat, no_hp, avatar)
VALUES ('$username', '$password', '$nama_lengkap', '$alamat', '$no_hp', 'default.jpg')";

if (mysqli_query($koneksi, $query)) {
    header("location: index.php");
    exit();

} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}