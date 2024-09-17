<?= $this->extend('layout/m_layout') ?>
<?php $this->section('content'); ?>

<?php 
$from='/?menu=create_unit_account';?>
<main id="main" class="main">
    <div class="container">
        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <?php include(APPPATH . 'Views/unit/submenu/create_account.php')?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main><!-- End #main -->
<!-- End #main -->
<?= $this->endSection() ?>