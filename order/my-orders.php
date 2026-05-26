<?php
require_once '../configs/database.php';
require_once '../configs/config.php';

// Cek user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil semua pesanan milik user
$orders = mysqli_query($conn, "
    SELECT * FROM orders 
    WHERE user_id = '$user_id'
    ORDER BY created_at DESC");

$page_title = 'Pesanan Saya';
require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<main class="orders-container">
    <h1 class="orders-title">Pesanan Saya</h1>

    <?php if (mysqli_num_rows($orders) > 0): ?>

        <div class="orders-list">
            <?php while ($order = mysqli_fetch_assoc($orders)): ?>

            <?php
            // Ambil item-item dalam pesanan ini
            $items = mysqli_query($conn, "
                SELECT oi.jumlah, oi.harga_saat_beli,
                       p.nama, p.foto_utama,
                       pv.warna, pv.size
                FROM order_items oi
                JOIN products p          ON oi.product_id = p.id
                JOIN product_variants pv ON oi.variant_id  = pv.id
                WHERE oi.order_id = '{$order['id']}'
            ");
            ?>

            <div class="order-card">
                <!-- Header pesanan -->
                <div class="order-card-header">
                    <div>
                        <p class="order-id">#<?= $order['id'] ?></p>
                        <p class="order-date"><?= date('d M Y', strtotime($order['created_at'])) ?></p>
                    </div>
                    <span class="status-badge status-<?= $order['status'] ?>">
                        <?= ucfirst($order['status']) ?>
                    </span>
                </div>

                <!-- Item produk -->
                <div class="order-items">
                    <?php while ($item = mysqli_fetch_assoc($items)): ?>
                    <div class="order-item-row">
                        <?php if ($item['foto_utama']): ?>
                            <img src="../assets/images/products/<?= htmlspecialchars($item['foto_utama']) ?>"
                                 alt="<?= htmlspecialchars($item['nama']) ?>">
                        <?php else: ?>
                            <div class="order-no-foto">-</div>
                        <?php endif; ?>

                        <div class="order-item-info">
                            <p class="order-item-nama"><?= htmlspecialchars($item['nama']) ?></p>
                            <p class="order-item-varian"><?= $item['warna'] ?> - <?= $item['size'] ?></p>
                            <p class="order-item-jumlah">x<?= $item['jumlah'] ?></p>
                        </div>

                        <p class="order-item-harga">
                            <?= format_rupiah($item['harga_saat_beli'] * $item['jumlah']) ?>
                        </p>
                    </div>
                    <?php endwhile; ?>
                </div>

                <!-- Footer pesanan -->
                <div class="order-card-footer">
                    <p class="order-total">Total: <?= format_rupiah($order['total_harga']) ?></p>
                    <?php if ($order['catatan']): ?>
                        <p class="order-catatan">Catatan: <?= htmlspecialchars($order['catatan']) ?></p>
                    <?php endif; ?>
                    <?php if ($order['status'] == 'pending'): ?>
                        <a href="../order/cancel-order.php?id=<?= $order['id'] ?>"class="btn-danger"
                        onclick="return confirm('Yakin mau batalkan pesanan ini?')">Batalkan Pesanan</a>
                    <?php endif; ?>
                </div>
            </div>

            <?php endwhile; ?>
        </div>

    <?php else: ?>
        <div class="orders-empty">
            <p>Kamu belum punya pesanan.</p>
            <a href="catalog.php" class="btn-hero">Mulai Belanja</a>
        </div>
    <?php endif; ?>
</main>

<?php require_once '../includes/footer.php'; ?>