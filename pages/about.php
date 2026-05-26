<?php
require_once '../configs/database.php';
require_once '../configs/config.php';

$page_title = 'Tentang Kami';
require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<!-- 1. Hero About -->
<section class="about-hero">
    <div class="about-hero-content">
        <p class="about-label">TENTANG KAMI</p>
        <h1 class="about-title">Lahir dari Passion, <br>Tumbuh dari Kualitas</h1>
    </div>
</section>

<!-- 2. Cerita Brand -->
<section class="about-story">
    <div class="about-story-container">
        <div class="about-story-text">
            <p class="about-section-label">CERITA KAMI</p>
            <h2>Tumbaso, Lebih dari Sekadar Fashion</h2>
            <p>Tumbaso lahir dari keyakinan bahwa fashion bukan hanya tentang penampilan — melainkan tentang bagaimana kamu merasa. Kami percaya setiap orang berhak tampil elegan tanpa harus mengorbankan kenyamanan.</p>
            <p>Didirikan pada 2026, Tumbaso hadir dengan koleksi fashion premium yang dirancang untuk mereka yang menghargai detail, kualitas bahan, dan keanggunan yang tak lekang oleh waktu.</p>
            <p>Setiap produk yang kami hadirkan melewati seleksi ketat — dari pemilihan bahan hingga jahitan akhir — untuk memastikan kamu mendapatkan yang terbaik.</p>
        </div>
        <div class="about-story-img">
            <img src="../assets/images/about image/Logo Tumbaso.jpeg" alt="Tumbaso" 
                style="width: 100%; aspect-ratio: 3/4; object-fit: cover;">
        </div>
    </div>
</section>

<!-- 3. Nilai-nilai Brand -->
<section class="about-values">
    <div class="about-values-container">
        <p class="about-section-label" style="text-align:center;">NILAI KAMI</p>
        <h2 style="text-align:center;">Yang Membuat Kami Berbeda</h2>

        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">✦</div>
                <h3>Kualitas Premium</h3>
                <p>Setiap produk dibuat dari bahan pilihan terbaik yang nyaman dipakai sepanjang hari.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">◈</div>
                <h3>Desain Eksklusif</h3>
                <p>Koleksi kami dirancang dengan memperhatikan setiap detail untuk tampilan yang selalu elegan.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">❋</div>
                <h3>Kepuasan Pelanggan</h3>
                <p>Kepercayaan dan kepuasan kamu adalah prioritas utama kami dalam setiap langkah.</p>
            </div>
        </div>
    </div>
</section>

<!-- 4. Kontak -->
<section class="about-contact">
    <div class="about-contact-container">
        <p class="about-section-label">HUBUNGI KAMI</p>
        <h2>Ada Pertanyaan?</h2>
        <p>Kami siap membantu kamu menemukan koleksi yang tepat.</p>
        <div class="contact-info">
            <p>Email: hello@tumbaso.com</p>
            <p>Instagram: @tumbaso</p>
            <p>🕐 Senin - Sabtu, 09.00 - 17.00 WIB</p>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>