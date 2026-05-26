<?php
require_once '../configs/database.php';
require_once '../configs/config.php';
 
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}

$error = $_GET['error'] ?? '';
 
$page_title = 'Daftar Akun';
require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<main class ="auth-container">
    <div class="auth-box">
        <h2 class="auth-title">BUAT AKUN BARU</h2>
        <p class="auth-subtitle">Selamat datang dan nikmati koleksi kami dengan kualitas premium</p>

        <?php if ($error): ?>
            <div class="alert alert-error">
                <?php
                if ($error == 'email_exists')   echo 'Email sudah terdaftar, gunakan email lain.';
                if ($error == 'password_short') echo 'Password minimal 6 karakter.';
                if ($error == 'password_not_match') echo 'Konfirmasi password tidak sesuai.';
                if ($error == 'gagal')          echo 'Registrasi gagal, coba lagi.';
                ?>
            </div>
        <?php endif; ?>

    
        <form action="../auth/procces-regist.php" method="post">
            <div class="form-group">
                 <label for="nama">Nama Lengkap:</label><br>
    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="form-group">
                 <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" placeholder="Masukkan Email" required>
            </div>
            <div class="form-group">
                 <label for="no-hp">No. Hp:</label><br>
    <input type="text" id="no_hp" name="no_hp" placeholder="Masukkan Nomer Hp" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label><br>
    <input type="text" id="password" name="password" placeholder="Minimal 6 karakter" required>
            </div>
            <div class="form-group"
            <label for="konfirmasi-password">Konfirmasi Password:</label><br>
    <input type="text" id="konfirmasi-password" name="konfirmasi-password" placeholder="Ulangi password" required>
            </div>
            <button type="submit" class="btn-primary">Daftar sekarang</button>
        </form>
        <p class="auth-switch">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </p>
 
    </div>
</main>

<?php require_once'../includes/footer.php';?>