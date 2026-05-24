<?php
session_start();

// 1. Data Buku (Minimal 10)
$buku_list = [
    ['kode' => 'B001', 'judul' => 'Pemrograman PHP Modern', 'kategori' => 'Teknologi', 'pengarang' => 'Budi Raharjo', 'penerbit' => 'Informatika', 'tahun' => 2022, 'harga' => 95000, 'stok' => 5],
    ['kode' => 'B002', 'judul' => 'Belajar Laravel 10', 'kategori' => 'Teknologi', 'pengarang' => 'Andi Jaya', 'penerbit' => 'Erlangga', 'tahun' => 2023, 'harga' => 120000, 'stok' => 0],
    ['kode' => 'B003', 'judul' => 'Seni Berbicara', 'kategori' => 'Self Help', 'pengarang' => 'Larry King', 'penerbit' => 'Gramedia', 'tahun' => 2015, 'harga' => 75000, 'stok' => 12],
    ['kode' => 'B004', 'judul' => 'Masakan Nusantara', 'kategori' => 'Kuliner', 'pengarang' => 'Rudy C.', 'penerbit' => 'Buku Kita', 'tahun' => 2020, 'harga' => 85000, 'stok' => 3],
    ['kode' => 'B005', 'judul' => 'Algoritma Pemrograman', 'kategori' => 'Teknologi', 'pengarang' => 'Rinaldi Munir', 'penerbit' => 'Informatika', 'tahun' => 2018, 'harga' => 110000, 'stok' => 8],
    ['kode' => 'B006', 'judul' => 'Psikologi Uang', 'kategori' => 'Finansial', 'pengarang' => 'Morgan Housel', 'penerbit' => 'KPG', 'tahun' => 2021, 'harga' => 98000, 'stok' => 15],
    ['kode' => 'B007', 'judul' => 'Dasar Desain Grafis', 'kategori' => 'Desain', 'pengarang' => 'Suryanto', 'penerbit' => 'Andi Offset', 'tahun' => 2019, 'harga' => 65000, 'stok' => 2],
    ['kode' => 'B008', 'judul' => 'Filosofi Teras', 'kategori' => 'Self Help', 'pengarang' => 'Henry Manampiring', 'penerbit' => 'Kompas', 'tahun' => 2018, 'harga' => 105000, 'stok' => 0],
    ['kode' => 'B009', 'judul' => 'Kecerdasan Buatan', 'kategori' => 'Teknologi', 'pengarang' => 'Suyanto', 'penerbit' => 'Informatika', 'tahun' => 2023, 'harga' => 135000, 'stok' => 4],
    ['kode' => 'B010', 'judul' => 'Investasi Saham', 'kategori' => 'Finansial', 'pengarang' => 'Ryan Filbert', 'penerbit' => 'Elex Media', 'tahun' => 2022, 'harga' => 88000, 'stok' => 10],
    ['kode' => 'B011', 'judul' => 'Web Design Expert', 'kategori' => 'Teknologi', 'pengarang' => 'Monica', 'penerbit' => 'Andi', 'tahun' => 2024, 'harga' => 150000, 'stok' => 7],
];

// 2. Ambil Parameter GET
$keyword = $_GET['keyword'] ?? '';
$kategori = $_GET['kategori'] ?? '';
$min_harga = $_GET['min_harga'] ?? '';
$max_harga = $_GET['max_harga'] ?? '';
$tahun_filter = $_GET['tahun'] ?? '';
$status = $_GET['status'] ?? 'semua';
$sort = $_GET['sort'] ?? 'judul';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;

// 3. Validasi
$errors = [];
if (!empty($min_harga) && !empty($max_harga) && $min_harga > $max_harga) {
    $errors[] = "Harga minimum tidak boleh lebih besar dari harga maksimum.";
}
if (!empty($tahun_filter) && ($tahun_filter < 1900 || $tahun_filter > date('Y'))) {
    $errors[] = "Tahun harus valid (1900 - " . date('Y') . ").";
}

// 4. Proses Filter & Pencarian
$hasil = [];
if (empty($errors)) {
    foreach ($buku_list as $buku) {
        // Filter Keyword (Judul / Pengarang)
        if ($keyword && stripos($buku['judul'], $keyword) === false && stripos($buku['pengarang'], $keyword) === false) continue;
        
        // Filter Kategori
        if ($kategori && $buku['kategori'] !== $kategori) continue;
        
        // Filter Harga
        if ($min_harga !== '' && $buku['harga'] < $min_harga) continue;
        if ($max_harga !== '' && $buku['harga'] > $max_harga) continue;
        
        // Filter Tahun
        if ($tahun_filter !== '' && $buku['tahun'] != $tahun_filter) continue;
        
        // Filter Status
        if ($status === 'tersedia' && $buku['stok'] <= 0) continue;
        if ($status === 'habis' && $buku['stok'] > 0) continue;

        $hasil[] = $buku;
    }

    // 5. Sorting
    usort($hasil, function($a, $b) use ($sort) {
        if ($sort == 'harga') return $a['harga'] <=> $b['harga'];
        if ($sort == 'tahun') return $a['tahun'] <=> $b['tahun'];
        return strcasecmp($a['judul'], $b['judul']);
    });

    // Save Recent Search to Session (Bonus)
    if ($keyword) {
        $_SESSION['recent_searches'][$keyword] = time();
        arsort($_SESSION['recent_searches']);
        $_SESSION['recent_searches'] = array_slice($_SESSION['recent_searches'], 0, 5, true);
    }
}

