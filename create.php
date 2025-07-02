<?php
require 'db.php';
require 'session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoName = uniqid() . '_' . $_FILES['foto']['name'];
        $uploadDir = 'uploads/';
        $uploadPath = $uploadDir . $fotoName;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadPath)) {
            $foto = $uploadPath;
        }
    }

    $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, jurusan, foto, tgl_lahir, jenis_kelamin, alamat, email, telepon) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssss", $nim, $nama, $jurusan, $foto, $tgl_lahir, $jenis_kelamin, $alamat, $email, $telepon);
    $stmt->execute();

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/index.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <h1 class="mb-4 text-center">Tambah Mahasiswa</h1>

  
    <div id="alert-container"></div>

    <form name="mahasiswaForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" class="p-4 border rounded bg-white shadow">

        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" name="jurusan" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select">
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>

