<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); ?>
<main id="main" class="main">
    <div class="container">

        <section class="section dashboard">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h4 class="card-title">POS | <span>Point of Sales</span></h4>
                        </div>
                    </div>
                </div>
                <!-- End Sales Card -->
            </div>
        </section>
    </div>
</main><!-- End #main -->
<?= $this->endSection() ?>