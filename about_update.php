<?php
include "auth.php";
include "koneksi.php";

$user_id = $_SESSION['id'];
$field = $_POST['field'] ?? '';
$value = mysqli_real_escape_string($koneksi, $_POST['value'] ?? '');

$allowed = ['headline','about','education','skills','experience','phone','address'];
if (!in_array($field, $allowed)) exit;

// UPSERT (INSERT kalau belum ada, UPDATE kalau sudah ada)
mysqli_query($koneksi, "
INSERT INTO user_about (user_id, $field)
VALUES ('$user_id', '$value')
ON DUPLICATE KEY UPDATE $field='$value'
");
