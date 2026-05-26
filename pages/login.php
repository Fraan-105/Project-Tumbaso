<?php
require_once '../configs/database.php';
require_once '../configs/config.php';

if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}

$error   = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';

$page_title = 'Login';
require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<main class="auth-container">
    <div class="auth-box">

        <h2 class="auth-title">Selamat Datang</h2>
        <p class="auth-subtitle">Login untuk melanjutkan belanja</p>

        <?php if ($success == 'register'): ?>
            <div class="alert alert-success">
                Registrasi berhasil! Silakan login.
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-error">
                <?php
                if ($error == 'wrong')  echo 'Email atau password salah.';
                if ($error == 'gagal')  echo 'Terjadi kesalahan, coba lagi.';
                ?>
            </div>
        <?php endif; ?>

        <form action="../auth/login-procces.php" method="POST">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn-primary">Login</button>

        </form>

        <p class="auth-switch">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </p>

    </div>
</main>

<?php require_once '../includes/footer.php'; ?>