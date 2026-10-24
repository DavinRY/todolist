<?php
include 'koneksi.php';


if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];


$query = "SELECT * FROM tugas WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$tugas = mysqli_fetch_assoc($result);


if (!$tugas) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['update'])) {
    $nama_tugas = trim($_POST['nama_tugas']);

    if (!empty($nama_tugas)) {
        $nama_tugas = mysqli_real_escape_string($koneksi, $nama_tugas);
        
        $update_query = "UPDATE tugas SET nama_tugas = '$nama_tugas' WHERE id = '$id'";
        mysqli_query($koneksi, $update_query);
        
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            padding-top: 50px;
        }
        .container {
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
        }
        form {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            padding: 10px 15px;
            background-color: #ffc107;
            color: #333;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #e0a800;
        }
        .btn-kembali {
            display: inline-block;
            margin-top: 15px;
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-kembali:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Tugas</h2>
    
   
    <form action="" method="POST">
        <input type="text" name="nama_tugas" value="<?= htmlspecialchars($tugas['nama_tugas']); ?>" required autocomplete="off">
        <button type="submit" name="update">Simpan</button>
    </form>

    <a href="index.php" class="btn-kembali">&larr; Kembali ke Daftar Tugas</a>
</div>

</body>
</html>