<?php 
session_start();

if(!isset($_SESSION['$login'])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET['id'];

if(Hapus($id) > 0){
    echo "<script>
        alert('Data berhasil dihapus');
        document.location.href = 'index.php';
        </script>";
}else{
    echo 'Data gagal dihapus';
}
