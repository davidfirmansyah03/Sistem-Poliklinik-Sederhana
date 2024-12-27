<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= isset($dokter) ? 'Edit' : 'Tambah' ?> Dokter</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?= isset($dokter) ? 'Edit' : 'Tambah' ?> Dokter</li>
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
                            <h4 class="card-title"><?= isset($dokter) ? 'Edit' : 'Tambah' ?> Dokter</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form ini menangani baik tambah dan edit dokter -->
                            <form method="POST"
                                action="<?= isset($dokter) ? site_url('welcome/edit_dokter/' . $dokter->id) : site_url('welcome/tambah_dokter') ?>">

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="<?= isset($dokter) ? $dokter->nama : '' ?>"
                                        placeholder="Masukkan nama dokter" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">Usernama</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="<?= isset($dokter) ? $dokter->username : '' ?>"
                                        placeholder="Masukkan nama dokter" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            value="<?= isset($dokter) ? $dokter->password : '' ?>"
                                            placeholder="Masukkan password dokter" required>
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
                                        value="<?= isset($dokter) ? $dokter->alamat : '' ?>"
                                        placeholder="Masukkan alamat dokter" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        value="<?= isset($dokter) ? $dokter->no_hp : '' ?>"
                                        placeholder="Masukkan nomor HP" required>
                                </div>

                                <div class="form-group">
                                    <label for="id_poli">Pilih Poli</label>
                                    <select class="form-control" id="id_poli" name="id_poli" required>
                                        <option value="">Pilih Poli</option>
                                        <?php foreach ($poliklinik as $poli): ?>
                                            <option value="<?= $poli->id ?>" <?= isset($dokter) && $dokter->id_poli == $poli->id ? 'selected' : '' ?>>
                                                <?= $poli->nama_poli ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit"
                                        class="btn btn-primary"><?= isset($dokter) ? 'Update' : 'Simpan' ?></button>
                                    <a href="<?= site_url('welcome/kelola_dokter') ?>"
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