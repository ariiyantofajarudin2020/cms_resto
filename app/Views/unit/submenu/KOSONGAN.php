<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); ?>
<main id="main" class="main">
    <div class="container">

        <section class="section dashboard">
            <div class="row">

                <!-- Body -->
                <div class="col-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h4 class="card-title">Setting Struk</h4>

                            <!--tombol tambah-->
                            <a href="<?=base_url('/u/'.$wc.'?menu=tools&submenu=k4f10&mode=create')?>">
                                <button type="button" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                    Tambah User
                                </button></a>
                        </div>
                    </div>
                </div>
                <!-- End Body -->
            </div>
        </section>
    </div>
</main><!-- End #main -->
<?= $this->endSection() ?>