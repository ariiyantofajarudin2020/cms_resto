<?= $this->extend('layout/m_layout') ?>
<?php $this->section('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h5 class="card-title">Selamat datang di Aplikasi POS<span>| PT.Nama Perusahaan</span></h5>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Sales Card -->
            <div class="col-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h4 class="card-title">Unit Induk <span>
                                <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">Management</li>
                                        <li class="breadcrumb-item active"><a href="<?=base_url('/?menu=induk')?>">Unit
                                                Induk</a></li>
                                    </ol>
                                </nav>
                            </span></h4>
                        <!--tombol tambah-->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#tambahinduk">
                            <i class="fa fa-plus"></i>
                            Tambah Unit Induk
                        </button>

                        <br><br>

                        <!--tabel unit-->
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Unit Induk</th>
                                    <th>Jumlah Unit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getdata as $key => $u) : ?>
                                <tr>
                                    <td><text style="visibility: hidden;"><?= ++$key ?></text><?= $u['id_induk'] ?></td>
                                    <td><?= $u['induk_nama'] ?></td>
                                    <td><?= $u['jumlah_unit'] ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <!--tombol detail-->
                                            <a href="/?menu=induk&select=<?= $u['id_induk'] ?>">
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </button>&nbsp
                                            </a>
                                            <!--tombol edit-->
                                            <a href="/?menu=induk&edit=<?= $u['id_induk'] ?>">
                                                <button class="btn btn-outline-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </button>&nbsp
                                            </a>
                                            <!--tombol hapus-->

                                            <a href="<?= base_url('deleteinduk/' . $u['id_induk']) ?>"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus ?')">
                                                <button class="btn btn-outline-danger btn-sm">
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
                        <?php include 'edit_unit_induk.php'; ?>
                        <?php include 'detail_unit_induk.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Halaman Tambah Unit Induk -->
<?php include 'tambah_unit_induk.php';?>
<!-- End #main -->
<?= $this->endSection() ?>