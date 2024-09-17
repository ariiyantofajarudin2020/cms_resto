<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); ?>
<main id="main" class="main">

    <section class="section dashboard">
        <div class="row">

            <!-- body -->
            <div class="col-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">TEST<span>| <?=$induk['induk_perusahaan']?></span></h5>
                        <?php include 'test.php'; ?>
                    </div>
                </div>
            </div>
            <!-- End Sales Card -->

        </div>
    </section>
</main><!-- End #main -->

<?= $this->endSection() ?>