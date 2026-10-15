<?php
include "auth.php";
include "koneksi.php";

$user_id = $_SESSION['user_id'];

$query = mysqli_query($koneksi, "SELECT * FROM user_about WHERE user_id='$user_id'");
$data = mysqli_fetch_assoc($query) ?? [];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit About</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  </head>
  <body>
    <form action="about_update.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label>Headline</label>
        <input type="text" name="headline" class="form-control" value="<?= htmlspecialchars($data['headline'] ?? '') ?>">
      </div>
      <div class="mb-3">
        <label>About Me</label>
        <textarea name="about" class="form-control" rows="4"><?= htmlspecialchars($data['about'] ?? '') ?></textarea>
      </div>
      <div class="mb-3">
        <label>Education (1 baris = 1 item)</label>
        <textarea name="education" class="form-control" rows="3"><?= htmlspecialchars($data['education'] ?? '') ?></textarea>
      </div>
      <div class="mb-3">
        <label>Skills (1 baris = 1 item)</label>
        <textarea name="skills" class="form-control" rows="3"><?= htmlspecialchars($data['skills'] ?? '') ?></textarea>
      </div>
      <div class="mb-3">
        <label>Experience</label>
        <textarea name="experience" class="form-control" rows="3"><?= htmlspecialchars($data['experience'] ?? '') ?></textarea>
      </div>
      <div class="mb-3">
        <label>Foto About</label>
        <input type="file" name="photo" class="form-control">
      </div>
      <button class="btn btn-primary">Simpan</button>
    </form>
  </body>
</html>