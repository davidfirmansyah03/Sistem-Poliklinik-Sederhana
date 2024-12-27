<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= isset($pasien) ? 'Edit' : 'Tambah' ?> Pasien</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?= isset($Pasien) ? 'Edit' : 'Tambah' ?> Pasien</li>
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
                            <h4 class="card-title"><?= isset($pasien) ? 'Edit' : 'Tambah' ?> Pasien</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form untuk tambah atau edit pasien -->
                            <form method="POST"
                                action="<?= isset($pasien) ? site_url('welcome/tambah_pasien/' . $pasien->id) : site_url('welcome/tambah_pasien') ?>">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="<?= isset($pasien) ? $pasien->nama : '' ?>"
                                        placeholder="Masukkan nama pasien" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="<?= isset($pasien) ? $pasien->username : '' ?>"
                                        placeholder="Masukkan username pasien" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            value="<?= isset($pasien) ? $pasien->password : '' ?>"
                                            placeholder="Masukkan password pasien" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="toggle-password">
                                                <i class="fas fa-eye" id="eye-icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        value="<?= isset($pasien) ? $pasien->alamat : '' ?>"
                                        placeholder="Masukkan alamat pasien" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_ktp">No. KTP</label>
                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp"
                                        value="<?= isset($pasien) ? $pasien->no_ktp : '' ?>"
                                        placeholder="Masukkan nomor KTP pasien" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">No. HP</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        value="<?= isset($pasien) ? $pasien->no_hp : '' ?>"
                                        placeholder="Masukkan nomor HP pasien" required>
                                </div>

                                <!-- Tampilkan no_rm sebagai teks dan tidak bisa diedit, hanya terlihat saat mengedit -->
                                <div class="form-group" <?= isset($pasien) ? '' : 'style="display:none;"' ?>>
                                    <label for="no_rm">No. RM</label>
                                    <input type="text" class="form-control" id="no_rm" name="no_rm"
                                        value="<?= isset($pasien) ? $pasien->no_rm : '' ?>" readonly>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit"
                                        class="btn btn-primary"><?= isset($pasien) ? 'Update' : 'Simpan' ?></button>
                                    <a href="<?= site_url('welcome/kelola_pasien') ?>"
                                        class="btn btn-secondary">Batal</a>
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