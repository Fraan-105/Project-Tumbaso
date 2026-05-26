<?php
// Mulai session
session_start();

define('NAMA_TOKO', 'Tumbaso');

function format_rupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}