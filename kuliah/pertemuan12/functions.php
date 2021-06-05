<?php

function koneksi()
{
  //koneksi ke database dan pilih database
  return mysqli_connect('localhost', 'root', '', 'tugaspw');
}

function query($query)
{
  $conn = koneksi();

  $result = mysqli_query($conn, $query);

  // //jika hasilnya ada 1 data
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function tambah($data)
{
  $conn = koneksi();

  $gambar = htmlspecialchars($data['gambar']);
  $nama = htmlspecialchars($data['nama']);
  $nrp = htmlspecialchars($data['nrp']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);

  $query = "INSERT INTO mahasiswa VALUES (null, '$gambar', '$nama', '$nrp', '$email', '$jurusan');";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  $conn = koneksi();

  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  $conn = koneksi();

  $id = ($data['id']);
  $gambar = htmlspecialchars($data['gambar']);
  $nama = htmlspecialchars($data['nama']);
  $nrp = htmlspecialchars($data['nrp']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);

  $query = "UPDATE mahasiswa SET
                gambar = '$gambar',
                nama = '$nama',
                nrp = '$nrp',
                email = '$email',
                jurusan = '$jurusan'
              WHERE id = $id";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $conn = koneksi();

  $query = "SELECT * FROM mahasiswa WHERE 
                nama LIKE '%$keyword%' OR
                nrp LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'";

  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function login($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  if ($user = query("SELECT * FROM user WHERE username = '$username'")) {
    if (password_verify($password, $user['password'])) {
      $_SESSION['$login'] = true;

      header("Location: index.php");
      exit;
    }
  }
  return [
    'error' => true,
    'pesan' => 'Username/Password Salah'
  ];
}

function registrasi($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  //jika ada field yang kosong
  if (empty($username) || empty($password1) || empty($password2)) {
    echo "<script> 
                alert ('Username/Password tidak boleh kosong');
                document.location.href = 'registrasi.php';
            </script>";
    return false;
  }

  //jika username sudah ada
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script> 
                alert ('Username sudah terdaftar');
                document.location.href = 'registrasi.php';
            </script>";
    return false;
  }

  //jika konfirmasi tidak sesuai
  if ($password1 !== $password2) {
    echo "<script> 
                alert ('Konfirmasi Password tidak sesuai');
                document.location.href = 'registrasi.php';
            </script>";
    return false;
  }

  //jika password kurang dari 6 digit
  if (strlen($password1) < 6) {
    echo "<script> 
                alert ('Password terlalu pendek');
                document.location.href = 'registrasi.php';
            </script>";
    return false;
  }

  //jika kondisi sudah sesuai
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);

  $query = "INSERT INTO user VALUES (null, '$username', '$password_baru')";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
