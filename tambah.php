<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama_tugas = trim($_POST['nama_tugas']);

    if (!empty($nama_tugas)) {
        $nama_tugas = mysqli_real_escape_string($koneksi, $nama_tugas);
        
        $query = "INSERT INTO tugas (nama_tugas) VALUES ('$nama_tugas')";
        mysqli_query($koneksi, $query);
    }
}


header("Location: index.php");
exit();
?>