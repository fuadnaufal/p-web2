<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Ketersediaan Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-search"></i> Cek Ketersediaan Buku</h1>
        
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
            
            // Batasi denda maksimum Rp 50.000
            if ($total_denda > 50000) {
                $total_denda = 50000;
            }
        }

        // --- Logika Bisnis: Cek Status Peminjaman (IF-ELSEIF-ELSE) ---
        $status_pesan = "";
        $boleh_pinjam = true;

        if ($buku_terlambat > 0) {
            $status_pesan = "Tidak bisa pinjam (Ada buku yang terlambat dikembalikan).";
            $boleh_pinjam = false;
        } elseif ($total_pinjaman >= 3) {
            $status_pesan = "Tidak bisa pinjam (Limit maksimal 3 buku tercapai).";
            $boleh_pinjam = false;
        } else {
            $status_pesan = "Boleh meminjam buku lagi.";
            $boleh_pinjam = true;
        }

        // --- Logika Bisnis: Level Member (SWITCH) ---
        // Karena Switch di PHP biasanya membandingkan nilai spesifik, 
        // kita gunakan switch(true) untuk mengevaluasi range (rentang).
        $level_member = "";
        switch (true) {
            case ($total_pinjaman >= 0 && $total_pinjaman <= 5):
                $level_member = "Perunggu";
                break;
            case ($total_pinjaman >= 6 && $total_pinjaman <= 15):
                $level_member = "Perak";
                break;
            case ($total_pinjaman > 15):
                $level_member = "Emas";
                break;
            default:
                $level_member = "Tidak Terdefinisi";
        }

        // --- Output Tampilan ---
        echo "<h2>Informasi Anggota Perpustakaan</h2>";
        echo "Nama Anggota: <b>$nama_anggota</b> <br>";
        echo "Total Pinjaman Aktif: $total_pinjaman buku <br>";
        echo "Level Member: <b>$level_member</b> <br>";

        echo "<h3>Status Peminjaman Saat Ini</h3>";
        echo "Status: $status_pesan <br>";

        if ($buku_terlambat > 0) {
            echo "<p style='color: red;'>";
            echo "⚠️ <b>PERINGATAN:</b> Anda memiliki $buku_terlambat buku yang terlambat!<br>";
            echo "Total Denda: Rp " . number_format($total_denda, 0, ',', '.');
            echo "</p>";
        } else {
            echo "<p style='color: green;'>Anda tidak memiliki tunggakan denda.</p>";
        }
        ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>