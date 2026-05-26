<?php
// 1. Include config & database
require_once '../configs/config.php';
require_once '../configs/database.php';

// 2. Cek user sudah login, kalau belum redirect ke login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// 3. Ambil semua item keranjang milik user ini
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


$page_title = 'Keranjang Belanja';
require_once '../includes/header.php';
require_once '../includes/navbar.php';

?>

<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/navbar.php'; ?>

<main class="cart-container">
    <h1 class="cart-title">Keranjang Belanja</h1>

    <!-- 5. Cek keranjang kosong atau tidak -->
    <?php if (mysqli_num_rows($cart_items) > 0): ?>

        <div class="cart-table">
            <?php 
            $total = 0;
            while ($item = mysqli_fetch_assoc($cart_items)): 
            ?>
            <div class="cart-row">   
             <img src="../assets/images/products/<?= htmlspecialchars($item['foto_utama']) ?>"
              alt="<?= htmlspecialchars($item['nama']) ?>">
                <!-- nama produk -->
             <h1 class="detail-nama"><?= htmlspecialchars($item['nama']) ?></h1>
                <!-- warna & size -->
             <p><?= $item['warna'] ?> - <?= $item['size']?></p>
                <!-- harga satuan -->
             <p><?= format_rupiah($item['harga'])?></p>
                <!-- jumlah -->
             <p><?= $item['jumlah'] ?></p>
                <!-- subtotal -->
             <p><?= format_rupiah($item['harga'] * $item['jumlah'])?></p>
                <!-- tombol hapus -->
             <div class="btn-hapus">
             <a href="../cart/remove-cart.php?id=<?= $item['id'] ?>" class="btn-danger">Hapus</a>
            </div>
            </div>
            <?php 
            $total += $item['harga'] * $item['jumlah']; // harga x jumlah
            endwhile; 
            ?>
        </div>

        <!-- 6. Total harga -->
        <div class="cart-total">
            <p>Total: <?= format_rupiah($total) ?></p>
        </div>

        <!-- 7. Tombol checkout -->
        <a href="checkout.php" class="btn-primary">Lanjut Checkout</a>

    <?php else: ?>
        <!-- Keranjang kosong -->
        <p>Keranjang kamu kosong.</p>
        <a href="catalog.php">Lihat Koleksi</a>
    <?php endif; ?>

</main>

<!-- include footer -->
<php require_once '../includes/footer.php' ?>