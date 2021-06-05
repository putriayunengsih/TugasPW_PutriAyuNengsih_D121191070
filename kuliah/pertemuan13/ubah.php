<?php
session_start();

if (!isset($_SESSION['$login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

$id = $_GET['id'];

$m = query("SELECT * FROM mahasiswa WHERE id = $id");

if (isset($_POST['Ubah'])) {
  if (Ubah($_POST) > 0) {
    echo "<script>
            alert('Data berhasil diubah');
            document.location.href = 'index.php';
        </script>";
  } else {
    echo 'Data gagal diubah';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h3>Form Ubah Data Mahasiswa</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" required value="<?= $m['id']; ?>">
    <ul>
      <li>
        <input type="hidden" name="gambar_lama" value="<?= $m['gambar']; ?>">
        <img src="img/<?= $m['gambar']; ?>" alt="" width="120" style="display: block;" class="img-preview">
        <label>
          gambar :
          <input type="file" name="gambar" class="gambar" onchange="previewImage()">
        </label>
      </li>
      <li>
        <label>
          nama :
          <input type="text" name="nama" autofocus required autocomplete="off" value="<?= $m['nama']; ?>">
        </label>
      </li>
      <li>
        <label>
          nrp :
          <input type="text" name="nrp" required autocomplete="off" value="<?= $m['nrp']; ?>">
        </label>
      </li>
      <li>
        <label>
          email :
          <input type="text" name="email" required autocomplete="off" value="<?= $m['email']; ?>">
        </label>
      </li>
      <li>
        <label>
          jurusan :
          <input type="text" name="jurusan" autocomplete="off" required value="<?= $m['jurusan']; ?>">
        </label>
      </li>

      <li>
        <button type="submit" name="Ubah">Ubah Data</button>
      </li>
    </ul>
  </form>

  <script src="js/script.js"></script>
</body>

</html>