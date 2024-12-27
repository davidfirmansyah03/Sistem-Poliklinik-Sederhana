<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
        .alert-small {
            width: 100%;
            max-width: 325px;
            /* Atur max-width untuk menentukan lebar maksimal */
            margin-left: auto;
            /* Menjaga alert tetap terpusat */
            margin-right: auto;
            /* Menjaga alert tetap terpusat */
            font-size: 0.875rem;
            /* Ukuran font lebih kecil */
            padding: 10px 15px;
            /* Padding lebih kecil */
            margin-bottom: 10px;
            /* Spasi bawah alert */
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= site_url('welcome/home'); ?>">
                <i class="fas fa-hospital-alt" style="font-size: 3rem; margin-right: 10px;"></i>
                <b>Poli</b>Klinik</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form method="POST" action="<?= site_url('auth/authenticate'); ?>">
                    <!-- Username -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Tampilkan pesan kesalahan jika ada -->
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-small">
                                <?= $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Button group -->
                    <div class="row">
                        <!-- Sign In Button -->
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- Cancel Button -->
                        <div class="col-6">
                            <a href="<?= site_url('welcome/home'); ?>" class="btn btn-danger btn-block">Cancel</a>
                        </div>
                    </div>
                </form>

                <!-- Register Link -->
                <p class="mb-0 mt-3">
                    <a href="<?= site_url('auth/register'); ?>" class="text-center">I don't have membership</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

</body>


</html>