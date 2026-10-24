<?php
include 'koneksi.php';

 
if (isset($_GET['status_id'])) {
    $id = $_GET['status_id'];
    $status_sekarang = $_GET['status'];
    $status_baru = ($status_sekarang == 'pending') ? 'selesai' : 'pending';

    $query = "UPDATE tugas SET status = '$status_baru' WHERE id = '$id'";
    mysqli_query($koneksi, $query);
    header("Location: index.php");
    exit();
}


if (isset($_GET['hapus_id'])) {
    $id = $_GET['hapus_id'];
    $query = "DELETE FROM tugas WHERE id = '$id'";
    mysqli_query($koneksi, $query);
    header("Location: index.php");
    exit();
}


$result = mysqli_query($koneksi, "SELECT * FROM tugas ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi To-Do List Sederhana</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Davin Risanta Yufa | 241552018155591</h2>
    <h2>Leopoldus Nosdin Sokong | 241552018155666</h2>

<div class="container">
    <h2>To-Do List</h2>

    <form action="tambah.php" method="POST">
        <input type="text" name="nama_tugas" placeholder="Ketik tugas baru..." required autocomplete="off">
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <ul>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <li>
                    <span class="<?= $row['status'] == 'selesai' ? 'selesai' : '' ?>">
                        <?= htmlspecialchars($row['nama_tugas']); ?>
                    </span>
                    <div class="aksi">
                        <a href="index.php?status_id=<?= $row['id']; ?>&status=<?= $row['status']; ?>" class="btn-status">
                            <?= $row['status'] == 'selesai' ? 'Batal' : 'Selesai'; ?>
                        </a>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                        <a href="index.php?hapus_id=<?= $row['id']; ?>" class="btn-hapus" onclick="return confirm('Hapus tugas ini?')">Hapus</a>
                    </div>
                    
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li style="text-align: center; color: #777;">Belum ada tugas.</li>
        <?php endif; ?>
    </ul>
</div>

</body>
</html>