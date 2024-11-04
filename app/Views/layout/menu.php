<?= $this->extend('layout/main') ?>
<?= $this->section('nav') ?>
<nav class="navbar-custom">
    <ul class="navbar-right list-inline float-right mb-0">

        <!-- full screen -->
        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
            <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                <i class="mdi mdi-arrow-expand-all noti-icon"></i>
            </a>
        </li>

        <li class="dropdown notification-list list-inline-item">
            <div class="dropdown notification-list nav-pro-img">
                <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <img src="<?= base_url('img/user/' .  session()->get('foto')) ?>" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <a class="dropdown-item" href="javascript:void(0);"> <?= session()->get('nama') ?> </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#" id="logout"><i class="mdi mdi-power text-danger"></i>
                        Logout</a>
                </div>
            </div>
        </li>

    </ul>

    <ul class="list-inline menu-left mb-0">
        <li class="float-left">
            <button class="button-menu-mobile open-left waves-effect">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>

    </ul>

</nav>
<?= $this->endSection('nav') ?>


<?= $this->section('menu') ?>
<li class="menu-title">Dashboard</li>
<li>
    <a href="<?= base_url('auth/dashboard') ?>" class="waves-effect">
        <i class="icon-accelerator"></i> <span> Dashboard </span>
    </a>
</li>

<?php if (session()->get('level') == 2) { ?>
    <li class="menu-title">Tenaga Kependidik & Pendidik</li>
    <li>
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-group"></i> <span> pengajar <span
                    class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
        <ul class="submenu">
            <li><a href="<?= base_url('auth/pengajar') ?>">Data Pengajar</a></li>

        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-badge-horizontal"></i><span> Santri
                <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
        <ul class="submenu">
            <li><a href="<?= base_url('auth/kelas') ?>">Kelas</a></li>
            <li><a href="<?= base_url('auth/santri') ?>">Data santri</a></li>
        </ul>
    </li>
    <!-- <li>
<a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-badge-horizontal"></i><span> Pembayaran
            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
    <ul class="submenu">
        <li><a href="<?= base_url('auth/infaq') ?>">Iuran Kamisan</a></li>
    </ul>
</li> -->
<?php } ?>
<li class="menu-title">Posting</li>
<li>
    <a href="<?= base_url('auth/nilai') ?>" class="waves-effect">
        <i class="mdi mdi-database"></i> <span> Input Nilai </span>
    </a>
</li>
<li>
    <a href="<?= base_url('auth/gallery') ?>" class="waves-effect">
        <i class="mdi mdi-folder-image"></i> <span> Gallery </span>
    </a>
</li>
<li>
    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-newspaper"></i> <span> Kegiatan <span
                class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
    <ul class="submenu">
        <li><a href="<?= base_url('auth/kegiatan') ?>">Data Informasi kegiatan</a></li>
        <?php if (session()->get('level') == 2) { ?>
        <?php } ?>
        <li class="nav-item">

        </li>
    </ul>
</li>
<?php if (session()->get('level') == 2) { ?>
    <li class="menu-title">Etc</li>
    <li>
        <a href="<?= base_url('auth/konfigurasi/user') ?>" class="waves-effect">
            <i class="mdi mdi-account-switch"></i> <span> Konfigurasi User </span>
        </a>
    </li>
    <li>
        <a href="<?= base_url('auth/konfigurasi/web') ?>" class="waves-effect">
            <i class="mdi mdi-settings-outline"></i> <span> Konfigurasi Web </span>
        </a>
    </li>
<?php } ?>
<?= $this->endSection('menu') ?>