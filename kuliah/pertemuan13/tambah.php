<?php
session_start();

if (!isset($_SESSION['$login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

if (isset($_POST['Tambah'])) {
  if (Tambah($_POST) > 0) {
    echo "<script> 
                    alert('data berhasil ditambahkan'); 
                    document.location.href = 'index.php';
               </script>";
  } else {
    echo "data gagal ditambahkan";
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
  <h3>Form Tambah Data Mahasiswa</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <ul>
      <li>
        <img src="img/image.jpg" alt="" width="120" style="display: block;" class="img-preview">

        <label>
          gambar :
          <input type="file" name="gambar" class="gambar" onchange="previewImage()">
        </label>
      </li>
      <li>
        <label>
          nama :
          <input type="text" name="nama" autofocus autocomplete="off" required>
        </label>
      </li>
      <li>
        <label>
          nrp :
          <input type="text" name="nrp" autocomplete="off" required>
        </label>
      </li>
      <li>
        <label>
          Email :
          <input type="text" name="email" autocomplete="off" required>
        </label>
      </li>
      <li>
        <label>
          jurusan :
          <input type="text" name="jurusan" autocomplete="off" required>
        </label>
      </li>

      <li>
        <button type="submit" name="Tambah">Tambah Data</button>
      </li>
    </ul>
  </form>

  <script src="js/script.js"></script>
</body>

</html>