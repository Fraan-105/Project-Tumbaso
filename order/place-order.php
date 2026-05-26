<?php
// 1. Include config & database
require_once '../configs/config.php';
require_once '../configs/database.php';

// 2. Cek user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/login.php');
    exit();
}

// 3. Pastikan diakses lewat POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/checkout.php');
    exit();
}

// 4. Ambil data dari form
$nama_penerima = trim($_POST['nama_penerima']);
$alamat_kirim  = trim($_POST['alamat_kirim']);
$catatan       = trim($_POST['catatan']);
$total_harga   = (int)$_POST['total_harga'];
$user_id       = $_SESSION['user_id'];

// 5. Simpan ke tabel orders
$query = "INSERT INTO orders (user_id, total_harga, alamat_kirim, catatan, status)
          VALUES ('$user_id', '$total_harga', '$alamat_kirim', '$catatan', 'pending')";
mysqli_query($conn, $query);

// 6. Ambil id order yang baru dibuat
$order_id = mysqli_insert_id($conn);

// 7. Ambil semua item keranjang milik user
$cart_items = mysqli_query($conn, "
    SELECT c.jumlah, c.product_id, c.variant_id, p.harga
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = '$user_id'
");

// Loop dan simpan ke order_items
while ($item = mysqli_fetch_assoc($cart_items)) {
    $product_id      = $item['product_id'];
    $variant_id      = $item['variant_id'];
    $jumlah          = $item['jumlah'];
    $harga_saat_beli = $item['harga'];

    mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, variant_id, jumlah, harga_saat_beli)
                         VALUES ('$order_id', '$product_id', '$variant_id', '$jumlah', '$harga_saat_beli')");
}

// 8. Kosongkan keranjang user
mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");

// 9. Redirect ke halaman sukses
header('Location: order-success.php');
exit();
?>