<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PoliKinik BK</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url("assets/") ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("assets/") ?>/css/adminlte.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand ms-3" href="#">PoliKlinik</a> <!-- Memberikan jarak kiri pada brand -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown mx-3"> <!-- Menambahkan margin horizontal antar item -->
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPasien" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Pasien
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownPasien"
                                style="margin-right: 10px;">
                                <li><a class="dropdown-item" href="#">Daftar Pasien</a></li>
                                <li><a class="dropdown-item" href="#">Riwayat Kesehatan</a></li>
                                <li><a class="dropdown-item" href="#">Jadwal Pemeriksaan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown mx-3"> <!-- Menambahkan margin horizontal antar item -->
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownDokter" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Dokter
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownDokter"
                                style="margin-right: 10px;">
                                <li><a class="dropdown-item" href="#">Jadwal Dokter</a></li>
                                <li><a class="dropdown-item" href="#">Berkas Pasien</a></li>
                                <li><a class="dropdown-item" href="#">Laporan Kesehatan</a></li>
                            </ul>
                        </li>
                        <!-- Tampilkan Login jika belum login, atau Dashboard dan Logout jika sudah login -->
                        <?php if ($this->session->userdata('user_id')): ?>
                            <!-- Jika sudah login -->
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="<?= site_url('auth/login'); ?>">Dashboard</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="<?= site_url('auth/logout'); ?>">Logout</a>
                            </li>
                        <?php else: ?>
                            <!-- Jika belum login -->
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="<?= site_url('auth/login'); ?>">Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row justify-content-center">
            <div class="col-12 text-center" style="height: 250px; display: flex; justify-content: center; align-items: center; 
        background: linear-gradient(45deg, #0000FF, #800080, #FF0000);">
                <!-- Icon Medis + Text dengan Typography -->
                <h1 class="text-white mb-0" style="font-family: 'Arial', sans-serif; font-weight: bold; 
        font-size: 3rem; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); letter-spacing: 2px; 
        transition: all 0.3s ease;">
                    <i class="fas fa-hospital-alt" style="font-size: 3rem; margin-right: 10px;"></i>
                    PoliKlinik BK
                </h1>
            </div>
        </div>




        <div class="row justify-content-center mt-5">
            <div class="col-8">
                <div class="card shadow-lg rounded"
                    style="padding: 30px; text-align: center; margin-left: 10%; margin-right: 10%;">
                    <h2 class="text-center"> Pentingnya Menjaga Kesehatan</h2>
                    <p class="lead">
                        Menjaga kesehatan tubuh sangat penting agar kita dapat menjalani kehidupan dengan baik dan
                        produktif. Tubuh yang sehat memungkinkan kita untuk bekerja dengan optimal, menikmati waktu
                        bersama keluarga, dan beraktivitas dengan energi yang cukup.
                    </p>
                </div>
                <div class="card shadow-lg rounded mt-4"
                    style="padding: 30px; text-align: center; margin-left: 10%; margin-right: 10%;">
                    <p class="lead">
                        Selain itu, menjaga kesehatan juga dapat mencegah berbagai penyakit yang bisa mengganggu
                        kualitas hidup. Dengan pola hidup yang sehat, kita bisa memperpanjang usia dan memiliki kondisi
                        tubuh yang lebih kuat untuk menghadapi tantangan hidup.
                    </p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center g-3 mt-5">
            <div class="col-sm-6 col-md-4 d-flex justify-content-center align-items-center">
                <div class="card shadow-lg rounded"
                    style="width: 100%; max-width: 250px; padding: 20px; text-align: center;">
                    <i class="fas fa-user-injured fa-3x mb-3"></i> <!-- Icon Pasien -->
                    <h5>Pasien</h5>
                    <a href="<?= site_url("auth/register") ?>" class="btn btn-primary mt-3">Daftar Sebagai Pasien</a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 d-flex justify-content-center align-items-center">
                <div class="card shadow-lg rounded"
                    style="width: 100%; max-width: 250px; padding: 20px; text-align: center;">
                    <i class="fas fa-user-md fa-3x mb-3"></i> <!-- Icon Dokter -->
                    <h5>Dokter</h5>
                    <a href="<?= site_url("auth/login") ?>" class="btn btn-primary mt-3">Login Sebagai Dokter</a>
                </div>
            </div>
        </div>

    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p class="mb-0">&copy; 2024 Muhammad David Firmansyah. All rights Reserved.</p>
    </footer>
</body>


<!-- Bootstrap JS (termasuk Popper.js untuk dropdown) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</html>