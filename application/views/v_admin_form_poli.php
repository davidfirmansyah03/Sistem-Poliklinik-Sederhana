<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= isset($Poli) ? 'Edit' : 'Tambah' ?> Poli</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?= isset($Poli) ? 'Edit' : 'Tambah' ?> Poli</li>
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
                            <h4 class="card-title"><?= isset($poli) ? 'Edit' : 'Tambah' ?> Poli</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form untuk tambah atau edit poli -->
                            <form method="POST"
                                action="<?= isset($poli) ? site_url('welcome/tambah_poli/' . $poli->id) : site_url('welcome/tambah_poli') ?>">
                                <div class="form-group">
                                    <label for="nama_poli">Nama Poli</label>
                                    <input type="text" class="form-control" id="nama_poli" name="nama_poli"
                                        value="<?= isset($poli) ? $poli->nama_poli : '' ?>"
                                        placeholder="Masukkan nama poli" required>
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan"
                                        value="<?= isset($poli) ? $poli->keterangan : '' ?>"
                                        placeholder="Masukkan keterangan" required>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit"
                                        class="btn btn-primary"><?= isset($poli) ? 'Update' : 'Simpan' ?></button>
                                    <a href="<?= site_url('welcome/kelola_poli') ?>"
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