

function validateForm() {


    const form = document.forms["mahasiswaForm"];

    const nim = form["nim"].value.trim();
    const nama = form["nama"].value.trim();
    const jurusan = form["jurusan"].value.trim();
    const tgl_lahir = form["tgl_lahir"].value.trim();
    const jenis_kelamin = form["jenis_kelamin"].value;
    const alamat = form["alamat"].value.trim();
    const email = form["email"].value.trim();
    const telepon = form["telepon"].value.trim();

      if (!nim || !nama || !jurusan || !tgl_lahir || !jenis_kelamin || !alamat || !email || !telepon) {
        showAlert("Semua kolom wajib diisi!");
        return false;
    }

    // Validasi NIM angka
    if (isNaN(nim)) {
        showAlert("NIM harus berupa angka!");
        return false;
    }

    // Validasi nomor telepon angka
    if (isNaN(telepon)) {
        showAlert("Nomor telepon harus berupa angka!");
        return false;
    }

    return true;
}


function confirmDelete(name) {
    return confirm(`Hapus data mahasiswa "${name}"?`);
}
