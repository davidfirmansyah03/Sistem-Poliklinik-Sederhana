<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/js/adminlte.min.js') ?>"></script>
<!-- Memuat JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    $(document).ready(function () {
        // Inisialisasi Select2 dengan pengaturan scroll
        $('#id_poli').select2({
            width: '100%', // Lebar dropdown 100%
            maximumSelectionLength: 1, // Hanya bisa memilih 1 item
            dropdownAutoWidth: true, // Otomatis mengatur lebar dropdown
            dropdownCssClass: "bigdrop", // Menambahkan kelas CSS
            allowClear: true, // Menambahkan tombol clear
            placeholder: "Pilih Poli", // Placeholder saat tidak ada pilihan
            // Menampilkan maksimal 5 item dalam dropdown
            dropdownCssClass: 'scrollable-dropdown'
        });

        // CSS untuk mengatur tinggi dropdown
        $('.select2-dropdown').css({
            'max-height': '200px',
            'overflow-y': 'auto'
        });
    });

</script>

<!-- Tambahkan JS untuk toggle password -->
<script>
    document.getElementById("toggle-password").addEventListener("click", function () {
        var passwordField = document.getElementById("password");
        var eyeIcon = document.getElementById("eye-icon");

        // Toggle between showing and hiding password
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    });
</script>

<script>
    $(document).ready(function () {
        // Fungsi untuk menambahkan titik pada input harga
        $('#harga').on('input', function () {
            var harga = $(this).val();
            // Hapus karakter selain angka dan titik
            var formattedHarga = harga.replace(/\D/g, '');
            // Format angka dengan titik sebagai pemisah ribuan
            $(this).val(formattedHarga.replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
        });

        // Sebelum mengirimkan form, hapus titik sebelum menyimpan ke database
        $('form').on('submit', function () {
            var harga = $('#harga').val();
            // Hapus titik sebelum mengirimkan data ke server
            $('#harga').val(harga.replace(/\./g, ''));
        });

        // Event handler untuk tombol radio
        $('.radio-jadwal').on('change', function () {
            var jadwalId = $(this).val(); // Ambil ID jadwal yang dipilih
            var dokterId = $(this).data('dokter-id'); // Ambil ID dokter dari atribut data

            // Kirim permintaan AJAX untuk memperbarui status
            $.ajax({
                url: '<?= site_url("welcome/update_status_jadwal"); ?>', // Endpoint untuk memperbarui status
                method: 'POST',
                data: {
                    jadwal_id: jadwalId,
                    id_dokter: dokterId // Kirim id_dokter
                },
                success: function (response) {
                    if (response.success) {
                        // Perbarui status di tabel jika berhasil
                        alert('Status jadwal berhasil diperbarui.');
                        location.reload(); // Reload halaman untuk memperbarui tampilan
                    } else {
                        alert('Gagal memperbarui status jadwal.');
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan. Coba lagi.');
                }
            });
        });

    });

</script>

<script>
    // Event Delegation: Menghitung estimasi biaya untuk semua dropdown obat
    document.addEventListener('change', function (event) {
        if (event.target.classList.contains('obat_select')) {
            hitung_estimasi_biaya();
        }
    });

    // Fungsi untuk menghitung estimasi biaya berdasarkan obat yang dipilih
    function hitung_estimasi_biaya() {
        let total = 150000; // Biaya dasar
        document.querySelectorAll('.obat_select').forEach(function (select) {
            const harga = parseFloat(select.selectedOptions[0]?.getAttribute('data-harga') || 0);
            total += harga;
        });
        document.getElementById('biaya_periksa').value = 'Rp. ' + total.toLocaleString();
    }

    // Tambah inputan obat baru
    document.querySelector('.tambah_obat').addEventListener('click', function () {
        const obatContainer = document.getElementById('obat_container');
        const index = document.querySelectorAll('.obat_select').length + 1; // Nomor input obat baru

        // Buat elemen baru untuk dropdown obat
        const newObat = document.createElement('div');
        newObat.classList.add('form-group', 'obat-row');
        newObat.innerHTML = `
        <label for="obat_${index}">Obat yang Diresepkan</label>
        <select class="form-control obat_select" id="obat_${index}" name="obat[]" required>
            <option value="">Pilih Obat</option>
            <?php foreach ($obat_list as $item): ?>
                        <option value="<?= $item->id ?>" data-harga="<?= $item->harga ?>">
                            <?= $item->nama_obat . ' - ' . $item->kemasan . ' (Rp. ' . number_format($item->harga, 0, ',', '.') . ')' ?>
                        </option>
            <?php endforeach; ?>
        </select>
        <button type="button" class="btn btn-danger btn-sm mt-2 hapus_obat">Hapus</button>
        `;

        // Tambahkan elemen ke dalam container
        obatContainer.appendChild(newObat);
    });

    // Event Delegation: Hapus inputan obat
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('hapus_obat')) {
            const obatRow = event.target.closest('.form-group');
            obatRow.remove();
            hitung_estimasi_biaya(); // Recalculate biaya setelah hapus obat
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tambahkan event listener ke semua ikon toggle-password
        document.querySelectorAll('.toggle-password').forEach(function (icon) {
            icon.addEventListener('click', function () {
                const targetInput = document.getElementById(this.getAttribute('data-target'));
                const type = targetInput.getAttribute('type') === 'password' ? 'text' : 'password';
                targetInput.setAttribute('type', type);

                // Ganti ikon mata (fa-eye menjadi fa-eye-slash)
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    });
</script>

</body>

</html>