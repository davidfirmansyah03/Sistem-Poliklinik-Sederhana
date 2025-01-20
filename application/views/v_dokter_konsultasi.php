<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Konsultasi Dokter</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Konsultasi</li>
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
                            <h4 class="card-title">Tanggapi Keluhan Pasien</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form Tanggapan -->
                            <?php if (isset($konsultasi)): ?>
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <form action="<?= site_url('welcome/save_tanggapan'); ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $konsultasi['id']; ?>">
                                            <div class="form-group">
                                                <label for="pertanyaan">Pertanyaan</label>
                                                <textarea id="pertanyaan" class="form-control" rows="3"
                                                    readonly><?= $konsultasi['pertanyaan']; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggapan">Tanggapan</label>
                                                <textarea name="tanggapan" id="tanggapan" rows="4" class="form-control"
                                                    required><?= isset($konsultasi['tanggapan']) ? $konsultasi['tanggapan'] : ''; ?></textarea>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-success"><?= isset($konsultasi['tanggapan']) ? 'Update Tanggapan' : 'Simpan Tanggapan'; ?></button>
                                            <a href="<?= site_url('welcome/konsultasi_dokter'); ?>"
                                                class="btn btn-secondary">Batal</a>
                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Tabel Daftar Konsultasi -->
                            <?php if (!empty($konsultasi_list)): ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Konsultasi</th>
                                            <th>Nama Pasien</th>
                                            <th>Pertanyaan</th>
                                            <th>Tanggapan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($konsultasi_list as $index => $konsultasi): ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= date('d-m-Y', strtotime($konsultasi['tgl_konsultasi'])); ?></td>
                                                <td><?= $konsultasi['nama_pasien']; ?></td>
                                                <td><?= $konsultasi['pertanyaan']; ?></td>
                                                <td><?= $konsultasi['tanggapan'] ?: 'Belum ada tanggapan'; ?></td>
                                                <td>
                                                    <?php if (empty($konsultasi['tanggapan'])): ?>
                                                        <a href="<?= site_url('welcome/konsultasi_dokter/' . $konsultasi['id']); ?>"
                                                            class="btn btn-primary btn-sm">
                                                            Tanggapi
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?= site_url('welcome/konsultasi_dokter/' . $konsultasi['id']); ?>"
                                                            class="btn btn-warning btn-sm">
                                                            Edit
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="alert alert-info text-center">
                                    <strong>Belum ada konsultasi yang tersedia.</strong>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- col md 12 -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->