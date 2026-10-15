<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Hapus token dari DB
    mysqli_query($koneksi, "
        UPDATE tb_user
        SET remember_token=NULL
        WHERE username='$username'
    ");
}

// Hapus cookie
setcookie("remember_token", "", time() - 3600, "/");

// Hapus session
session_unset();
session_destroy();

header("Location: index.php");
exit();
