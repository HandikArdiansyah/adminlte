<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "
    SELECT * FROM tb_user WHERE username='$username'
");

if (mysqli_num_rows($query) === 0) {
    header("Location: index.php?error=username");
    exit();
}

$user = mysqli_fetch_assoc($query);

if (!password_verify($password, $user['password'])) {
    header("Location: index.php?error=password");
    exit();
}

/* BUAT SESSION LOGIN */
$_SESSION['login']        = true;
$_SESSION['username']     = $user['username'];
$_SESSION['nama_lengkap'] = $user['nama_lengkap'];
$_SESSION['alamat']       = $user['alamat'];
$_SESSION['no_hp']        = $user['no_hp'];
$_SESSION['avatar']       = $user['avatar'];

/* REMEMBER ME */
if (isset($_POST['remember'])) {
    $token = bin2hex(random_bytes(32));

    mysqli_query($koneksi, "
        UPDATE tb_user
        SET remember_token='$token'
        WHERE id='{$user['id']}'
    ");

    setcookie(
        "remember_token",
        $token,
        time() + (30 * 24 * 60 * 60),
        "/",
        "",
        false,
        true
    );
}

header("Location: dashboard.php");
exit();
