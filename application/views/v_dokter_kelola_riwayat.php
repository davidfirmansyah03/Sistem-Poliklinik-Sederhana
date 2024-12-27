<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Halaman Riwayat Pasien!</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Riwayat Pasien</li>
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

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title">Daftar Riwayat Pasien</h4>
                        </div>
                        <div class="card-body">

                            <!-- Tabel Riwayat Pemeriksaan Pasien -->
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Alamat</th>
                                        <th>No KTP</th>
                                        <th>No HP</th>
                                        <th>No RM</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($riwayat as $row): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row->nama_pasien ?></td>
                                            <td><?= $row->alamat ?></td>
                                            <td><?= $row->no_ktp ?></td>
                                            <td><?= $row->no_hp ?></td>
                                            <td><?= $row->no_rm ?></td>
                                            <td>
                                                <a href="<?= site_url('welcome/detail_riwayat_pasien/' . $row->id_pasien) ?>"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                    Detail Riwayat Periksa
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div><!-- /.col-md-12 -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->