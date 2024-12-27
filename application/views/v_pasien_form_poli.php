<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Poli</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Poli</li>
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
                            <h4 class="card-title">Pendaftaran Poli</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form untuk tambah atau edit -->
                            <form method="POST" action="<?= site_url('welcome/daftar_poli_submit') ?>">
                                <!-- Pilih Poli -->
                                <div class="form-group">
                                    <label for="poli">Pilih Poli</label>
                                    <select class="form-control" id="poli" name="id_poli" required
                                        onchange="loadDokter()">
                                        <option value="">Pilih Poli</option>
                                        <?php foreach ($poliklinik as $poli): ?>
                                            <option value="<?= $poli->id ?>"><?= $poli->nama_poli ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Pilih Dokter -->
                                <div class="form-group" id="dokter-section" style="display:none;">
                                    <label for="dokter">Pilih Dokter</label>
                                    <select class="form-control" id="dokter" name="id_dokter" required
                                        onchange="loadJadwal()">
                                        <option value="">Pilih Dokter</option>
                                    </select>
                                </div>

                                <!-- Pilih Jadwal -->
                                <div class="form-group" id="jadwal-section" style="display:none;">
                                    <label for="jadwal">Pilih Jadwal</label>
                                    <select class="form-control" id="jadwal" name="id_jadwal" required>
                                        <option value="">Pilih Jadwal</option>
                                    </select>
                                </div>

                                <!-- Keluhan -->
                                <div class="form-group">
                                    <label for="keluhan">Keluhan</label>
                                    <textarea class="form-control" id="keluhan" name="keluhan" required></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                    <a href="<?= site_url('welcome/daftar_poli') ?>" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div><!-- /.col-md-8 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    // Fungsi untuk memuat dokter berdasarkan poli yang dipilih
    function loadDokter() {
        var poliId = document.getElementById('poli').value;
        if (poliId) {
            // Menampilkan dropdown dokter
            document.getElementById('dokter-section').style.display = 'block';

            $.ajax({
                url: '<?= site_url("welcome/get_dokter_by_poli/") ?>' + poliId,
                method: 'GET',
                success: function (response) {
                    var data = JSON.parse(response);
                    var dokterSelect = document.getElementById('dokter');
                    dokterSelect.innerHTML = '<option value="">Pilih Dokter</option>';

                    data.forEach(function (dokter) {
                        var option = document.createElement('option');
                        option.value = dokter.id;
                        option.textContent = dokter.nama;
                        dokterSelect.appendChild(option);
                    });
                }
            });
        } else {
            document.getElementById('dokter-section').style.display = 'none';
            document.getElementById('jadwal-section').style.display = 'none';
        }
    }

    // Fungsi untuk memuat jadwal berdasarkan dokter yang dipilih
    function loadJadwal() {
        var dokterId = document.getElementById('dokter').value;
        if (dokterId) {
            // Menampilkan dropdown jadwal
            document.getElementById('jadwal-section').style.display = 'block';

            $.ajax({
                url: '<?= site_url("welcome/get_jadwal_dokter_by_status/") ?>' + dokterId,
                method: 'GET',
                success: function (response) {
                    var data = JSON.parse(response);
                    var jadwalSelect = document.getElementById('jadwal');
                    jadwalSelect.innerHTML = '<option value="">Pilih Jadwal</option>';

                    data.forEach(function (jadwal) {
                        var option = document.createElement('option');
                        option.value = jadwal.id;
                        option.textContent = jadwal.hari + ' ' + jadwal.jam_mulai + ' - ' + jadwal.jam_selesai;
                        jadwalSelect.appendChild(option);
                    });
                }
            });
        } else {
            document.getElementById('jadwal-section').style.display = 'none';
        }
    }
</script>