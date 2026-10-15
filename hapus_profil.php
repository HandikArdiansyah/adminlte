<?php
include "auth.php";
include "koneksi.php";

// Pastikan user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];

// Hapus data dari database
$query = "DELETE FROM tb_user WHERE username = '$username'";

if (mysqli_query($koneksi, $query)) {

    // Hapus semua session (logout otomatis)
    session_unset();
    session_destroy();

    // Redirect ke halaman login
    header("Location: index.php?delete=success");
    exit();

} else {
    echo "Gagal menghapus profil: " . mysqli_error($koneksi);
}
?>
