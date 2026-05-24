<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Informasi Buku</h1>

        <?php
        // Data buku 1
        $judul1 = "Laravel: From Beginner to Advanced";
        $pengarang1 = "Budi Raharjo";
        $penerbit1 = "Informatika";
        $tahun_terbit1 = 2023;
        $kategori_buku1 = "Programming";
        $bahasa1 = "Inggris";
        $jumlah_halaman1 = 256;
        $berat_buku1 = 1; // Kg
        $harga1 = 125000;
        $stok1 = 8;
        $isbn1 = "978-602-1234-56-7";

        // Data buku 2
        $judul2 = "Sistem Basis Data: Perancangan dan Data Definition Languange MySQL & Oracle";
        $pengarang2 = "Fetty Try Anggreany, Faisal Muttaqin";
        $penerbit2 = "Indomedia Pustaka";
        $tahun_terbit2 = 2021;
        $kategori_buku2 = "Basis Data";
        $bahasa2 = "Bahasa Indonesia";
        $jumlah_halaman2 = 220;
        $berat_buku2 = 0.56; // Kg
        $harga2 = 99000;
        $stok2 = 156;
        $isbn2 = "978-623-7889-72-4";

         // Data buku 3
        $judul3 = "Logika Algoritma dan Pemrograman Dasar";
        $pengarang3 = "Rosa A. S.";
        $penerbit3 = "Modula";
        $tahun_terbit3 = 2018;
        $kategori_buku3 = "Programming";
        $bahasa3 = "Bahasa Indonesia";
        $jumlah_halaman3 = 866;
        $berat_buku3 = 1.05; // Kg
        $harga3 = 162000;
        $stok3 = 6;
        $isbn3 = "9786028759427";
        ?>
        
        
        <div class="row">

            <!-- Buku 1 -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5><?php echo $judul1; ?></h5>
                    </div>
                    <div class="card-body">
                        <span class="badge bg-success mb-2"><?php echo $kategori_buku1; ?></span>
                        <table class="table table-sm">
                            <tr>
                                <th width="200">Pengarang</th>
                                <td>: <?php echo $pengarang1; ?></td>
                            </tr>
                            <tr>
                                <th>Penerbit</th>
                                <td>: <?php echo $penerbit1; ?></td>
                            </tr>
                            <tr>
                                <th>Tahun Terbit</th>
                                <td>: <?php echo $tahun_terbit1; ?></td>
                            </tr>
                            <tr>
                                <th>Kategori Buku</th>
                                <td>: <?php echo $kategori_buku1; ?></td>
                            </tr>
                            <tr>
                                <th>Bahasa</th>
                                <td>: <?php echo $bahasa1; ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Halaman</th>
                                <td>: <?php echo $jumlah_halaman1; ?></td>
                            </tr>
                            <tr>
                                <th>Berat Buku</th>
                                <td>: <?php echo $berat_buku1 * 1000; ?> gram</td>
                            </tr>
                            <tr>
                                <th>ISBN</th>
                                <td>: <?php echo $isbn1; ?></td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>: Rp <?php echo number_format($harga1, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td>: <?php echo $stok1; ?> buku</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        
        
            <!-- Buku 2 -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5><?php echo $judul2; ?></h5>
                    </div>
                    <div class="card-body">
                        <span class="badge bg-primary text-white mb-2"><?php echo $kategori_buku2; ?></span>
                        <table class="table table-sm">
                            <tr>
                                <th width="200">Pengarang</th>
                                <td>: <?php echo $pengarang2; ?></td>
                            </tr>
                            <tr>
                                <th>Penerbit</th>
                                <td>: <?php echo $penerbit2; ?></td>
                            </tr>
                            <tr>
                                <th>Tahun Terbit</th>
                                <td>: <?php echo $tahun_terbit2; ?></td>
                            </tr>
                            <tr>
                                <th>Kategori Buku</th>
                                <td>: <?php echo $kategori_buku2; ?></td>
                            </tr>
                            <tr>
                                <th>Bahasa</th>
                                <td>: <?php echo $bahasa2; ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Halaman</th>
                                <td>: <?php echo $jumlah_halaman2; ?></td>
                            </tr>
                            <tr>
                                <th>Berat Buku</th>
                                <td>: <?php echo $berat_buku2  * 1000; ?> gram</td>
                            </tr>
                            <tr>
                                <th>ISBN</th>
                                <td>: <?php echo $isbn2; ?></td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>: Rp <?php echo number_format($harga2, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td>: <?php echo $stok2; ?> buku</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        

            <!-- Buku 3 -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5><?php echo $judul3; ?></h5>
                    </div>
                    <div class="card-body">
                        <span class="badge bg-success mb-2"><?php echo $kategori_buku3; ?></span>
                        <table class="table table-sm">
                            <tr>
                                <th width="200">Pengarang</th>
                                <td>: <?php echo $pengarang3; ?></td>
                            </tr>
                            <tr>
                                <th>Penerbit</th>
                                <td>: <?php echo $penerbit3; ?></td>
                            </tr>
                            <tr>
                                <th>Tahun Terbit</th>
                                <td>: <?php echo $tahun_terbit3; ?></td>
                            </tr>
                            <tr>
                                <th>Kategori Buku</th>
                                <td>: <?php echo $kategori_buku3; ?></td>
                            </tr>
                            <tr>
                                <th>Bahasa</th>
                                <td>: <?php echo $bahasa3; ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Halaman</th>
                                <td>: <?php echo $jumlah_halaman3; ?></td>
                            </tr>
                            <tr>
                                <th>Berat Buku</th>
                                <td>: <?php echo $berat_buku3 * 1000; ?> gram</td>
                            </tr>
                            <tr>
                                <th>ISBN</th>
                                <td>: <?php echo $isbn3; ?></td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>: Rp <?php echo number_format($harga3, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td>: <?php echo $stok3; ?> buku</td>
                            </tr>
                        </table>
                    </div>
                </div>            
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>