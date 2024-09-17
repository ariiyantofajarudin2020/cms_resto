<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); ?>
<main id="main" class="main">
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">

                            <div class="pt-12 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Edit Account</h5>
                            </div>
                            <form class="row g-3 needs-validation" novalidate
                                action="<?= base_url('/unit/post/up_user') ?>" enctype="multipart/form-data"
                                method="post">
                                <input type="hidden" name="wc" value="<?= $wc ?>">
                                <input type="hidden" name="id" value="<?= $user['id_user'] ?>">
                                <div class="col-6">
                                    <label for="photo" class="form-label">Foto Profil</label>
                                    <br>
                                    <img src="<?= base_url('images/' . $user['user_photo']) ?>" alt="Profile Photo"
                                        width="100" height="100" id="photo-preview" required>
                                    <br>
                                    <input class="form-control" type="file" name="user_photo" id="photo" src=""
                                        onchange="previewPhoto()">
                                </div>
                                <div class="col-6">
                                </div>

                                <div class="col-6">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <input type="password" name="user_password" class="form-control" id="yourPassword">
                                    <div class="invalid-feedback">Mohon masukkan password kamu</div>
                                </div>

                                <div class="col-6">
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <input type="text" name="user_alamat" class="form-control" id="alamat"
                                        value="<?= $user['user_alamat']; ?>" required>
                                    <div class="invalid-feedback">Mohon masukkan alamat kamu</div>
                                </div>

                                <div class="col-6">
                                    <label for="telepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" name="user_telepon" class="form-control" id="telepon"
                                        value="<?= $user['user_telepon']; ?>" required>
                                    <div class="invalid-feedback">Mohon masukkan nomor telepon kamu</div>
                                </div>

                                <div class="col-6">
                                    <label for="yourEmail" class="form-label">Email</label>
                                    <input type="email" name="user_email" class="form-control" id="yourEmail"
                                        value="<?= $user['user_email']; ?>" required>
                                    <div class="invalid-feedback">Mohon masukkan email kamu</div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    </section>

    </div>
</main><!-- End #main -->
<?= $this->endSection() ?>