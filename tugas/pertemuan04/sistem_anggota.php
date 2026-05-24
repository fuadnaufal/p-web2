<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <?php
    require_once 'functions_anggota.php';
    
    $anggota_list = [
        ["id" => "AGT-001", "nama" => "Budi Santoso", "email" => "budi@email.com", "telepon" => "081234567890", "alamat" => "Jakarta", "tanggal_daftar" => "2024-01-15", "status" => "Aktif", "total_pinjaman" => 12],
        ["id" => "AGT-002", "nama" => "Siti Aminah", "email" => "siti@email.com", "telepon" => "081299887766", "alamat" => "Bandung", "tanggal_daftar" => "2024-02-10", "status" => "Aktif", "total_pinjaman" => 8],
        ["id" => "AGT-003", "nama" => "Andi Wijaya", "email" => "andi@email.com", "telepon" => "085511223344", "alamat" => "Surabaya", "tanggal_daftar" => "2023-11-20", "status" => "Non-Aktif", "total_pinjaman" => 2],
        ["id" => "AGT-004", "nama" => "Dewi Lestari", "email" => "dewi@email.com", "telepon" => "087766554433", "alamat" => "Yogya", "tanggal_daftar" => "2024-03-05", "status" => "Aktif", "total_pinjaman" => 15],
        ["id" => "AGT-005", "nama" => "Rizky Pratama", "email" => "rizky@email.com", "telepon" => "081122334455", "alamat" => "Semarang", "tanggal_daftar" => "2023-09-12", "status" => "Non-Aktif", "total_pinjaman" => 4]
    ];

    // Implementasi Bonus: Sorting A-Z
    urutkan_anggota_by_nama($anggota_list);

    // Variabel Statistik
    $total = hitung_total_anggota($anggota_list);
    $aktif_count = hitung_anggota_aktif($anggota_list);
    $rata_rata = hitung_rata_rata_pinjaman($anggota_list);
    $teraktif = cari_anggota_teraktif($anggota_list);
    ?>
    
    <div class="container mt-5">
        <h1 class="mb-4 text-primary"><i class="bi bi-book-half"></i> Library Member System</h1>
        
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center p-3">
                    <h6 class="text-muted">Total Anggota</h6>
                    <h2 class="fw-bold"><?= $total ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center p-3">
                    <h6 class="text-muted">Anggota Aktif</h6>
                    <h2 class="fw-bold text-success"><?= $aktif_count ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center p-3">
                    <h6 class="text-muted">Rata-rata Pinjaman</h6>
                    <h2 class="fw-bold text-info"><?= number_format($rata_rata, 1) ?></h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Semua Anggota (Sorted A-Z)</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Tgl Daftar</th>
                                    <th class="text-center">Pinjaman</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($anggota_list as $agt): ?>
                                <tr>
                                    <td>
                                        <strong><?= $agt['nama'] ?></strong><br>
                                        <small class="text-muted"><?= $agt['email'] ?></small>
                                    </td>
                                    <td>
                                        <span class="badge <?= $agt['status'] == 'Aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                            <?= $agt['status'] ?>
                                        </span>
                                    </td>
                                    <td><small><?= format_tanggal_indo($agt['tanggal_daftar']) ?></small></td>
                                    <td class="text-center"><?= $agt['total_pinjaman'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-star-fill"></i> Anggota Teraktif</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="display-6 text-warning mb-2"><i class="bi bi-trophy"></i></div>
                        <h4><?= $teraktif['nama'] ?></h4>
                        <p class="text-muted mb-0">Total Pinjaman:</p>
                        <h3 class="fw-bold"><?= $teraktif['total_pinjaman'] ?> Buku</h3>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h6><i class="bi bi-check-circle-fill text-success"></i> Anggota Aktif</h6>
                        <ul class="list-unstyled small">
                            <?php foreach(filter_by_status($anggota_list, 'Aktif') as $a): ?>
                                <li>• <?= $a['nama'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <hr>
                        <h6><i class="bi bi-x-circle-fill text-danger"></i> Non-Aktif</h6>
                        <ul class="list-unstyled small">
                            <?php foreach(filter_by_status($anggota_list, 'Non-Aktif') as $a): ?>
                                <li>• <?= $a['nama'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>