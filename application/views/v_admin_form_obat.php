<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= isset($obat) ? 'Edit' : 'Tambah' ?> Obat</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?= isset($obat) ? 'Edit' : 'Tambah' ?> Obat</li>
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
                            <h4 class="card-title"><?= isset($obat) ? 'Edit' : 'Tambah' ?> Obat</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form untuk tambah atau edit obat -->
                            <form method="POST"
                                action="<?= isset($obat) ? site_url('welcome/tambah_obat/' . $obat->id) : site_url('welcome/tambah_obat') ?>">
                                <div class="form-group">
                                    <label for="nama_obat">Nama Obat</label>
                                    <input type="text" class="form-control" id="nama_obat" name="nama_obat"
                                        value="<?= isset($obat) ? $obat->nama_obat : '' ?>"
                                        placeholder="Masukkan nama obat" required>
                                </div>

                                <div class="form-group">
                                    <label for="kemasan">Kemasan</label>
                                    <input type="text" class="form-control" id="kemasan" name="kemasan"
                                        value="<?= isset($obat) ? $obat->kemasan : '' ?>"
                                        placeholder="Masukkan kemasan obat" required>
                                </div>

                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" class="form-control" id="harga" name="harga"
                                        value="<?= isset($obat) ? number_format($obat->harga, 0, '', '.') : '' ?>"
                                        placeholder="Masukkan harga obat" required>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit"
                                        class="btn btn-primary"><?= isset($obat) ? 'Update' : 'Simpan' ?></button>
                                    <a href="<?= site_url('welcome/kelola_obat') ?>" class="btn btn-secondary">Batal</a>
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