<?= $this->extend('layout/m_layout') ?>
<?php $this->section('content'); ?>
<?php $editmode='';
if (isset($edits)):
    $editmode='style="display:none;"';  
endif;
?>


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
                        <h4 class="card-title">Unit Aplikasi <span>
                                <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">Management</li>
                                        <li class="breadcrumb-item active"><a href="<?=base_url('/?menu=unit')?>">Unit
                                                Aplikasi</a></li>
                                    </ol>
                                </nav>
                            </span></h4>
                        <!--tombol tambah-->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#tambahunit" <?=$editmode?>>
                            <i class="fa fa-plus"></i>
                            Tambah Unit Aplikasi
                        </button>

                        <br><br>

                        <!--tabel unit-->
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Unit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($unit as $key => $u) : ?>
                                <tr>
                                    <td><text style="visibility: hidden;"><?= ++$key ?></text><?= $u['id_unit'] ?></td>
                                    <td><?= $u['unit_nama'] ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <!--tombol detail-->
                                            <a href="<?=base_url('/?menu=unit&select='. $u['id_unit']) ?>">
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </button>&nbsp
                                            </a>
                                            <!--tombol edit-->
                                            <a href="<?=base_url('/?menu=unit&edit='. $u['id_unit']) ?>">
                                                <button class="btn btn-outline-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </button>&nbsp
                                            </a>
                                            <!--tombol hapus-->
                                            <a href="<?= base_url('deleteunit/' . $u['id_unit']) ?>"
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
                        <?php include 'detail_unit.php';?>
                        <?php include 'edit_unit.php';?>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</main><!-- End #main -->

<!-- Halaman Tambah Unit -->
<?php include 'tambah_unit.php';?>
<?= $this->endSection() ?>