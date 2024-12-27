<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Halaman Periksa Pasien!</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kelola Pasien</li>
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
                            <h4 class="card-title">Daftar Pasien yang Menunggu</h4>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Poli</th>
                                        <th>Dokter</th>
                                        <th>Jadwal</th>
                                        <th>Keluhan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($listpasien)) { ?>
                                        <?php
                                        $no = 1;
                                        $isAdaPasienBelum = false; // Menandakan ada atau tidak pasien yang statusnya 'belum'
                                        ?>

                                        <?php foreach ($listpasien as $pasien): ?>
                                            <?php if ($pasien['status_periksa'] === 'belum') {
                                                $isAdaPasienBelum = true; // Jika ada pasien dengan status 'belum'
                                                ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $pasien['pasien_nama']; ?></td>
                                                    <td><?= $pasien['nama_poli']; ?></td>
                                                    <td><?= $pasien['dokter_nama']; ?></td>
                                                    <td><?= $pasien['hari'] . ', ' . $pasien['jam_mulai'] . ' - ' . $pasien['jam_selesai']; ?>
                                                    </td>
                                                    <td><?= $pasien['keluhan']; ?></td>
                                                    <td>
                                                        <span class="badge badge-warning">Belum Diperiksa</span>
                                                    </td>
                                                    <td>
                                                        <a href="<?= site_url('welcome/periksa_pasien_action/' . $pasien['daftar_poli_id']); ?>"
                                                            class="btn btn-success btn-sm">Periksa</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php endforeach; ?>

                                        <?php if (!$isAdaPasienBelum) { // Jika tidak ada pasien dengan status 'belum' ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada pasien yang menunggu</td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
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