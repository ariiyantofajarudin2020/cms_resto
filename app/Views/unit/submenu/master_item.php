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
                            <h4 class="card-title">Master item barang</h4>

                            <!--tabel unit-->
                            <table class="table datatable table-sm" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Item barang</th>
                                        <th>Satuan</th>
                                        <th>Stock</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($item as $key => $u) : ?>
                                    <tr>
                                        <td><text><?= ++$key ?></text>
                                        </td>
                                        <td><?= $u['item_nama'] ?></td>
                                        <td><?= $u['item_satuan'] ?></td>
                                        <td><?= $u['item_stock'] ?></td>
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
                                        document.getElementById('unique_old').value = '<?=$u["item_barcode"]?>';
                                        document.getElementById('nama').value = '<?=$u["item_nama"]?>';
                                        document.getElementById('barcode').value = '<?=$u["item_barcode"]?>';
                                        document.getElementById('keterangan').value = '<?=$u["item_keterangan"]?>';
                                        document.getElementById('satuan').value = '<?=$u["item_satuan"]?>';
                                        document.getElementById('harga').value = '<?=$u["item_harga"]?>';
                                        document.getElementById('stock').value = '<?=$u["item_stock"]?>';
                                        document.getElementById('item_kategori_selected').value =
                                            '<?=$u["id_item_kategori"]?>';
                                        document.getElementById('item_kategori_selected').innerHTML =
                                            '<?=$u["item_kategori"]?>';

                                        document.getElementById('mode').value = 'lihat';
                                        document.getElementById('id_item').value = '<?=$u["id_item"]?>';
                                        document.getElementById('judul').innerHTML = 'Detail info  item';
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
                                <h5 id="judul" class="card-title text-center pb-0 fs-4">Detail info item</h5>
                            </div>
                            <form class="row g-3 needs-validation" novalidate
                                action="<?= base_url('/unit/post/up_item') ?>" enctype="multipart/form-data"
                                method="post">
                                <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
                                <input type="hidden" name="wc" value="<?= $wc ?>">
                                <input id="id_item" type="hidden" name="id_item">
                                <input id="mode" type="hidden" name="mode">
                                <input id="unique_old" type="hidden" name="unique_old">

                                <div class="col-6">
                                    <label for="nama" class="form-label">Nama item</label>
                                    <input type="text" name="item_nama" class="form-control" id="nama" disabled
                                        required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>
                                <div class="col-6">
                                    <label for="barcode" class="form-label">Item barcode</label>
                                    <input type="text" name="item_barcode" class="form-control" id="barcode" disabled
                                        required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>
                                <div class="col-6">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select name="id_item_kategori" id="kategori" class="form-select cur" disabled
                                        required>
                                        <option selected value="" id="item_kategori_selected"></option>
                                        <?php
                                            foreach($katitem as $v) {
                                        ?>
                                        <option value="<?=$v['id_item_kategori']?>">
                                            <?=$v['item_kategori']?>
                                        </option>
                                        <?php
                                            }
                                        ?>

                                    </select>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>
                                <div class="col-6">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" name="item_keterangan" class="form-control" id="keterangan"
                                        disabled required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>
                                <div class="col-6">
                                    <label for="satuan" class="form-label">Satuan</label>
                                    <input type="text" name="item_satuan" class="form-control" id="satuan" disabled
                                        required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>
                                <div class="col-6">
                                    <label for="harga" class="form-label">Harga beli</label>
                                    <input type="number" name="item_harga" class="form-control" id="harga" disabled
                                        required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>
                                <div class="col-6">
                                    <label for="stock" class="form-label">Stok</label>
                                    <input type="number" name="item_stock" class="form-control" id="stock" disabled>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-12">

                                    <!--tombol tambah-->
                                    <button id="btn_tambah" type="button" class="btn btn-primary btn-sm"
                                        onclick="tambah()">
                                        <i class="fa fa-plus"></i>
                                        Tambah item
                                    </button>
                                    <!--tombol simpan-->
                                    <button id="btn_simpan" class="btn btn-primary btn-sm" type="submit"
                                        style="display:none" onclick="simpan()"><i class="fa fa-save"></i>
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
                                    function simpan() {
                                        document.getElementById('stock').disabled = false;
                                    }

                                    function enabledform() {
                                        document.getElementById('nama').disabled = false;
                                        document.getElementById('barcode').disabled = false;
                                        document.getElementById('kategori').disabled = false;
                                        document.getElementById('keterangan').disabled = false;
                                        document.getElementById('satuan').disabled = false;
                                        document.getElementById('harga').disabled = false;
                                    }

                                    function disabledform() {
                                        document.getElementById('nama').disabled = true;
                                        document.getElementById('barcode').disabled = true;
                                        document.getElementById('kategori').disabled = true;
                                        document.getElementById('keterangan').disabled = true;
                                        document.getElementById('satuan').disabled = true;
                                        document.getElementById('harga').disabled = true;
                                    }

                                    function resetvalue() {
                                        document.getElementById('nama').value = '';
                                        document.getElementById('barcode').value = '';
                                        document.getElementById('keterangan').value = '';
                                        document.getElementById('satuan').value = '';
                                        document.getElementById('harga').value = '';
                                        document.getElementById('stock').value = '';
                                        document.getElementById('item_kategori_selected').value = '';
                                        document.getElementById('item_kategori_selected').innerHTML = '';
                                    }

                                    function tambah() {
                                        resetvalue();
                                        enabledform();
                                        document.getElementById('mode').value = 'create';
                                        document.getElementById('id_item').value = '';
                                        document.getElementById('judul').innerHTML = 'Tambah item baru';
                                        document.getElementById('btn_tambah').style.display = 'none';
                                        document.getElementById('btn_simpan').style.display = '';
                                        document.getElementById('btn_edit').style.display = 'none';
                                        document.getElementById('btn_batal').style.display = '';
                                        document.getElementById('btn_hapus').style.display = 'none';
                                    }

                                    function edit() {
                                        enabledform();
                                        document.getElementById('mode').value = 'edit';
                                        document.getElementById('judul').innerHTML = 'Ubah data item';
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
                                        document.getElementById('judul').innerHTML = 'Detail info item';
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