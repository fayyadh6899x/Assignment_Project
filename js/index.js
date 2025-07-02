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

    if (nim === "" || nama === "" || jurusan === "" || tgl_lahir === "" || jenis_kelamin === "" || alamat === "" || email === "" || telepon === "") {
        alert("Semua kolom wajib diisi!");
        return false;
    }
    
    if (isNaN(nim)) {
        alert("NIM harus berupa angka!");
        return false;
    }
    
    const emailPattern = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Format email tidak valid!");
        return false;
  }

    if (isNaN(telepon)) {
        alert("Nomor telepon harus berupa angka!");
        return false;
    }

    if (telepon.length < 10) {
        alert("Nomor telepon minimal 10 digit!");
        return false;
    }

    return true;
}

function confirmDelete(name) {
    return confirm(`Hapus data mahasiswa \"${name}\"?`);
}

