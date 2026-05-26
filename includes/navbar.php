<nav class="navbar">
    <div class="navbar-container">

        <!-- Logo / Nama Toko -->
        <a href="../index.php" class="navbar-logo">
            Tumbaso
        </a>

        <!-- Menu Navigasi -->
        <ul class="navbar-menu">
            <li><a href="../pages/home.php">Home</a></li>
            <li><a href="../pages/catalog.php">Koleksi</a></li>
            <li><a href="../pages/about.php">Tentang</a></li>
        </ul>

        <!-- Kanan: Keranjang & Login -->
        <div class="navbar-right">

            <!-- Keranjang -->
            <a href="../pages/cart.php" class="navbar-cart">
                Keranjang
                <?php
                // Tampilkan jumlah item di keranjang
                $jumlah_cart = 0;
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $q = mysqli_query($conn, "SELECT SUM(jumlah) as total FROM cart WHERE user_id = $user_id");
                    $row = mysqli_fetch_assoc($q);
                    $jumlah_cart = $row['total'] ?? 0;
                }
                ?>
                <span class="cart-badge"><?= $jumlah_cart ?></span>
            </a>

            <!-- Login / Logout -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="navbar-username">Halo, <?= htmlspecialchars($_SESSION['nama']) ?></span>
                <a href="../order/my-orders.php" class="navbar-btn">Pesanan Saya</a>
                <a href="../auth/logout.php" class="navbar-btn btn-danger">Logout</a>
            <?php else: ?>
                <a href="../pages/login.php" class="navbar-btn">Login</a>
            <?php endif; ?>

        </div>
    </div>
</nav>