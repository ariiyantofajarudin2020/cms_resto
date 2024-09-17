<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); ?>
<div id="showimg" class="overlay" onclick="release()" style="display:none">
    <img src="<?= base_url('images/' . $user['user_photo']) ?>" alt="photo profil" width="500" height="auto">
</div>
<main id="main" class="main">

    <div class="pagetitle">
        <h5 class="card-title">Selamat datang di Aplikasi POS<span>| <?= $induk['induk_perusahaan'] ?></span></h5>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Sales Card - Foto profil unit -->
            <div class="col-3">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <br>
                        <!--Foto profil Unit-->
                        <img class="rounded-circle cur" src="<?= base_url('images/'.$user['user_photo'])?>"
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
                        <h4 class="card-title">Profil <?= $user['user_nama']; ?></h4>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th>Nama user / Username</th>
                                <td><?= $user['user_nama']; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?= $user['user_alamat']; ?></td>
                            </tr>
                            <tr>
                                <th>No Telepon</th>
                                <td><?= $user['user_telepon']; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= $user['user_email']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <!-- Detail Induk -->
                    <div class="card-body">
                        <h4 class="card-title">Daftar Unit yang dapat diakses</h4>
                        <table class="table table-sm">
                            <tbody>
                                <?php foreach($units as $u):?>
                                <tr>
                                    <td>
                                        <a href="/u/<?= $u['wildcard']; ?>?menu=profile"
                                            style="color:#03006e;font-weight:bold;">
                                            <img id="img" class="rounded-circle"
                                                src="<?=base_url( 'images/' . $u['photo']) ?>" alt="" width="50px"
                                                height="auto">
                                            <?= $u['unit_nama']; ?>
                                        </a>
                                    </td>
                                    <td><a href="<?= base_url('/u/' . $u['wildcard']) ?>">
                                            <button class="btn btn-success btn-sm">
                                                <?= base_url('/u/' . $u['wildcard']) ?>
                                            </button>
                                        </a></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Sales Card -->

        </div>
    </section>
</main><!-- End #main -->

<?= $this->endSection() ?>