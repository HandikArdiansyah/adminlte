<?php
session_start();
include "koneksi.php";

/* 1. CEK SESSION LOGIN */
if (isset($_SESSION['login'])) {
    return; // user sudah login → lanjut
}

/* 2. CEK COOKIE REMEMBER ME */
if (isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];

    $query = mysqli_query($koneksi, "
        SELECT * FROM tb_user 
        WHERE remember_token='$token'
        LIMIT 1
    ");

    if (mysqli_num_rows($query) === 1) {
        $user = mysqli_fetch_assoc($query);

        // buat ulang session
        $_SESSION['login']        = true;
        $_SESSION['user_id']      = $user['id'];
        $_SESSION['username']     = $user['username'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['alamat']       = $user['alamat'];
        $_SESSION['no_hp']        = $user['no_hp'];
        $_SESSION['avatar']       = $user['avatar'];

        return;
    }
}

/* 3. GAGAL → BALIK KE LOGIN */
header("Location: index.php");
exit();
