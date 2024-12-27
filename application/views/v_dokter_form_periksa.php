<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Welcome Pasien!</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('welcome/periksa_pasien'); ?>">Kelola
                                Pasien</a></li>
                        <li class="breadcrumb-item active">Obat</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title">Periksa Pasien</h4>
                        </div>
                        <div class="card-body">
                            <!-- Menampilkan Nama Pasien -->
                            <h5><strong>Nama Pasien:</strong> <?= $periksa['nama']; ?></h5>

                            <!-- Form untuk periksa pasien dan resep obat -->
                            <form method="POST" action="<?= site_url('welcome/periksa_pasien_submit'); ?>">
                                <!-- ID Pasien (tersembunyi) -->
                                <input type="hidden" name="id_pasien" value="<?= $periksa['pasien_id']; ?>">
                                <input type="hidden" name="id_daftar_poli" value="<?= $periksa['daftar_poli_id']; ?>">

                                <div id="obat_container">
                                    <div class="form-group">
                                        <label for="obat_1">Obat yang Diresepkan</label>
                                        <select class="form-control obat_select" id="obat_1" name="obat[]" required>
                                            <option value="">Pilih Obat</option>
                                            <?php foreach ($obat as $item): ?>
                                                <option value="<?= $item->id ?>" data-harga="<?= $item->harga ?>">
                                                    <?= $item->nama_obat . ' - ' . $item->kemasan . ' (Rp. ' . number_format($item->harga, 0, ',', '.') . ')' ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="button" class="btn btn-success btn-sm mt-2 tambah_obat">+ Tambah
                                            Obat</button>
                                    </div>
                                </div>


                                <!-- Estimasi Biaya -->
                                <div class="form-group">
                                    <label for="tgl_periksa">Tanggal Periksa</label>
                                    <input type="datetime-local" class="form-control" id="tgl_periksa"
                                        name="tgl_periksa">
                                </div>

                                <!-- Estimasi Biaya -->
                                <div class="form-group">
                                    <label for="biaya_periksa">Estimasi Biaya</label>
                                    <input type="text" class="form-control" id="biaya_periksa" name="biaya_periksa"
                                        readonly>
                                </div>

                                <!-- Catatan Pemeriksaan -->
                                <div class="form-group">
                                    <label for="catatan">Catatan Pemeriksaan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3"
                                        placeholder="Tulis catatan pemeriksaan pasien"></textarea>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Selesai Periksa</button>
                            </form>

                        </div>
                    </div>
                </div><!-- /.col-md-8 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('tambah_obat')) {
            const obatContainer = document.getElementById('obat_container');
            const index = document.querySelectorAll('.obat_select').length + 1; // Nomor input obat baru

            // Buat elemen baru untuk dropdown obat
            const newObat = document.createElement('div');
            newObat.classList.add('form-group');
            newObat.innerHTML = `
            <label for="obat_${index}">Obat yang Diresepkan</label>
            <select class="form-control obat_select" id="obat_${index}" name="obat[]" required>
                <option value="">Pilih Obat</option>
                <?php foreach ($obat as $item): ?>
                        <option value="<?= $item->id ?>" data-harga="<?= $item->harga ?>">
                            <?= $item->nama_obat . ' - ' . $item->kemasan . ' (Rp. ' . number_format($item->harga, 0, ',', '.') . ')' ?>
                        </option>
                <?php endforeach; ?>
            </select>
            <button type="button" class="btn btn-danger btn-sm mt-2 hapus_obat">Hapus</button>
            `;

            // Tambahkan elemen ke dalam container
            obatContainer.appendChild(newObat);
        }
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