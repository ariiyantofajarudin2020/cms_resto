<?php
helper('url');
// Memeriksa apakah pengguna sudah login
if (!isset(session()->username)) {
  return redirect()->to (base_url('/'));
  }
?>

<head>
    <?php include 'style.php'; ?>
</head>

<body>
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