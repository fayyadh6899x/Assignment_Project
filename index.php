
<?php
require 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Mahasiswa</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light fade-in">

    <div class="container mt-5">
        <h1 class="mb-4 text-center"><i class="fa-solid fa-database me-2"></i>Data Mahasiswa</h1>

        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p>Halo, <strong><i class="fa-solid fa-user me-1"></i><?= $_SESSION['username'] ?></strong></p>
                <div>
                    <a href="create.php" class="btn btn-primary me-2"><i class="fa-solid fa-plus"></i> Tambah Mahasiswa</a>
                    <a href="logout.php" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
            </div>
        <?php else: ?>
            <div class="mb-3">
                <a href="login.php" class="btn btn-success me-2"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                <a href="register.php" class="btn btn-secondary"><i class="fa-solid fa-user-plus"></i> Register</a>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Foto</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = $conn->query("SELECT * FROM mahasiswa");
                    while ($row = $res->fetch_assoc()):
                    ?>
                        <tr>
                            <td>
                                <?php if (!empty($row['foto'])): ?>
                                    <img src="<?= htmlspecialchars($row['foto']) ?>" width="80" height="80" class="rounded-circle" style="object-fit:cover;">
                                <?php else: ?>
                                    <span class="text-muted"><i class="fa-solid fa-image me-1"></i>Tidak Ada Foto</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($row['nim']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['jurusan']) ?></td>
                            <td><?= htmlspecialchars($row['tgl_lahir']) ?></td>
                            <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['telepon']) ?></td>
                            <td>
                                <?php if (isset($_SESSION['login'])): ?>
                                    <a href="edit.php?nim=<?= urlencode($row['nim']) ?>" class="btn btn-warning btn-sm mb-2">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="delete.php?nim=<?= urlencode($row['nim']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus <?= addslashes($row['nama']) ?>?')">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted"><i class="fa-solid fa-lock me-1"></i>Login untuk edit/hapus</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; $res->free(); ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>

