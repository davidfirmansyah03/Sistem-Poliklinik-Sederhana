<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Welcome <?= $username; ?>!</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                            <h4 class="card-title">Pendaftaran Poli Aktif</h4>
                        </div>
                        <div class="card-body">
                            <!-- Daftar Poli dengan Status Belum -->
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No. Antrian</th>
                                        <th>Poli</th>
                                        <th>Dokter</th>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Keluhan</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($daftar_poli)): ?>
                                        <?php foreach ($daftar_poli as $item): ?>
                                            <tr>
                                                <td><?= $item->no_antrian; ?></td>
                                                <td><?= $item->nama_poli; ?></td>
                                                <td><?= $item->nama_dokter; ?></td>
                                                <td><?= $item->hari; ?></td>
                                                <td><?= $item->jam_mulai . ' - ' . $item->jam_selesai; ?></td>
                                                <td><?= $item->keluhan; ?></td>
                                                <td><?= date('d-m-Y', strtotime($item->tanggal)); ?></td>
                                                <td><span
                                                        class="badge badge-warning"><?= ucfirst($item->status_periksa); ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada pendaftaran poli yang aktif.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->