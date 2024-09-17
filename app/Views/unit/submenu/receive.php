<?= $this->extend('layout/u_layout'); ?>
<?php $this->section('content'); ?>
<?php include APPPATH.'Views/layout/u_function.php';?>
<main id="main" class="main">
    <div class="container">
        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <button id="btn_minimize" class="btn btn-success btn-sm" onclick="minimize()"><i
                            class="bi bi-arrows-angle-contract"></i></button>
                    <button id="btn_maximize" style="display:none" class="btn btn-warning btn-sm"
                        onclick="maximize()"><i class="bi bi-arrows-angle-expand"></i></button>
                </div>
                <div class="col-5" id="po_list">
                    <div class="card info-card sales-card">
                        <div class="card-body">

                            <h4 class="card-title">Daftar PO Aktif</h4>
                            <!--tabel unit-->
                            <table class="table datatable tbl-sm" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>PO ID</th>
                                        <th>Supplier</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (empty($podata)) {
                                        echo 'Tidak ada data';
                                    }else{
                                    foreach ($podata as $key => $data) :
                                    $key++;
                                    ?>
                                    <tr>
                                        <td><span><text><?=$key?></text></span>
                                        </td>
                                        <td><span><?= $data['po']['id_po'] ?></span></td>
                                        <td><span><?= $data['supplier']['supplier_nama'] ?></span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!--tombol detail-->
                                                <button class="btn btn-outline-primary btn-sm"
                                                    onclick="pilih(<?='`'.$key.'`'?>)">
                                                    <i class="bi bi-arrow-up-right-circle-fill"></i>
                                                </button>&nbsp
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-7" id="po_detail">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h4 class="card-title">Penerimaan Barang</h4>

                            <?php 
                            if (empty($podata)) {
                                        echo 'Tidak ada data';
                                    }else{
                            foreach ($podata as $key => $v) {$key++;?>
                            <div class="row detail" id="detail<?=$key?>" style="display:none">
                                <form class="row g-3 needs-validation" novalidate
                                    action="<?= base_url('/unit/post/up_receive') ?>" method="post"
                                    onsubmit="return simpan()">
                                    <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
                                    <input type="hidden" name="wc" value="<?= $wc ?>">
                                    <input type="hidden" name="id" class="form-control" value="<?=$v['po']['id_po']?>"
                                        required>
                                    <div class="col-6">
                                        <table class="table table-borderless tbl-sm">
                                            <tr>
                                                <th width="30%">ID PO</th>
                                                <td><?=$v['po']['id_po']?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Supplier</th>
                                                <td><?=$v['supplier']['supplier_nama']?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Tanggal</th>
                                                <td><?=$v['po']['po_tanggal']?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Keterangan</th>
                                                <td><textarea class="form-control" name="rec_keterangan" cols="30"
                                                        rows="2"></textarea></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <table class="table table-borderless tbl-sm">
                                            <tr>
                                                <th width="30%">User</th>
                                                <td><?=$v['user']['user_nama']?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Keterangan</th>
                                                <td><?=$v['po']['po_keterangan']?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Total Harga</th>
                                                <td><?=rp($v['po']['po_harga'])?></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-12">
                                        <h5 class="card-title">Daftar Item</h5>
                                        <table class="table table-stripped tbl-sm">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Item</th>
                                                    <th>Harga</th>
                                                    <th>Satuan</th>
                                                    <th>Order</th>
                                                    <th>Aktual</th>
                                                    <th>Aktual Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($v['item'] as $k=>$i) {$k++
                                                ?>
                                                <input type="hidden" name="id_puritem[]" value="<?=$i['id_pur_item']?>">
                                                <input type="hidden" name="id_item[]" value="<?=$i['id_item']?>"></tr>
                                                <tr>
                                                    <td><?=$k?></td>
                                                    <td><?=$i['item_nama']?></td>
                                                    <td><?=rp($i['item_harga'])?></td>
                                                    <td><?=$i['item_satuan']?></td>
                                                    <td><?=$i['po_item_qty']?></td>
                                                    <td>
                                                        <input type="number" class="form-control qty" style="width:80px"
                                                            name="rec_qty[]" required>
                                                        <div class="invalid-feedback">Tidak boleh kosong</div>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control harga"
                                                            style="width:100px" name="rec_harga[]" required>
                                                        <div class="invalid-feedback">Tidak boleh kosong</div>
                                                    </td>
                                                </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <!--tombol simpan-->
                                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i>
                                            Proses
                                        </button>
                                        <!--tombol batal-->
                                        <button type="button" class="btn btn-danger btn-sm" onclick="batal()">
                                            <i class="fa fa-back"></i> Batal
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <script>
    function simpan() {
        let class_qty = document.getElementsByClassName('qty');
        let class_harga = document.getElementsByClassName('harga');
        for (let i = 0; i < class_qty.length; i++) {
            let qty = parseInt(class_qty[i].value);
            let harga = parseInt(class_harga[i].value);
            if (qty < 0 || harga < 0) {
                alert('Qty atau Harga tidak boeleh mines (-) !!');
                return false;
            }
        }
        return confirm('Pastikan data sudah sesuai !, apakah data sudah sesuai ?');
    }

    function pilih(key) {
        hide_detail_tbl();
        document.getElementById('detail' + key).style.display = '';
    }

    function minimize() {
        document.getElementById('po_list').style.display = 'none';
        document.getElementById('btn_minimize').style.display = 'none';
        document.getElementById('po_detail').className = 'col-12';
        document.getElementById('btn_maximize').style.display = '';
    }

    function maximize() {
        document.getElementById('po_list').style.display = '';
        document.getElementById('btn_minimize').style.display = '';
        document.getElementById('po_detail').className = 'col-7';
        document.getElementById('btn_maximize').style.display = 'none';
    }

    function hide_detail_tbl() {
        let detail = document.getElementsByClassName('detail');
        for (let i = 0; i < detail.length; i++) {
            detail[i].style.display = 'none';

        }
    }

    function batal() {
        hide_detail_tbl();
    }
    </script>
</main><!-- End #main -->


<?= $this->endSection() ?>