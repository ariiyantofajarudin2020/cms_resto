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
                            <h4 class="card-title">Master Kategori Item</h4>

                            <!--tabel unit-->
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori Item</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($katitem as $key => $u) : ?>
                                    <tr>
                                        <td><text><?= ++$key ?></text>
                                        </td>
                                        <td><?= $u['item_kategori'] ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!--tombol detail-->
                                                <button class="btn btn-outline-primary btn-sm"
                                                    onclick="lihat<?=$key?>()">
                                                    <i class="fa fa-eye"></i> lihat
                                                </button>&nbsp
                                            </div>
                                        </td>
                                    </tr>
                                    <script>
                                    function lihat<?=$key?>() {
                                        disabledform();
                                        document.getElementById('unique_old').value = '<?=$u["item_kategori"]?>';
                                        document.getElementById('nama').value = '<?=$u["item_kategori"]?>';
                                        document.getElementById('mode').value = 'lihat';
                                        document.getElementById('id_katitem').value = '<?=$u["id_item_kategori"]?>';
                                        document.getElementById('judul').innerHTML = 'Detail info kategori item';
                                        document.getElementById('btn_edit').style.display = '';
                                        document.getElementById('btn_hapus').style.display = '';
                                        document.getElementById('btn_tambah').style.display = '';
                                        document.getElementById('btn_simpan').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = 'none';
                                    }
                                    </script>
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

                            <div class="pt-12 pb-2">
                                <h5 id="judul" class="card-title text-center pb-0 fs-4">Detail info kategori item</h5>
                            </div>
                            <form class="row g-3 needs-validation" novalidate
                                action="<?= base_url('/unit/post/up_katitem') ?>" enctype="multipart/form-data"
                                method="post">
                                <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
                                <input type="hidden" name="wc" value="<?= $wc ?>">
                                <input id="id_katitem" type="hidden" name="id_katitem">
                                <input id="mode" type="hidden" name="mode">
                                <input id="unique_old" type="hidden" name="unique_old">

                                <div class="col-6">
                                    <label for="nama" class="form-label">Nama Kategori</label>
                                    <input type="text" name="item_kategori" class="form-control" id="nama" disabled
                                        required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-12">

                                    <!--tombol tambah-->
                                    <button id="btn_tambah" type="button" class="btn btn-primary btn-sm"
                                        onclick="tambah()">
                                        <i class="fa fa-plus"></i>
                                        Tambah kategori item
                                    </button>
                                    <!--tombol simpan-->
                                    <button id="btn_simpan" class="btn btn-primary btn-sm" type="submit"
                                        style="display:none"><i class="fa fa-save"></i>
                                        Simpan
                                    </button>

                                    <!--tombol edit-->
                                    <button type="button" id="btn_edit" class="btn btn-success btn-sm" onclick="edit()"
                                        style="display:none">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>

                                    <!--tombol batal-->
                                    <button type="button" id="btn_batal" class="btn btn-danger btn-sm" onclick="batal()"
                                        style="display:none">
                                        <i class="fa fa-back"></i> Batal
                                    </button>&nbsp

                                    <!--tombol hapus-->
                                    <button type="submit" class="btn btn-danger  btn-sm" id="btn_hapus"
                                        style="display:none"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus ?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>

                                    <script>
                                    function enabledform() {
                                        document.getElementById('nama').disabled = false;
                                    }

                                    function disabledform() {
                                        document.getElementById('nama').disabled = true;
                                    }

                                    function resetvalue() {
                                        document.getElementById('nama').value = '';
                                    }

                                    function tambah() {
                                        resetvalue();
                                        enabledform();
                                        document.getElementById('mode').value = 'create';
                                        document.getElementById('id_katitem').value = '';
                                        document.getElementById('judul').innerHTML = 'Tambah kategori item baru';
                                        document.getElementById('btn_tambah').style.display = 'none';
                                        document.getElementById('btn_simpan').style.display = '';
                                        document.getElementById('btn_edit').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = '';
                                        document.getElementById('btn_hapus').style.display = 'none';
                                    }

                                    function edit() {
                                        enabledform();
                                        document.getElementById('mode').value = 'edit';
                                        document.getElementById('judul').innerHTML = 'Ubah data kategori item';
                                        document.getElementById('btn_tambah').style.display = 'none';
                                        document.getElementById('btn_simpan').style.display = '';
                                        document.getElementById('btn_edit').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = '';
                                        document.getElementById('btn_hapus').style.display = 'none';
                                    }

                                    function batal() {
                                        resetvalue();
                                        disabledform();
                                        document.getElementById('mode').value = 'lihat';
                                        document.getElementById('judul').innerHTML = 'Detail info kategori item';
                                        document.getElementById('btn_tambah').style.display = '';
                                        document.getElementById('btn_simpan').style.display = 'none';
                                        document.getElementById('btn_edit').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = 'none';
                                        document.getElementById('btn_hapus').style.display = 'none';
                                    }
                                    </script>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main><!-- End #main -->
<?= $this->endSection() ?>