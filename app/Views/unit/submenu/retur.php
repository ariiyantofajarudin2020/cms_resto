<?= $this->extend('layout/u_layout'); ?>
<?php $this->section('content'); ?>
<?php function rp($num) { $res='Rp.' .number_format($num, 0, '.' ,',') . ",-" ; return $res; } ?>
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

                            <h4 class="card-title">Daftar Penerimaan Barang</h4>
                            <!--tabel unit-->
                            <table class="table datatable tbl-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Receive ID</th>
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
                                        <td><span><?= $data['po']['id_rec'] ?></span></td>
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
                            <h4 class="card-title">Retur Barang</h4>

                            <?php 
                            if (empty($podata)) {
                                        echo 'Tidak ada data';
                                    }else{
                            foreach ($podata as $key => $v) {$key++;?>
                            <div class="row detail" id="detail<?=$key?>" style="display:none">
                                <form class="row g-3 needs-validation" novalidate method="post"
                                    action="<?= base_url('/unit/post/up_retur') ?>" onsubmit="return simpan(<?=$key?>)">
                                    <input type="hidden" name="id_induk" value="<?= $induk['id_induk'] ?>">
                                    <input type="hidden" name="wc" value="<?= $wc ?>">
                                    <input type="hidden" name="id" class="form-control" value="<?=$v['po']['id_po']?>"
                                        required>
                                    <input type="hidden" name="ret_harga" id="ret_harga<?=$key?>" value="0">
                                    <div class="col-6">
                                        <table class="table table-borderless tbl-sm">
                                            <tr>
                                                <th width="30%">ID Receive</th>
                                                <td><?=$v['po']['id_rec']?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Total Harga Beli</th>
                                                <td><?=rp($v['po']['po_harga'])?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Total Harga Retur</th>
                                                <td id="display_ret_harga<?=$key?>"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <table class="table table-borderless tbl-sm">
                                            <tr>
                                                <th width="30%">Tanggal</th>
                                                <td><?=$v['po']['rec_tanggal']?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Supplier</th>
                                                <td><?=$v['supplier']['supplier_nama']?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Alasan retur</th>
                                                <td><textarea class="form-control" name="ret_alasan" cols="15" rows="3"
                                                        required></textarea>
                                                    <div class="invalid-feedback">Tidak boleh kosong</div>
                                                </td>
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
                                                    <th>Qty Order</th>
                                                    <th>Qty Retur</th>
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
                                                    <td class="rec_harga<?=$key?>"><?=rp($i['rec_item_harga'])?></td>
                                                    <td><?=$i['item_satuan']?></td>
                                                    <td class="rec_qty<?=$key?>"><?=$i['rec_item_qty']?></td>
                                                    <td>
                                                        <input type="number" class="form-control ret_qty<?=$key?>"
                                                            style="width:80px" name="ret_qty[]" required
                                                            onchange="total(<?=$key?>)" value="0">
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
                                        <a type="button" class="btn btn-danger btn-sm"
                                            href="<?=base_url('/u/'.$wc.'?menu=pembelian&submenu=k2f4')?>">
                                            <i class="fa fa-back"></i> Batal
                                        </a>
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
    function simpan(key) {
        let rec_qtys = document.getElementsByClassName('rec_qty' + key);
        let ret_qtys = document.getElementsByClassName('ret_qty' + key);
        let total = 0;
        for (let i = 0; i < ret_qtys.length; i++) {
            let rec_qty = rec_qtys[i].innerHTML;
            let ret_qty = parseInt(ret_qtys[i].value);

            if (ret_qty > rec_qty) {
                alert("Qty retur tidak boleh melebihi Qty receive !!");
                return false;
            } else if (ret_qty < 0) {
                alert("Qty retur tidak boleh mines (-) !!");
                return false;
            } else {
                return confirm('Pastikan data sudah sesuai !, apakah data sudah sesuai ?');
            }
        }


    }

    function total(key) {
        let rec_harga = document.getElementsByClassName('rec_harga' + key);
        let qtys = document.getElementsByClassName('ret_qty' + key);
        let total = 0;
        for (let i = 0; i < qtys.length; i++) {
            let harga = rptoint(rec_harga[i].innerHTML);
            let qty = parseInt(qtys[i].value);

            let subTotal = harga * qty;
            total = total + subTotal;
        }
        document.getElementById('display_ret_harga' + key).innerHTML = RP(total);
        document.getElementById('ret_harga' + key).value = total;
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
    </script>
</main><!-- End #main -->


<?= $this->endSection() ?>