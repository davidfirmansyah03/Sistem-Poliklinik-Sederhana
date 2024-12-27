<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Welcome Dokter!</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('welcome/riwayat_pasien'); ?>">Riwayat
                                Pasien</a></li>
                        <li class="breadcrumb-item active">Detail Riwayat Pasien</li>
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
                            <h4 class="card-title">Detail Pemeriksaan Pasien</h4>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($detail)): ?>

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Pemeriksaan</th>
                                            <th>Nama</th>
                                            <th>Catatan</th>
                                            <th>Keluhan</th>
                                            <th>No Antrian</th>
                                            <th>Status Pemeriksaan</th>
                                            <th>Obat yang Diberikan</th>
                                            <th>Total Biaya Pemeriksaan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($detail as $row): ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $row['tgl_periksa'] ?></td>
                                                <td><?= $row['nama_pasien'] ?></td>
                                                <td><?= $row['catatan'] ?></td>
                                                <td><?= $row['keluhan'] ?></td>
                                                <td><?= $row['no_antrian'] ?></td>
                                                <td><?= $row['status_periksa'] ?></td>
                                                <td><?= $row['obat'] ?></td>
                                                <td><?= number_format($row['biaya_periksa'], 0, ',', '.') ?></td>
                                                <td>
                                                    <a href="<?= site_url('welcome/edit_riwayat_pasien/' . $row['periksa_id']) ?>"
                                                        class="btn btn-warning btn-sm">
                                                        Edit
                                                    </a>
                                                </td>

                                            </tr>
                                        </tbody>
                                    <?php endforeach; ?>
                                </table>

                            <?php else: ?>
                                <p>Data detail pemeriksaan tidak ditemukan.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div><!-- /.col-md-12 -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->