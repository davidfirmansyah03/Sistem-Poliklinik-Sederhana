<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Konsultasi Pasien</h1>
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
                            <h4 class="card-title"><?= isset($konsultasi) ? 'Edit' : 'Konsultasikan' ?> Keluhan Anda
                            </h4>
                        </div>
                        <div class="card-body">
                            <!-- Form Konsultasi -->
                            <form action="<?= site_url('welcome/save_konsultasi'); ?>" method="post">
                                <input type="hidden" name="id" value="<?= isset($konsultasi) ? $konsultasi['id'] : ''; ?>">
                                <div class="form-group">
                                    <label for="tgl_konsultasi">Tanggal Konsultasi</label>
                                    <input type="date" name="tgl_konsultasi" id="tgl_konsultasi" class="form-control" 
                                        value="<?= isset($konsultasi) ? $konsultasi['tgl_konsultasi'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="dokter">Pilih Dokter</label>
                                    <select name="id_dokter" id="dokter" class="form-control" required>
                                        <option value="">-- Pilih Dokter --</option>
                                        <?php foreach ($list_dokter as $dokter): ?>
                                            <option value="<?= $dokter['id']; ?>" 
                                                <?= isset($konsultasi) && $konsultasi['id_dokter'] == $dokter['id'] ? 'selected' : ''; ?>>
                                                <?= $dokter['nama']; ?>, <?= $dokter['poli']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pertanyaan">Pertanyaan</label>
                                    <textarea name="pertanyaan" id="pertanyaan" rows="3" class="form-control" required><?= isset($konsultasi) ? $konsultasi['pertanyaan'] : ''; ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-<?= isset($konsultasi) ? 'warning' : 'success'; ?>">
                                    <?= isset($konsultasi) ? 'Update' : 'Kirim'; ?>
                                </button>
                            </form>
                            <hr>
                            <?php if (!empty($riwayat_konsultasi)): ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Konsultasi</th>
                                            <th>Nama Dokter</th>
                                            <th>Pertanyaan</th>
                                            <th>Tanggapan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($riwayat_konsultasi as $index => $konsultasi): ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= date('d-m-Y', strtotime($konsultasi['tgl_konsultasi'])); ?></td>
                                                <td><?= $konsultasi['nama']; ?></td>
                                                <td><?= $konsultasi['pertanyaan']; ?></td>
                                                <td><?= $konsultasi['tanggapan'] ?: 'Belum ada tanggapan'; ?></td>
                                                <td>
                                                    <a href="<?= site_url('welcome/konsultasi_pasien/' . $konsultasi['id']); ?>"
                                                        class="btn btn-primary btn-sm">
                                                        Edit
                                                    </a>
                                                    <a href="<?= site_url('welcome/delete_konsultasi/' . $konsultasi['id']); ?>"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus konsultasi ini?');">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="alert alert-info text-center">
                                    <strong>Belum ada riwayat konsultasi.</strong>
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