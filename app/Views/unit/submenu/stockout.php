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
                            <h4 class="card-title">Stock Keluar | <span>Daftar Item</span></h4>

                            <!--tabel unit-->
                            <table class="table datatable tbl-sm" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Item</th>
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
                                            <!--tombol 1-->
                                            <div class="btn-group">
                                                <button class="btn btn-outline-primary btn-sm"
                                                    onclick="add(<?='`'.$u['id_item'].'`,`'.$u['item_nama'].'`,'.$u['item_stock']?>)">
                                                    <i class="bi bi-arrow-up-right-circle-fill"></i>
                                                </button>
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

                            <div class="pt-12 pb-2">
                                <h4 id="judul" class="card-title text-center">Detail Item</h4>
                            </div>
                            <form class="row g-3 needs-validation" novalidate
                                action="<?= base_url('/unit/post/up_stockout') ?>" enctype="multipart/form-data"
                                method="post">
                                <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
                                <input type="hidden" name="wc" value="<?= $wc ?>">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" id="stock">
                                <!--nama item-->
                                <div class="col-6">
                                    <label for="nama" class="form-label">Nama item</label>
                                    <input type="text" name="nama" class="form-control" id="nama" required disabled>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-6">
                                    <label for="jumlah" class="form-label">Jumlah Keluar</label>
                                    <input type="number" name="jumlah" class="form-control" id="jumlah" required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-12">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" id="keterangan"
                                        required></textarea>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-12">
                                    <!--tombol simpan-->
                                    <button id="btn_simpan" class="btn btn-primary btn-sm" type="submit"
                                        onclick="return simpan()"><i class="fa fa-save"></i>
                                        Proses
                                    </button>

                                    <!--tombol batal-->
                                    <button type="button" id="btn_batal" class="btn btn-danger btn-sm"
                                        onclick="batal()">
                                        <i class="fa fa-back"></i> Batal
                                    </button>&nbsp

                                    <script>
                                    function simpan() {
                                        let stock = parseInt(document.getElementById('stock').value);
                                        let jumlah = parseInt(document.getElementById('jumlah').value);
                                        if (jumlah > stock) {
                                            alert('Jumlah stock keluar tidak boleh melebihi stock yang tersedia !!');
                                            return false;
                                        } else if (jumlah < 1) {
                                            alert('Jumlah stock keluar tidak boleh mines (-) !!');
                                            return false;
                                        } else {
                                            return confirm('Pastikan data sudah sesuai !, apakah sudah sesuai ?');
                                        }
                                    }

                                    function batal() {
                                        document.getElementById('id').value = '';
                                        document.getElementById('stock').value = '';
                                        document.getElementById('nama').value = '';
                                        document.getElementById('jumlah').value = '';
                                        document.getElementById('keterangan').value = '';
                                    }

                                    function add(id, nama, stock) {
                                        document.getElementById('id').value = id;
                                        document.getElementById('stock').value = stock;
                                        document.getElementById('nama').value = nama;
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