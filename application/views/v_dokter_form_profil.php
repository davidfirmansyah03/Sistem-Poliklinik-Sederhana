<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Halaman Profil!</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profil</li>
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

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title">Edit Profil</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form untuk tambah atau edit obat -->
                            <form method="POST" action="<?= site_url('welcome/profil_dokter_submit') ?>">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama Dokter" value="<?= set_value('nama', $dokter->nama); ?>"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                                        required><?= set_value('alamat', $dokter->alamat); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">Nomor HP</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        placeholder="Nomor HP" value="<?= set_value('no_hp', $dokter->no_hp); ?>"
                                        required>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="no_poli">Poli</label>
                                    <select class="form-control" id="id_poli" name="id_poli" required>
                                        <option value="">Pilih Poli</option>
                                        <?php foreach ($poliklinik as $poli): ?>
                                            <option value="<?= $poli->id ?>" <?= $dokter->id_poli == $poli->id ? 'selected' : ''; ?>><?= $poli->nama_poli ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> -->

                                <button type="submit" class="btn btn-primary">Update Profil</button>
                            </form>

                        </div>
                    </div>
                </div><!-- /.col-md-6 -->

                <div class="col-md-6">
                    <!-- Menampilkan Profil Dokter -->
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h4 class="card-title">Profil Dokter</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Nama:</strong> <?= $dokter->nama ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Alamat:</strong> <?= $dokter->alamat ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Nomor HP:</strong> <?= $dokter->no_hp ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Poli:</strong> <?= $nama_poli ?>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div><!-- /.col-md-6 -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->