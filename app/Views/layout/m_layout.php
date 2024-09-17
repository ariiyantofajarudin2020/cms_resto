<?php
helper('url');
// Memeriksa apakah pengguna sudah login
if (!isset(session()->username)) {
    return redirect()->to(base_url('/'));
}
// Menu aktif
switch ($page) {
    case 'induk':
        $p1 = '';
        $p2 = $p3 = $p4 = 'collapsed';
        break;
    case 'unit':
        $p1 = $p3 = $p4 = 'collapsed';
        $p2 = '';
        break;
    case 'changepass':
        $p1 = $p2 = $p4 = 'collapsed';
        $p3 = '';
        break;
    case 'create_unit_account':
        $p1 = $p2 = $p3 = 'collapsed';
        $p4 = '';
        break;
    default:
        $p1 = 'collapsed';
        $p2 = 'collapsed';
        $p3 = 'collapsed';
        $p4 = 'collapsed';
        break;
}
?>
<?php include 'style.php'?>

<head>

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
                <span class=" d-none d-lg-block">MANAGEMENT RESTO</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>

        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url('assets/img/profile-img.jpg') ?>" alt=" Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo session()->username ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $_SESSION['username'] ?></h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?=base_url('logout')?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link <?=$p1;?>" href="/?menu=induk">
                    <i class="bi bi-grid"></i>
                    <span>Halaman Utama</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$p2;?>" href="/?menu=unit">
                    <i class="bi bi-grid"></i>
                    <span>Unit Aplikasi</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <!-- End Dashboard Nav -->

            <li class="nav-heading">Alat</li>

            <li class="nav-item">
                <a class="nav-link <?=$p3;?>" href="/?menu=changepass">
                    <i class="bi bi-card-list"></i>
                    <span>Ganti Password</span>
                </a>
            </li><!-- End User Management Nav -->

            <li class="nav-item">
                <a class="nav-link <?= $p4; ?>" href="/?menu=create_unit_account">
                    <i class="bi bi-card-list"></i>
                    <span>Buat akun untuk Unit</span>
                </a>
            </li><!-- End User Management Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <!-- Begin Page Content -->
    <?php if (session()->getFlashdata('success')): ?>
    <script>
    alert('<?= session()->getFlashdata('success') ?>');
    </script>
    <div id="success-alert"
        class="alert alert-success align-items-center justify-content-center alert-dismissible fade show position-fixed bottom-0 start-50 translate-middle-x mb-3"
        style="z-index: 9999;" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
    <script>
    alert('<?= session()->getFlashdata('error') ?>');
    </script>
    <div id="error-alert"
        class="alert alert-danger align-items-center justify-content-center alert-dismissible fade show position-fixed bottom-0 start-50 translate-middle-x mb-3"
        style="z-index: 9999;" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    <?= $this->renderSection('content') ?>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/chart.js/chart.umd.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/echarts/echarts.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/quill/quill.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/php-email-form/validate.js') ?>"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
    <!-- JS Custom pribadi -->
    <script src="<?= base_url('assets/custom/m_script.js') ?>"></script>
    <script src="<?= base_url('assets/custom/global.js') ?>"></script>
</body>

</html>