<?php
require_once '../configs/database.php';
require_once '../configs/config.php';

$product_id = (int)$_POST['product_id'];
$variant_id = (int)$_POST['variant_id'];
$jumlah     = (int)$_POST['jumlah'];
$user_id    = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/login.php');
    exit();
}

if ($variant_id == 0) {
    header('Location: ../pages/product-detail.php?id=' . $product_id . '&error=pilih_varian');
    exit();
}

$cek = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' 
                             AND product_id = '$product_id' 
                             AND variant_id = '$variant_id'");

if (mysqli_num_rows($cek) > 0){
    mysqli_query($conn, "UPDATE cart
    SET jumlah = jumlah + '$jumlah'
    where user_id = 'user_id'
    AND product_id = 'product_id'
    AND variant_id = 'variant_id'");
} else {
    mysqli_query($conn, "INSERT INTO cart (user_id, product_id, variant_id, jumlah)
    VALUES ('$user_id', '$product_id', '$variant_id', '$jumlah')");
}

// 5. Redirect kembali ke halaman product detail
header('Location: ../pages/product-detail.php?id=' . $product_id . '&success=added');
exit();
?>