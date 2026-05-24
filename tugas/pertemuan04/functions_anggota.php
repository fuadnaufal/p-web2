<?php
// 1. Function untuk hitung total anggota
function hitung_total_anggota($anggota_list) {
    return count($anggota_list);
}

// 2. Function untuk hitung anggota aktif
function hitung_anggota_aktif($anggota_list) {
    $count = 0;
    foreach ($anggota_list as $agt) {
        if (strtolower($agt['status']) === "aktif") $count++;
    }
    return $count;
}

// 3. Function untuk hitung rata-rata pinjaman
function hitung_rata_rata_pinjaman($anggota_list) {
    if (empty($anggota_list)) return 0;
    $total = 0;
    foreach ($anggota_list as $agt) {
        $total += $agt['total_pinjaman'];
    }
    return $total / count($anggota_list);
}

// 4. Function untuk cari anggota by ID
function cari_anggota_by_id($anggota_list, $id) {
    foreach ($anggota_list as $agt) {
        if ($agt['id'] === $id) return $agt;
    }
    return null;
}

// 5. Function untuk cari anggota teraktif
function cari_anggota_teraktif($anggota_list) {
    if (empty($anggota_list)) return null;
    $teraktif = $anggota_list[0];
    foreach ($anggota_list as $agt) {
        if ($agt['total_pinjaman'] > $teraktif['total_pinjaman']) {
            $teraktif = $agt;
        }
    }
    return $teraktif;
}

// 6. Function untuk filter by status
function filter_by_status($anggota_list, $status) {
    $result = [];
    foreach ($anggota_list as $agt) {
        if (strtolower($agt['status']) === strtolower($status)) {
            $result[] = $agt;
        }
    }
    return $result;
}

// 7. Function untuk validasi email
function validasi_email($email) {
    return !empty($email) && strpos($email, '@') !== false && strpos($email, '.') !== false;
}

// 8. Function untuk format tanggal Indonesia
function format_tanggal_indo($tanggal) {
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    $split = explode('-', $tanggal); // 2024-01-15
    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}

// BONUS: Sort anggota by nama (A-Z)
function urutkan_anggota_by_nama(&$anggota_list) {
    usort($anggota_list, function($a, $b) {
        return strcmp($a['nama'], $b['nama']);
    });
}

// BONUS: Search anggota by nama (partial match)
function cari_anggota_by_nama($anggota_list, $keyword) {
    $result = [];
    foreach ($anggota_list as $agt) {
        if (stripos($agt['nama'], $keyword) !== false) {
            $result[] = $agt;
        }
    }
    return $result;
}
?>