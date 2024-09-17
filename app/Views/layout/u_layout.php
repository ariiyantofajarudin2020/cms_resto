<?php
helper('url');
// Memeriksa apakah pengguna sudah login
if (!isset(session()->username)) {
  return redirect()->to (base_url('/'));
  }
$p1=$p2=$p3=$p4=$p5=$p6=$p7='collapsed';
// Menu aktif
switch ($page) {
    case 'profile':
        $p1 = '';
        break;
    case 'master':
        $p2 = '';
        break;
    case 'stok':
        $p3 = '';
        break;
    case 'pembelian':
        $p4 = '';
        break;
    case 'penjualan':
        $p5 = '';
        break;
    case 'laporan':
        $p6 = '';
        break;
    case 'tools':
        $p7 = '';
        break;
    default:
        break;
}

?>

<head>
    <?php include 'style.php'; ?>
</head>

<body>
    <!-- ======= Header ======= -->

    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url('/u/'.$unit['wildcard'])?>" class="logo d-flex align-items-center">
                <img src="<?= base_url('images/'.$unit['photo']) ?>" alt="">
                <span class=" d-none d-lg-block"><?=$unit['unit_nama']?></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>

        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url('images/'.$user['user_photo']) ?>" alt=" Profile" class="rounded-circle">
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
                            <a class="dropdown-item d-flex align-items-center"
                                href="<?= base_url('/u/' . $unit['wildcard']) . '?menu=user_profile' ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="<?= base_url('/u/' . $unit['wildcard']) . '?menu=edit_account' ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Edit Account</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('/u/logout')?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
    <div id="loading-container" class="progress mt-3"
        style="position: fixed; top: 40; left: 0; width: 100%;height:5px;z-index: 1000;">
        <div id="loading-progress" class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
            role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link <?=$p1;?>" href="<?=base_url('/u/'.$unit['wildcard'].'?menu=profile')?>">
                    <i class="bi bi-person-circle"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$p2;?>" href="<?=base_url('/u/'.$unit['wildcard'].'?menu=master')?>">
                    <i class="bi bi-grid"></i>
                    <span>Master</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$p3;?>" href="<?=base_url('/u/'.$unit['wildcard'].'?menu=stok')?>">
                    <i class="bi bi-box"></i>
                    <span>Stok</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$p4;?>" href="<?=base_url('/u/'.$unit['wildcard'].'?menu=pembelian')?>">
                    <i class="bi bi-cart2"></i>
                    <span>Pembelian</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$p5;?>" href="<?=base_url('/u/'.$unit['wildcard'].'?menu=penjualan')?>">
                    <i class="bi bi-cash-coin"></i>
                    <span>Penjualan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$p6;?>" href="<?=base_url('/u/'.$unit['wildcard'].'?menu=laporan')?>">
                    <i class="bi bi-journal-text"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->
            <!-- End Dashboard Nav -->

            <li class="nav-heading">Alat</li>

            <li class="nav-item">
                <a class="nav-link <?=$p7;?>" href="<?=base_url('/u/'.$unit['wildcard'].'?menu=tools')?>">
                    <i class=" bi bi-tools"></i>
                    <span>Tools</span>
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
    <script src="<?= base_url('assets/custom/u_script.js') ?>"></script>
    <script src="<?= base_url('assets/custom/global.js') ?>"></script>
</body>

</html>