<?php
include "auth.php";
include "koneksi.php";

$nama_lengkap = $_POST['nama_lengkap'];
$alamat       = $_POST['alamat'];
$no_hp        = preg_replace('/[^0-9]/', '', $_POST['no_hp']);
$username     = $_SESSION['username'];

// Base query
$query = "UPDATE tb_user SET nama_lengkap='$nama_lengkap', alamat='$alamat', no_hp='$no_hp'";

// Jika password diisi → update password
if (!empty($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query .= ", password='$password'";
}

$query .= " WHERE username='$username'";

if (mysqli_query($koneksi, $query)) {
    $_SESSION['nama_lengkap'] = $nama_lengkap;
    $_SESSION['alamat']       = $alamat;
    $_SESSION['no_hp']        = $no_hp;

    header("Location: profil.php?update=success");
    exit();
} else {
    echo mysqli_error($koneksi);
}
