<?php require 'db.php';
if(!isset($_GET['nim'])) header('Location: index.php');
$nim = $_GET['nim'];
$res = $conn->prepare("SELECT * FROM mahasiswa WHERE nim=?");
$res->bind_param("s",$nim);
$res->execute();
$data = $res->get_result()->fetch_assoc();
if(!$data) header('Location: index.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
  $nama = $_POST['nama'];
  $jurusan = $_POST['jurusan'];
  $upd = $conn->prepare("UPDATE mahasiswa SET nama=?,jurusan=? WHERE nim=?");
  $upd->bind_param("sss",$nama,$jurusan,$nim);
  $upd->execute();
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html><html><head><title>Edit Mahasiswa</title></head><body>
<h1>Edit Mahasiswa</h1>
<form method="POST">
  <label>NIM: <input type="text" value="<?=htmlspecialchars($data['nim'])?>" disabled></label><br><br>
  <label>Nama: <input type="text" name="nama" value="<?=htmlspecialchars($data['nama'])?>" required></label><br><br>
  <label>Jurusan: <input type="text" name="jurusan" value="<?=htmlspecialchars($data['jurusan'])?>" required></label><br><br>
  <button type="submit">Update</button>
  <a href="index.php">Batal</a>
</form>
</body></html>

