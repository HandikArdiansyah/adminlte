<?php
include "auth.php";
include "koneksi.php";

// Cek login
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

// Ambil username dari session
$username = $_SESSION['username'];

// Cek file
if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] == 4) {
    header("Location: profil.php?error=no_file");
    exit();
}

// Setting upload
$allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
$max_size = 2 * 1024 * 1024; // Maks 2 MB

$filename = $_FILES['avatar']['name'];
$filetmp  = $_FILES['avatar']['tmp_name'];
$filesize = $_FILES['avatar']['size'];

$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

// Validasi ekstensi
if (!in_array($ext, $allowed_ext)) {
    header("Location: profil.php?error=invalid_ext");
    exit();
}

// Validasi ukuran file
if ($filesize > $max_size) {
    header("Location: profil.php?error=size");
    exit();
}

// Buat nama file baru unik
$newname = "avatar_" . time() . "_" . rand(1000,9999) . "." . $ext;

// Folder tujuan
$folder = "uploads/profile/";
$target = $folder . $newname;

// Pastikan folder ada
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

// Pindahkan file
if (!move_uploaded_file($filetmp, $target)) {
    header("Location: profil.php?error=upload_fail");
    exit();
}

// Update database (tb_user)
$update = mysqli_query($koneksi, "UPDATE tb_user SET avatar='$newname' WHERE username='$username'");

// Update session langsung tanpa login ulang
$_SESSION['avatar'] = $newname;

if ($update) {
    header("Location: profil.php?success=updated");
    exit();
} else {
    header("Location: profil.php?error=db_fail");
    exit();
}