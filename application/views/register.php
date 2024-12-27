<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url("assets/") ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("assets/") ?>/css/adminlte.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .alert-notification {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            width: 80%;
            max-width: 600px;
            display: none;
            /* Disembunyikan awalnya */
        }
    </style>

</head>

<body class="hold-transition register-page">

    <!-- Display success alert after registration -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            <?= $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Redirect after 1 second -->
        <script type="text/javascript">
            setTimeout(function () {
                window.location.href = '<?= site_url('auth/login') ?>';
            }, 1800);
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('username_error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('username_error'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('no_ktp_error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('no_ktp_error'); ?>
        </div>
    <?php endif; ?>

    <div class="register-box">
        <div class="login-logo">
            <a href="<?= site_url('welcome/home'); ?>">
                <i class="fas fa-hospital-alt" style="font-size: 3rem; margin-right: 10px;"></i>
                <b>Poli</b>Klinik</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form action="<?= site_url('auth/register_submit'); ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nama" placeholder="Nama" required
                            value="<?= set_value('nama'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" required
                            value="<?= set_value('username'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="alamat" placeholder="Alamat" required
                            value="<?= set_value('alamat'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-map-marker-alt"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="no_ktp" placeholder="Nomor KTP" required
                            value="<?= set_value('no_ktp'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="no_hp" placeholder="Nomor Handphone" required
                            value="<?= set_value('no_hp'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone-alt"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden No. RM field, generated by the system -->
                    <input type="hidden" name="no_rm" value="">

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="<?= site_url('auth/login'); ?>" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

</body>

</html>