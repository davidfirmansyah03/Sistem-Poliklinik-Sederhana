<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Pasien</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pasien</li>
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
                <div class="col-12">
                    <div class="mb-3">
                        <a href="<?= site_url('welcome/tambah_pasien') ?>" class="btn btn-primary">Tambah Pasien</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Alamat</th>
                                        <th>No. KTP</th>
                                        <th>No. HP</th>
                                        <th>No. Rekam Medis</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($pasiens as $pasien): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $pasien->nama ?></td>
                                            <td><?= $pasien->username ?></td>
                                            <td><?= $pasien->password ?></td>
                                            <td><?= $pasien->alamat ?></td>
                                            <td><?= $pasien->no_ktp ?></td>
                                            <td><?= $pasien->no_hp ?></td>
                                            <td><?= $pasien->no_rm ?></td>
                                            <td>
                                                <a href="<?= site_url('welcome/tambah_pasien/' . $pasien->id) ?>"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?= site_url('welcome/hapus_pasien/' . $pasien->id) ?>"
                                                    class="btn btn-danger btn-sm">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->