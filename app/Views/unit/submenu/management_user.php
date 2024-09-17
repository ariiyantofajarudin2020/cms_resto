<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); ?>
<main id="main" class="main">
    <div class="container">

        <section class="section dashboard">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h4 class="card-title">User Management</h4>
                            <!--tombol tambah-->
                            <a href="<?=base_url('/u/'.$wc.'?menu=tools&submenu=k4f10&mode=create')?>">
                                <button type="button" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                    Tambah User
                                </button></a>

                            <br><br>

                            <!--tabel unit-->
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user_by_induk as $key => $u) : ?>
                                    <tr>
                                        <td><text><?= ++$key ?></text>
                                        </td>
                                        <td><?= $u['user_nama'] ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!--tombol detail-->
                                                <a
                                                    href="<?=base_url('/u/'.$wc.'?menu=tools&submenu=k4f10&mode=detail&select='.bin2hex(base64_encode($u['id_user']))) ?>">
                                                    <button class="btn btn-outline-primary btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </button>&nbsp
                                                </a>
                                                <!--tombol edit-->
                                                <a
                                                    href="<?=base_url('/u/'.$wc.'?menu=tools&submenu=k4f10&mode=edit&select='.bin2hex(base64_encode($u['id_user']))) ?>">
                                                    <button class="btn btn-outline-success btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </button>&nbsp
                                                </a>
                                                <!--tombol hapus-->
                                                <a href="<?= base_url('/unit/mu_delete/' . bin2hex(base64_encode($u['id_user'])).'/'.$wc) ?>"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus ?')">
                                                    <button class="btn btn-outline-danger  btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
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
                            <?php include 'create_account_route.php';?>
                            <?php include 'um_detail_user.php';?>
                            <?php include 'um_edit_user.php';?>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->
<?= $this->endSection() ?>