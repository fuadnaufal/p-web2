<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Peminjaman Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .card-header { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-person-badge"></i> Status Peminjaman Anggota</h1>
        
        <?php
        // --- Data Anggota ---
        $nama_anggota = "Budi Santoso";
        $total_pinjaman = 2;
        $buku_terlambat = 1;
        $hari_keterlambatan = 5; // hari

        // --- Logika Bisnis: Perhitungan Denda (IF-ELSE) ---
        $biaya_per_hari = 1000;
        $total_denda = 0;

        if ($buku_terlambat > 0) {
            $total_denda = $buku_terlambat * $hari_keterlambatan * $biaya_per_hari;
            if ($total_denda > 50000) { $total_denda = 50000; }
        }

        // --- Logika Bisnis: Cek Status Peminjaman (IF-ELSEIF-ELSE) ---
        $status_pesan = "";
        $boleh_pinjam = true;
        $status_color = "success";
        $status_icon = "check-circle";

        if ($buku_terlambat > 0) {
            $status_pesan = "Tidak bisa pinjam (Ada buku yang terlambat dikembalikan).";
            $boleh_pinjam = false;
            $status_color = "danger";
            $status_icon = "x-circle";
        } elseif ($total_pinjaman >= 3) {
            $status_pesan = "Tidak bisa pinjam (Limit maksimal 3 buku tercapai).";
            $boleh_pinjam = false;
            $status_color = "warning";
            $status_icon = "exclamation-triangle";
        } else {
            $status_pesan = "Buku dapat dipinjam kembali.";
            $boleh_pinjam = true;
            $status_color = "success";
            $status_icon = "check-circle";
        }

        // --- Logika Bisnis: Level Member (SWITCH) ---
        $level_member = "";
        $badge_color = "";
        switch (true) {
            case ($total_pinjaman >= 0 && $total_pinjaman <= 5):
                $level_member = "Perunggu";
                $badge_color = "secondary";
                break;
            case ($total_pinjaman >= 6 && $total_pinjaman <= 15):
                $level_member = "Perak";
                $badge_color = "info";
                break;
            case ($total_pinjaman > 15):
                $level_member = "Emas";
                $badge_color = "warning text-dark";
                break;
            default:
                $level_member = "Tidak Terdefinisi";
                $badge_color = "dark";
        }
        ?>

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Anggota: <?php echo $nama_anggota; ?></h5>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <p><strong>Nama Anggota:</strong> <?php echo $nama_anggota; ?></p>
                        <p><strong>Total Pinjaman Aktif:</strong> <?php echo $total_pinjaman; ?> buku</p>
                        <p><strong>Level Member:</strong> <span class="badge bg-<?php echo $badge_color; ?>"><?php echo $level_member; ?></span></p>
                        
                        <hr>
                        
                        <p>
                            <strong>Status Peminjaman:</strong> 
                            <span class="badge bg-<?php echo $status_color; ?>">
                                <i class="bi bi-<?php echo $status_icon; ?>"></i> 
                                <?php echo ($boleh_pinjam) ? "Tersedia" : "Ditangguhkan"; ?>
                            </span>
                        </p>
                        <p class="text-muted"><em><?php echo $status_pesan; ?></em></p>
                    </div>
                    
                    <div class="col-md-4 text-end">
                        <?php if ($boleh_pinjam): ?>
                            <button class="btn btn-success btn-lg">
                                <i class="bi bi-cart-plus"></i> Pinjam Buku
                            </button>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-lg" disabled>
                                <i class="bi bi-lock"></i> Tidak Bisa Pinjam
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($buku_terlambat > 0): ?>
            <div class="alert alert-danger shadow-sm" role="alert">
                <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Peringatan Keterlambatan!</h4>
                <p>Anda memiliki <strong><?php echo $buku_terlambat; ?> buku</strong> yang terlambat dikembalikan selama <strong><?php echo $hari_keterlambatan; ?> hari</strong>.</p>
                <hr>
                <p class="mb-0">Total Denda yang harus dibayar: <strong>Rp <?php echo number_format($total_denda, 0, ',', '.'); ?></strong></p>
            </div>
        <?php else: ?>
            <div class="alert alert-success shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill"></i> Anda tidak memiliki tunggakan denda. Terima kasih telah mematuhi aturan perpustakaan.
            </div>
        <?php endif; ?>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>