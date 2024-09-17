<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); ?>
<?php include APPPATH.'Views/layout/u_function.php';?>
<main id="main" class="main">
    <div class="container">

        <section class="section dashboard">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h4 class="card-title">Initial Shift | <span>Sedang Berlangsung</span></h4>

                            <table class="table table-borderless tbl-sm " width="100%" cellspacing="0">
                                <tr>
                                    <th>Tanggal</th>
                                    <td><?=$init_current['initial_tanggal']?></td>
                                </tr>
                                <tr>
                                    <th>Jam Initial</th>
                                    <td><?=$init_current['initial_jam']?></td>
                                </tr>
                                <tr>
                                    <th>Shift</th>
                                    <td><?=$init_current['shift']?></td>
                                </tr>
                                <tr>
                                    <th>Kasir</th>
                                    <td><?=$init_current['user_nama']?></td>
                                </tr>
                                <tr>
                                    <th>Modal</th>
                                    <td><?=rp($init_current['initial_modal'])?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End Sales Card -->

                <!-- Halaman Detail Unit -->
                <!-- Sales Card -->
                <div class="col-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">

                            <div class="pt-12 pb-2">
                                <h4 id="judul" class="card-title text-center">Daftar initial aktif</h4>
                            </div>
                            <!--tabel initial aktif-->
                            <table class="table datatable tbl-sm" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Shift</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($init_active as $key => $v) : ?>
                                    <tr>
                                        <td><text><?= ++$key ?></text>
                                        </td>
                                        <td><?= $v['user_nama'] ?></td>
                                        <td><?= $v['initial_tanggal'] ?></td>
                                        <td><?= $v['initial_jam'] ?></td>
                                        <td><?= $v['shift'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main><!-- End #main -->
<?= $this->endSection() ?>