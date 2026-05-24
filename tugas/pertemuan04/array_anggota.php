<?php
// 1. Inisialisasi Data Anggota (Minimal 5 data)
$anggota_list = [
    [
        "id" => "AGT-001",
        "nama" => "Budi Santoso",
        "email" => "budi@email.com",
        "telepon" => "081234567890",
        "alamat" => "Jakarta",
        "tanggal_daftar" => "2024-01-15",
        "status" => "Aktif",
        "total_pinjaman" => 12
    ],
    [
        "id" => "AGT-002",
        "nama" => "Siti Aminah",
        "email" => "siti@email.com",
        "telepon" => "081299887766",
        "alamat" => "Bandung",
        "tanggal_daftar" => "2024-02-10",
        "status" => "Aktif",
        "total_pinjaman" => 8
    ],
    [
        "id" => "AGT-003",
        "nama" => "Andi Wijaya",
        "email" => "andi@email.com",
        "telepon" => "085511223344",
        "alamat" => "Surabaya",
        "tanggal_daftar" => "2023-11-20",
        "status" => "Non-Aktif",
        "total_pinjaman" => 2
    ],
    [
        "id" => "AGT-004",
        "nama" => "Dewi Lestari",
        "email" => "dewi@email.com",
        "telepon" => "087766554433",
        "alamat" => "Yogyakarta",
        "tanggal_daftar" => "2024-03-05",
        "status" => "Aktif",
        "total_pinjaman" => 15
    ],
    [
        "id" => "AGT-005",
        "nama" => "Rizky Pratama",
        "email" => "rizky@email.com",
        "telepon" => "081122334455",
        "alamat" => "Semarang",
        "tanggal_daftar" => "2023-09-12",
        "status" => "Non-Aktif",
        "total_pinjaman" => 4
    ]
];

// 2. Logika Perhitungan Statistik
$total_anggota = count($anggota_list);
$aktif = 0;
$non_aktif = 0;
$total_seluruh_pinjaman = 0;
$anggota_teraktif = $anggota_list[0];

foreach ($anggota_list as $agt) {
    // Hitung status
    if ($agt['status'] == "Aktif") {
        $aktif++;
    } else {
        $non_aktif++;
    }

    // Hitung total pinjaman untuk rata-rata
    $total_seluruh_pinjaman += $agt['total_pinjaman'];

    // Cari anggota teraktif
    if ($agt['total_pinjaman'] > $anggota_teraktif['total_pinjaman']) {
        $anggota_teraktif = $agt;
    }
}

$persen_aktif = ($aktif / $total_anggota) * 100;
$persen_non_aktif = ($non_aktif / $total_anggota) * 100;
$rata_rata_pinjaman = $total_seluruh_pinjaman / $total_anggota;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Dashboard Anggota Perpustakaan</h2>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body text-center">
                    <h6>Total Anggota</h6>
                    <h3><?= $total_anggota ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body text-center">
                    <h6>Aktif (%)</h6>
                    <h3><?= $persen_aktif ?>%</h3>
                    <small><?= $aktif ?> Orang</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white shadow-sm">
                <div class="card-body text-center">
                    <h6>Non-Aktif (%)</h6>
                    <h3><?= $persen_non_aktif ?>%</h3>
                    <small><?= $non_aktif ?> Orang</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark shadow-sm">
                <div class="card-body text-center">
                    <h6>Rata-rata Pinjaman</h6>
                    <h3><?= number_format($rata_rata_pinjaman, 1) ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-info shadow-sm mb-4">
        <strong>🔥 Anggota Teraktif:</strong> <?= $anggota_teraktif['nama'] ?> 
        dengan total <strong><?= $anggota_teraktif['total_pinjaman'] ?></strong> buku dipinjam.
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Daftar Seluruh Anggota</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Tgl Daftar</th>
                            <th>Status</th>
                            <th class="text-center">Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($anggota_list as $anggota) : ?>
                        <tr>
                            <td><code><?= $anggota['id'] ?></code></td>
                            <td><strong><?= $anggota['nama'] ?></strong></td>
                            <td><?= $anggota['email'] ?></td>
                            <td><?= $anggota['telepon'] ?></td>
                            <td><?= $anggota['alamat'] ?></td>
                            <td><?= date('d/m/Y', strtotime($anggota['tanggal_daftar'])) ?></td>
                            <td>
                                <span class="badge <?= $anggota['status'] == 'Aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $anggota['status'] ?>
                                </span>
                            </td>
                            <td class="text-center"><?= $anggota['total_pinjaman'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>