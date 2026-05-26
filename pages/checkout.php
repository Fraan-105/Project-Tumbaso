<?php
// 1. Include config & database
require_once '../configs/config.php';
require_once '../configs/database.php';
// 2. Cek user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
// 3. Ambil semua item keranjang milik user
$user_id = $_SESSION['user_id'];
$cart_items = mysqli_query($conn,
    "SELECT c.id, c.jumlah,
           p.nama, p.harga, p.foto_utama,
           pv.warna, pv.size
    FROM cart c
    JOIN products p         ON c.product_id = p.id
    JOIN product_variants pv ON c.variant_id = pv.id
    WHERE c.user_id = '$user_id'
");
// 4. Kalau keranjang kosong redirect ke cart
if (mysqli_num_rows($cart_items) == 0) {
    header('Location: cart.php');
    exit();
}
// 5. Hitung total harga semua item
$total = 0;
while ($item = mysqli_fetch_assoc($cart_items)) {
    $total += $item['harga'] * $item['jumlah'];
}
$page_title = 'Checkout';
// include header & navbar
require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>
<div class="checkout-container">
    <div class="checkout-form">
        <h2>Informasi Pengiriman</h2>
        <form action="../order/place-order.php" method="POST">
            <div class="form-group">
                <label>Nama Penerima</label>
                <input type="text" name="nama_penerima" required>
            </div>
            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat_kirim" row="4" required></textarea>
            </div>
             <div class="form-group">
                <label>Catatan (Opsional)</label>
                <textarea name="catatan" row="3"></textarea>
            </div>
            <input type="hidden" name="total_harga" value="<?= $total ?>">
            <button type="submit" class="btn-primary" >Buat pesanan</button>
        </form>
    </div>
    
<?php
$cart_items2 = mysqli_query($conn, "
    SELECT c.jumlah,
           p.nama, p.harga,
           pv.warna, pv.size
    FROM cart c
    JOIN products p          ON c.product_id = p.id
    JOIN product_variants pv ON c.variant_id  = pv.id
    WHERE c.user_id = '$user_id'
");
?>
<div class="checkout-summary">
    <h2>Ringkasan Pesanan</h2>

    <?php while ($item = mysqli_fetch_assoc($cart_items2)): ?>
    <div class="summary-row">
        <div>
            <p><?= htmlspecialchars($item['nama']) ?></p>
            <p><?= $item['warna'] ?> - <?= $item['size'] ?></p>
            <p>x<?= $item['jumlah'] ?></p>
        </div>
        <p><?= format_rupiah($item['harga'] * $item['jumlah']) ?></p>
    </div>
    <?php endwhile; ?>

    <div class="summary-total">
        <p>Total</p>
        <p><?= format_rupiah($total) ?></p>
    </div>
</div>
</div>
<?php require_once '../includes/footer.php' ?>