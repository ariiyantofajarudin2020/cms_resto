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
                            <h4 class="card-title">Konversi Stock | <span>Daftar Item</span></h4>

                            <!--tabel unit-->
                            <table class="table datatable table-sm" id="dataTable" width="100%" cellspacing="0">
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
                                                <button class="btn btn-success btn-sm"
                                                    onclick="add1(<?='`'.$u['id_item'].'`,`'.$u['item_nama'].'`,`'.$u['item_satuan'].'`'?>)">
                                                    1<i class="bi bi-arrow-bar-right bi-sm"></i>
                                                </button>
                                                <!--tombol 2-->
                                                <button class="btn btn-warning btn-sm"
                                                    onclick="add2(<?='`'.$u['id_item'].'`,`'.$u['item_nama'].'`,`'.$u['item_satuan'].'`'?>)">
                                                    2<i class="bi bi-arrow-bar-right bi-sm"></i>
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
                                <h5 id="judul" class="card-title text-center pb-0 fs-4">Detail Konversi</h5>
                            </div>
                            <form class="row g-3 needs-validation" novalidate
                                action="<?= base_url('/unit/post/up_konversi') ?>" enctype="multipart/form-data"
                                method="post" onsubmit="return simpan()">
                                <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
                                <input type="hidden" name="wc" value="<?= $wc ?>">
                                <input type="hidden" name="id1" id="id1">
                                <input type="hidden" name="id2" id="id2">
                                <!--nama item-->
                                <div class="col-6">
                                    <label for="nama1" class="form-label">Nama item 1</label>
                                    <input type="text" name="nama1" class="form-control" id="nama1" required disabled>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-6">
                                    <label for="nama2" class="form-label">Nama item 2</label>
                                    <input type="text" name="nama2" class="form-control" id="nama2" required disabled>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>
                                <!--satuan-->
                                <div class="col-6">
                                    <label for="satuan1" class="form-label">satuan item 1</label>
                                    <input type="text" name="satuan1" class="form-control" id="satuan1" required
                                        disabled>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-6">
                                    <label for="satuan2" class="form-label">satuan item 2</label>
                                    <input type="text" name="satuan2" class="form-control" id="satuan2" required
                                        disabled>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>
                                <!--konversi-->
                                <div class="col-6">
                                    <label for="konversi" class="form-label">Jumlah konversi</label>
                                    <input type="number" name="konversi" class="form-control" id="konversi" required>
                                    <div class="invalid-feedback">Mohon masukkan data</div>
                                </div>

                                <div class="col-6">
                                    <label for="hasil" class="form-label">Jumlah hasil</label>
                                    <input type="number" name="hasil" class="form-control" id="hasil" required>
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
                                    <button id="btn_simpan" class="btn btn-primary btn-sm" type="submit"><i
                                            class="fa fa-save"></i>
                                        Simpan
                                    </button>

                                    <!--tombol batal-->
                                    <button type="button" id="btn_batal" class="btn btn-danger btn-sm"
                                        onclick="batal()">
                                        <i class="fa fa-back"></i> Batal
                                    </button>&nbsp

                                    <script>
                                    function simpan() {
                                        let konversi = parseInt(document.getElementById('konversi').value);
                                        let hasil = parseInt(document.getElementById('hasil').value);
                                        if (konversi < 0 || hasil < 0) {
                                            alert('Tidak boleh ada nilai mines (-) !!');
                                            return false;
                                        } else if (confirm(
                                                'Pastikan data sudah sesuai !!, Apakah data sudah sesuai ?')) {
                                            document.getElementById('nama1').disabled = false;
                                            document.getElementById('nama2').disabled = false;
                                            document.getElementById('satuan1').disabled = false;
                                            document.getElementById('satuan2').disabled = false;
                                            return true;
                                        }
                                        return false;
                                    }

                                    function batal() {
                                        document.getElementById('nama1').value = '';
                                        document.getElementById('nama2').value = '';
                                        document.getElementById('satuan1').value = '';
                                        document.getElementById('satuan2').value = '';
                                        document.getElementById('konversi').value = '';
                                        document.getElementById('hasil').value = '';
                                        document.getElementById('keterangan').value = '';
                                    }

                                    function add1(id, nama, satuan) {
                                        document.getElementById('id1').value = id;
                                        document.getElementById('nama1').value = nama;
                                        document.getElementById('satuan1').value = satuan;
                                    }

                                    function add2(id, nama, satuan) {
                                        document.getElementById('id2').value = id;
                                        document.getElementById('nama2').value = nama;
                                        document.getElementById('satuan2').value = satuan;
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