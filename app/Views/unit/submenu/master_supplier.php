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
                            <h4 class="card-title">Master Supplier</h4>

                            <!--tabel unit-->
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Supplier</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($supplier as $key => $u) : ?>
                                    <tr>
                                        <td><text><?= ++$key ?></text>
                                        </td>
                                        <td><?= $u['supplier_nama'] ?></td>
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
                                        document.getElementById('unique_old').value = '<?=$u["supplier_nama"]?>';
                                        document.getElementById('nama').value = '<?=$u["supplier_nama"]?>';
                                        document.getElementById('alamat').value = '<?=$u["supplier_alamat"]?>';
                                        document.getElementById('telepon').value = '<?=$u["supplier_telepon"]?>';
                                        document.getElementById('email').value = '<?=$u["supplier_email"]?>';
                                        document.getElementById('item').value = '<?=$u["supplier_item"]?>';
                                        document.getElementById('mode').value = 'lihat';
                                        document.getElementById('id_supplier').value = '<?=$u["id_supplier"]?>';
                                        document.getElementById('judul').innerHTML = 'Detail info supplier';
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
                                <h5 id="judul" class="card-title text-center pb-0 fs-4">Edit Data User</h5>
                            </div>
                            <form class="row g-3 needs-validation" novalidate
                                action="<?= base_url('/unit/post/up_supplier') ?>" enctype="multipart/form-data"
                                method="post">
                                <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
                                <input type="hidden" name="wc" value="<?= $wc ?>">
                                <input id="id_supplier" type="hidden" name="id_supplier">
                                <input id="unique_old" type="hidden" name="unique_old">
                                <input id="mode" type="hidden" name="mode">

                                <div class="col-6">
                                    <label for="nama" class="form-label">Nama Supplier</label>
                                    <input type="text" name="nama" class="form-control" id="nama" disabled required>
                                    <div class="invalid-feedback">Mohon masukkan username kamu</div>
                                </div>

                                <div class="col-6">
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <input type="text" name="alamat" class="form-control" id="alamat" disabled>
                                    <div class="invalid-feedback">Mohon masukkan alamat</div>
                                </div>

                                <div class="col-6">
                                    <label for="telepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" name="telepon" class="form-control" id="telepon" disabled>
                                    <div class="invalid-feedback">Mohon masukkan nomor telepon</div>
                                </div>

                                <div class="col-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" disabled>
                                    <div class="invalid-feedback">Mohon masukkan email kamu</div>
                                </div>
                                <div class="col-12">
                                    <label for="item" class="form-label">Daftar Item :</label>
                                    <textarea class="form-control" id="item" name="item" id="" cols="30" rows="5"
                                        disabled>
                                    </textarea>
                                </div>
                                <div class="col-12">

                                    <!--tombol tambah-->
                                    <button id="btn_tambah" type="button" class="btn btn-primary btn-sm"
                                        onclick="tambah()">
                                        <i class="fa fa-plus"></i>
                                        Tambah Supplier
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
                                        document.getElementById('alamat').disabled = false;
                                        document.getElementById('telepon').disabled = false;
                                        document.getElementById('email').disabled = false;
                                        document.getElementById('item').disabled = false;
                                    }

                                    function disabledform() {
                                        document.getElementById('nama').disabled = true;
                                        document.getElementById('alamat').disabled = true;
                                        document.getElementById('telepon').disabled = true;
                                        document.getElementById('email').disabled = true;
                                        document.getElementById('item').disabled = true;
                                    }

                                    function resetvalue() {
                                        document.getElementById('nama').value = '';
                                        document.getElementById('alamat').value = '';
                                        document.getElementById('telepon').value = '';
                                        document.getElementById('email').value = '';
                                        document.getElementById('item').value = '';
                                    }

                                    function tambah() {
                                        resetvalue();
                                        enabledform();
                                        document.getElementById('mode').value = 'create';
                                        document.getElementById('id_supplier').value = '';
                                        document.getElementById('judul').innerHTML = 'Tambah supplier baru';
                                        document.getElementById('btn_tambah').style.display = 'none';
                                        document.getElementById('btn_simpan').style.display = '';
                                        document.getElementById('btn_edit').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = '';
                                        document.getElementById('btn_hapus').style.display = 'none';
                                    }

                                    function edit() {
                                        enabledform();
                                        document.getElementById('mode').value = 'edit';
                                        document.getElementById('judul').innerHTML = 'Ubah data supplier';
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
                                        document.getElementById('judul').innerHTML = 'Detail info supplier';
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