<?php
// 1. Include config & database
require_once '../configs/database.php';
require_once '../configs/config.php';

// 2. Ambil ID produk dari URL
$id     = (int)$_GET['id'] ?? 0;
$sql    = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$produk = mysqli_fetch_assoc($result);

if (!$produk) {
    header('Location: catalog.php');
    exit();
}

// 5. Ambil foto-foto tambahan produk
$foto_tambahan = mysqli_query($conn, "SELECT * FROM product_photos where product_id = '$id' ORDER BY urutan ASC");

// 6. Ambil varian produk
$variants = mysqli_query($conn, "SELECT * FROM product_variants where product_id = '$id'");

$page_title = $produk['nama'];
require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<?php if (isset($_GET['success']) && $_GET['success'] == 'added'): ?>
    <div class="alert alert-success" style="max-width:800px; margin:20px auto;">
        Produk berhasil ditambahkan ke keranjang!
    </div>
<?php endif; ?>

<?php if (isset($_GET['error']) && $_GET['error'] == 'pilih_varian'): ?>
    <div class="alert alert-error" style="max-width:800px; margin:20px auto;">
        Silakan pilih varian terlebih dahulu!
    </div>
<?php endif; ?>
<?php
// Kirim data varian ke JavaScript
$semua_varian = mysqli_query($conn, "SELECT * FROM product_variants WHERE product_id = '$id'");
$varian_data = [];
while ($v = mysqli_fetch_assoc($semua_varian)) {
    $varian_data[] = $v;
}
?>
<script>
// Data semua varian dari PHP
const varianData = <?= json_encode($varian_data) ?>;
</script>
<script src="../assets/js/product-detail.js"></script>

<div class="detail-container">
    <div class="detail-foto">
        <img src="../assets/images/products/<?= htmlspecialchars($produk['foto_utama']) ?>"
            alt="<?= htmlspecialchars($produk['nama']) ?>">
    </div>
    <div class="detail-info">
        <h1 class="detail-nama"><?= htmlspecialchars($produk['nama']) ?></h1>
        <p class="detail-harga"><?= format_rupiah($produk['harga']) ?></p>
        <p class="detail-deskripsi"><?= htmlspecialchars($produk['deskripsi']) ?></p>
        <!-- Varian Warna -->
        <?php $variants2 = mysqli_query($conn, "SELECT DISTINCT warna FROM product_variants WHERE product_id = '$id'"); ?>
        <div class="detail-varian">
            <p class="varian-label">Pilih Warna:</p>
            <?php while ($w = mysqli_fetch_assoc($variants2)): ?>
                <button type="button" class="btn-warna" data-warna="<?= htmlspecialchars($w['warna']) ?>">
                    <?= htmlspecialchars($w['warna']) ?>
                </button>
            <?php endwhile; ?>
        </div>
<!-- Varian Size -->
        <div class="detail-varian">
            <p class="varian-label">Pilih Size:</p>
            <?php while ($v = mysqli_fetch_assoc($variants)): ?>
                <button type="button" class="btn-varian" data-id="<?= $v['id'] ?>">
                    <?= ($v['size']) ?>
                </button>
            <?php endwhile; ?>
        </div>
        <form action="../cart/add-to-cart.php" method="POST">
            <input type = "hidden" name="product_id" value="<?= $produk['id'] ?>">
            <input type = "hidden" name="variant_id" id="variant_id"value="">

            <div class="detail-jumlah">
                <label>jumlah:</label>
                <input type = "number" name="jumlah" value="1" min="1">
            </div>

            <div class="btn-cart">
                <button type="submit" class="btn-primary">Masukkan keranjang</button>
            </div>
        </form>
    </div>
</div>

<script src="../assets/js/product-detail.js"></script>
<?php require_once '../includes/footer.php'; ?>