<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Halaman Ganti Password!</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('welcome/home'); ?>">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('auth/login'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Ganti Password</li>
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

                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title">Ganti Password</h4>
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                            <?php endif; ?>

                            <form method="POST" action="<?= site_url('welcome/update_password') ?>">
                                <div class="form-group">
                                    <label for="old_password">Password Lama</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="old_password"
                                            name="old_password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-eye toggle-password" data-target="old_password"
                                                    style="cursor: pointer;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="new_password"
                                            name="new_password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-eye toggle-password" data-target="new_password"
                                                    style="cursor: pointer;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Konfirmasi Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirm_password"
                                            name="confirm_password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-eye toggle-password" data-target="confirm_password"
                                                    style="cursor: pointer;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </form>
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