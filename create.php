<?php require 'db.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $jurusan = $_POST['jurusan'];
  $stmt = $conn->prepare("INSERT INTO mahasiswa (nim,nama,jurusan) VALUES (?,?,?)");
  $stmt->bind_param("sss",$nim,$nama,$jurusan);
  $stmt->execute();
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html><html><head><title>Tambah Mahasiswa</title></head><body>
<h1>Tambah Mahasiswa</h1>
<form method="POST">
  <label>NIM: <input type="text" name="nim" required></label><br><br>
  <label>Nama: <input type="text" name="nama" required></label><br><br>
  <label>Jurusan: <input type="text" name="jurusan" required></label><br><br>
  <button type="submit">Simpan</button>
  <a href="index.php">Batal</a>
</form>
</body></html>

