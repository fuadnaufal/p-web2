<?php
// Inisialisasi variabel untuk menampung input dan pesan error
$errors = [];
$success = false;
$data = [
    'nama' => '', 'email' => '', 'telepon' => '', 
    'alamat' => '', 'gender' => '', 'tgl_lahir' => '', 'pekerjaan' => ''
];

// Logika Validasi saat Form di-Submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dan bersihkan dari karakter berbahaya
    foreach ($data as $key => $val) {
        $data[$key] = trim($_POST[$key] ?? '');
    }

    // 1. Validasi Nama
    if (empty($data['nama'])) {
        $errors['nama'] = "Nama lengkap wajib diisi.";
    } elseif (strlen($data['nama']) < 3) {
        $errors['nama'] = "Nama minimal 3 karakter.";
    }

    // 2. Validasi Email
    if (empty($data['email'])) {
        $errors['email'] = "Email wajib diisi.";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid.";
    }

    // 3. Validasi Telepon (08xxxxxxxxxx, 10-13 digit)
    if (empty($data['telepon'])) {
        $errors['telepon'] = "Nomor telepon wajib diisi.";
    } elseif (!preg_match("/^08[0-9]{8,11}$/", $data['telepon'])) {
        $errors['telepon'] = "Format telepon salah (08...) dan harus 10-13 digit.";
    }

    // 4. Validasi Alamat
    if (empty($data['alamat'])) {
        $errors['alamat'] = "Alamat wajib diisi.";
    } elseif (strlen($data['alamat']) < 10) {
        $errors['alamat'] = "Alamat minimal 10 karakter.";
    }

    // 5. Validasi Jenis Kelamin
    if (empty($data['gender'])) {
        $errors['gender'] = "Pilih jenis kelamin.";
    }

    // 6. Validasi Tanggal Lahir (Min 10 Tahun)
    if (empty($data['tgl_lahir'])) {
        $errors['tgl_lahir'] = "Tanggal lahir wajib diisi.";
    } else {
        $lahir = new DateTime($data['tgl_lahir']);
        $sekarang = new DateTime();
        $umur = $sekarang->diff($lahir)->y;
        if ($umur < 10) {
            $errors['tgl_lahir'] = "Umur minimal harus 10 tahun.";
        }
    }

    // 7. Validasi Pekerjaan
    if (empty($data['pekerjaan'])) {
        $errors['pekerjaan'] = "Pilih pekerjaan.";
    }

    // Jika tidak ada error
    if (count($errors) == 0) {
        $success = true;
    }
}

// Fungsi bantu untuk class CSS Bootstrap
function getValidationClass($field, $errors) {
    if ($_SERVER["REQUEST_METHOD"] != "POST") return "";
    return isset($errors[$field]) ? "is-invalid" : "is-valid";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding-top: 50px; }
        .card { box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            
            <?php if ($success): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> Anggota baru telah terdaftar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>

                <div class="card mb-4 border-success">
                    <div class="card-header bg-success text-white">Data Registrasi Berhasil</div>
                    <div class="card-body">
                        <table class="table table-sm mb-0">
                            <tr><th>Nama</th><td>: <?= htmlspecialchars($data['nama']) ?></td></tr>
                            <tr><th>Email</th><td>: <?= htmlspecialchars($data['email']) ?></td></tr>
                            <tr><th>Telepon</th><td>: <?= htmlspecialchars($data['telepon']) ?></td></tr>
                            <tr><th>Alamat</th><td>: <?= nl2br(htmlspecialchars($data['alamat'])) ?></td></tr>
                            <tr><th>Gender</th><td>: <?= $data['gender'] ?></td></tr>
                            <tr><th>Tgl Lahir</th><td>: <?= $data['tgl_lahir'] ?></td></tr>
                            <tr><th>Pekerjaan</th><td>: <?= $data['pekerjaan'] ?></td></tr>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Form Registrasi Anggota</h4>
                </div>
                <div class="card-body p-4">
                    <form action="" method="POST" novalidate>
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control <?= getValidationClass('nama', $errors) ?>" 
                                   value="<?= htmlspecialchars($data['nama']) ?>" placeholder="Min 3 karakter">
                            <div class="invalid-feedback"><?= $errors['nama'] ?? '' ?></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control <?= getValidationClass('email', $errors) ?>" 
                                       value="<?= htmlspecialchars($data['email']) ?>" placeholder="nama@email.com">
                                <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Telepon</label>
                                <input type="text" name="telepon" class="form-control <?= getValidationClass('telepon', $errors) ?>" 
                                       value="<?= htmlspecialchars($data['telepon']) ?>" placeholder="08xxxxxxxxxx">
                                <div class="invalid-feedback"><?= $errors['telepon'] ?? '' ?></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control <?= getValidationClass('alamat', $errors) ?>" 
                                      rows="3"><?= htmlspecialchars($data['alamat']) ?></textarea>
                            <div class="invalid-feedback"><?= $errors['alamat'] ?? '' ?></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label d-block">Jenis Kelamin</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input <?= isset($errors['gender']) ? 'is-invalid' : '' ?>" type="radio" name="gender" 
                                           id="l" value="Laki-laki" <?= $data['gender'] == 'Laki-laki' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="l">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input <?= isset($errors['gender']) ? 'is-invalid' : '' ?>" type="radio" name="gender" 
                                           id="p" value="Perempuan" <?= $data['gender'] == 'Perempuan' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="p">Perempuan</label>
                                </div>
                                <div class="text-danger small mt-1" style="font-size: 0.875em;"><?= $errors['gender'] ?? '' ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control <?= getValidationClass('tgl_lahir', $errors) ?>" 
                                       value="<?= $data['tgl_lahir'] ?>">
                                <div class="invalid-feedback"><?= $errors['tgl_lahir'] ?? '' ?></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Pekerjaan</label>
                            <select name="pekerjaan" class="form-select <?= getValidationClass('pekerjaan', $errors) ?>">
                                <option value="">-- Pilih Pekerjaan --</option>
                                <?php 
                                $opsi = ['Pelajar', 'Mahasiswa', 'Pegawai', 'Lainnya'];
                                foreach ($opsi as $o) {
                                    $selected = ($data['pekerjaan'] == $o) ? 'selected' : '';
                                    echo "<option value=\"$o\" $selected>$o</option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback"><?= $errors['pekerjaan'] ?? '' ?></div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Daftar Anggota</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>