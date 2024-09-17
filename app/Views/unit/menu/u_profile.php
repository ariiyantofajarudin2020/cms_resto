<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); ?>
<div id="showimg" class="overlay" onclick="release()" style="display:none">
    <img src="<?= base_url('images/'.$unit['photo']) ?>" alt="photo profil" width="500" height="auto">
</div>
<main id="main" class="main">

    <div class="pagetitle">
        <h5 class="card-title">Selamat datang di Aplikasi POS<span>| <?=$induk['induk_perusahaan']?></span></h5>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Sales Card - Foto profil unit -->
            <div class="col-3">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <br>
                        <!--Foto profil Unit-->
                        <img class="rounded-circle cur" src="<?= base_url('images/'.$unit['photo']) ?>"
                            alt="photo profil" width="200" height="auto" onclick="showimg()">
                    </div>
                </div>
            </div>
            <!-- End Sales Card -->

            <!-- Sales Card - Detail -->
            <div class="col-9">
                <div class="card info-card sales-card">
                    <!-- Detail Unit -->
                    <div class="card-body">
                        <h4 class="card-title">Profil <?= $unit['unit_nama']; ?></h4>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th>Nama Unit</th>
                                <td><?= $unit['unit_nama']; ?></td>
                            </tr>
                            <tr>
                                <th>URL</th>
                                <td><a href="http://localhost:8080/u/<?= $unit['wildcard']; ?>"
                                        target="blank">localhost:8080/u/<?= $unit['wildcard']; ?></a>
                                </td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td><?= $unit['unit_deskripsi']; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?= $unit['unit_alamat']; ?></td>
                            </tr>
                            <tr>
                                <th>No Telepon</th>
                                <td><?= $unit['unit_telepon']; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= $unit['unit_email']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <!-- Detail Induk -->
                    <div class="card-body">
                        <h4 class="card-title">Profil Usaha</h4>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th>Unit Induk</th>
                                <td>
                                    <?= $induk['induk_nama']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Perusahaan</th>
                                <td><?= $induk['induk_perusahaan']; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?= $induk['induk_alamat']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Jenis Usaha</th>
                                <td><?= $induk['induk_jenis']; ?></td>
                            </tr>
                            <tr>
                                <th>Pimpinan</th>
                                <td><?= $induk['induk_pic']; ?></td>
                            </tr>
                            <tr>
                                <th>No Telepon Pimpinan</th>
                                <td><?= $induk['induk_pic_telepon']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Sales Card -->

        </div>
    </section>
</main><!-- End #main -->

<?= $this->endSection() ?>