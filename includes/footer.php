<footer class="footer">
        <div class="footer-container">

            <!-- Kiri: Nama toko & deskripsi singkat -->
            <div class="footer-brand">
                <h3>Tumbaso</h3>
                <p>Koleksi fashion premium untuk mereka yang menghargai kualitas.</p>
            </div>

            <!-- Tengah: Link navigasi -->
            <div class="footer-links">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="../pages/home.php">Home</a></li>
                    <li><a href="../pages/catalog.php">Koleksi</a></li>
                    <li><a href="../pages/about.php">Tentang</a></li>
                </ul>
            </div>

            <!-- Kanan: Kontak -->
            <div class="footer-contact">
                <h4>Kontak</h4>
                <p>Email: @Tumbaso.com</p>
                <p>Instagram: @Tumbaso</p>
            </div>

        </div>

        <!-- Bawah: Copyright -->
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> Tumbaso. All rights reserved.</p>
        </div>
    </footer>

    <!-- JS Global -->
    <script src="../assets/js/main.js"></script>

    <!-- JS tambahan per halaman (opsional) -->
    <?php if (isset($extra_js)): ?>
        <script src="../assets/js/<?= $extra_js ?>"></script>
    <?php endif; ?>

</body>
</html>
