<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4 text-primary"><i class="bi bi-journal-text"></i> Daftar Transaksi Peminjaman</h1>
        
        <?php
        // Inisialisasi variabel statistik
        $total_tampil = 0;
        $total_dipinjam = 0;
        $total_dikembalikan = 0;
        
        // Loop pertama untuk hitung statistik (mengikuti aturan filter yang sama dengan tabel)
        for ($i = 1; $i <= 10; $i++) {
            // Aturan 1: Skip transaksi genap
            if ($i % 2 == 0) continue;
            
            // Aturan 2: Stop di transaksi ke-8
            if ($i > 8) break;

            $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";
            
            $total_tampil++;
            if ($status == "Dipinjam") {
                $total_dipinjam++;
            } else {
                $total_dikembalikan++;
            }
        }
        ?>
        
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white shadow-sm">
                    <div class="card-body text-center">
                        <h6>Total Transaksi Tampil</h6>
                        <h2><?php echo $total_tampil; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-dark shadow-sm">
                    <div class="card-body text-center">
                        <h6>Masih Dipinjam</h6>
                        <h2><?php echo $total_dipinjam; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white shadow-sm">
                    <div class="card-body text-center">
                        <h6>Sudah Dikembalikan</h6>
                        <h2><?php echo $total_dikembalikan; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Peminjam</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Durasi (Hari)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor_urut = 1;
                        for ($i = 1; $i <= 10; $i++) {
                            // 1. Skip transaksi genap (Anggota 2, 4, 6, dst tidak muncul)
                            if ($i % 2 == 0) {
                                continue;
                            }

                            // 2. Stop di transaksi ke-8 (Loop berhenti sepenuhnya jika $i > 8)
                            if ($i > 8) {
                                break;
                            }

                            // Generate data transaksi
                            $id_transaksi = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                            $nama_peminjam = "Anggota " . $i;
                            $judul_buku = "Buku Teknologi Vol. " . $i;
                            $tanggal_pinjam = date('Y-m-d', strtotime("-$i days"));
                            $tanggal_kembali = date('Y-m-d', strtotime("+7 days", strtotime($tanggal_pinjam)));
                            $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";
                            
                            // Hitung jumlah hari sejak pinjam hingga hari ini
                            $tgl_sekarang = time();
                            $tgl_pinjam_unix = strtotime($tanggal_pinjam);
                            $selisih_detik = $tgl_sekarang - $tgl_pinjam_unix;
                            $jumlah_hari = floor($selisih_detik / (60 * 60 * 24));

                            // Tentukan warna badge
                            $badge_class = ($status == "Dikembalikan") ? "bg-success" : "bg-warning text-dark";
                            ?>
                            <tr>
                                <td><?php echo $nomor_urut++; ?></td>
                                <td><code><?php echo $id_transaksi; ?></code></td>
                                <td><?php echo $nama_peminjam; ?></td>
                                <td><?php echo $judul_buku; ?></td>
                                <td><?php echo $tanggal_pinjam; ?></td>
                                <td><?php echo $tanggal_kembali; ?></td>
                                <td><?php echo $jumlah_hari; ?> Hari</td>
                                <td>
                                    <span class="badge <?php echo $badge_class; ?>">
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-3 text-muted small">
            * Menampilkan transaksi ganjil saja (Continue) dan membatasi hingga indeks ke-8 (Break).
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>