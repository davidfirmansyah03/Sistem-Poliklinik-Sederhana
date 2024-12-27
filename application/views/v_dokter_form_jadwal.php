<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Halaman Jadwal Periksa!</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Jadwal Periksa</li>
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
                <!-- Kolom untuk Form Input Jadwal -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title"><?= isset($jadwal_edit) ? 'Edit' : 'Tambah' ?> Jadwal Periksa</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form untuk tambah atau edit jadwal -->
                            <form method="POST" action="<?= site_url('welcome/tambah_jadwal_submit'); ?>">
                                <input type="hidden" name="id_jadwal"
                                    value="<?= isset($jadwal_edit) ? $jadwal_edit->id : ''; ?>">

                                <div class="form-group">
                                    <label for="hari">Hari</label>
                                    <input type="text" class="form-control" id="hari" name="hari"
                                        placeholder="Hari (Senin, Selasa, dll)"
                                        value="<?= isset($jadwal_edit) ? $jadwal_edit->hari : ''; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="jam_mulai">Jam Mulai</label>
                                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai"
                                        value="<?= isset($jadwal_edit) ? $jadwal_edit->jam_mulai : ''; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="jam_selesai">Jam Selesai</label>
                                    <input type="time" class="form-control" id="jam_selesai" name="jam_selesai"
                                        value="<?= isset($jadwal_edit) ? $jadwal_edit->jam_selesai : ''; ?>" required>
                                </div>

                                <button type="submit"
                                    class="btn btn-primary"><?= isset($jadwal_edit) ? 'Update' : 'Tambah' ?>
                                    Jadwal</button>
                            </form>

                        </div>
                    </div>
                </div><!-- /.col-md-6 -->

                <!-- Kolom untuk Daftar Jadwal yang sudah ada -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h4 class="card-title">Jadwal yang sudah ada</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Aktifkan</th>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($jadwal_periksa as $jadwal): ?>
                                        <tr>
                                            <!-- Tombol Radio -->
                                            <td>
                                                <input type="radio" class="radio-jadwal" name="jadwal"
                                                    value="<?= $jadwal->id ?>" data-dokter-id="<?= $jadwal->id_dokter ?>">
                                            </td>

                                            <!-- Kolom Hari -->
                                            <td><?= $jadwal->hari; ?></td>

                                            <!-- Kolom Jam -->
                                            <td><?= $jadwal->jam_mulai; ?></td>
                                            <td><?= $jadwal->jam_selesai; ?></td>

                                            <!-- Kolom Status -->
                                            <td>
                                                <?= $jadwal->status == 'aktif' ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>'; ?>
                                            </td>

                                            <!-- Tombol Aksi -->
                                            <td>
                                                <a href="<?= site_url('welcome/kelola_jadwal/' . $jadwal->id); ?>"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?= site_url('welcome/delete_jadwal/' . $jadwal->id); ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Anda yakin ingin menghapus jadwal ini?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div><!-- /.col-md-6 -->
            </div><!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->