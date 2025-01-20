<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Riwayat Daftar Poli</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Riwayat Daftar Poli</li>
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
                            <h4 class="card-title">Pendaftaran Poli Tidak Aktif</h4>
                        </div>
                        <div class="card-body">
                            <!-- Daftar Poli dengan Status Belum -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No. Antrian</th>
                                        <th>Nama Dokter</th>
                                        <th>Keluhan</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($riwayat_poli)): ?>
                                        <?php foreach ($riwayat_poli as $item): ?>
                                            <tr>
                                                <td><?= $item->no_antrian; ?></td>
                                                <td><?= $item->nama_dokter; ?></td>
                                                <td><?= $item->keluhan; ?></td>
                                                <td><?= date('d-m-Y', strtotime($item->tanggal)); ?></td>
                                                <td><span
                                                        class="badge badge-success"><?= ucfirst($item->status_periksa); ?></span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#modalDetail<?= $item->id; ?>">
                                                        Detail
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Detail -->
                                            <div class="modal fade" id="modalDetail<?= $item->id; ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalDetailLabel">Detail Pendaftaran
                                                                Poli</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>No. Antrian:</strong> <?= $item->no_antrian; ?></p>
                                                            <p><strong>Poli:</strong> <?= $item->nama_poli; ?></p>
                                                            <p><strong>Dokter:</strong> <?= $item->nama_dokter; ?></p>
                                                            <p><strong>Keluhan:</strong> <?= $item->keluhan; ?></p>
                                                            <p><strong>Hari:</strong> <?= $item->hari; ?></p>
                                                            <p><strong>Jam:</strong>
                                                                <?= $item->jam_mulai . ' - ' . $item->jam_selesai; ?></p>
                                                            <p><strong>Tanggal Daftar:</strong>
                                                                <?= date('d-m-Y', strtotime($item->tanggal)); ?></p>
                                                            <p><strong>Status:</strong> <span
                                                                    class="badge badge-success"><?= ucfirst($item->status_periksa); ?></span>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada riwayat pendaftaran poli.</td>
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