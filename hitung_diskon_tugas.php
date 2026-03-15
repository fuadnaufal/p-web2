<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Diskon - Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Sistem Perhitungan Diskon Bertingkat</h1>
        
        <?php
        // TODO: Isi data pembeli dan buku di sini
        $nama_pembeli = "Budi Santoso";
        $judul_buku = "Laravel Advanced";
        $harga_satuan = 150000;
        $jumlah_beli = 4;
        $is_member = true; // true atau false
        
        // TODO: Hitung subtotal
        $subtotal = $harga_satuan * $jumlah_beli; 
        
        // TODO: Tentukan persentase diskon berdasarkan jumlah
        if ($jumlah_beli >= 1 && $jumlah_beli <= 2) {
            $persentase_diskon = 0;
        } elseif ($jumlah_beli >= 3 && $jumlah_beli <= 5) {
            $persentase_diskon = 0.10;
        } elseif ($jumlah_beli >= 6 && $jumlah_beli <= 10) {
            $persentase_diskon = 0.15;
        } else {
            $persentase_diskon = 0.20;
        };
        
        // TODO: Hitung diskon
        $diskon = $subtotal * $persentase_diskon;
        
        // TODO: Total setelah diskon pertama
        $total_setelah_diskon1 = $subtotal - $diskon;
        
        // TODO: Hitung diskon member jika member
        $diskon_member = 0;
        if ($is_member) {
            $diskon_member = $total_setelah_diskon1 * 0.05;
        }
        
        // TODO: Total setelah semua diskon
        $total_setelah_diskon = $total_setelah_diskon1 - $diskon_member;
        
        // TODO: Hitung PPN
        $ppn = $total_setelah_diskon * 0.11;
        
        // TODO: Total akhir
        $total_akhir = $total_setelah_diskon + $ppn;
        
        // TODO: Total penghematan
        $total_hemat = $diskon + $diskon_member;
        ?>
        
        <!-- TODO: Tampilkan hasil perhitungan dengan Bootstrap -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5>Detail Pembelian</h5>
            </div>
            <div class="card-body">
                <span class="badge bg-success mb-3">
                    <?php echo $is_member ? "Member" : "Non Member"; ?>
                </span>

                <!-- Gunakan card, table, dan badge -->
                <table class="table table-bordered">
                    <tr>
                        <th width="250">Nama Pembeli</th>
                        <td><?php echo $nama_pembeli; ?></td>
                    </tr>
                    <tr>
                        <th>Judul Buku</th>
                        <td><?php echo $judul_buku; ?></td>
                    </tr>
                    <tr>
                        <th>Harga Satuan</th>
                        <td>Rp <?php echo number_format($harga_satuan,0,",","."); ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Beli</th>
                        <td><?php echo $jumlah_beli; ?> buku</td>
                    </tr>
                    <tr>
                        <th>Subtotal</th>
                        <td>Rp <?php echo number_format($subtotal,0,",","."); ?></td>
                    </tr>
                    <tr class="table-warning">
                        <th>Diskon (<?php echo $persentase_diskon*100; ?>%)</th>
                        <td>- Rp <?php echo number_format($diskon,0,",","."); ?></td>
                    </tr>

                    <?php if($is_member){ ?>
                        <tr class="table-info">
                            <th>Diskon Member (5%)</th>
                            <td>- Rp <?php echo number_format($diskon_member,0,",","."); ?></td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <th>Total Setelah Diskon</th>
                        <td>Rp <?php echo number_format($total_setelah_diskon,0,",","."); ?></td>
                    </tr>
                    <tr>
                        <th>PPN 11%</th>
                        <td>Rp <?php echo number_format($ppn,0,",","."); ?></td>
                    </tr>
                    <tr class="table-success">
                        <th>Total Akhir</th>
                        <td><strong>Rp <?php echo number_format($total_akhir,0,",","."); ?></strong></td>
                    </tr>
                    <tr class="table-secondary">
                        <th>Total Penghematan</th>
                        <td>Rp <?php echo number_format($total_hemat,0,",","."); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>