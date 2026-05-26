<?php
// 1. Include config & database
require_once '../configs/database.php';
require_once '../configs/config.php';

// 2. Ambil semua produk yang aktif
$query  = "SELECT p.id, p.nama, p.harga, p.foto_utama,
                         COALESCE(SUM(pv.stok), 0) as total_stok
                   FROM products p
                   LEFT JOIN product_variants pv ON p.id = pv.product_id
                   WHERE p.is_active = 1
                   GROUP BY p.id
                   ORDER BY p.created_at DESC";
        $result = mysqli_query($conn, $query);
        
$page_title = 'Koleksi';
// include header & navbar
require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<!-- 3. Tampilkan judul halaman -->
<div class="catalog-container">
    <h1 class="catalog-title">KATALOG</h1>
<!-- 4. Tampilkan grid produk -->
    <div class="product-grid">
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($produk = mysqli_fetch_assoc($result)): ?>
        <div class="product-card">
            <a href="product-detail.php?id=<?= $produk['id'] ?>">
                <div class="product-img-wrap">
                    <?php if ($produk['foto_utama']): ?>
                        <img src="../assets/images/products/<?= htmlspecialchars($produk['foto_utama']) ?>"
                             alt="<?= htmlspecialchars($produk['nama']) ?>">
                    <?php else: ?>
                        <div class="product-no-img">No Image</div>
                    <?php endif; ?>

                    <?php if ($produk['total_stok'] == 0): ?>
                        <span class="badge-habis">Habis</span>
                    <?php endif; ?>
                </div>

                <div class="product-info">
                    <p class="product-nama"><?= htmlspecialchars($produk['nama']) ?></p>
                    <p class="product-harga"><?= format_rupiah($produk['harga']) ?></p>
                </div>
            </a>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="empty-msg">Belum ada produk tersedia.</p>
    <?php endif; ?>  
   </div>
</div>

<!-- include footer -->
<?php require_once '../includes/footer.php'?>