// Tombol WARNA
document.querySelectorAll('.btn-warna').forEach(function(btn) {
    btn.addEventListener('click', function() {

        // Hapus active dari semua tombol warna
        document.querySelectorAll('.btn-warna').forEach(function(b) {
            b.classList.remove('active');
        });

        // Tambah active ke tombol warna yang diklik
        this.classList.add('active');

        // Ambil warna yang dipilih
        const warnaDipilih = this.dataset.warna;

        // Reset variant_id
        document.getElementById('variant_id').value = '';

        // Reset semua tombol size
        document.querySelectorAll('.btn-varian').forEach(function(b) {
            b.classList.remove('active');
        });

        // Filter size berdasarkan warna yang dipilih
        const sizeAvailable = varianData
            .filter(v => v.warna === warnaDipilih && v.stok > 0)
            .map(v => v.size);

        // Tampilkan/sembunyikan tombol size
        document.querySelectorAll('.btn-varian').forEach(function(btn) {
            const size = btn.textContent.trim();
            if (sizeAvailable.includes(size)) {
                btn.disabled = false;
                btn.style.opacity = '1';
            } else {
                btn.disabled = true;
                btn.style.opacity = '0.3';
            }
        });
    });
});

// Tombol SIZE
document.querySelectorAll('.btn-varian').forEach(function(btn) {
    btn.addEventListener('click', function() {
        if (this.disabled) return;

        // Cek apakah warna sudah dipilih
        const warnaAktif = document.querySelector('.btn-warna.active');
        if (!warnaAktif) {
            alert('Pilih warna terlebih dahulu!');
            return;
        }

        // Hapus active dari semua tombol size
        document.querySelectorAll('.btn-varian').forEach(function(b) {
            b.classList.remove('active');
        });

        // Tambah active ke tombol size yang diklik
        this.classList.add('active');

        // Cari variant_id berdasarkan warna + size yang dipilih
        const warnaDipilih = warnaAktif.dataset.warna;
        const sizeDipilih  = this.textContent.trim();

        const varian = varianData.find(v => v.warna === warnaDipilih && v.size === sizeDipilih);
        if (varian) {
            document.getElementById('variant_id').value = varian.id;
        }
    });
});