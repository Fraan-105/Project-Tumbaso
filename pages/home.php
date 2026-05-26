<?php
require_once '../configs/database.php';
require_once '../configs/config.php';

$page_title = 'Home';
require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<section class="hero">
    <div class="hero-content">
        <p class="hero-label">TOP TREND 2026</p>
        <h1 class="hero-title">Temukan Gaya <br> Terbaikmu</h1>
        <p class="hero-sub">Koleksi fashion premium untuk mereka yang menghargai kualitas</p>
        <a href="catalog.php" class="btn-hero">Lihat Koleksi</a>
    </div>
</section>

<section class="section-produk">
    <div class="section-header">
        <h2>Produk Terbaru</h2>
        <a href="catalog.php" class="link-lihat-semua">Lihat Semua →</a>
    </div>

    <div class="product-grid">
        <?php
        $query  = "SELECT p.id, p.nama, p.harga, p.foto_utama,
                          MIN(pv.stok) as min_stok
                   FROM products p
                   LEFT JOIN product_variants pv ON p.id = pv.product_id
                   WHERE p.is_active = 1
                   GROUP BY p.id
                   ORDER BY p.created_at DESC
                   LIMIT 8";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0):
            while ($produk = mysqli_fetch_assoc($result)):
        ?>
        <div class="product-card">
            <a href="product-detail.php?id=<?= $produk['id'] ?>">
                <div class="product-img-wrap">
                    <?php if ($produk['foto_utama']): ?>
                        <img src="../assets/images/products/<?= htmlspecialchars($produk['foto_utama']) ?>"
                             alt="<?= htmlspecialchars($produk['nama']) ?>">
                    <?php else: ?>
                        <div class="product-no-img">No Image</div>
                    <?php endif; ?>

                    <?php if ($produk['min_stok'] == 0): ?>
                        <span class="badge-habis">Habis</span>
                    <?php endif; ?>
                </div>

                <div class="product-info">
                    <p class="product-nama"><?= htmlspecialchars($produk['nama']) ?></p>
                    <p class="product-harga"><?= format_rupiah($produk['harga']) ?></p>
                </div>
            </a>
        </div>
        <?php
            endwhile;
        else:
        ?>
        <p class="empty-msg">Belum ada produk tersedia.</p>
        <?php endif; ?>
    </div>
</section>

<section class="banner-promo">
    <div class="banner-content">
        <p class="banner-label">EKSKLUSIF</p>
        <h2>Kualitas Premium, <br> Harga Terjangkau</h2>
        <p>Setiap produk dibuat dengan bahan terbaik dan perhatian penuh terhadap detail.</p>
        <a href="catalog.php" class="btn-hero">Belanja Sekarang</a>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>

