
<?php require 'db.php'; ?>
<!DOCTYPE html><html><head><title>Data Mahasiswa</title>
<link rel="stylesheet" href="css/styles.css">
<script src="js/index.js"></script>
</head><body>
<h1>Data Mahasiswa</h1>
<a class="button" href="create.php">Tambah Mahasiswa</a>
<table>
<thead><tr><th>NIM</th><th>Nama</th><th>Jurusan</th><th>Aksi</th></tr></thead>
<tbody>
<?php
$res = $conn->query("SELECT * FROM mahasiswa");
while($row = $res->fetch_assoc()):
?>
<tr>
<td><?=htmlspecialchars($row['nim'])?></td>
<td><?=htmlspecialchars($row['nama'])?></td>
<td><?=htmlspecialchars($row['jurusan'])?></td>
<td>
  <a class="button edit" href="edit.php?nim=<?=urlencode($row['nim'])?>">Edit</a>
  <a class="button delete" href="delete.php?nim=<?=urlencode($row['nim'])?>" onclick="return confirmDelete('<?=addslashes($row['nama'])?>')">Hapus</a>
</td>
</tr>
<?php endwhile; $res->free(); ?>
</tbody>
</table>
</body></html>

