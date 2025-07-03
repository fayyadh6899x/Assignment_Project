<?php
require 'db.php';
require 'session.php';

if (!isset($_GET['nim'])) {
    header('Location: index.php');
    exit;
}

$nim = $_GET['nim'];
$res = $conn->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
$res->bind_param("s", $nim);
$res->execute();
$result = $res->get_result();

if ($result->num_rows == 0) {
    echo "Data tidak ditemukan!";
    exit;
}

$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    $foto = $data['foto'];
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoName = uniqid() . '_' . $_FILES['foto']['name'];
        $uploadDir = 'uploads/';
        $uploadPath = $uploadDir . $fotoName;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadPath)) {
            $foto = $uploadPath;
        }
    }

    $stmt = $conn->prepare("UPDATE mahasiswa SET nama=?, jurusan=?, foto=?, tgl_lahir=?, jenis_kelamin=?, alamat=?, email=?, telepon=? WHERE nim=?");
    $stmt->bind_param("sssssssss", $nama, $jurusan, $foto, $tgl_lahir, $jenis_kelamin, $alamat, $email, $telepon, $nim);
    $stmt->execute();

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/index.js"></script>
</head>

<body class="bg-light fade-in">

    <div class="container mt-5 mb-5">
        <h1 class="mb-4 text-center">Edit Mahasiswa</h1>


        <div id="alert-container"></div>

        <form name="mahasiswaForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" class="p-4 border rounded bg-white shadow">

            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($data['nim']) ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Jurusan</label>
                <input type="text" name="jurusan" class="form-control" value="<?= htmlspecialchars($data['jurusan']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Profil</label><br>
                <?php if (!empty($data['foto'])): ?>
                    <img src="<?= htmlspecialchars($data['foto']) ?>" width="100" height="100" class="rounded mb-3" style="object-fit:cover;"><br>
                <?php endif; ?>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="<?= htmlspecialchars($data['tgl_lahir']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3"><?= htmlspecialchars($data['alamat']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control" value="<?= htmlspecialchars($data['telepon']) ?>">
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

</body>

</html>