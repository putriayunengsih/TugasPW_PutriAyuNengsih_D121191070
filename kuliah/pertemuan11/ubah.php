<?php

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
  <form action="" method="POST">
    <input type="hidden" name="id" required value="<?= $m['id']; ?>">
    <ul>
      <li>
        <label>
          Gambar :
          <input type="text" name="gambar" required value="<?= $m['gambar']; ?>">
        </label>
      </li>
      <li>
        <label>
          Nama :
          <input type="text" name="nama" autofocus required value="<?= $m['nama']; ?>">
        </label>
      </li>
      <li>
        <label>
          Nim :
          <input type="text" name="nrp" required value="<?= $m['nrp']; ?>">
        </label>
      </li>
      <li>
        <label>
          Email :
          <input type="text" name="email" required value="<?= $m['email']; ?>">
        </label>
      </li>
      <li>
        <label>
          Departemen :
          <input type="text" name="jurusan" required value="<?= $m['jurusan']; ?>">
        </label>
      </li>

      <li>
        <button type="submit" name="Ubah">Ubah Data</button>
      </li>
    </ul>
  </form>
</body>

</html>