<?php
require_once '../configs/database.php';
require_once '../configs/config.php';

// Cek user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/login.php');
    exit();
}

$page_title = 'Pesanan Berhasil';
require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<main class="success-container">
    <div class="success-box">
        <div class="success-icon">✓</div>
        <h1>Pesanan Berhasil!</h1>
        <p>Terima kasih telah berbelanja di Tumbaso. Pesanan kamu sedang kami proses. <br> Silahkan Transfer ke nomor rekening 123456789010 a.n TUMBASO</p>
        <div class="success-actions">
            <a href="../pages/home.php" class="btn-primary">Kembali ke Home</a>
            <a href="my-orders.php" class="btn-secondary">Lihat Pesanan Saya</a>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>