// 6. Pagination Logic
$total_hasil = count($hasil);
$offset = ($page - 1) * $limit;
$hasil_paginated = array_slice($hasil, $offset, $limit);

// 7. Bonus: Export CSV
if (isset($_GET['export']) && $_GET['export'] == 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="hasil_pencarian.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Kode', 'Judul', 'Kategori', 'Pengarang', 'Penerbit', 'Tahun', 'Harga', 'Stok']);
    foreach ($hasil as $row) fputcsv($output, $row);
    fclose($output);
    exit;
}

// Fungsi Highlight (Bonus)
function highlight($text, $search) {
    if (!$search) return $text;
    return preg_replace('/(' . preg_quote($search, '/') . ')/i', '<span class="bg-warning">$1</span>', $text);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Pencarian Buku Lanjutan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Pencarian Buku Katalog</h2>

    <?php if ($errors): ?>
        <div class="alert alert-danger"><?= implode('<br>', $errors) ?></div>
    <?php endif; ?>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Keyword</label>
                        <input type="text" name="keyword" class="form-control" value="<?= htmlspecialchars($keyword) ?>" placeholder="Judul atau pengarang...">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua</option>
                            <?php 
                            $kats = array_unique(array_column($buku_list, 'kategori'));
                            foreach ($kats as $k) echo "<option value='$k' ".($kategori == $k ? 'selected':'').">$k</option>";
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Harga Min</label>
                        <input type="number" name="min_harga" class="form-control" value="<?= $min_harga ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Harga Max</label>
                        <input type="number" name="max_harga" class="form-control" value="<?= $max_harga ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" class="form-control" value="<?= $tahun_filter ?>" placeholder="Contoh: 2022">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label d-block">Status Ketersediaan</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="semua" <?= $status=='semua'?'checked':'' ?>>
                            <label class="form-check-label">Semua</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="tersedia" <?= $status=='tersedia'?'checked':'' ?>>
                            <label class="form-check-label">Tersedia</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="habis" <?= $status=='habis'?'checked':'' ?>>
                            <label class="form-check-label">Habis</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Urutkan Berdasarkan</label>
                        <select name="sort" class="form-select">
                            <option value="judul" <?= $sort=='judul'?'selected':'' ?>>Judul (A-Z)</option>
                            <option value="harga" <?= $sort=='harga'?'selected':'' ?>>Harga Termurah</option>
                            <option value="tahun" <?= $sort=='tahun'?'selected':'' ?>>Tahun Terbaru</option>
                        </select>
                    </div>

                    <div class="col-md-6 d-flex align-items-end justify-content-end gap-2">
                        <a href="search_advanced.php" class="btn btn-secondary">Reset</a>
                        <button type="submit" class="btn btn-primary px-4">Cari Buku</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Hasil Ditemukan: <span class="badge bg-info text-dark"><?= $total_hasil ?> Buku</span></h5>
        <?php if ($total_hasil > 0): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['export' => 'csv'])) ?>" class="btn btn-success btn-sm">Export to CSV</a>
        <?php endif; ?>
    </div>

    <div class="table-responsive bg-white p-3 rounded shadow-sm">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($hasil_paginated)): ?>
                    <tr><td colspan="7" class="text-center py-4">Data tidak ditemukan.</td></tr>
                <?php else: ?>
                    <?php foreach ($hasil_paginated as $b): ?>
                    <tr>
                        <td><?= $b['kode'] ?></td>
                        <td class="fw-bold"><?= highlight($b['judul'], $keyword) ?></td>
                        <td><span class="badge bg-secondary"><?= $b['kategori'] ?></span></td>
                        <td><?= highlight($b['pengarang'], $keyword) ?></td>
                        <td><?= $b['tahun'] ?></td>
                        <td>Rp <?= number_format($b['harga'], 0, ',', '.') ?></td>
                        <td>
                            <span class="badge <?= $b['stok'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                <?= $b['stok'] > 0 ? $b['stok'] . ' Tersedia' : 'Habis' ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($_SESSION['recent_searches'])): ?>
    <div class="mt-4">
        <small class="text-muted">Pencarian Terakhir: </small>
        <?php foreach ($_SESSION['recent_searches'] as $s => $time): ?>
            <a href="?keyword=<?= urlencode($s) ?>" class="badge rounded-pill bg-light text-dark border text-decoration-none"><?= htmlspecialchars($s) ?></a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</div>
</body>
</html>