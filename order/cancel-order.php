<?php
require_once '../configs/database.php';
require_once '../configs/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/login.php');
    exit();
}

$id      = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];

mysqli_query($conn, "UPDATE orders 
                     SET status = 'dibatalkan'
                     WHERE id = '$id' 
                     AND user_id = '$user_id'
                     AND status = 'pending'");

header('Location: ../order/my-orders.php');
exit();
?>