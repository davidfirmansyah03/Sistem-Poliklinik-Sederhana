<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url("assets/") ?>img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url("assets/") ?>/gambar/Windah.jpeg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="<?= site_url('auth/login'); ?>" class="d-block"><?= $this->session->userdata('username') ?></a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= site_url('auth/login'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <!-- Menu Admin -->
                <?php if ($this->session->userdata('user_type') == 'Admin'): ?>
                    <li class="nav-item">
                        <a href="<?= site_url('welcome/kelola_dokter'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>Dokter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('welcome/kelola_pasien'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('welcome/kelola_poli'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-clinic-medical"></i>
                            <p>Poli</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('welcome/kelola_obat'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-pills"></i>
                            <p>Obat</p>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Menu Dokter -->
                <?php if ($this->session->userdata('user_type') == 'Dokter'): ?>

                    <li class="nav-item">
                        <a href="<?= site_url('welcome/periksa_pasien'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-user-injured"></i>
                            <p>Periksa Pasien</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= site_url('welcome/riwayat_pasien'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-file-medical"></i>
                            <p>Riwayat Pasien</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= site_url('welcome/kelola_jadwal'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Jadwal</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= site_url('welcome/konsultasi_dokter'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>Konsultasi</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= site_url('welcome/profil_dokter'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profil</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= site_url('welcome/ganti_password'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Ganti Password</p>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Menu Pasien -->
                <?php if ($this->session->userdata('user_type') == 'Pasien'): ?>
                    <li class="nav-item">
                        <a href="<?= site_url('welcome/daftar_poli'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-hospital"></i>
                            <p>Daftar Poli</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('welcome/riwayat_daftar_poli'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>Riwayat Daftar Poli</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('welcome/konsultasi_pasien'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>Konsultasi</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>