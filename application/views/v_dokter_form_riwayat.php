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
                        <li class="breadcrumb-item active"><a href="<?= site_url('welcome/riwayat_pasien'); ?>">Detail Riwayat Pasien</a></li>
                        <li class="breadcrumb-item active">Edit Detail Riwayat Pasien</li>
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
                            <h4 class="card-title">Edit Detail Pemeriksaan Pasien</h4>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($detail)): ?>
                                <form method="POST" action="<?= site_url('welcome/update_riwayat_pasien') ?>">
                                    <!-- Hidden field untuk ID pemeriksaan -->
                                    <input type="hidden" name="periksa_id" value="<?= $detail['periksa_id'] ?>">

                                    <!-- Nama Pasien -->
                                    <div class="form-group">
                                        <label for="nama_pasien">Nama Pasien</label>
                                        <input type="text" class="form-control" id="nama_pasien"
                                            value="<?= $detail['nama_pasien'] ?>" readonly>
                                    </div>

                                    <!-- Tanggal Pemeriksaan -->
                                    <div class="form-group">
                                        <label for="tgl_periksa">Tanggal Pemeriksaan</label>
                                        <input type="date" class="form-control" id="tgl_periksa" name="tgl_periksa"
                                            value="<?= $detail['tgl_periksa'] ?>" required>
                                    </div>

                                    <!-- Catatan -->
                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <textarea class="form-control" id="catatan" name="catatan"
                                            required><?= $detail['catatan'] ?></textarea>
                                    </div>

                                    <!-- Obat yang Diresepkan -->
                                    <div id="obat_container">
                                        <?php if (!empty($obat)): ?>
                                            <?php foreach ($obat as $key => $obat_detail): ?>
                                                <div class="form-group">
                                                    <label for="obat_<?= $key ?>">Obat yang Diresepkan</label>
                                                    <select class="form-control obat_select" id="obat_<?= $key ?>" name="obat[]"
                                                        required>
                                                        <option value="">Pilih Obat</option>
                                                        <?php foreach ($obat_list as $item): ?>
                                                            <option value="<?= $item->id ?>" data-harga="<?= $item->harga ?>"
                                                                <?= $item->id == $obat_detail['obat_id'] ? 'selected' : '' ?>>
                                                                <?= $item->nama_obat . ' - ' . $item->kemasan . ' (Rp. ' . number_format($item->harga, 0, ',', '.') . ')' ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <button type="button" class="btn btn-danger btn-sm mt-2 hapus_obat" <?= $key === 0 ? 'style="display:none;"' : '' ?>>Hapus</button>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-success btn-sm mt-2 tambah_obat">+ Tambah
                                            Obat</button>
                                    </div>

                                    <!-- Total Biaya Pemeriksaan -->
                                    <div class="form-group">
                                        <label for="biaya_periksa">Total Biaya Pemeriksaan</label>
                                        <input type="text" class="form-control" id="biaya_periksa" name="biaya_periksa"
                                            value="Rp. <?= number_format($detail['biaya_periksa'], 0, ',', '.') ?>"
                                            readonly>
                                    </div>

                                    <!-- Submit -->
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="<?= site_url('welcome/riwayat_pasien') ?>"
                                            class="btn btn-secondary">Batal</a>
                                    </div>
                                </form>
                            <?php else: ?>
                                <p>Data detail pemeriksaan tidak ditemukan.</p>
                            <?php endif; ?>
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