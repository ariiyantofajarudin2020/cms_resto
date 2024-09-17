<?= $this->extend('layout/u_layout') ?>
<?php $this->section('content'); ?>
<main id="main" class="main">
    <div class="container">

        <section class="section dashboard">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h4 class="card-title">Stock Opname</h4>
                            <form class="needs-validation" novalidate action="<?= base_url('/unit/post/up_opname') ?>"
                                method="POST">
                                <input type="hidden" name="id_induk" value="<?=$induk['id_induk']?>">
                                <input type="hidden" name="wc" value="<?=$wc?>">
                                <button class="btn btn-success btn-sm" type="submit"
                                    onclick="return simpan()">Proses</button>
                                <a class="btn btn-danger btn-sm"
                                    href="<?= base_url('/u/'.$wc.'?menu=stok&submenu=k4f4') ?>">Batal</a>
                                <br><br>
                                <div class="row tbl-sm">
                                    <div class="col-3">
                                        <label class="form-label" for="tanggal">Tanggal SO</label>
                                        <input class="form-control tbl-sm" name="tanggal" id="tanggal"
                                            value="<?=date('d/m/Y')?>" disabled>
                                        <br>
                                        <label class="form-label" for="id_so">ID SO</label>
                                        <input type="text" class="form-control tbl-sm" name="id_so" id="id_so"
                                            value="SO<?=$induk['id_induk'].'-'.date('dmyHis')?>" disabled>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label" for="keterangan">Keterangan</label>
                                        <textarea class="form-control tbl-sm cur" name="keterangan" id="keterangan"
                                            cols="30" rows="5" required></textarea>
                                        <div class="invalid-feedback">Tidak boleh kosong</div>
                                    </div>
                                </div>

                                <!--tabel unit-->
                                <table class="table table-stripped tbl-sm" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Satuan</th>
                                            <th>Kategori</th>
                                            <th>Opname</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($opname as $key => $u) : ?>
                                        <input type="hidden" name="id_item[]" value="<?= $u['item']['id_item']?>">
                                        <input type="hidden" name="qty_awal[]" value="<?= $u['item']['item_stock']?>">
                                        <tr>
                                            <td><text><?= ++$key ?></text>
                                            </td>
                                            <td><?= $u['item']['item_nama']?></td>
                                            <td><?= $u['item']['item_satuan']?></td>
                                            <td><?= $u['item']['item_kategori']?></td>
                                            <td><input type="number" class="form-control cur qty tbl-sm" name="qty_so[]"
                                                    style="width:80px" required>
                                                <div class="invalid-feedback">Tidak boleh kosong</div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Sales Card -->
            </div>
        </section>
        <script>
        function simpan() {
            let class_qty = document.getElementsByClassName('qty');
            for (let i = 0; i < class_qty.length; i++) {
                let qty = parseInt(class_qty[i].value);
                if (qty < 0) {
                    alert('Data tidak boleh minus (-) !!, minimal 0');
                    return false;
                }
            }
            document.getElementById('id_so').disabled = false;
            document.getElementById('tanggal').disabled = false;
            return confirm('Pastikan data sudah sesuai semua !!, Apakah data sudah sesuai ?');
        }
        </script>
    </div>
</main><!-- End #main -->
<?= $this->endSection() ?>