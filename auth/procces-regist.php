<?php
require_once '../configs/database.php';
require_once '../configs/config.php';
 
// Halaman ini hanya boleh diakses lewat POST (dari form)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/register.php');
    exit();
}
 
// 1. Ambil data dari form
$nama                = trim($_POST['nama']);
$email               = trim($_POST['email']);
$no_hp               = trim($_POST['no_hp']);   
$password            = $_POST['password'];
$konfirmasi_password = $_POST['konfirmasi-password'];
 
// 2. Validasi password minimal 6 karakter
if (strlen($password) < 6) {
    header('Location: ../pages/register.php?error=password_short');
    exit();
}
 
// 3. Validasi konfirmasi password harus sama
if ($password !== $konfirmasi_password) {
    header('Location: ../pages/register.php?error=password_not_match');
    exit();
}
 
// 4. Cek apakah email sudah terdaftar
$cek = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
if (mysqli_num_rows($cek) > 0) {
    header('Location: ../pages/register.php?error=email_exists');
    exit();
}
 
// 5. Hash password sebelum disimpan (keamanan)
$password_hash = password_hash($password, PASSWORD_DEFAULT);
 
// 6. Simpan user baru ke database
$query = "INSERT INTO users (nama, email, no_hp, password, role)
          VALUES ('$nama', '$email', '$no_hp', '$password_hash', 'user')";
 
if (mysqli_query($conn, $query)) {
    // Registrasi berhasil → redirect ke halaman login
    header('Location: ../pages/login.php?success=register');
    exit();
} else {
    header('Location: ../pages/register.php?error=gagal');
    exit();
}
?>