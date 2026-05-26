<?php
require_once '../configs/database.php';
require_once '../configs/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/login.php');
    exit();
}

$email    = trim($_POST['email']);
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    header('Location: ../pages/login.php?error=wrong');
    exit();
}

$user = mysqli_fetch_assoc($result);

if (!password_verify($password, $user['password'])) {
    header('Location: ../pages/login.php?error=wrong');
    exit();
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['nama']    = $user['nama'];
$_SESSION['email']   = $user['email'];
$_SESSION['role']    = $user['role'];

if ($user['role'] == 'admin') {
    header('Location: ../admin/index.php');
} else {
    header('Location: ../pages/home.php');
}
exit();
?>