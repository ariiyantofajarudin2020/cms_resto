<?= $this->extend('layout/m_layout') ?>
<?php $this->section('content') ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h5 class="card-title">Selamat datang di Aplikasi POS<span>| PT.Nama Perusahaan</span></h5>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-12">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h4 class="card-title">Unit Induk <span>
                                        <nav>
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item">Management</li>
                                                <li class="breadcrumb-item active"><a
                                                        href="<?=base_url('/?menu=induk')?>">Unit Induk</a>
                                                </li>
                                            </ol>
                                        </nav>
                                    </span></h4>
                                <div class="col-4">
                                    <form action="<?= base_url('akses_update/1') ?>" method="post">
                                        <b><label class="form-label" for="password">Username :
                                                <?php echo session()->username?></label></b>
                                        <input type="password" name="password" class="form-control" id="yourPassword"
                                            required placeholder="Masukkan Password Baru">
                                        <br>

                                        <button class="btn btn-primary w-100" type="submit">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->

            </div>
        </div><!-- End Left side columns -->
    </section>

</main><!-- End #main -->

<?= $this->endSection()?>