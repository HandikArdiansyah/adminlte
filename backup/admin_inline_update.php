<?php
include "auth.php";
include "koneksi.php";

$user_id = $_SESSION['user_id'];
$about = mysqli_real_escape_string($koneksi, $_POST['about']);

$query = "
  UPDATE tb_user
  SET about = '$about'
  WHERE id = '$user_id'
";

mysqli_query($koneksi, $query);
